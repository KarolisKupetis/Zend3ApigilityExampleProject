<?php

namespace Artists\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Albums\Entity\AlbumEntity;

/**
 * Class ArtistEntity
 * @package Artists\entity
 * @ORM\Entity
 * @ORM\Table(name="artists")
 */
class ArtistEntity
{

    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id")
     */
    private $id;

    /**
     * @ORM\Column(name="artistName")
     */
    private $artistName;

    /**
     * @return int
     */

    /**
     * @ORM\OneToMany(targetEntity="Albums\entity\AlbumEntity", mappedBy="artist")
     */
    private $albums;

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getArtistName(): string
    {
        return $this->artistName;
    }

    /**
     * @param string $artistName
     */
    public function setArtistName(string $artistName)
    {
        $this->artistName = $artistName;
    }

    /**
     * @param AlbumEntity $album
     */
    public function addAlbum(AlbumEntity $album)
    {
        $this->albums[]=$album;
    }

    /**
     * @return ArrayCollection
     */
    public function getAlbums():ArrayCollection
    {
        return $this->albums;
    }
}