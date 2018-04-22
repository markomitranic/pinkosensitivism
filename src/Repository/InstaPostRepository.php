<?php

namespace App\Repository;

use App\Entity\InstaPost;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

/**
 * @method InstaPost|null find($id, $lockMode = null, $lockVersion = null)
 * @method InstaPost|null findOneBy(array $criteria, array $orderBy = null)
 * @method InstaPost[]    findAll()
 * @method InstaPost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InstaPostRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, InstaPost::class);
    }

    /**
     * @return InstaPost[]
     * @throws ResourceNotFoundException
     */
    public function findAllPostsSortByDate()
    {
        $qb = $this->createQueryBuilder('InstaPost');

        $results = $qb
            ->orderBy('InstaPost.dateTime', 'DESC')
            ->getQuery()
            ->getResult();

        if (!isset($results) || empty($results)) {
            throw new ResourceNotFoundException('There seem to be no InstaPosts in the database.');
        }

        return $results;
    }
}
