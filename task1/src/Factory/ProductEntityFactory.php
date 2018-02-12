<?php

namespace SchoolStore\Factory;

use SchoolStore\Entity\ProductEntity;

interface ProductEntityFactory
{
    /**
     * @param $name
     * @param $description
     * @param $category
     * @return ProductEntity
     */
    public function create($name, $description, $category);
}