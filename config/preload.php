<?php

define('PRELOAD_PATH',dirname(__FILE__,2) . '/var/cache/dev/verfriemelt_inserts_AppKernelDevContainer.preload.php');

if (file_exists(PRELOAD_PATH)) {
    require_once PRELOAD_PATH;
}
