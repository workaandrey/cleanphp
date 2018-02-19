<?php
namespace SchoolStore\Domain\Entity;

/**
 * Class ValueEntity
 * @package SchoolStore\Domain\Entity
 */
class ValueEntity
{
    /**
     * @var AttributeEntity
     */
    private $attribute;

    /**
     * @var string
     */
    private $name;

    public function __construct(AttributeEntity $attribute, $name)
    {
        $this->name = $name;
        $this->attribute = $attribute;

        $attribute->addValue($this);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf('%s: %s', $this->attribute, $this->name);
    }
}