<?php

$vendorDir = dirname(__DIR__);
$rootDir = dirname(dirname(__DIR__));

return array (
  'sebastianlenz/linkfield' => 
  array (
    'class' => 'lenz\\linkfield\\Plugin',
    'basePath' => $vendorDir . '/sebastianlenz/linkfield/src',
    'handle' => 'typedlinkfield',
    'aliases' => 
    array (
      '@lenz/linkfield' => $vendorDir . '/sebastianlenz/linkfield/src',
    ),
    'name' => 'Typed link field',
    'version' => 'v2.0.x-dev',
    'description' => 'A Craft field type for selecting links',
    'developer' => 'Sebastian Lenz',
    'developerUrl' => 'https://github.com/sebastian-lenz/',
  ),
  'carlcs/craft-assetmetadata' => 
  array (
    'class' => 'carlcs\\assetmetadata\\Plugin',
    'basePath' => $vendorDir . '/carlcs/craft-assetmetadata/src',
    'handle' => 'asset-metadata',
    'aliases' => 
    array (
      '@carlcs/assetmetadata' => $vendorDir . '/carlcs/craft-assetmetadata/src',
    ),
    'name' => 'Asset Metadata',
    'version' => '3.0.0',
    'description' => 'Asset Metadata plugin for Craft CMS',
    'developer' => 'carlcs',
    'developerUrl' => 'https://github.com/carlcs',
  ),
  'craftcms/aws-s3' => 
  array (
    'class' => 'craft\\awss3\\Plugin',
    'basePath' => $vendorDir . '/craftcms/aws-s3/src',
    'handle' => 'aws-s3',
    'aliases' => 
    array (
      '@craft/awss3' => $vendorDir . '/craftcms/aws-s3/src',
    ),
    'name' => 'Amazon S3',
    'version' => '1.2.11',
    'description' => 'Amazon S3 integration for Craft CMS',
    'developer' => 'Pixel & Tonic',
    'developerUrl' => 'https://pixelandtonic.com/',
    'documentationUrl' => 'https://github.com/craftcms/aws-s3/blob/master/README.md',
  ),
  'craftcms/contact-form' => 
  array (
    'class' => 'craft\\contactform\\Plugin',
    'basePath' => $vendorDir . '/craftcms/contact-form/src',
    'handle' => 'contact-form',
    'aliases' => 
    array (
      '@craft/contactform' => $vendorDir . '/craftcms/contact-form/src',
    ),
    'name' => 'Contact Form',
    'version' => '2.2.7',
    'description' => 'Add a simple contact form to your Craft CMS site',
    'developer' => 'Pixel & Tonic',
    'developerUrl' => 'https://pixelandtonic.com/',
    'developerEmail' => 'support@craftcms.com',
    'documentationUrl' => 'https://github.com/craftcms/contact-form/blob/v2/README.md',
    'components' => 
    array (
      'mailer' => 'craft\\contactform\\Mailer',
    ),
  ),
  'craftcms/redactor' => 
  array (
    'class' => 'craft\\redactor\\Plugin',
    'basePath' => $vendorDir . '/craftcms/redactor/src',
    'handle' => 'redactor',
    'aliases' => 
    array (
      '@craft/redactor' => $vendorDir . '/craftcms/redactor/src',
    ),
    'name' => 'Redactor',
    'version' => '2.8.5',
    'description' => 'Edit rich text content in Craft CMS using Redactor by Imperavi.',
    'developer' => 'Pixel & Tonic',
    'developerUrl' => 'https://pixelandtonic.com/',
    'developerEmail' => 'support@craftcms.com',
    'documentationUrl' => 'https://github.com/craftcms/redactor/blob/v2/README.md',
  ),
  'rynpsc/craft-phone-number' => 
  array (
    'class' => 'rynpsc\\phonenumber\\PhoneNumber',
    'basePath' => $vendorDir . '/rynpsc/craft-phone-number/src',
    'handle' => 'phone-number',
    'aliases' => 
    array (
      '@rynpsc/phonenumber' => $vendorDir . '/rynpsc/craft-phone-number/src',
    ),
    'name' => 'Phone Number',
    'version' => '1.4.1',
    'description' => 'International phone number field.',
    'developer' => 'Ryan Pascoe',
    'developerUrl' => 'https://www.ryanpascoe.co',
    'documentationUrl' => 'https://github.com/rynpsc/craft-phone-number',
    'changelogUrl' => 'https://raw.githubusercontent.com/rynpsc/craft-phone-number/master/CHANGELOG.md',
    'downloadUrl' => 'https://github.com/rynpsc/craft-phone-number/archive/master.zip',
  ),
  'spicyweb/craft-neo' => 
  array (
    'class' => 'benf\\neo\\Plugin',
    'basePath' => $vendorDir . '/spicyweb/craft-neo/src',
    'handle' => 'neo',
    'aliases' => 
    array (
      '@benf/neo' => $vendorDir . '/spicyweb/craft-neo/src',
    ),
    'name' => 'Neo',
    'version' => '2.8.15.1',
    'schemaVersion' => '2.8.15',
    'description' => 'A Matrix-like field type that uses existing fields',
    'developer' => 'Spicy Web',
    'developerUrl' => 'https://github.com/spicywebau',
    'documentationUrl' => 'https://github.com/spicywebau/craft-neo/wiki',
    'changelogUrl' => 'https://github.com/spicywebau/craft-neo/blob/master/CHANGELOG.md',
    'downloadUrl' => 'https://github.com/spicywebau/craft-neo/archive/master.zip',
  ),
);
