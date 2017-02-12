<?php

namespace App\Service\Instagram\ApiKeyAdapter;

use Exception;
use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;
use Throwable;

class ApiAdapter
{

    /** @var string  */
    const API_BASE = 'https://api.instagram.com/oauth/access_token';

    /**
     * @var Client
     */
    private $api;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $clientSecret;

    /**
     * @var string
     */
    private $redirectUri;

    public function __construct(
        LoggerInterface $logger,
        string $clientId,
        string $clientSecret,
        string $redirectUri
    ) {
        $this->api = new Client([
            'base_uri' => self::API_BASE,
        ]);
        $this->logger = $logger;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->redirectUri = $redirectUri;
    }

    /**
     * @throws Exception
     */
    public function requestAccessToken(string $authCode): string
    {
        try {
            $response = $this->api->post(
                '',
                [
                    'form_params' => [
                        'client_id' => $this->clientId,
                        'client_secret' => $this->clientSecret,
                        'redirect_uri' => $this->redirectUri,
                        'grant_type' => 'authorization_code',
                        'code' => $authCode
                    ]
                ]
            );

            $token = json_decode($response->getBody()->getContents(), true)['access_token'];
        } catch (Throwable $e) {
            $this->logger->error('Cannot contact Instagram API. HTTP Error.', ['exception' => $e]);
            throw new Exception('Cannot contact Instagram API.');
        }

        return $token;
    }
}
