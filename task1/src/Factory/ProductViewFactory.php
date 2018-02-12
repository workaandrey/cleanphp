<?php
namespace SchoolStore\Factory;

use SchoolStore\Entity\ProductEntity;
use SchoolStore\View\ProductView;

interface ProductViewFactory
{
    /**
     * @param ProductEntity $entity
     * @return ProductView
     */
    public function create(ProductEntity $entity);
}