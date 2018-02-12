<?php
namespace SchoolStore\Repository;

use SchoolStore\Entity\ProductEntity;

interface ProductRepository
{
    /**
     * @param $offset
     * @param $limit
     * @return ProductEntity[]|null
     */
    public function findAllPaginated($offset, $limit);

    public function add(ProductEntity $entry);
}