<?php
namespace SpotifyAPI\V1\Rest\Artist;

use Artists\Service\ArtistService;
use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;

class ArtistResource extends AbstractResourceListener
{
    /**
     * @var ArtistService
     */
    private $artistService;

    /**
     * ArtistResource constructor.
     *
     * @param ArtistService $artistService
     */
    public function __construct(ArtistService $artistService)
    {
        $this->artistService = $artistService;
    }

    /**
     * @param mixed $data
     *
     * @return mixed|void|ApiProblem
     * @throws \Artists\Exceptions\ArtistException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create($data)
    {
        $artistParams = [];
        $artistParams['artistName'] = $data->artistName;
        $this->artistService->createNewArtist($artistParams);
    }
}
