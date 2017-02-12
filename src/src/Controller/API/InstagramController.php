<?php

namespace App\Controller\API;

use App\API\ErrorResponse;
use App\API\ListResponse;
use App\InstagramApiService;
use App\Service\Instagram\ApiKeyAdapter\ApiAdapter;
use App\Service\Instagram\ApiKeySaver;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class InstagramController extends ApiController
{

    /** @var string  */
    const AUTH_PASS_HASH = '$2y$10$tjklmr.F083AXXEnqq8Aaue25DUfBaM3n6XMq5Pfo65NpgU7LxQmS';
    /** @var string  */
    const AUTH_CODE_API_EP = 'https://api.instagram.com/oauth/authorize/';

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    /**
     * @param InstagramApiService $api
     * @param Request $request
     * @return JsonResponse
     */
    public function list(InstagramApiService $api, Request $request): JsonResponse
    {
        $maxId = ($request->get('maxId')) ? $request->get('maxId') : '';

        try {
            $items = $api->getPostsStartingWith($maxId);
        } catch (\Exception $e) {
            $error = new ErrorResponse($e->getMessage());
            return new JsonResponse($error->jsonSerialize());
        }

        $nextPageMaxId = null;

        $response = new ListResponse($items, $nextPageMaxId, time());
        return new JsonResponse($response->jsonSerialize());
    }

    public function authCode(
        string $instagramClientId,
        string $instagramRedirectUri,
        string $sillyPasswordProtection,
        string $password
    ): Response {
        $hash = password_hash($sillyPasswordProtection, PASSWORD_DEFAULT);
        if (!password_verify($password, $hash)) {
            $this->logger->error('Someone tried to access Instagram AuthCode EP with a wrong passwword.', ['password' => $password]);
            return new Response('Route not found.', Response::HTTP_NOT_FOUND);
        }

        return new RedirectResponse(
            self::AUTH_CODE_API_EP
            . '?client_id=' . $instagramClientId
            . '&redirect_uri=' . $instagramRedirectUri
            . '&response_type=code',
            Response::HTTP_TEMPORARY_REDIRECT
        );
    }

    public function authToken(
        ApiAdapter $apiAdapter,
        ApiKeySaver $apiKeySaver,
        Request $request
    ): Response {
        $authCode = $request->query->get('code');

        try {
            $token = $apiAdapter->requestAccessToken($authCode);
            $apiKeySaver->save($token);
        } catch (Throwable $e) {
            $this->logger->error('Someone tried to access Instagram AuthToken EP with a wrong code.', ['authCode' => $authCode]);
            return new Response('Route not found.', Response::HTTP_NOT_FOUND);
        }

        return new Response('Cached a new API Key: ' . $token, Response::HTTP_NOT_FOUND);
    }

}
