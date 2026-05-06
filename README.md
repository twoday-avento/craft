# CraftUp

A starter project for [Craft CMS](https://craftcms.com/) by Twoday Avento.

Includes a curated set of plugins and a modern frontend stack:
- **Tailwind CSS 4** for styling
- **Alpine.js** for interactivity
- **Vite** for asset bundling
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
- **Pages** (structure section) with block-based content (Rich Text, Image)
- **News** (channel section) for articles
- **Navigation** (structure section) for menus

---

## Creating a New Project

### Prerequisites
- [DDEV](https://ddev.readthedocs.io/en/stable/users/install/ddev-installation/)
- [Composer](https://getcomposer.org/)

### Setup

```bash
# Create the project directory
mkdir my-project && cd my-project

# Configure DDEV
ddev config --project-type=craftcms --docroot=web --create-docroot

# Create the project from the starter
ddev composer create -y --stability dev \
  --repository '{"url": "https://github.com/twoday-avento/craft", "type": "vcs"}' \
  twoday-avento/craft

# Install Craft CMS
ddev craft install

# Install frontend dependencies
ddev npm install

# Start developing
ddev npm run dev
```

Open the site with `ddev launch`, or the control panel with `ddev launch /admin`.

---

## Development

### Make Commands

This project includes a `Makefile` for common tasks:

```bash
make help       # Show all available commands
make install    # Full project setup
make dev        # Start Vite dev server
make build      # Build frontend for production
make up         # Start DDEV + run migrations
make update     # Update all dependencies
make ssh        # SSH into the web container
make clean      # Remove generated files
```

### Frontend

- CSS: `src/css/app.css` (Tailwind CSS 4, CSS-first configuration)
- JS: `src/js/app.js` (Alpine.js)
- Build output: `web/dist/`
- Dev server runs on port 3000

### Project Structure

```
├── config/            # Craft CMS configuration
│   ├── general.php    # General settings
│   ├── vite.php       # Vite plugin settings
│   └── project/       # Project config (version-controlled)
├── modules/           # Custom Craft modules
├── src/
│   ├── css/           # Tailwind CSS source
│   ├── js/            # JavaScript source
│   └── public/        # Static assets (copied to web root)
├── templates/         # Twig templates
│   ├── _errors/       # Error pages (404, 500, 503)
│   ├── _includes/     # Partials (header, footer, blocks)
│   ├── _layouts/      # Layout templates
│   └── _macros/       # Twig macros (images, typography)
├── web/               # Document root
│   └── dist/          # Built assets (gitignored)
├── .ddev/             # DDEV configuration
├── Makefile           # Development shortcuts
└── vite.config.mjs    # Vite configuration
```

---

## Deployment

Build the frontend assets before deploying:

```bash
npm install
npm run build
```

Set these environment variables in production:

```
CRAFT_ENVIRONMENT=production
DEV_MODE=false
ALLOW_ADMIN_CHANGES=false
DISALLOW_ROBOTS=false
ENABLE_TEMPLATE_CACHING=true
```
