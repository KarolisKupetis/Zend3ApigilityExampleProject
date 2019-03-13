<?php

namespace Artists\Creator;

use Artists\Entity\ArtistEntity;
use Doctrine\ORM\EntityManager;

class ArtistCreator
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * AlbumCreator constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param array $artistParameters
     *
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function insertArtist(array $artistParameters): void
    {
        $newArtist = $this->createEntity($artistParameters);

        $this->entityManager->persist($newArtist);

        $this->entityManager->flush();
    }

    /**
     * @param array $artistParameters
     *
     * @return ArtistEntity
     */
    private function createEntity(array $artistParameters): ArtistEntity
    {
        $newArtist = new ArtistEntity();
        $newArtist->setArtistName($artistParameters['artistName']);

        return $newArtist;
    }
}