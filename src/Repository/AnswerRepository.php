<?php

namespace App\Repository;

use App\Entity\Answer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Answer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Answer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Answer[]    findAll()
 * @method Answer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnswerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Answer::class);
    }

     /**
      * @return Answer[] Returns an array of Answer objects
      */
    public function findByQuestion($qst)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.question = :qst')
            ->setParameter('qst', $qst)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findSortedAnswers($qst)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.question = :qst')
            ->setParameter('qst', $qst)
            ->orderBy('a.isCorrect', 'DESC')
            ->addOrderBy('a.rating', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }

    /*
    public function findOneBySomeField($value): ?Answer
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
