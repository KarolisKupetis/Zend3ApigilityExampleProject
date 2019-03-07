<?php
use Zend\ServiceManager\AbstractFactory\ConfigAbstractFactory;
use APISpotify\V1\Rest\Album\AlbumResource;
use APISpotify\V1\Rest\Album\AlbumResourceFactory;
use Albums\service\AlbumsService;

return [
    ConfigAbstractFactory::class=>[

        \Albums\repository\AlbumsRepository::class=>[],
        \Artists\service\ArtistsService::class=>[],

        AlbumsService::class => [
            \Albums\repository\AlbumsRepository::class,
            \Artists\service\ArtistsService::class,
        ],
    ],
    'service_manager' => [
        'abstract_factories' => [
            ConfigAbstractFactory::class,
        ],
        'factories' => [
            AlbumResource::class => AlbumResourceFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'api-spotify.rest.album' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/albums[/:album_id]',
                    'defaults' => [
                        'controller' => 'APISpotify\\V1\\Rest\\Album\\Controller',
                    ],
                ],
            ],
            'api-spotify.rest.artist' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/artists[/:artist_id]',
                    'defaults' => [
                        'controller' => 'APISpotify\\V1\\Rest\\Artist\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'api-spotify.rest.album',
            1 => 'api-spotify.rest.artist',
        ],
    ],
    'zf-rest' => [
        'APISpotify\\V1\\Rest\\Album\\Controller' => [
            'listener' => \APISpotify\V1\Rest\Album\AlbumResource::class,
            'route_name' => 'api-spotify.rest.album',
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
            'entity_class' => \APISpotify\V1\Rest\Album\AlbumEntity::class,
            'collection_class' => \APISpotify\V1\Rest\Album\AlbumCollection::class,
            'service_name' => 'album',
        ],
        'APISpotify\\V1\\Rest\\Artist\\Controller' => [
            'listener' => \APISpotify\V1\Rest\Artist\ArtistResource::class,
            'route_name' => 'api-spotify.rest.artist',
            'route_identifier_name' => 'artist_id',
            'collection_name' => 'artist',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
                4 => 'POST',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \APISpotify\V1\Rest\Artist\ArtistEntity::class,
            'collection_class' => \APISpotify\V1\Rest\Artist\ArtistCollection::class,
            'service_name' => 'artist',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'APISpotify\\V1\\Rest\\Album\\Controller' => 'HalJson',
            'APISpotify\\V1\\Rest\\Artist\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'APISpotify\\V1\\Rest\\Album\\Controller' => [
                0 => 'application/vnd.api-spotify.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'APISpotify\\V1\\Rest\\Artist\\Controller' => [
                0 => 'application/vnd.api-spotify.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'APISpotify\\V1\\Rest\\Album\\Controller' => [
                0 => 'application/vnd.api-spotify.v1+json',
                1 => 'application/json',
            ],
            'APISpotify\\V1\\Rest\\Artist\\Controller' => [
                0 => 'application/vnd.api-spotify.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'zf-hal' => [
        'metadata_map' => [
            \APISpotify\V1\Rest\Album\AlbumEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api-spotify.rest.album',
                'route_identifier_name' => 'album_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \APISpotify\V1\Rest\Album\AlbumCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api-spotify.rest.album',
                'route_identifier_name' => 'album_id',
                'is_collection' => true,
            ],
            \APISpotify\V1\Rest\Artist\ArtistEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api-spotify.rest.artist',
                'route_identifier_name' => 'artist_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \APISpotify\V1\Rest\Artist\ArtistCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api-spotify.rest.artist',
                'route_identifier_name' => 'artist_id',
                'is_collection' => true,
            ],
        ],
    ],
    'zf-content-validation' => [
        'APISpotify\\V1\\Rest\\Album\\Controller' => [
            'input_filter' => 'APISpotify\\V1\\Rest\\Album\\Validator',
        ],
        'APISpotify\\V1\\Rest\\Artist\\Controller' => [
            'input_filter' => 'APISpotify\\V1\\Rest\\Artist\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'APISpotify\\V1\\Rest\\Album\\Validator' => [],
        'APISpotify\\V1\\Rest\\Artist\\Validator' => [
            0 => [
                'required' => true,
                'name' => 'name',
                'description' => 'name of the artist',
            ],
        ],
    ],
    'zf-mvc-auth' => [
        'authorization' => [
            'APISpotify\\V1\\Rest\\Album\\Controller' => [
                'collection' => [
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
                'entity' => [
                    'GET' => true,
                    'PUT' => true,
                    'PATCH' => true,
                    'DELETE' => true,
                ],
            ],
            'APISpotify\\V1\\Rest\\Artist\\Controller' => [
                'collection' => [
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
                'entity' => [
                    'GET' => true,
                    'PUT' => true,
                    'PATCH' => true,
                    'DELETE' => true,
                ],
            ],
        ],
    ],
];
