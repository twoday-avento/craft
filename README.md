<a href="https://craftcms.com/" rel="noopener" target="_blank"><img width="247" height="60" src="https://craftcms.com/craftcms.svg" alt="Craft CMS"></a>

<br>

CraftUp is a starter setup for quickly getting started creating a website with Craft CMS.

It includes a basic set of plugins, and a front-end consisting of Tailwind CSS and Alpine.js, built with Vite.

---

## Getting Started

The best way to spin up your first project is with [DDEV](https://ddev.com/), a cross-platform, Docker-based PHP development environment.

1. [Install DDEV](https://ddev.readthedocs.io/en/stable/users/install/ddev-installation/)
2. Choose a folder for your project and move into it:
   ```bash
   cd /path/to/web/projects
   mkdir my-project
   cd my-project
   ```
3. Configure a new DDEV [project](https://ddev.readthedocs.io/en/latest/users/quickstart/#craft-cms), and install CraftUp:

   ```bash
   # Configure the ddev project
   ddev config --project-type=craftcms --docroot=web --create-docroot

   # Use this package as a starting point:
   ddev composer create -y --stability dev --repository '{"url": "https://github.com/twoday-avento/craft", "type": "vcs"}' twoday-avento/craft

   # Run the Craft CMS installer (use all defaults):
   ddev craft install

   # Install front-end dependencies
   ddev yarn install

   # Start developing
   ddev yarn dev

   # Build front-end code for production
   ddev yarn build
   ```

4. Run `ddev launch` to open the project in your browser.
