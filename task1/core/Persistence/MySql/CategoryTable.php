<?php
namespace SchoolStore\Persistence\MySql;

use SchoolStore\Domain\Repository\CategoryRepositoryInterface;

class CategoryTable extends AbstractTable implements CategoryRepositoryInterface
{
    protected $table = 'categories';
}