<?php

namespace Service;

use Model\InstaPost;

class InstagramService
{

    /**
     * @return array
     */
    public function getPosts()
    {
        return $this->getCacheService()->GetCache();
    }

    /**
     * @param InstaPost[] $posts
     */
    public function acceptPosts($posts)
    {
        $cs = $this->getCacheService();
        $cache = $cs->GetCache();

        $combinedPosts = array_merge($posts, $cache['posts']);

        $cs->setCache($combinedPosts);
    }

    /**
     * @return CacheService
     */
    private function getCacheService()
    {
        return new CacheService();
    }

}
