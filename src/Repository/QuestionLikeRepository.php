<?php

namespace App\Repository;

use App\Entity\Question;
use App\Entity\QuestionLike;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method QuestionLike|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuestionLike|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuestionLike[]    findAll()
 * @method QuestionLike[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionLikeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuestionLike::class);
    }

     /**
      * @return QuestionLike[] Returns an array of QuestionLike objects
      */

    public function findByQuestionUser($q_id, $u_id)
    {
        $result = $this->createQueryBuilder('q')
            ->select('q', 'question', 'user')
            ->leftJoin('q.question', 'question')
            ->leftJoin('q.user', 'user')
            ->where('question.id = :q_id')
            ->andWhere('user.id = :u_id')
            ->setParameter('q_id', $q_id)
            ->setParameter('u_id', $u_id)
            ->getQuery()
            ->getResult()
        ;
//        dd($result);

        return $result;
    }


    /*
    public function findOneBySomeField($value): ?QuestionLike
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
