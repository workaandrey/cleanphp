<?php

namespace SchoolStore\Persistence\MySql;


use SchoolStore\Domain\Repository\AttributeRepositoryInterface;

class AttributeTable extends AbstractTable implements AttributeRepositoryInterface
{
    protected $table = 'attributes';

    /**
     * @return array
     */
    public function getAttributesMap()
    {
        $attributesMap = [];
        foreach ($this->getAll() as $attribute) {
            $attributesMap = array_merge($attributesMap, [$attribute['name'] => $attribute['id']]);
        }

        return $attributesMap;
    }
}