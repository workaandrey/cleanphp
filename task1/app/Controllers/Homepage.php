<?php

namespace SchoolStore\App\Controllers;

use Http\Request;
use Http\Response;
use SchoolStore\Domain\Entity\ProductEntity;
use SchoolStore\Domain\Repository\AttributeRepositoryInterface;
use SchoolStore\Domain\Repository\CategoryRepositoryInterface;
use SchoolStore\Domain\Repository\ProductRepositoryInterface;
use SchoolStore\Domain\Repository\ValueRepositoryInterface;

/**
 * Class Homepage
 * @package SchoolStore\App\Controllers
 */
class Homepage
{
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;
    /**
     * @var AttributeRepositoryInterface
     */
    private $attributeRepository;
    /**
     * @var ValueRepositoryInterface
     */
    private $valueRepository;
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
        Response $response,
        CategoryRepositoryInterface $categoryRepository,
        ProductRepositoryInterface $productRepository,
        AttributeRepositoryInterface $attributeRepository,
        ValueRepositoryInterface $valueRepository
    ) {
        $this->request = $request;
        $this->response = $response;
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->attributeRepository = $attributeRepository;
        $this->valueRepository = $valueRepository;
    }

    /**
     * @return array
     */
    public function index()
    {
        return $this->response->setContent(json_encode([
            'products' => $this->productRepository->getAll()
        ]));
    }
}