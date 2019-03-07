<?php


namespace APISpotify\V1\Rest\Artist;

use PDO;

class ArtistRepository
{
    //temporary
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
    //temporary

    public function findById(int $artistId)
    {
        return true;
    }

    public function findByName(string $name) // nezinau ka grazint, see Klausimai
    {
        $sql = 'SELECT * FROM artists WHERE artistName = ?';
        $statement = $this->connection->prepare($sql);
        $statement->execute([$name]);
        $artist = $statement->fetchObject(ArtistEntity::class);

        if ($artist !== false) {
            return $artist;
        }

        return null;
    }
}