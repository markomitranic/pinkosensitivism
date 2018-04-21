<?php

namespace App;


use App\Entity\InstaPost;
use App\Transformer\InstaPostTransformer;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use Psr\Container\ContainerInterface;
use Symfony\Component\DependencyInjection\Container;

class InstagramApiService
{

    const API_ENDPOINT = 'https://api.instagram.com/v1/users/self/media/recent/';

    /**
     * @var Client
     */
    private $api;

    /**
     * @var Container
     */
    private $container;

    /**
     * @var string
     */
    private $apiKey;

    public function __construct(
        ContainerInterface $container
    ) {
        $this->container = $container;
        $this->apiKey = $this->container->getParameter('instagram.apikey');
        $this->api = new Client([
            'base_uri' => self::API_ENDPOINT,
        ]);
    }

    /**
     * @param string $skip_until
     * @return InstaPost[]
     * @throws RequestException
     * @throws Exception
     */
    public function getPostsStartingWith(string $skip_until = '') {
        if ($skip_until) {
            $apiData = $this->sendRequest($this::API_ENDPOINT.'?max_id='.$skip_until.'&access_token='.$this->apiKey);
        } else {
            $apiData = $this->sendRequest($this::API_ENDPOINT.'?access_token='.$this->apiKey);
        }

        return $this->transformResponse($apiData);
    }

    /**
     * @param string $url
     * @return array
     * @throws Exception
     * @throws RequestException
     */
    private function sendRequest(string $url) {

        try {
            $response = $this->api->get($url);
        } catch (RequestException $e) {
            Logger::getLogger()->error('Cannot contact Instagram API: '.$e->getMessage());
            throw $e;
        }

        if ($response->getStatusCode() === 200) {
            $data = json_decode($response->getBody(), true);
        } else {
            Logger::getLogger()->error('Request returned but not 200');
            throw new Exception('Request returned but not 200');
        }

        if (json_last_error() !== JSON_ERROR_NONE) {
            Logger::getLogger()->error('Unable to deserialize JSON response.');
            throw new Exception('Unable to deserialize JSON response.');
        }

        if (array_key_exists('error_message', $data)) {
            Logger::getLogger()->error('Instagram returned an error.');
            throw new Exception('Instagram returned an error.');
        }

        if (!array_key_exists('data', $data) || empty($data['data'])) {
            Logger::getLogger()->error('JSON does not contain posts.');
            throw new Exception('JSON does not contain posts.');
        }

        return $data;
    }

    /**
     * @param array $response
     * @return InstaPost[]
     */
    private function transformResponse(array $response)
    {
        $transformer = $this->getInstaPostTransformer();
        /** @var InstaPost[] $transformed */
        $transformed = [];

        foreach ($response['data'] as $post) {
            try {
                $transformed[] = $transformer->hydrate($post);
            } catch (Exception $e) {
                continue;
            }
        }

        return $transformed;
    }

    /**
     * @return InstaPostTransformer
     */
    private function getInstaPostTransformer()
    {
        return new InstaPostTransformer();
    }

}
