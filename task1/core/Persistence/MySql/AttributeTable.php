<?php

namespace SchoolStore\Persistence\MySql;


use SchoolStore\Domain\Repository\AttributeRepositoryInterface;

class AttributeTable extends AbstractTable implements AttributeRepositoryInterface
{
    protected $table = 'attributes';
}