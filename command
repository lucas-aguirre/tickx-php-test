#!/usr/bin/env php
<?php

if (php_sapi_name() !== 'cli') {
    exit;
}

require __DIR__ . '/vendor/autoload.php';

use Minicli\App;
use Minicli\Exception\CommandNotFoundException;

$app = new App([
    'app_path' => __DIR__ . '/app/Command',
    'debug' => true,
    'theme' => 'Unicorn'
]);

try {
    $app->runCommand($argv);
} catch (CommandNotFoundException $notFoundException) {
    $app->getPrinter()->error("Command Not Found.");
    return 1;
} catch (Exception $exception) {
    if ($app->config->debug) {
        $app->getPrinter()->error("An error occurred:");
        $app->getPrinter()->error($exception->getMessage());
    }
    return 1;
}

return 0;