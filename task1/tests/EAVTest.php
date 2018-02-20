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
        $categoryNotebooks = new CategoryEntity(1, 'Notebooks');

        $colorAttribute = new AttributeEntity(1, 'color');
        $colorSilver = new ValueEntity($colorAttribute, 1, 'silver');
        $colorBlack = new ValueEntity($colorAttribute, 2, 'black');

        $memoryAttribute = new AttributeEntity(1, 'memory');
        $memory8Gb = new ValueEntity($memoryAttribute, 3,'8GB');

        $entity = new ProductEntity( 1,'MacBook Pro', $categoryNotebooks, [$colorSilver, $colorBlack, $memory8Gb]);

        $this->assertEquals('Notebooks: MacBook Pro, color: silver, color: black, memory: 8GB', (string) $entity);
    }
}