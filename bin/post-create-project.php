#!/usr/bin/env php
<?php
/**
 * Post-create-project setup script for CraftUp.
 *
 * Runs automatically via Composer's post-create-project-cmd hook.
 * Handles file swaps, env setup, and cleanup of template-only files.
 */

$root = dirname(__DIR__);

// 1. Copy .env.example to .env if it doesn't exist
if (!file_exists("$root/.env")) {
    copy("$root/.env.example", "$root/.env");
    echo "Created .env from .env.example\n";
}

// 2. Swap .gitignore with the project version
if (file_exists("$root/.gitignore.default")) {
    if (file_exists("$root/.gitignore")) {
        unlink("$root/.gitignore");
    }
    rename("$root/.gitignore.default", "$root/.gitignore");
    echo "Swapped .gitignore\n";
}

// 3. Swap composer.json with the project version
if (file_exists("$root/composer.json.default")) {
    if (file_exists("$root/composer.json")) {
        unlink("$root/composer.json");
    }
    rename("$root/composer.json.default", "$root/composer.json");
    echo "Swapped composer.json\n";
}

// 4. Remove template-only files
foreach (['packages.json'] as $file) {
    $path = "$root/$file";
    if (file_exists($path)) {
        unlink($path);
    }
}

// 5. Set DDEV project name
$ddevConfig = "$root/.ddev/config.yaml";
if (file_exists($ddevConfig) && ($project = getenv('DDEV_PROJECT'))) {
    file_put_contents(
        $ddevConfig,
        str_replace('%PROJECT%', $project, file_get_contents($ddevConfig))
    );
    echo "Set DDEV project name: $project\n";
}

// 6. Generate unique CRAFT_APP_ID
$envFile = "$root/.env";
if (file_exists($envFile)) {
    $appId = bin2hex(random_bytes(16));
    file_put_contents(
        $envFile,
        str_replace('CRAFT_APP_ID=', "CRAFT_APP_ID=$appId", file_get_contents($envFile))
    );
    echo "Generated CRAFT_APP_ID\n";
}

// 7. Self-cleanup: remove this script and bin dir if empty
@unlink(__FILE__);
$binDir = "$root/bin";
if (is_dir($binDir) && count(glob("$binDir/*")) === 0) {
    @rmdir($binDir);
}

echo "\nSetup complete! Next steps:\n";
echo "  ddev restart\n";
echo "  ddev craft install\n";
echo "  ddev craft plugin/install ckeditor\n";
echo "  ddev craft plugin/install seomatic\n";
echo "  ddev craft plugin/install imager-x\n";
echo "  ddev craft plugin/install hyper\n";
echo "  ddev craft plugin/install vite\n";
echo "  ddev npm install\n";
echo "  ddev npm run dev\n";
