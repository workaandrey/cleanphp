<?php

use SchoolStore\Domain\Entity\AttributeEntity;
use SchoolStore\Domain\Entity\CategoryEntity;
use SchoolStore\Domain\Entity\ProductEntity;
use SchoolStore\Domain\Entity\ValueEntity;

class EAVTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function itCanAddAttributeToProductEntity()
    {
        $categoryNotebooks = new CategoryEntity('Notebooks');

        $colorAttribute = new AttributeEntity('color');
        $colorSilver = new ValueEntity($colorAttribute, 'silver');
        $colorBlack = new ValueEntity($colorAttribute, 'black');

        $memoryAttribute = new AttributeEntity('memory');
        $memory8Gb = new ValueEntity($memoryAttribute, '8GB');

        $entity = new ProductEntity( $categoryNotebooks,'MacBook Pro', [$colorSilver, $colorBlack, $memory8Gb]);

        $this->assertEquals('Notebooks: MacBook Pro, color: silver, color: black, memory: 8GB', (string) $entity);
    }
}