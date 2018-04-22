<?php

namespace App;

use App\Entity\InstaPost;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Psr\Log\LoggerInterface;

class InstagramService
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var PostUploadService
     */
    private $postUploadService;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(
        EntityManagerInterface $entityManager,
        PostUploadService $postUploadService,
        LoggerInterface $logger
    ) {
        $this->entityManager = $entityManager;
        $this->postUploadService = $postUploadService;
        $this->logger = $logger;
    }

    /**
     * Persists posts, while overwriting any existing ones.
     * @param InstaPost $post
     * @throws \Exception
     */
    public function persistPostOverwrite(InstaPost $post) {
        $repository = $this->entityManager->getRepository('App:InstaPost');
        $duplicates = $repository->findBy([
            'instagramId' => $post->getInstagramId()
        ]);

        foreach ($duplicates as $duplicate) {
            $this->entityManager->remove($duplicate);
        }
        $this->entityManager->flush();

        $persistedFile = $this->postUploadService->uploadPost(
            $post->getThumbnailUrl()
        );
        $post->setThumbnail($persistedFile);

        $this->entityManager->persist($post);
        $this->entityManager->flush();
    }

    /**
     * Persist post without overwriting. If an existing post is encountered, skip.
     * @param InstaPost $post
     * @return bool Is the post persisted?
     * @throws \Exception
     */
    public function persistPost(InstaPost $post) {
        $repository = $this->entityManager->getRepository('App:InstaPost');
        $duplicates = $repository->findBy([
            'instagramId' => $post->getInstagramId()
        ]);

        if (count($duplicates) > 0) {
            return false;
        }

        $persistedFile = $this->postUploadService->uploadPost(
            $post->getThumbnailUrl()
        );
        $post->setThumbnail($persistedFile);

        $this->entityManager->persist($post);
        $this->entityManager->flush();
        return true;
    }

}