<?php

namespace SchoolStore\Entity;

class ProductEntity
{
    private $name = '';
    private $description = '';
    private $category = '';

    /**
     * ProductEntity constructor.
     * @param $name
     * @param $description
     * @param $category
     */
    public function __construct($name, $description, $category)
    {
        $this->name = $name;
        $this->description = $description;
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }


}