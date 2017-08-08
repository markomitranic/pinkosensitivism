<?php

namespace Service;

class InstagramAPIService
{
    const API_ENDPOINT = 'https://www.instagram.com/pinkosensitivism/media/';

    /**
     * @param string $skip_post
     * @return string
     */
    public function getPostsStartingWith(string $skip_post = '') {
        if ($skip_post) {
            $apiData = $this->sendRequest(InstagramAPIService::API_ENDPOINT.'?max_id='.$skip_post);
        } else {
            $apiData = $this->sendRequest(InstagramAPIService::API_ENDPOINT);
        }
        return $apiData;
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

}
