<?php

namespace Albums\Entity;

use Doctrine\ORM\Mapping as ORM;

use Artists\Entity\ArtistEntity;


/**
 * @ORM\Entity
 * @ORM\Table(name="albums")
 */
class AlbumEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id")
     */
    private $id;

    /**
     * @ORM\Column(name="title")
     */
    private $title;

    /**
     * Many features have one product. This is the owning side.
     * @ORM\ManyToOne(targetEntity="Artists\Entity\ArtistEntity", inversedBy="albums")
     * @ORM\JoinColumn(name="artist", referencedColumnName="id")
     */
    private $artist;

    /**
     * @ORM\Column(name="releaseDate")
     */
    private $releaseDate;

    /**
     * @return int
     */
    public function getId():int
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
    public function getTitle():string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getArtist():ArtistEntity
    {
        return $this->artist;
    }

    /**
     * @param ArtistEntity $artist
     */
    public function setArtist(ArtistEntity $artist)
    {
        $this->artist = $artist;
        $artist->addAlbum($this);
    }

    /**
     * @return string
     */
    public function getReleaseDate():string
    {
        return $this->releaseDate;
    }

    /**
     * @param string $releaseDate
     */
    public function setReleaseDate(string $releaseDate)
    {
        $this->releaseDate = $releaseDate;
    }



}