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
        $cache = $this->getCacheService()->GetCache();

        if ($this->getInstagramApiService()->isAllowedToCallAPI($cache['last_cache'])) {
            $lastCachedPostId = ($cache['posts'][0]->getId()) ? $cache['posts'][0]->getId() : '';
            $fetchedData = $this->getInstagramApiService()->getPostsUntilId($lastCachedPostId);

            $cache = $this->acceptPosts($fetchedData, $cache);
        }

        return $cache;
    }

    /**
     * @param InstaPost[] $newPosts
     * @param null $cachedPosts
     * @return array
     */
    public function acceptPosts($newPosts, $cachedPosts = null)
    {
        $cs = $this->getCacheService();

        if (null === $cachedPosts) {
            $cachedPosts = $cs->GetCache();
        }

        $combinedPosts = array_merge($newPosts, $cachedPosts['posts']);

        $cs->setCache($combinedPosts);

        return [
            'last_update'   => time(),
            'posts'         => $combinedPosts
        ];
    }

    /**
     * @return CacheService
     */
    private function getCacheService()
    {
        return new CacheService();
    }

    /**
     * @return InstagramAPIService
     */
    private function getInstagramApiService()
    {
        return new InstagramAPIService();
    }

    /**
     * @return InstaPostTransformer
     */
    private function getInstaPostTransformer()
    {
        return new InstaPostTransformer();
    }

}
