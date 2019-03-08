<?php

namespace Albums\repository;

use Doctrine\ORM\EntityManager;
use PDO;
use Albums\Entity\AlbumEntity;

class AlbumRepository
{
    private $connection;
    private $host = 'localhost';
    private $user = 'root';
    private $password = 'qwer';
    private $databaseName = 'spotify';

    private $entityManager;
    private $repository;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager=$entityManager;
        $this->repository = $this->entityManager ->getRepository(AlbumEntity::class);

        $source = 'mysql:host=' . $this->host . ';dbname=' . $this->databaseName;
        $this->connection = new \PDO($source, $this->user, $this->password);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * @param string $title
     * @return object|null
     */
    public function findByTitle(string $title)
    {
        $album =$this->repository->findOneBy(array('title'=>$title));
        $sql = 'SELECT * FROM albums WHERE title = ?';
//        $statement = $this->connection->prepare($sql);
//        $statement->execute([$title]);
//        $album = $statement->fetchObject(AlbumEntity::class);

        if($album!==false)
        {
            return $album;
        }

        return null;
    }

    /**
     * @param AlbumEntity $album
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function insertAlbum(AlbumEntity $album)
    {
//        $sql = 'INSERT INTO albums (title, artist, releaseDate) VALUES (?, ?, ?)';
//        $statement = $this->connection->prepare($sql);
//        $artist = $album->getArtist();
//        $artistName = $artist->getArtistName();
//        $statement->execute([$album->getTitle(),$artistName,$album->getReleaseDate()]);
        $this->entityManager->persist($album);
        $this->entityManager->flush();
    }


}