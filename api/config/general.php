<?php
/**
 * General Configuration
 *
 * All of your system's general configuration settings go in here. You can see a
 * list of the available settings in vendor/craftcms/cms/src/config/GeneralConfig.php.
 *
 * @see \craft\config\GeneralConfig
 */

use craft\helpers\App;

$dev = App::env('ENVIRONMENT') === 'dev';

$s3BucketPathFormat = 'https://s3.%s.amazonaws.com/%s/';

return [
    // Global settings
    '*' => [
        // Default Week Start Day (0 = Sunday, 1 = Monday...)
        'defaultWeekStartDay' => 1,

        // Whether generated URLs should omit "index.php"
        'omitScriptNameInUrls' => true,

        // Control Panel trigger word
        'cpTrigger' => 'admin',

        // The secure key Craft will use for hashing and encrypting data
        'securityKey' => App::env('SECURITY_KEY'),

        // Whether to save the project config out to config/project.yaml
        // (see https://docs.craftcms.com/v3/project-config.html)
        'useProjectConfigFile' => true,

        'aliases' => [
            '@previewUrlFormat' => App::env('ALIAS_PREVIEW_URL_FORMAT'),
            '@assetsAssetVariantBaseURL' => sprintf(
                $s3BucketPathFormat,
                App::env('AWS_ASSET_S3_REGION'),
                App::env('AWS_ASSET_S3_BUCKET')
            ),
            '@assetBaseURL' => App::env('DEFAULT_SITE_URL'),
            '@webBaseUrl' => App::env('WEB_BASE_URL')
        ],

        'headlessMode' => true,

        // Disable CSRF protection for contact form
        'enableCsrfProtection' => $_SERVER['REQUEST_URI'] !== '/actions/contact-form/send'//,

        // Configured in nginx config for local dev, and needs to be configured in nginx
        // on staging / production, too. It's not easy to get Craft to serve CORS headers
        // for both GraphQL and non-Graphql requests (eg, the contact form), so we went
        // with this approach.
        // Commenting this out as a test to see if the client will build without -erosas
        //'allowedGraphqlOrigins' => false
    ],

    // Dev environment settings
    'dev' => [
        // Dev Mode (see https://craftcms.com/guides/what-dev-mode-does)
        'devMode' => App::env('ENVIRONMENT') === 'dev',
    ],

    // Staging environment settings
    'staging' => [
        // Set this to `false` to prevent administrative changes from being made on staging
        'allowAdminChanges' => false,
    ],

    // Production environment settings
    'production' => [
        // Set this to `false` to prevent administrative changes from being made on production
        'allowAdminChanges' => false,
    ],
];
