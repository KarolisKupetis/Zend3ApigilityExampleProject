<?php

namespace Albums\Creator;

use Albums\Entity\AlbumEntity;
use Doctrine\ORM\EntityManager;

class AlbumCreator
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
     * @param array $albumParameters
     *
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function insertAlbum(array $albumParameters): void
    {
        $newAlbum = $this->createEntity($albumParameters);

        $this->entityManager->persist($newAlbum);
        $this->entityManager->flush();
    }

    /**
     * @param array $albumParameters
     *
     * @return AlbumEntity
     */
    private function createEntity(array $albumParameters): AlbumEntity
    {
        $newAlbum = new AlbumEntity();
        $newAlbum->setTitle($albumParameters['title']);
        $newAlbum->setArtist($albumParameters['artist']);
        $newAlbum->setReleaseDate($albumParameters['releaseDate']);

        return $newAlbum;
    }
}