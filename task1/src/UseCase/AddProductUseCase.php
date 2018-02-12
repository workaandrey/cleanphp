<?php

namespace SchoolStore\UseCase;

use SchoolStore\Factory\ProductEntityFactory;
use SchoolStore\MessageStream\AddProductMessageStream;
use SchoolStore\Repository\ProductRepository;
use SchoolStore\Validator\AddProductValidator;

final class AddProductUseCase
{
    /**
     * @var AddProductValidator
     */
    private $addProductValidator;
    /**
     * @var ProductEntityFactory
     */
    private $productEntityFactory;
    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * AddProductUseCase constructor.
     * @param AddProductValidator $addProductValidator
     * @param ProductEntityFactory $productEntityFactory
     * @param ProductRepository $productRepository
     */
    public function __construct(AddProductValidator $addProductValidator, ProductEntityFactory $productEntityFactory, ProductRepository $productRepository)
    {
        $this->addProductValidator = $addProductValidator;
        $this->productEntityFactory = $productEntityFactory;
        $this->productRepository = $productRepository;
    }


    public function process(AddProductMessageStream $messageStream)
    {
        $this->addProductValidator->setMessageStream($messageStream);

        if (!$this->addProductValidator->isValid()) {
            return;
        }
        $product = $this->productEntityFactory->create($messageStream->getName(), $messageStream->getDescription(), $messageStream->getCategory());
        if(!$product){
            return;
        }
        $this->productRepository->add($product);
    }
}