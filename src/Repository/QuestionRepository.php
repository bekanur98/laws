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

//    public function findTop5Answered()
//    {
//        $sub_query = '(SELECT COUNT(t.id) FROM BlogPostTag t WHERE blog_post_id = '.$id.')';
//
//        $query = $this->createQuery('q')
//            ->select('q.*')
//            ->addSelect($sub_query.' as nb_tags') // the number of tags will be in the nb_tags variable
//            ->where('bp.id = ?', $id);
//
//        $result = $this->createQueryBuilder('q')
//            ->select('q', 'answers')
//            ->leftJoin('q.answers', 'answers')
//            ->orderBy('q.views', 'DESC')
//            ->setMaxResults(5)
//            ->getQuery()
//            ->getResult()
//        ;
//
//        return $result;
//    }
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
