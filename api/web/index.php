<?php
/**
 * Craft web bootstrap file
 */

// Set path constants
define('CRAFT_BASE_PATH', dirname(__DIR__));
define('CRAFT_VENDOR_PATH', CRAFT_BASE_PATH.'/vendor');
define('SECRETS_DIR', '/var/secrets');

// Load Composer's autoloader
require_once CRAFT_VENDOR_PATH.'/autoload.php';

// Load dotenv?
if (class_exists('Dotenv\Dotenv') && file_exists(SECRETS_DIR . '/.env')) {
    Dotenv\Dotenv::create(SECRETS_DIR)->load();
}

// Load and run Craft
define('CRAFT_ENVIRONMENT', getenv('ENVIRONMENT') ?: 'production');
/** @var craft\web\Application $app */
$app = require CRAFT_VENDOR_PATH.'/craftcms/cms/bootstrap/web.php';
$app->run();
