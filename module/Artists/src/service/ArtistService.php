<?php

namespace Artists\service;

use Artists\repository\ArtistRepository;

class ArtistService
{
    private $artistsRepo;

    public function getArtistsId($artistName)
    {
        $this->artistsRepo=new ArtistRepository();
        $isArtist =  $this->artistsRepo->findByName($artistName);

        if($isArtist!==false)
        {
            return $isArtist;
        }

        return false;
    }
}