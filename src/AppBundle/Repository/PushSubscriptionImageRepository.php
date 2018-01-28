<?php

namespace AppBundle\Repository;



class PushSubscriptionImageRepository extends \Doctrine\ORM\EntityRepository
{

    /**
     * @param array $ids
     * @return array
     */
    public function findByIds(array $ids): array
    {
        return $this->createQueryBuilder('i')
            ->select('i')
            ->where('i.id IN (:param)')
            ->setParameter('param', $ids)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return array
     */
    public function getIdsAndNamesArray(): array
    {
        return $this->createQueryBuilder('i')
            ->select('i.id, i.name')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->createQueryBuilder('i')
            ->select('COUNT(i.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }

}
