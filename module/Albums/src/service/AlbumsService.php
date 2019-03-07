<?php


namespace Albums\service;

use Albums\repository\AlbumsRepository;
use Albums\entity\AlbumsEntity;
use APISpotify\V1\Rest\Artist\ArtistService;
use ZF\ApiProblem\ApiProblem;
use Artists\service\ArtistsService;

class AlbumsService
{
    /**
     * @var AlbumsRepository
     */
    private $albumRepository;

    /**
     * @var ArtistsService
     */
    private $artistService;


    /**
     * AlbumService constructor.
     * @param AlbumsRepository $repo
     * @param ArtistsService $artistService
     */
    public function __construct(AlbumsRepository $repo, ArtistsService $artistService)
    {
        $this->albumRepository = $repo;
        $this->artistService = $artistService;
    }

    /**
     * @param array $albumParameters
     * @return ApiProblem|null
     */
    public function createNewAlbum(array $albumParameters)
    {
        $album = $this->albumRepository->findByTitle($albumParameters['title']);

        $artist = $this->artistService->getArtistsId($albumParameters['artist']);

        if ($album) {

            return new ApiProblem(409, 'Album already exists');
        }

        if ($artist) {

            $newAlbum = new AlbumsEntity();
            $newAlbum->setArtist($albumParameters['artist']);
            $newAlbum->setTitle($albumParameters['title']);
            $newAlbum->setReleaseDate($albumParameters['releaseDate']);

            $this->albumRepository->insertAlbum($newAlbum);
            return null;
        }

        return new ApiProblem(404, 'Artist does not exist');

    }
}