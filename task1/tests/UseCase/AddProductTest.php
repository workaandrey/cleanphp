<?php
use SchoolStore\Fake\Factory\FakeProductEntityFactory;
use SchoolStore\Fake\MessageStream\FakeAddProductMessageStream;
use SchoolStore\Fake\Repository\FakeProductRepository;
use SchoolStore\Fake\Validator\FakeAddProductValidator;
use SchoolStore\UseCase\AddProductUseCase;

class AddProductTest extends \PHPUnit\Framework\TestCase
{
    public function testProductSaved()
    {
        $messageStream = new FakeAddProductMessageStream('Book Name', 'Book Description', 'Books');
        $addProductValidator = new FakeAddProductValidator();
        $productFactory = new FakeProductEntityFactory();
        $productRepository = new FakeProductRepository();
        $useCase = new AddProductUseCase($addProductValidator, $productFactory, $productRepository);
        $useCase->process($messageStream);

        $this->assertNotEmpty($messageStream->name);
        $this->assertNotEmpty($messageStream->description);
        $this->assertNotEmpty($messageStream->category);

    }
}