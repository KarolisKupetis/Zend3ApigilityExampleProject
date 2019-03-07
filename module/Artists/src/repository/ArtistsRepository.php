<?php

namespace Artists\repository;

use PDO;
use Artists\entity\ArtistsEntity;

class ArtistsRepository
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

    public function findById(int $artistId)
    {
        return true;
    }

    public function findByName(string $name) // nezinau ka grazint, see Klausimai
    {
        $sql = 'SELECT * FROM artists WHERE artistName = ?';
        $statement = $this->connection->prepare($sql);
        $statement->execute([$name]);
        $artist = $statement->fetchObject(ArtistsEntity::class);

        if ($artist !== false) {
            return $artist;
        }

        return null;
    }
}