<?php

namespace Service;

use Model\InstaPost;

class InstagramAPIService
{
    const API_ENDPOINT = 'https://www.instagram.com/pinkosensitivism/media/';


    /**
     * @param string $postId
     * @return InstaPost[]
     */
    public function getPostsUntilId(string $postId = '')
    {
        $fetchedPosts = [];
        $startQueryFromPost = '';

        while (true) {
            $singleApiQuery = $this->getPostsStartingWith($startQueryFromPost);
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
            $apiData = $this->sendRequest(InstagramAPIService::API_ENDPOINT.'?max_id='.$skip_until);
        } else {
            $apiData = $this->sendRequest(InstagramAPIService::API_ENDPOINT);
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
     * @return string
     */
    private function sendRequest(string $url) {
        date_default_timezone_set("Europe/Belgrade");
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3");
        $data = curl_exec($ch);
        curl_close($ch);
        if (!$data) { die('Connection Error'); }
        return $data;
    }

    /**
     * @param string $response
     * @return InstaPost[]
     */
    private function transformResponse(string $response)
    {
        $response = json_decode($response, true);
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

        return $transformer->arrayToPosts($adaptedResponse);;
    }

    /**
     * @return InstaPostTransformer
     */
    private function getInstaPostTransformer()
    {
        return new InstaPostTransformer();
    }

}
