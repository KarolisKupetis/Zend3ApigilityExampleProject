<?php

namespace Artists\Repository;

use Doctrine\ORM\EntityRepository;
use PDO;

class ArtistRepository extends EntityRepository
{
    /**
     * @param int $artistId
     *
     * @return object|null
     */
    public function findById(int $artistId)
    {
        return $this->find($artistId);
    }

    /**
     * @param string $name
     *
     * @return object|null
     */
    public function findByName(string $name)
    {
        return $this->findOneBy(['artistName' => $name]);
    }

    /**
     *
     * @param string $name
     */
    public function getByName(string $name): void
    {

    }
}