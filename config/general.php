<?php
/**
 * General Configuration
 *
 * All of your system's general configuration settings go in here. You can see a
 * list of the available settings in vendor/craftcms/cms/src/config/GeneralConfig.php.
 *
 * @see \craft\config\GeneralConfig
 */

use craft\config\GeneralConfig;
use craft\helpers\App;

return GeneralConfig::create()
    // Set the default week start day for date pickers (0 = Sunday, 1 = Monday, etc.)
    ->defaultWeekStartDay(1)
    ->defaultSearchTermOptions([
        'subLeft' => true,
        'subRight' => true,
    ])
    // Prevent generated URLs from including "index.php"
    ->omitScriptNameInUrls()
    // Preload Single entries as Twig variables
    ->preloadSingles()
    // Prevent user enumeration attacks
    ->preventUserEnumeration()
    // Enable Dev Mode (see https://craftcms.com/guides/what-dev-mode-does)
    ->devMode(App::env('DEV_MODE') ?? false)
    // Allow administrative changes
    ->allowAdminChanges(App::env('ALLOW_ADMIN_CHANGES') ?? false)
    // Disallow robots
    ->disallowRobots(App::env('DISALLOW_ROBOTS') ?? false)
    // Set a CP trigger
    ->cpTrigger(App::env('CP_TRIGGER', 'admin'))
    // Backup on updates
    ->backupOnUpdate(App::env('BACKUP_ON_UPDATE') ?? true)
    // Enable template caching
    ->enableTemplateCaching(App::env('ENABLE_TEMPLATE_CACHING') ?? false)
    // Run queue automatically. Disable if using daemon
    ->runQueueAutomatically(App::env('RUN_QUEUE_AUTOMATICALLY') ?? true)
    // Disable use of usernames instead of emails
    ->useEmailAsUsername(true)
    // Set the @webroot and @web aliases so the clear-caches command knows where to find CP resources
    ->aliases([
        '@web' => rtrim(App::env('PRIMARY_SITE_URL'), '/'),
        '@webroot' => dirname(__DIR__).'/web',
    ]);
