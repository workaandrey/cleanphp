<?php

namespace SchoolStore\App\Controllers;

use Http\Request;
use Http\Response;
use SchoolStore\Domain\Repository\ProductRepositoryInterface;

/**
 * Class Homepage
 * @package SchoolStore\App\Controllers
 */
class Products
{
    /**
     * @var Request
     */
    private $request;
    /**
     * @var Response
     */
    private $response;

    public function __construct(
        Request $request,
        Response $response
    ) {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @param ProductRepositoryInterface $productRepository
     * @return mixed
     */
    public function index(ProductRepositoryInterface $productRepository)
    {
        return $this->response->setContent(json_encode([
            'products' => $productRepository->getAll()
        ]));
    }

    /**
     * @param ProductRepositoryInterface $productRepository
     * @param $id
     * @return mixed
     */
    public function byCategory(ProductRepositoryInterface $productRepository, $id)
    {
        return $this->response->setContent(json_encode([
            'products' => $productRepository->getByCategoryId($id)
        ]));
    }
}