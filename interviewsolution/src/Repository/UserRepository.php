<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;


/**
 * @extends ServiceEntityRepository<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findUsersByFilters(?bool $isActive = null, ?bool $isMember = null, ?string $lastLoginAtFrom = null, ?string $lastLoginAtTo = null, ?array $userTypes = null): array
    {
        $qb = $this->createQueryBuilder('u');

        if ($isActive !== null) {
            $qb->andWhere('u.isActive = :isActive')
               ->setParameter('isActive', $isActive);
        }

        if ($isMember !== null) {
            $qb->andWhere('u.isMember = :isMember')
               ->setParameter('isMember', $isMember);
        }

        if ($lastLoginAtFrom !== null) {
            $qb->andWhere('u.lastLoginAt >= :fromDate')
               ->setParameter('fromDate', new \DateTimeImmutable($lastLoginAtFrom));
        }

        if ($lastLoginAtTo !== null) {
            $qb->andWhere('u.lastLoginAt <= :toDate')
               ->setParameter('toDate', new \DateTimeImmutable($lastLoginAtTo));
        }

        if ($userTypes !== null && !empty($userTypes)) {
            $qb->andWhere('u.userType IN (:userTypes)')
               ->setParameter('userTypes', $userTypes);
        }

        return $qb->getQuery()->getResult();
    }
}
