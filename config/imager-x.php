<?php

use craft\helpers\App;

return [
    'fallbackImage' => App::env('CRAFT_ENVIRONMENT') != 'production' ? 'https://dummyimage.com/1024/e5e7eb/111827.png&text=Fallback' : null,
];
