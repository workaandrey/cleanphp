<?php
namespace SchoolStore\UseCase;

use SchoolStore\MessageStream\ViewProductsMessageStream;
use SchoolStore\Repository\ProductRepository;
use SchoolStore\Factory\ProductViewFactory;

final class ViewProductsUseCase
{
    /**
     * @var ProductRepository
     */
    private $productRepository;
    /**
     * @var ProductViewFactory
     */
    private $productViewFactory;

    /**
     * ViewEntriesUseCase constructor.
     * @param ProductRepository $productRepository
     * @param ProductViewFactory $productViewFactory
     */
    public function __construct(ProductRepository $productRepository, ProductViewFactory $productViewFactory)
    {
        $this->productRepository = $productRepository;
        $this->productViewFactory = $productViewFactory;
    }


    public function process(ViewProductsMessageStream $messageStream)
    {
        $entries = $this->productRepository->findAllPaginated($messageStream->getOffset(), $messageStream->getLimit());
        if (!$entries) {
            return;
        }

        foreach ($entries as $product) {
            $productView = $this->productViewFactory->create($product);
            $messageStream->addEntry($productView);
        }
    }
}