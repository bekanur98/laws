<?php

namespace App\Repository;

use App\Entity\AnswerLike;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AnswerLike|null find($id, $lockMode = null, $lockVersion = null)
 * @method AnswerLike|null findOneBy(array $criteria, array $orderBy = null)
 * @method AnswerLike[]    findAll()
 * @method AnswerLike[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnswerLikeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AnswerLike::class);
    }

     /**
      * @return AnswerLike[] Returns an array of AnswerLike objects
      */

    public function findByAnswerUser($a_id, $u_id)
    {
        $result =  $this->createQueryBuilder('a')
            ->select('a', 'answer', 'user')
            ->leftJoin('a.answer', 'answer')
            ->leftJoin('a.user', 'user')
            ->where('answer.id = :a_id')
            ->andWhere('user.id = :u_id')
            ->setParameter('a_id', $a_id)
            ->setParameter('u_id', $u_id)
            ->getQuery()
            ->getResult()
        ;

        return $result;
    }

    /*
    public function findOneBySomeField($value): ?AnswerLike
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
