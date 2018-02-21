<?php

namespace SchoolStore\Domain\Repository;

/**
 * Interface ProductRepositoryInterface
 * @package SchoolStore\Domain\Repository
 */
interface ProductRepositoryInterface extends RepositoryInterface
{
    public function getByCategoryId($categoryId);

    public function getByFilter(array $filter);
}