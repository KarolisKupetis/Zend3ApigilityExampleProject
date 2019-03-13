<?php
return [
    \Zend\ServiceManager\AbstractFactory\ConfigAbstractFactory::class => [
        0 => \Artists\Repository\ArtistRepository::class,
        1 => \Doctrine\ORM\EntityManager::class,
        \Artists\Creator\ArtistCreator::class => [
            0 => \Doctrine\ORM\EntityManager::class,
        ],
        \Albums\Creator\AlbumCreator::class => [
            0 => \Doctrine\ORM\EntityManager::class,
        ],
        \Artists\Service\ArtistService::class => [
            0 => \Artists\Repository\ArtistRepository::class,
            1 => \Artists\Creator\ArtistCreator::class,
        ],
        \Albums\Service\AlbumService::class => [
            0 => \Albums\Repository\AlbumRepository::class,
            1 => \Artists\Service\ArtistService::class,
            2 => \Albums\Creator\AlbumCreator::class,
        ],
    ],
    'service_manager' => [
        'abstract_factories' => [
            0 => \Zend\ServiceManager\AbstractFactory\ConfigAbstractFactory::class,
            1 => \Albums\Repository\AbstractRepositoryFactory::class,
        ],
        'factories' => [
            \Albums\Repository\AlbumRepository::class => \Albums\Repository\AbstractRepositoryFactory::class,
            \Artists\Repository\ArtistRepository::class => \Albums\Repository\AbstractRepositoryFactory::class,
            \SpotifyAPI\V1\Rest\Album\AlbumResource::class => \SpotifyAPI\V1\Rest\Album\AlbumResourceFactory::class,
            \SpotifyAPI\V1\Rest\Artist\ArtistResource::class => \SpotifyAPI\V1\Rest\Artist\ArtistResourceFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'spotify-api.rest.album' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/albums[/:album_id]',
                    'defaults' => [
                        'controller' => 'SpotifyAPI\\V1\\Rest\\Album\\Controller',
                    ],
                ],
            ],
            'spotify-api.rest.artist' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/artists[/:artist_id]',
                    'defaults' => [
                        'controller' => 'SpotifyAPI\\V1\\Rest\\Artist\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'spotify-api.rest.album',
            1 => 'spotify-api.rest.artist',
        ],
    ],
    'zf-rest' => [
        'SpotifyAPI\\V1\\Rest\\Album\\Controller' => [
            'listener' => \SpotifyAPI\V1\Rest\Album\AlbumResource::class,
            'route_name' => 'spotify-api.rest.album',
            'route_identifier_name' => 'album_id',
            'collection_name' => 'album',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \SpotifyAPI\V1\Rest\Album\AlbumEntity::class,
            'collection_class' => \SpotifyAPI\V1\Rest\Album\AlbumCollection::class,
            'service_name' => 'album',
        ],
        'SpotifyAPI\\V1\\Rest\\Artist\\Controller' => [
            'listener' => \SpotifyAPI\V1\Rest\Artist\ArtistResource::class,
            'route_name' => 'spotify-api.rest.artist',
            'route_identifier_name' => 'artist_id',
            'collection_name' => 'artist',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \SpotifyAPI\V1\Rest\Artist\ArtistEntity::class,
            'collection_class' => \SpotifyAPI\V1\Rest\Artist\ArtistCollection::class,
            'service_name' => 'artist',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'SpotifyAPI\\V1\\Rest\\Album\\Controller' => 'HalJson',
            'SpotifyAPI\\V1\\Rest\\Artist\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'SpotifyAPI\\V1\\Rest\\Album\\Controller' => [
                0 => 'application/vnd.spotify-api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'SpotifyAPI\\V1\\Rest\\Artist\\Controller' => [
                0 => 'application/vnd.spotify-api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'SpotifyAPI\\V1\\Rest\\Album\\Controller' => [
                0 => 'application/vnd.spotify-api.v1+json',
                1 => 'application/json',
            ],
            'SpotifyAPI\\V1\\Rest\\Artist\\Controller' => [
                0 => 'application/vnd.spotify-api.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'zf-hal' => [
        'metadata_map' => [
            \SpotifyAPI\V1\Rest\Album\AlbumEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'spotify-api.rest.album',
                'route_identifier_name' => 'album_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \SpotifyAPI\V1\Rest\Album\AlbumCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'spotify-api.rest.album',
                'route_identifier_name' => 'album_id',
                'is_collection' => true,
            ],
            \SpotifyAPI\V1\Rest\Artist\ArtistEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'spotify-api.rest.artist',
                'route_identifier_name' => 'artist_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \SpotifyAPI\V1\Rest\Artist\ArtistCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'spotify-api.rest.artist',
                'route_identifier_name' => 'artist_id',
                'is_collection' => true,
            ],
        ],
    ],
    'zf-content-validation' => [
        'SpotifyAPI\\V1\\Rest\\Album\\Controller' => [
            'input_filter' => 'SpotifyAPI\\V1\\Rest\\Album\\Validator',
        ],
        'SpotifyAPI\\V1\\Rest\\Artist\\Controller' => [
            'input_filter' => 'SpotifyAPI\\V1\\Rest\\Artist\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'SpotifyAPI\\V1\\Rest\\Album\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'title',
                'field_type' => 'string',
            ],
            1 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'artist',
                'field_type' => 'string',
            ],
            2 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'releaseDate',
                'field_type' => \datetime::class,
            ],
        ],
        'SpotifyAPI\\V1\\Rest\\Artist\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'artistName',
                'field_type' => 'string',
            ],
        ],
    ],
];
