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
        $transformer = $this->getInstaPostTransformer();
        $cache = $cs->GetCache();

        $combinedPosts = array_merge($posts, $cache['posts']);
        $posts = [];

        foreach ($combinedPosts as $hydratedPost) {
            array_push($posts, $transformer->transform($hydratedPost));
        }

        $cs->setCache($posts);
    }

    /**
     * @return InstaPostTransformer
     */
    private function getInstaPostTransformer()
    {
        return new InstaPostTransformer();
    }

    /**
     * @return CacheService
     */
    private function getCacheService()
    {
        return new CacheService();
    }

}
