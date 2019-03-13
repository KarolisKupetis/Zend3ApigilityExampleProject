<?php
namespace SpotifyAPI\V1\Rest\Artist;

use Artists\Service\ArtistService;
use Psr\Container\ContainerInterface;

class ArtistResourceFactory
{
    public function __invoke(ContainerInterface $services)
    {
        $albumService = $services->get(ArtistService::class);

        return new ArtistResource($albumService);
    }
}
