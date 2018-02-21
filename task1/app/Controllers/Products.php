<?php

namespace SchoolStore\App\Controllers;

use Http\Request;
use Http\Response;
use SchoolStore\Domain\Repository\AttributeRepositoryInterface;
use SchoolStore\Domain\Repository\ProductRepositoryInterface;

/**
 * Class Homepage
 * @package SchoolStore\App\Controllers
 */
class Products
{
    /**
     * @var ProductRepositoryInterface
     */
    protected $productRepository;
    /**
     * @var Request
     */
    private $request;
    /**
     * @var Response
     */
    private $response;

    /**
     * Products constructor.
     * @param Request $request
     * @param Response $response
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(
        Request $request,
        Response $response,
        ProductRepositoryInterface $productRepository
    ) {
        $this->request = $request;
        $this->response = $response;
        $this->productRepository = $productRepository;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return $this->response->setContent(json_encode([
            'products' => $this->productRepository->getAll()
        ]));
    }

    /**
     * @param AttributeRepositoryInterface $attributeRepository
     * @return mixed
     */
    public function search(AttributeRepositoryInterface $attributeRepository)
    {
        $filter = $this->request->getParameter('filter', []);
        if(empty($filter)) {
            $products = $this->productRepository->getAll();
        } else {
            $attributes = array_map(function($attribute) {
                return $attribute['name'];
            }, $attributeRepository->getAll());
            array_map(function($filterParamKey) use($attributes) {
                if(!in_array($filterParamKey, $attributes)) {
                    throw new \Exception(sprintf('Unsupported filter parameter "%s"', $filterParamKey));
                }
            }, array_keys($filter));
            $products = $this->productRepository->getByFilter($filter);
        }

        return $this->response->setContent(json_encode([
            'products' => $products
        ]));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function byCategory($id)
    {
        return $this->response->setContent(json_encode([
            'products' => $this->productRepository->getByCategoryId($id)
        ]));
    }
}