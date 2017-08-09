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
            $this->getNewData();
//            $cache = $this->getCacheService()->GetCache();
        }

        return $cache;
    }

    private function getNewData()
    {
        $instagramData = $this->getInstagramApiService()->getPostsStartingWith();


        //// SVE JE GOTOVO ON SAD TREBA DA IZBROJI KOLIKO POSTOVA SME DA DODA NA SPISAK IDA SNIMI TO
//        $instagramData = $this->filterNewPosts()

//        $this->acceptPosts()
    }

    /**
     * @param string $lastCachedPostId
     * @return array
     */
    private function filterNewPosts(string $lastCachedPostId)
    {
        return [];
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
