# CraftUp

A starter project for [Craft CMS](https://craftcms.com/) by Twoday Avento.

Includes a curated set of plugins and a modern frontend stack:
- **Tailwind CSS 4** for styling
- **Alpine.js** for interactivity
- **Vite 6** for asset bundling
- **DDEV** for local development

## What's Included

### Plugins
| Plugin | Purpose |
|---|---|
| [CKEditor](https://plugins.craftcms.com/ckeditor) | Rich text editing |
| [SEOmatic](https://plugins.craftcms.com/seomatic) | SEO management |
| [Imager X](https://plugins.craftcms.com/imager-x) | Image transforms |
| [Hyper](https://plugins.craftcms.com/hyper) | Link fields |
| [Vite](https://plugins.craftcms.com/vite) | Vite integration for Craft |

### Content Structure
- **Pages** — structure section with block-based content (Rich Text, Image)
- **News** — channel section for articles
- **Navigation** — structure section for menus

---

## Creating a New Project

### Prerequisites
- [DDEV](https://ddev.readthedocs.io/en/stable/users/install/ddev-installation/)

### Step 1: Create the project directory

```bash
mkdir my-project && cd my-project
```

### Step 2: Initialize DDEV

```bash
ddev config --project-type=craftcms --docroot=web --create-docroot
```

### Step 3: Install CraftUp via Composer

This downloads the starter template and runs the setup script, which swaps in
the production `composer.json`, `.gitignore`, and configures DDEV.

```bash
ddev composer create-project -y --stability dev \
  --repository '{"url": "https://github.com/twoday-avento/craft", "type": "vcs"}' \
  twoday-avento/craft
```

### Step 4: Restart DDEV

The starter template includes its own DDEV config (PHP 8.3, Node 22, MySQL 8.0).
Restart DDEV to pick up the new configuration:

```bash
ddev restart
```

### Step 5: Install Craft CMS

This will prompt you for site name, URL, and admin account details.
Use all defaults or customize as needed.

```bash
ddev craft install
```

### Step 6: Install frontend dependencies and start developing

```bash
ddev npm install
ddev npm run dev
```

Open the site with `ddev launch`, or the control panel with `ddev launch /admin`.

---

## Development

### Make Commands

The project includes a `Makefile` for common tasks:

```
make help       Show all available commands
make install    Full project setup (start, deps, install)
make dev        Start Vite dev server
make build      Build frontend for production
make up         Start DDEV + run pending migrations
make update     Update all Composer + npm dependencies
make ssh        SSH into the web container
make clean      Remove vendor, node_modules, dist
```

### Frontend

| | |
|---|---|
| CSS source | `src/css/app.css` (Tailwind CSS 4) |
| JS source | `src/js/app.js` (Alpine.js) |
| Build output | `web/dist/` |
| Dev server | Port 3000 |

Tailwind 4 uses CSS-first configuration. Customize your theme directly in
`src/css/app.css` using `@theme` — no `tailwind.config.js` needed.

### Project Structure

```
config/
  general.php        General config (uses env vars)
  vite.php           Vite plugin config
  project/           Project config (version-controlled)
modules/             Custom Craft modules (autoloaded)
src/
  css/app.css        Tailwind CSS entry point
  js/app.js          JavaScript entry point
  public/            Static assets copied to web root
templates/
  _errors/           Error pages (404, 500, 503)
  _includes/         Partials (header, footer, blocks)
  _layouts/          Layout templates
  _macros/           Twig macros (images, typography)
web/                 Document root (nginx/apache points here)
  dist/              Built assets (gitignored)
.ddev/               DDEV configuration
Makefile             Development shortcuts
vite.config.mjs      Vite configuration
```

---

## Deployment

Build the frontend assets before deploying:

```bash
npm install
npm run build
```

Recommended production environment variables:

```env
CRAFT_ENVIRONMENT=production
DEV_MODE=false
ALLOW_ADMIN_CHANGES=false
DISALLOW_ROBOTS=false
ENABLE_TEMPLATE_CACHING=true
```
