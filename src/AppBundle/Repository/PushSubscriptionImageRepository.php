<?php

namespace AppBundle\Repository;

use Exception;

class PushSubscriptionImageRepository extends \Doctrine\ORM\EntityRepository
{

    public function findByIds(array $ids)
    {
        return $this->createQueryBuilder('i')
            ->select('i')
            ->where('i.id IN (:param)')
            ->setParameter('param', $ids)
            ->getQuery()
            ->getResult();
    }

    public function getIdsAndNamesArray()
    {
        return $this->createQueryBuilder('i')
            ->select('i.id, i.name')
            ->getQuery()
            ->getResult();
    }

}
