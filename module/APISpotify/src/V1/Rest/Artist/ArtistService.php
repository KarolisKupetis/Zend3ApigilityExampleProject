<?php


namespace APISpotify\V1\Rest\Artist;


class ArtistService
{
    private $artistsRepo;

    public function getArtistsId($artistName):bool
    {
        $this->artistsRepo=new ArtistRepository();
        $isArtist =  $this->artistsRepo->findByName($artistName);

        return $isArtist!==false;
    }
}