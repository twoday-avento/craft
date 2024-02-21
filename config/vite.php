<?php

use Craft;
use craft\helpers\App;

return [
    'checkDevServer' => true,
    'devServerInternal' => 'http://localhost:3000',
    'devServerPublic' => Craft::getAlias('@web').':3000',
    'errorEntry' => 'src/js/app.js',
    'useDevServer' => App::env('CRAFT_ENVIRONMENT') === 'dev',
    'manifestPath' => Craft::getAlias('@webroot').'/dist/.vite/manifest.json',
    'serverPublic' => Craft::getAlias('@web').'/dist/',
];
