<?php

namespace Artists\Service;

use Artists\Creator\ArtistCreator;
use Artists\Exceptions\ArtistException;
use Artists\Repository\ArtistRepository;

class ArtistService
{
    /**
     * @var ArtistRepository
     */
    private $repository;
    /**
     * @var ArtistCreator
     */
    private $artistCreator;

    /**
     * ArtistService constructor.
     *
     * @param ArtistRepository $repository
     * @param ArtistCreator    $artistCreator
     */
    public function __construct(
        ArtistRepository $repository,
        ArtistCreator $artistCreator
    ) {
        $this->repository = $repository;
        $this->artistCreator = $artistCreator;
    }

    /**
     * @param $artistName
     *
     * @return object|null
     */
    public function findByName($artistName)
    {
        return $this->repository->findByName($artistName);
    }

    /**
     * @param array $artistParameters
     *
     * @throws ArtistException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createNewArtist(array $artistParameters): void
    {
        if ($this->repository->findByName($artistParameters['artistName'])) {
            throw new ArtistException('Artist already exists');
        }

        $this->artistCreator->insertArtist($artistParameters);
    }
}