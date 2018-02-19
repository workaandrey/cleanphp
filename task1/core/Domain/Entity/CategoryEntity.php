<?php

namespace SchoolStore\Domain\Entity;

/**
 * Class CategoryEntity
 * @package SchoolStore\Domain\Entity
 */
class CategoryEntity extends AbstractEntity
{
    /**
     * @var string
     */
    private $name;

    /**
     * @return mixed
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
}