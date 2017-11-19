<?php

namespace Service;

use Exception;
use Model\InstaPost;

class InstagramAPIService
{
    const API_ENDPOINT = 'https://api.instagram.com/v1/users/self/media/recent/';
    const ACCESS_TOKEN = '2966022865.bc6804b.6e4a1949176a4769b219f2628a022c38';

    /**
     * @param string $postId
     * @return InstaPost[]
     */
    public function getPostsUntilId(string $postId = '')
    {
        $fetchedPosts = [];
        $startQueryFromPost = '';

        while (true) {
            try {
                $singleApiQuery = $this->getPostsStartingWith($startQueryFromPost);
            } catch (Exception $e) {
                error_log($e->getMessage());
                break;
            }

            $lastItemKey = count($singleApiQuery) - 1;

            foreach ($singleApiQuery as $key => $post) {
                if ($post->getId() === $postId) {
                    break 2;
                }
                if ($lastItemKey === $key) {
                    $startQueryFromPost = $post->getId();
                    break 1;
                }
                array_push($fetchedPosts, $post);
            }
        }

        return $fetchedPosts;
    }

    /**
     * @param string $skip_until
     * @return InstaPost[]
     */
    private function getPostsStartingWith(string $skip_until = '') {
        if ($skip_until) {
            $apiData = $this->sendRequest($this::API_ENDPOINT.'?max_id='.$skip_until.'&access_token='.$this::ACCESS_TOKEN);
        } else {
            $apiData = $this->sendRequest($this::API_ENDPOINT.'?access_token='.$this::ACCESS_TOKEN);
        }

        return $this->transformResponse($apiData);
    }

    /**
     * Ensure that API is called at most once in 15 minutes, compared to the last cache update.
     *
     * @param string $lastCacheTimestamp
     * @return bool
     */
    public function isAllowedToCallAPI(string $lastCacheTimestamp)
    {
        $now = time();
        $timeDifference = $now - $lastCacheTimestamp;
        if ($timeDifference > 900) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param string $url
     * @return array
     * @throws Exception
     */
    private function sendRequest(string $url) {
        date_default_timezone_set("Europe/Belgrade");
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3");
        $data = curl_exec($ch);
        curl_close($ch);

        if (!$data) {
            throw new Exception('Server Connection failed.');
        }

        $response = json_decode($data, true);

        if ($response === null && json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('Unexpected Response');
        } else if (array_key_exists('error_message', $response)) {
            throw new Exception($response['error_message']);
        } else if (!array_key_exists('data', $response) || empty($response['data'])) {
            throw new Exception('JSON does not contain posts');
        }

        return $response;
    }

    /**
     * @param array $response
     * @return InstaPost[]
     */
    private function transformResponse(array $response)
    {
        $transformer = $this->getInstaPostTransformer();
        $adaptedResponse = [];

        foreach ($response['data'] as $post) {
            array_push($adaptedResponse, [
                'image' => $post['images']['standard_resolution']['url'],
                'link' => $post['link'],
                'id' => $post['id']
            ]);
        }

        return $transformer->arrayToPosts($adaptedResponse);
    }

    /**
     * @return InstaPostTransformer
     */
    private function getInstaPostTransformer()
    {
        return new InstaPostTransformer();
    }

}
