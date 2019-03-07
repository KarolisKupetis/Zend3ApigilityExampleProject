<?php
namespace APISpotify\V1\Rest\Album;
use Interop\Container\ContainerInterface;
use Albums\service\AlbumsService;

class AlbumResourceFactory
{
    public function __invoke(ContainerInterface $services)
    {
        /** @var AlbumsService $albumService */
        $albumService = $services->get(AlbumsService::class);

        return new AlbumResource($albumService);
    }
}
