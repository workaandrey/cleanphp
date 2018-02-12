<?php

namespace SchoolStore\Fake\MessageStream;

use SchoolStore\MessageStream\AddProductMessageStream;

class FakeAddProductMessageStream implements AddProductMessageStream
{
    public $name = '';
    public $description = '';
    public $category = '';

    /**
     * FakeAddProductMessageStream constructor.
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
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

}