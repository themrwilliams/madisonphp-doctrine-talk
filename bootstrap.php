<?php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\Cache\ArrayCache;

require_once 'vendor/autoload.php'; // Composer autoloader

date_default_timezone_set('America/Chicago');

// To use on CLI: export DEMODEV=1
$isDevMode = getenv('DEMODEV') ? (bool) getenv('DEMODEV') : false;
$config    = Setup::createAnnotationMetadataConfiguration(
    array(__DIR__ . '/src'),
    $isDevMode
);

if ($isDevMode) {
    // Add a SQL logger for development
    $config->setSQLLogger(new \Doctrine\DBAL\Logging\EchoSQLLogger());
}

$config->setProxyDir(sys_get_temp_dir()); // Defaults to /tmp

$config->setMetadataCacheImpl(new ArrayCache()); // Defaults to ArrayCache
$config->setQueryCacheImpl(new ArrayCache());    // Defaults to ArrayCache

// SQLite configuration
$conn = array(
    'driver' => 'pdo_sqlite',
    'path'   => __DIR__ . '/db.sqlite',
);

$entityManager = EntityManager::create($conn, $config);
