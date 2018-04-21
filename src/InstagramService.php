<?php

namespace App;


use App\Entity\InstaPost;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

class InstagramService
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(
        EntityManagerInterface $entityManager,
        LoggerInterface $logger
    ) {
        $this->entityManager = $entityManager;
        $this->logger = $logger;
    }

    /**
     * @param InstaPost $post
     */
    public function persistPost(InstaPost $post) {
        $repository = $this->entityManager->getRepository('App:InstaPost');
        $duplicates = $repository->findBy([
            'instagramId' => $post->getInstagramId()
        ]);

        foreach ($duplicates as $duplicate) {
            $this->entityManager->remove($duplicate);
        }
        $this->entityManager->flush();

        $this->entityManager->persist($post);
        $this->entityManager->flush();
    }

}