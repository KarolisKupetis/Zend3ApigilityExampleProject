<?php

namespace Albums\Service;

use Albums\Creator\AlbumCreator;
use Albums\Exceptions\AlbumExceptions;
use Albums\Repository\AlbumRepository;
use Artists\Exceptions\ArtistException;
use Artists\Service\ArtistService;

class AlbumService
{
    /**
     * @var AlbumRepository
     */
    private $albumRepository;

    /**
     * @var ArtistService
     */
    private $artistService;
    /**
     * @var AlbumCreator
     */
    private $albumCreator;


    /**
     * AlbumService constructor.
     *
     * @param AlbumRepository $repo
     * @param ArtistService   $artistService
     * @param AlbumCreator    $albumCreator
     */
    public function __construct(
        AlbumRepository $repo,
        ArtistService $artistService,
        AlbumCreator $albumCreator
    ) {
        $this->albumRepository = $repo;
        $this->artistService = $artistService;
        $this->albumCreator = $albumCreator;
    }

    /**
     * @param array $albumParameters
     *
     * @throws AlbumExceptions
     * @throws ArtistException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createNewAlbum(array $albumParameters): void
    {
        $album = $this->albumRepository->findByTitle($albumParameters['title']);

        $artist = $this->artistService->findByName($albumParameters['artist']);

        if ($album) {
            throw new AlbumExceptions('Album already exists');
        }

        if ($artist) {
            $albumParameters['artist'] = $artist;
            $this->albumCreator->insertAlbum($albumParameters);
        } else {

            throw new ArtistException('Artist does not exist');
        }
    }
}