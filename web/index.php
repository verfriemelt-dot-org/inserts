<?php

declare(strict_types=1);

use verfriemelt\inserts\AppKernel;


require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return static function (array $context): AppKernel {
    return new AppKernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
