<?php

namespace Albums\Entity;

use Doctrine\ORM\Mapping as ORM;
use Artists\Entity\ArtistEntity;

/**
 * @ORM\Entity(repositoryClass="Albums\Repository\AlbumRepository")
 * @ORM\Table(name="albums")
 */
class AlbumEntity
{
    /**
     * @ORM\Id
     * @var int
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="id")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=256, name="title")
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="Artists\Entity\ArtistEntity", inversedBy="albums")
     * @ORM\JoinColumn(name="artist", referencedColumnName="id")
     */
    private $artist;

    /**
     * @ORM\Column(type="date", name="release_date")
     */
    private $releaseDate;

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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return ArtistEntity
     */
    public function getArtist(): ArtistEntity
    {
        return $this->artist;
    }

    /**
     * @param ArtistEntity $artist
     */
    public function setArtist(ArtistEntity $artist): void
    {
        $this->artist = $artist;
        $artist->addAlbum($this);
    }

    /**
     * @return string
     */
    public function getReleaseDate(): string
    {
        return $this->releaseDate;
    }

    /**
     * @param \DateTime $releaseDate
     */
    public function setReleaseDate(\DateTime $releaseDate): void
    {
        $this->releaseDate = $releaseDate;
    }

}