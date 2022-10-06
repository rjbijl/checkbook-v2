<?php

namespace App\Repository;

use App\Entity\Mutation;
use App\Model\Mutation\Filter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class MutationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mutation::class);
    }

    /**
     * @return array<Mutation>
     */
    public function findWithFilter(Filter $filter): array
    {
        $qb = $this->createQueryBuilder('m')
            ->orderBy('m.date', 'ASC')
        ;

        if ($startDate = $filter->getStartDate()) {
            $qb->andWhere('m.date >= :startDate')
                ->setParameter('startDate', $startDate)
            ;
        }

        if ($endDate = $filter->getEndDate()) {
            $qb->andWhere('m.date <= :endDate')
                ->setParameter('endDate', $endDate)
            ;
        }

        if ($category = $filter->getCategory()) {
            $qb->andWhere('m.category = :category')
                ->setParameter('category', $category)
            ;
        }

        return $qb->getQuery()->getResult();
    }
}
