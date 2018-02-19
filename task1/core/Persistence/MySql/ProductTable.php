<?php
namespace SchoolStore\Persistence\MySql;

use SchoolStore\Domain\Repository\ProductRepositoryInterface;

class ProductTable extends AbstractTable implements ProductRepositoryInterface
{
    protected $table = 'products';

    public function getAll()
    {
        $products = parent::getAll();
        //TODO: load attributes values
        return $products;
    }
}