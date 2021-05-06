<?php

namespace App\Repository;

use App\Entity\Question;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Question|null find($id, $lockMode = null, $lockVersion = null)
 * @method Question|null findOneBy(array $criteria, array $orderBy = null)
 * @method Question[]    findAll()
 * @method Question[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Question::class);
    }

    public function findTop5NewQuestions()
    {
        return $this->createQueryBuilder('q')
            ->orderBy('q.created_at', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findTop5Visited()
    {
        return $this->createQueryBuilder('q')
            ->orderBy('q.views', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findAnswered()
    {
        return $this->createQueryBuilder('q')
            ->where('q.is_answered = 1')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findUnanswered()
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.is_answered = 0')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findTop5HighestRated() {
        return $this->createQueryBuilder('q')
            ->orderBy('q.rating', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByTag($q_tag) {
        return $this->createQueryBuilder('q')
            ->select('q', 'tags')
            ->leftJoin('q.tags', 'tags')
            ->andWhere('tags.name LIKE :q_tag')
            ->setParameter('q_tag', '%'.$q_tag.'%')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findAllQuestions() {
        return $this->createQueryBuilder('q')
            ->select('q', 'ql', 'user')
            ->leftJoin('q.questionLikes', 'ql')
            ->leftJoin('ql.user', 'user')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findTop5MostAnswered() {
        return $this->createQueryBuilder('q')
            ->select('q')
            ->leftJoin('q.answers', 'a')
            ->groupBy('q.id')
            ->orderBy('count(a.question)', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Question[] Returns an array of Question objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Question
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
