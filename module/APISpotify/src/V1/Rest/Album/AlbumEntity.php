<?php
namespace APISpotify\V1\Rest\Album;

class AlbumEntity
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="CUSTOM")
     * @CustomIdGenerator(class="My\Namespace\MyIdGenerator")
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $artist;

    /**
     * @var string
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
    public function getArtist():string
    {
        return $this->artist;
    }

    /**
     * @param string $artist
     */
    public function setArtist(string $artist)
    {
        $this->artist = $artist;
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
