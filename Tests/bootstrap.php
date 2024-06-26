<?php

use Doctrine\Common\Annotations\AnnotationRegistry;

function includeIfExists($file)
{
    if (file_exists($file)) {
        return include $file;
    }
}

if ((!$loader = includeIfExists(__DIR__.'/../vendor/autoload.php')) &&
    (!$loader = includeIfExists(__DIR__.'/../../../../vendor/autoload.php')) &&
    (!$loader = includeIfExists(__DIR__.'/../../../../../autoload.php'))
   ) {
    die('You must set up the project dependencies, run the following commands:'.PHP_EOL.
        'curl -s http://getcomposer.org/installer | php'.PHP_EOL.
        'php composer.phar install'.PHP_EOL);
}

if (method_exists(AnnotationRegistry::class, 'registerLoader')) {
    AnnotationRegistry::registerLoader('class_exists');
}

// force loading the XRateLimit annotation since the composer target-dir autoloader does not run through $loader::loadClass
class_exists('Noxlogic\RateLimitBundle\Annotation\RateLimit');
