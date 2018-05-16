<?php

namespace AppBundle\Repository;

use AppBundle\DTO\PushMessageDTO;
use AppBundle\Entity\PushMessageHistory;
use AppBundle\Entity\User;
use DateTime;
use Doctrine\ORM\EntityRepository;

/**
 * @author mathil <github.com/mathil>
 */
class PushMessageHistoryRepository extends EntityRepository
{


    /**
     * @param PushMessageDTO $pushMessageDTO
     * @param array $result
     * @param User $user
     */
    public function save(PushMessageDTO $pushMessageDTO, array $result, User $user): void
    {
        $history = (new PushMessageHistory())
            ->setMessage($pushMessageDTO->getMessage())
            ->setSubject($pushMessageDTO->getSubject())
            ->setAction($pushMessageDTO->getAction())
            ->setUrl($pushMessageDTO->getUrl())
            ->setSentDate(new DateTime())
            ->setSender($user)
            ->setReceivedFailCount($result['fail'])
            ->setReceivedSuccessCount($result['success']);
        $this->getEntityManager()->persist($history);
        $this->getEntityManager()->flush();
    }
}
