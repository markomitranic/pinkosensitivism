<?php

namespace Service;

use Exception;
use Model\InstaPost;

class InstagramAPIService
{
    const API_ENDPOINT = 'https://api.instagram.com/v1/users/self/media/recent/';
    const ACCESS_TOKEN = '50080987.9ab283e.d8a0bd72733d4c289f5b2c311a09b118';

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
     * @param string $lastCacheTimestamp
     * @return bool
     */
    public function isAllowedToCallAPI(string $lastCacheTimestamp)
    {
        $now = time();
        $timeDifference = $now - $lastCacheTimestamp;
        if ($timeDifference > 3600) {
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
        } else if (!array_key_exists('items', $response) || !empty($response['items'])) {
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

        foreach ($response['items'] as $post) {
            array_push($adaptedResponse, [
                'image' => $post['images']['standard_resolution']['url'],
                'code' => $post['code'],
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
