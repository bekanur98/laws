<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(UserInterface $user, string $newEncodedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newEncodedPassword);
        $this->_em->persist($user);
        $this->_em->flush();
    }

    public function findLawyersByAlph()
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.is_lawyer = true')
            ->orderBy('u.username', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findLawyersByRegTime()
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.is_lawyer = true')
            ->orderBy('u.createdAt', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findLawyersByRating()
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.is_lawyer = true')
            ->orderBy('u.law_rating', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findNotLawyersByAlph()
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.is_lawyer = false')
            ->orderBy('u.username', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findNotLawyersByRegTime()
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.is_lawyer = false')
            ->orderBy('u.createdAt', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findNotLawyersByRating()
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.is_lawyer = false')
            ->orderBy('u.law_rating', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findLawyers()
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.is_lawyer = true')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findNotLawyers()
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.is_lawyer = false')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findTop3Users()
    {
        return $this->createQueryBuilder('u')
//            ->select('u', 'q')
//            ->leftJoin('u.questions', 'q')
            ->andWhere('u.is_lawyer = false')
            ->orderBy('u.law_rating', 'DESC')
//            ->addOrderBy('q.rating', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
