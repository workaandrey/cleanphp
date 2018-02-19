<?php

namespace SchoolStore\Domain\Repository;

use SchoolStore\Domain\Entity\AbstractEntity;

/**
 * Interface RepositoryInterface
 * @package SchoolStore\Domain\Repository
 */
interface RepositoryInterface
{
    /**
     * @param int $id
     * @return mixed
     */
    public function getById($id);

    /**
     * @return array
     */
    public function getAll();

    /**
     * @param AbstractEntity $entity
     * @return $this
     */
    public function persist(AbstractEntity $entity);

}
