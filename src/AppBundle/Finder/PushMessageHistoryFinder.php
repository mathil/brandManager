<?php

namespace AppBundle\Finder;

use AppBundle\Enum\FormEnum;
use DateTime;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * @author mathil <github.com/mathil>
 */
class PushMessageHistoryFinder implements FinderInterface
{

    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return string
     */
    public function getAlias(): string
    {
        return 'pmhf';
    }

    /**
     * @param array $parameters
     * @return array
     */
    public function getData(array $parameters): array
    {
        $initColumns = ['sent_date', 'subject', 'message', 'action', 'received_success_count', 'received_fail_count'];
        $columns = [];
        foreach ($initColumns as &$column) {
            $columns[] = $this->getAlias().'.'.$column;
        }

        $queryBuilder = $this->connection->createQueryBuilder()
            ->select($columns)
            ->from('push_message_history', $this->getAlias())
            ->setMaxResults($parameters['length'])
            ->setFirstResult($parameters['start'])
            ->orderBy($columns[$parameters['order'][0]['column']], $parameters['order'][0]['dir']);

        $queryBuilder = $this->buildSearchCriteria($parameters['search'], $queryBuilder);

        $result = $queryBuilder->execute()->fetchAll();
        $data = ['data' => []];
        foreach ($result as $res) {
            $row = [];
            foreach ($initColumns as $column) {
                $row[] = $res[$column];
            }
            $data['data'][] = $row;
        }

        return $data;
    }

    /**
     * @param array $criteria
     * @param QueryBuilder $queryBuilder
     * @return QueryBuilder
     */
    private function buildSearchCriteria(array $criteria, QueryBuilder $queryBuilder): QueryBuilder
    {
        $value = $criteria['value'];

        if ($value === FormEnum::CLEAR_SEARCH_FORM) {
            return $queryBuilder;
        }

        $form = [];
        parse_str($value, $form);
        foreach ($form as $formName => $data) {
            if ($data['dateFrom'] !== '' && $data['dateTo'] !== '') {
                $queryBuilder->andWhere(
                    $this->getAlias().'.sent_date >= :dateFrom AND '.$this->getAlias().'.sent_date <= :dateTo'
                );
            } else {
                if ($data['dateFrom'] !== '') {
                    $queryBuilder->andWhere($this->getAlias().'.sent_date >= :dateFrom');
                } else {
                    if ($data['dateTo'] !== '') {
                        $queryBuilder->andWhere($this->getAlias().'.sent_date <= :dateTo');
                    }
                }
            }
            if ($data['subject'] !== '') {
                $queryBuilder->andWhere($this->getAlias().'.subject like :subject');
            }
            if ($data['message'] !== '') {
                $queryBuilder->andWhere($this->getAlias().'.message like :message');
            }
            $queryBuilder->setParameters(
                [
                    'dateFrom' => (new DateTime($data['dateFrom'].' 00:00:00'))->format('Y-m-d H:i:s'),
                    'dateTo' => (new DateTime($data['dateTo'].'23:59:59'))->format('Y-m-d H:i:s'),
                    'subject' => '%'.$data['subject'].'%',
                    'message' => '%'.$data['message'].'%',
                ]
            );
        }

        return $queryBuilder;
    }

}
