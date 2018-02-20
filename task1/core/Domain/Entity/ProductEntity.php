<?php

namespace SchoolStore\Domain\Entity;

/**
 * Class ProductEntity
 * @package SchoolStore\Entity
 */
class ProductEntity extends AbstractEntity
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var \SplObjectStorage
     */
    private $values;

    /**
     * @var CategoryEntity
     */
    private $category;

    /**
     * ProductEntity constructor.
     * @param $id
     * @param $name
     * @param CategoryEntity $category
     * @param ValueEntity[] $values
     */
    public function __construct($id, $name, CategoryEntity $category,  $values)
    {
        $this->id = $id;
        $this->category = $category;
        $this->values = new \SplObjectStorage();
        $this->name = $name;

        foreach ($values as $value) {
            $this->values->attach($value);
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $text = [$this->category->getName() . ': ' . $this->name];

        foreach ($this->values as $value) {
            $text[] = (string) $value;
        }

        return join(', ', $text);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $attributes = [];
        foreach ($this->values as $value) {
            $attributes = array_merge($attributes, $value->toArray());
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'category' => $this->category->toArray(),
            'attributes' => $attributes
        ];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return \SplObjectStorage
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @param $values
     * @return $this
     */
    public function setValues($values)
    {
        $this->values = $values;
        return $this;
    }

    /**
     * @return CategoryEntity
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param $category
     * @return $this
     */
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }

}