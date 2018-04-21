<?php

namespace App\Transformer;

use App\Entity\InstaPost;
use App\Logger;

class InstaPostTransformer
{

    /**
     * @param InstaPost $post
     * @return array
     */
    public function transform(InstaPost $post)
    {
        return $post->jsonSerialize();
    }

    /**
     * @param array $post
     * @return InstaPost
     * @throws \Exception
     */
    public function hydrate(array $post) {
        $instaPost = new InstaPost();

        try {
            $instaPost->setId($post['id']);
            $instaPost->setType($post['type']);
            $instaPost->setLink($post['link']);
            $instaPost->setThumbnailUrl($post['images']['standard_resolution']['url']);
            $instaPost->setLikeCount($post['likes']['count']);
            $instaPost->setCommentCount($post['comments']['count']);

            if ($instaPost->getType() === InstaPost::TYPE_VIDEO) {
                $instaPost->setVideoUrl($post['videos']['standard_resolution']['url']);
            }
        } catch (\Exception $e) {
            Logger::getLogger()->error('Cannot hydrate InstaPost: '.$e->getMessage());
            throw $e;
        }

        return $instaPost;
    }
}