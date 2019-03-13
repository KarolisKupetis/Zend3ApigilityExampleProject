<?php

namespace Artists\Entity;

use Albums\Entity\AlbumEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="Artists\Repository\ArtistRepository")
 * @ORM\Table(name="artists")
 */
class ArtistEntity
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="id")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=256, name="artist_name")
     */
    private $artistName;

    /**
     * @return int
     */

    /**
     * @ORM\OneToMany(targetEntity="Albums\Entity\AlbumEntity", mappedBy="artist")
     */
    private $albums;


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }


    /**
     * @param int $id
     */
    public function setId(int $id): void
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
    public function setArtistName(string $artistName): void
    {
        $this->artistName = $artistName;
    }

    /**
     * @param AlbumEntity $album
     */
    public function addAlbum(AlbumEntity $album): void
    {
        $this->albums[] = $album;
    }

    /**
     * @return ArrayCollection
     */
    public function getAlbums(): ArrayCollection
    {
        return $this->albums;
    }
}