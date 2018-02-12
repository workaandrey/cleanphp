<?php
namespace SchoolStore\Fake\Factory;

use SchoolStore\Entity\ProductEntity;
use SchoolStore\Fake\View\FakeProductView;
use SchoolStore\View\ProductView;
use SchoolStore\Factory\ProductViewFactory;

class FakeProductViewFactory implements ProductViewFactory
{
    /**
     * @param ProductEntity $entity
     * @return ProductView
     */
    public function create(ProductEntity $entity)
    {

        $view = new FakeProductView();
        $view->name = $entity->getName();
        $view->description = $entity->getDescription();
        $view->category = $entity->getCategory();
        return $view;
    }
}