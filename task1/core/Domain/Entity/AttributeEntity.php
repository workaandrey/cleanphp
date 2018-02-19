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
     * @param $name
     */
    public function __construct($name)
    {
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