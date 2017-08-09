<?php

namespace Service;

use Model\InstaPost;

class CacheService
{

    /**
     * @return string
     */
    private function getCacheLocation()
    {
        return dirname(__DIR__).'/cache.json';
    }

    /**
     * @return array
     */
    public function GetCache() {
        if (!file_exists($this->getCacheLocation())) {
            $this->createFile();
        }

        $cache = json_decode(file_get_contents($this->getCacheLocation()), true);

        return [
            'last_cache'    => $cache['last_cache'],
            'posts'         => $this->getInstaPostTransformer()->arrayToPosts($cache['posts'])
        ];
    }

    /**
     * @param array $newCache
     */
    public function setCache(array $newCache)
    {
        $this->overwriteFile([
            'last_cache' => time(),
            'posts' => $this->getInstaPostTransformer()->postsToArray($newCache)
        ]);
    }

    /**
     * Creates a brand new empty file.
     */
    private function createFile() {
        $this->overwriteFile([
            'last_cache' => time(),
            'posts' => array()
        ]);
    }

    /**
     * @param array $content
     */
    private function overwriteFile(array $content) {
        $fp = fopen($this->getCacheLocation(), 'w');
        fwrite($fp, json_encode($content));
        fclose($fp);
    }

    /**
     * @return InstaPostTransformer
     */
    private function getInstaPostTransformer()
    {
        return new InstaPostTransformer();
    }

}