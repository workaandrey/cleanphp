<?php

namespace SchoolStore\Persistence\MySql;

use SchoolStore\Domain\Repository\ValueRepositoryInterface;

class ValueTable extends AbstractTable implements ValueRepositoryInterface
{
    protected $table = 'values';
}