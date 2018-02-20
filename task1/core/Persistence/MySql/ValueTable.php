<?php

namespace SchoolStore\Persistence\MySql;

use SchoolStore\Domain\Repository\ValueRepositoryInterface;

class ValueTable extends AbstractTable implements ValueRepositoryInterface
{
    protected $table = 'values';

    /**
     * @param $id
     * @return array
     */
    public function getAllByProductId($id)
    {
        $sth = $this->gateway->prepare("select * from `{$this->table}` where product_id = :id");
        $sth->execute([':id' => $id]);
        $rows = $sth->fetchAll(\PDO::FETCH_ASSOC);
        return $rows;
    }
}