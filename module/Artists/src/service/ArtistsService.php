<?php

namespace Artists\service;

use Artists\repository\ArtistsRepository;

class ArtistsService
{
    private $artistsRepo;

    public function getArtistsId($artistName):bool
    {
        $this->artistsRepo=new ArtistsRepository();
        $isArtist =  $this->artistsRepo->findByName($artistName);

        return $isArtist!==false;
    }
}