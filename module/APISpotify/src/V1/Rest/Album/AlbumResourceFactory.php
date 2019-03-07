<?php
namespace APISpotify\V1\Rest\Album;

use Interop\Container\ContainerInterface;

class AlbumResourceFactory
{
    public function __invoke(ContainerInterface $services)
    {
        /** @var AlbumService $albumService */
        $albumService = $services->get(AlbumService::class);

        return new AlbumResource($albumService);
    }
}
