<?php

namespace Albums\Creator;

use Psr\Container\ContainerInterface;

class AlbumCreatorFactory
{
    /**
     * @param ContainerInterface $services
     *
     * @return AlbumCreator
     */
    public function __invoke(ContainerInterface $services)
    {
        $albumCreator = $services->get('doctrine.entitymanager.orm_default');

        return new AlbumCreator($albumCreator);
    }
}