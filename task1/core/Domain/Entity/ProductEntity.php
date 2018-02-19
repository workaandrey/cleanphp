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
     * @param CategoryEntity $category
     * @param string $name
     * @param ValueEntity[] $values
     */
    public function __construct(CategoryEntity $category, $name, $values)
    {
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