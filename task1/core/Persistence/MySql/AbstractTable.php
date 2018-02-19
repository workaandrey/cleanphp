<?php

namespace SchoolStore\Persistence\MySql;

use SchoolStore\Domain\Entity\AbstractEntity;
use SchoolStore\Domain\Repository\RepositoryInterface;

abstract class AbstractTable implements RepositoryInterface
{
    /**
     * @var \PDO
     */
    protected $gateway;

    /**
     * @var
     */
    protected $table = '';

    /**
     * @var
     */
    protected $entityClass = '';

    /**
     * AbstractTable constructor.
     * @param $gateway
     */
    public function __construct(\PDO $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * @param int $id
     * @return array|\ArrayObject|bool|null
     */
    public function getById($id)
    {
        $count = $this->gateway->prepare("select * from {$this->table} where id=:id");
        $count->bindParam(":id", $id);
        if(!$count->execute()) {
            return null;
        }

        return $count->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * @return array
     */
    public function getAll()
    {
        $res = $this->gateway->query("select * from {$this->table}");
        $rows = [];
        while ($row = $res->fetch(\PDO::FETCH_ASSOC)) {
            $rows[] = $row;
        }
        return $rows;
    }

    /**
     * @param AbstractEntity $entity
     * @return $this|AbstractEntity
     */
    public function persist(AbstractEntity $entity)
    {

    }
}