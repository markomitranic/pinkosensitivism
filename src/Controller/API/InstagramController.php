<?php

namespace App\Controller\API;

use App\API\ErrorResponse;
use App\API\ListResponse;
use App\InstagramApiService;
use App\Logger;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class InstagramController extends ApiController
{

    /**
     * @var InstagramApiService
     */
    private $api;

    public function __construct(
        InstagramApiService $api,
        LoggerInterface $logger
    ) {
        $this->api = $api;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request)
    {
        $maxId = ($request->get('maxId')) ? $request->get('maxId') : '';

        try {
            $items = $this->api->getPostsStartingWith($maxId);
        } catch (\Exception $e) {
            $error = new ErrorResponse($e->getMessage());
            return new JsonResponse($error->jsonSerialize());
        }

        $nextPageMaxId = null;

        $response = new ListResponse($items, $nextPageMaxId, time());
        return new JsonResponse($response->jsonSerialize());
    }

}