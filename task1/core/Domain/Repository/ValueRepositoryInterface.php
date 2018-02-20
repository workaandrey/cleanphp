<?php

namespace SchoolStore\Domain\Repository;

/**
 * Interface ValueRepositoryInterface
 * @package SchoolStore\Domain\Repository
 */
interface ValueRepositoryInterface extends RepositoryInterface
{

    public function getAllByProductId($id);

}
