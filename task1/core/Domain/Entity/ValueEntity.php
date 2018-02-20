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
    private $value;

    /**
     * ValueEntity constructor.
     * @param AttributeEntity $attribute
     * @param $id
     * @param $value
     */
    public function __construct(AttributeEntity $attribute, $id, $value)
    {
        $this->value = $value;
        $this->id = $id;
        $this->attribute = $attribute;

        $attribute->addValue($this);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf('%s: %s', $this->attribute, $this->value);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            (string) $this->attribute => $this->value
        ];
    }
}