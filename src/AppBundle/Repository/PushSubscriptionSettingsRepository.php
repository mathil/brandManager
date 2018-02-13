<?php

namespace AppBundle\Repository;

use PDO;

class PushSubscriptionSettingsRepository extends \Doctrine\ORM\EntityRepository
{

    /**
     * @param int $userId
     * @return string|null
     */
    public function getPublicKeyForUser(int $userId): ?string
    {
        return $this->createQueryBuilder('s')
            ->select('s.publicKey')
            ->join('s.client', 'c')
            ->join('c.users', 'u')
            ->where('u.id = :userId')
            ->setParameter('userId', $userId, PDO::PARAM_INT)
            ->getQuery()
            ->getOneOrNullResult(PDO::FETCH_BOTH);
    }

    /**
     * @return string
     */
    public function getAlias(): string
    {
        return 'pss';
    }

}
