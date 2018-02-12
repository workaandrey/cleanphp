<?php

use SchoolStore\Entity\ProductEntity;
use SchoolStore\Fake\Factory\FakeProductViewFactory;
use SchoolStore\Fake\MessageStream\FakeViewProductsMessageStream;
use SchoolStore\Fake\Repository\FakeProductRepository;
use SchoolStore\UseCase\ViewProductsUseCase;

class ListProductsTest extends PHPUnit\Framework\TestCase
{
    public function testProductsNotExists()
    {
        $entries = [];
        $request = new FakeViewProductsMessageStream(5);
        $response = $this->processUseCase($request, $entries);
        $this->assertEmpty($response->entries);
    }

    public function testCanSeeProducts()
    {
        $entries = [
            new ProductEntity('Book Name', 'Short Description', 'Books')
        ];
        $request = new FakeViewProductsMessageStream(5);
        $response = $this->processUseCase($request, $entries);
        $this->assertNotEmpty($response->entries);
    }

    public function testCanSeeFiveProducts()
    {
        $entities = [];
        for ($i = 0; $i < 10; $i++) {
            $entities[] = new ProductEntity('Book Name ' . $i, 'Short Description', 'Books');
        }
        $request = new FakeViewProductsMessageStream(5);
        $response = $this->processUseCase($request, $entities);
        $this->assertNotEmpty($response->entries);
        $this->assertSame(5, count($response->entries));
    }

    /**
     * @param $messageStream
     * @param $entries
     * @return FakeViewProductsMessageStream
     */
    private function processUseCase($messageStream, $entries)
    {
        $repository = new FakeProductRepository($entries);
        $factory = new FakeProductViewFactory();
        $useCase = new ViewProductsUseCase($repository, $factory);
        $useCase->process($messageStream);
        return $messageStream;
    }
}