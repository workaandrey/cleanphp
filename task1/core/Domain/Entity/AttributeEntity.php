<?php

namespace SchoolStore\Domain\Entity;

/**
 * Class AttributeEntity
 * @package SchoolStore\Domain\Entity
 */
class AttributeEntity extends AbstractEntity
{
    /**
     * @var \SplObjectStorage
     */
    private $values;

    /**
     * @var string
     */
    private $name;

    /**
     * AttributeEntity constructor.
     * @param $id
     * @param $name
     */
    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->values = new \SplObjectStorage();
        $this->name = $name;
    }

    public function addValue(ValueEntity $value)
    {
        $this->values->attach($value);
    }

    /**
     * @return \SplObjectStorage
     */
    public function getValues()
    {
        return $this->values;
    }

    public function __toString()
    {
        return $this->name;
    }
}