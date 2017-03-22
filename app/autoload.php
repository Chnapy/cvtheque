<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use Composer\Autoload\ClassLoader;

/** @var ClassLoader $loader */
$loader = require __DIR__.'/../vendor/autoload.php';
if (!function_exists('intl_is_failure')) {
    require '/path/to/Icu/Resources/stubs/functions.php';
    $loader->registerPrefixFallback('/path/to/Icu/Resources/stubs');
}
AnnotationRegistry::registerLoader([$loader, 'loadClass']);

return $loader;
