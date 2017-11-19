<?php

namespace Service;

use Model\InstaPost;

class InstagramService
{

    /**
     * Simply returns the full post cache from the disk.
     *
     * @return array
     */
    public function getCache()
    {
        return $this->getCacheService()->GetCache();
    }

    /**
     * Updates the cache on disk, if needed.
     */
    public function updateCache()
    {
        $cache = $this->getCache();

        /** @var InstaPost $latestPost */
        $latestPost = $cache['posts'][0];

        $now = date('d.m.Y H:i:s', time());

        if ($this->getInstagramApiService()->isAllowedToCallAPI($cache['last_cache'])) {
            $lastCachedPostId = ($latestPost->getId()) ? $latestPost->getId() : '';
            $fetchedData = $this->getInstagramApiService()->getPostsUntilId($lastCachedPostId);
            $newCache = $this->addPostsToCache($fetchedData, $cache);
        }

        if (isset($newCache) && $newCache !== $cache) {
            fwrite(STDOUT, "[$now] Updated Cache".PHP_EOL);
            error_log("[$now] Updated Cache");
            return true;
        } else {
            fwrite(STDOUT, "[$now] Cache Update failed, no new posts.".PHP_EOL);
            error_log("[$now] Cache Update failed, no new posts.");
            return false;
        }

    }

    /**
     * @param InstaPost[] $newPosts
     * @param null $cachedPosts
     * @return array
     */
    public function addPostsToCache($newPosts, $cachedPosts = null)
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

}
