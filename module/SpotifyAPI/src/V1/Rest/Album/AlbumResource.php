<?php

namespace SpotifyAPI\V1\Rest\Album;

use Albums\Exceptions\AlbumExceptions;
use Albums\Service\AlbumService;
use Artists\Exceptions\ArtistException;
use DeepCopy\f001\A;
use Doctrine\ORM\OptimisticLockException;
use Zend\Validator\Date;
use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;

class AlbumResource extends AbstractResourceListener
{
    /**
     * @var AlbumService
     */
    private $albumService;

    /**
     * AlbumResource constructor.
     *
     * @param AlbumService $albumService
     */
    public function __construct(AlbumService $albumService)
    {
        $this->albumService = $albumService;
    }


    /**
     * @param mixed $data
     *
     * @return mixed|ApiProblem
     * @throws OptimisticLockException
     */
    public function create($data)
    {
        $albumParameters = [];
        $albumParameters['title'] = $data->title;
        $albumParameters['artist'] = $data->artist;

        try {
            $releaseDate = new \DateTime($data->releaseDate);
        } catch (\Exception $e) {
            return new ApiProblem(409, 'Wrong date format');
        }

        $albumParameters['releaseDate'] = $releaseDate;

        $this->albumService->createNewAlbum($albumParameters);

        return null;
    }
}
