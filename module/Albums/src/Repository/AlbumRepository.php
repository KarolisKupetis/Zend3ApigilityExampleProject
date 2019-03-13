<?php

namespace Albums\Repository;

use Doctrine\ORM\EntityRepository;

class AlbumRepository extends EntityRepository
{
    /**
     * @param string $title
     *
     * @return object|null
     */
    public function findByTitle(string $title)
    {
        return $this->findOneBy(['title' => $title]);
    }
}