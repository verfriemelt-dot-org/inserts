<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->extension('framework', [
        'secret' => 'alksfhjlkajsfv[wlkjt;lkjweg;lkjhdgblkjzbn',
        'http_method_override' => false,
        'php_errors' => ['log' => true],
    ]);
};
