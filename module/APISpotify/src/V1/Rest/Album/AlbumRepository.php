<?php


namespace APISpotify\V1\Rest\Album;

use PDO;

class AlbumRepository
{

    private $connection;
    private $host = 'localhost';
    private $user = 'root';
    private $password = 'qwer';
    private $databaseName = 'spotify';

    public function __construct()
    {
        $source = 'mysql:host=' . $this->host . ';dbname=' . $this->databaseName;
        $this->connection = new \PDO($source, $this->user, $this->password);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }


    /**
     * @param string $title
     * @return AlbumEntity|null
     */
    public function findByTitle(string $title)
    {
        $sql = 'SELECT * FROM albums WHERE title = ?';
        $statement = $this->connection->prepare($sql);
        $statement->execute([$title]);
        $album = $statement->fetchObject(AlbumEntity::class);

        if($album!==false)
        {
            return $album;
        }

        return null;
    }

    /**
     * @param AlbumEntity $album
     */
    public function insertAlbum(AlbumEntity $album)
    {
        $sql = 'INSERT INTO albums (title, artist, releaseDate) VALUES (?, ?, ?)';
        $statement = $this->connection->prepare($sql);
        $statement->execute([$album->getTitle(),$album->getArtist(),$album->getReleaseDate()]);
    }
}