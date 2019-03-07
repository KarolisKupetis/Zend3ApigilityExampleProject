<?php
namespace APISpotify\V1\Rest\Artist;

class ArtistResourceFactory
{
    public function __invoke($services)
    {
        return new ArtistResource();
    }
}
