<?php

declare(strict_types=1);

use Laminas\ServiceManager\ServiceManager;

/** @var array<string, array|string> $config */
$config = require 'config.php';

/** @var array<string, array|string> $dependencies */
$dependencies                       = $config['dependencies'];
$dependencies['services']['config'] = $config;

// Build container
return new ServiceManager($dependencies);
