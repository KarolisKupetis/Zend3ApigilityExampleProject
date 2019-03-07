<?php


namespace APISpotify\V1\Rest\Album;


use APISpotify\V1\Rest\Artist\ArtistService;
use ZF\ApiProblem\ApiProblem;

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
     * AlbumService constructor.
     * @param AlbumRepository $repo
     * @param ArtistService $artistService
     */
    public function __construct(AlbumRepository $repo, ArtistService $artistService)
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

            $newAlbum = new AlbumEntity();
            $newAlbum->setArtist($albumParameters['artist']);
            $newAlbum->setTitle($albumParameters['title']);
            $newAlbum->setReleaseDate($albumParameters['releaseDate']);

            $this->albumRepository->insertAlbum($newAlbum);
            return null;
        }

        return new ApiProblem(404, 'Artist does not exist');

    }
}