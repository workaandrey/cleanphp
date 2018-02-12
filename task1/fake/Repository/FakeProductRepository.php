<?php

namespace SchoolStore\Fake\Repository;

use SchoolStore\Entity\ProductEntity;
use SchoolStore\Repository\ProductRepository;

class FakeProductRepository implements ProductRepository
{
    private $entries = [];

    public function __construct(array $entries = [])
    {
        $this->entries = $entries;
    }

    public function findAllPaginated($offset, $limit)
    {
        return array_splice($this->entries, $offset, $limit);
    }

    public function add(ProductEntity $entry)
    {
        $this->entries[]=$entry;
    }

}