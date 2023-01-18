<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->extension('doctrine', [
        'dbal' => [
            'url' => 'postgresql://%env(POSTGRES_USER)%:%env(POSTGRES_PASSWORD)%@%env(POSTGRES_HOST)%:%env(POSTGRES_PORT)%/%env(POSTGRES_DB)%?serverVersion=15&charset=utf8',
            'schema_filter' => '~^(?!public)~',
        ],
        'orm' => [
            'auto_generate_proxy_classes' => true,
            'entity_managers' => [
                'default' => [
                    'auto_mapping' => true,
                    'naming_strategy' => 'doctrine.orm.naming_strategy.underscore_number_aware',
                    'mappings' => [
                        'App' => [
                            'is_bundle' => false,
                            'dir' => '%kernel.project_dir%/src/Entity',
                            'prefix' => 'verfriemelt\\inserts\\Entity',
                        ],
                    ],
                ],
            ],
        ],
    ]);
};
