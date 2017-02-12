<?php

namespace App\Transformer;

use App\Entity\InstaPost;
use App\PostUploadService;
use DateTime;
use Psr\Log\LoggerInterface;

class InstaPostTransformer
{

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var PostUploadService
     */
    private $postUploadService;

    public function __construct(
        LoggerInterface $logger,
        PostUploadService $postUploadService
    ) {
        $this->logger = $logger;
        $this->postUploadService = $postUploadService;
    }

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
            $instaPost->setInstagramId($post['id']);
            $instaPost->setType($post['type']);
            $instaPost->setLink($post['link']);
            $instaPost->setThumbnailUrl($post['images']['standard_resolution']['url']);
            $instaPost->setLikeCount($post['likes']['count']);
            $instaPost->setCommentCount($post['comments']['count']);
            $instaPost->setDateTime((new DateTime())->setTimestamp($post['created_time']));
        } catch (\Exception $e) {
            $this->logger->error('Cannot hydrate InstaPost: '.$e->getMessage());
            throw $e;
        }

        return $instaPost;
    }
}