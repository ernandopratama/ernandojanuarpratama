# Deployment Guide

Production deployment guide for the Ernando Januar Pratama portfolio.

This project is a Laravel application using:

- Laravel
- PHP
- MySQL
- Blade
- Vite
- Tailwind CSS
- Node.js
- cPanel Git Version Control
- LiteSpeed / Apache

Production domain:

https://ernando.my.id

---

# 1. Production Server Architecture

The production server uses the following directory structure:

```text
/home/ernando2/
│
├── repositories/
│   └── ernandojanuarpratama/
│       ├── .git/
│       ├── app/
│       ├── bootstrap/
│       ├── config/
│       ├── database/
│       ├── public/
│       ├── resources/
│       ├── routes/
│       ├── artisan
│       ├── composer.json
│       ├── composer.lock
│       ├── package.json
│       ├── package-lock.json
│       └── .cpanel.yml
│
├── ernando-portofolio/
│   ├── app/
│   ├── bootstrap/
│   ├── config/
│   ├── database/
│   ├── resources/
│   ├── routes/
│   ├── storage/
│   ├── vendor/
│   ├── .env
│   └── public/
│
└── public_html/
    ├── .htaccess
    ├── index.php
    ├── build/
    ├── favicon.ico
    ├── og-image.png
    └── robots.txt
```

The Git repository is:

```text
/home/ernando2/repositories/ernandojanuarpratama
```

The Laravel application directory is:

```text
/home/ernando2/ernando-portofolio
```

The public document root for the domain is:

```text
/home/ernando2/public_html
```

The domain is:

```text
https://ernando.my.id
```

---

# 2. Important Architecture Rule

The domain document root MUST remain:

```text
/home/ernando2/public_html
```

Do not change the domain document root to:

```text
/home/ernando2/ernando-portofolio
```

and do not change it to:

```text
/home/ernando2/ernando-portofolio/public
```

The current hosting configuration intentionally keeps the Laravel application outside the public web root.

The production structure is:

```text
Internet
   │
   ▼
https://ernando.my.id
   │
   ▼
/home/ernando2/public_html
   │
   ├── index.php
   ├── .htaccess
   ├── build/
   └── public assets
   │
   ▼
/home/ernando2/ernando-portofolio
   │
   ├── app/
   ├── bootstrap/
   ├── config/
   ├── database/
   ├── resources/
   ├── routes/
   ├── storage/
   └── vendor/
```

This separation protects the Laravel application source code from direct public access.

---

# 3. Server Requirements

Current production environment:

```text
PHP:
8.5.9

PHP executable:
 /usr/local/bin/php

Node.js:
20.20.2

npm:
10.8.2

Node.js environment:
 /home/ernando2/nodevenv/ernando-portofolio/20/
```

The application requires PHP with the Laravel-required extensions, including:

- pdo
- pdo_mysql
- mbstring
- openssl
- tokenizer
- xml
- ctype
- fileinfo
- gd
- json

The actual enabled PHP extensions should be verified on the hosting server before production deployment.

---

# 4. PHP

The server currently provides PHP through:

```bash
/usr/local/bin/php
```

Check PHP version:

```bash
/usr/local/bin/php -v
```

Check loaded extensions:

```bash
/usr/local/bin/php -m
```

PHP should be compatible with the Laravel version used by this project.

---

# 5. Composer

Composer is NOT currently available as a global shell command:

```bash
composer
```

returns:

```text
command not found
```

Therefore, do not assume that this command works:

```bash
composer install
```

Composer should be executed using the Composer installation provided by cPanel/hosting, or by the appropriate Composer binary configured for the account.

Before manually running Composer, verify the Composer location available on the hosting account.

For example, check:

```bash
find /opt/cpanel /usr/local/cpanel -type f -name composer 2>/dev/null
```

or:

```bash
find /opt/cpanel /usr/local/cpanel -type f -name composer.phar 2>/dev/null
```

Do not install another Composer copy unless required.

---

# 6. Node.js

The application uses Node.js 20 for frontend asset compilation.

Current Node.js environment:

```text
/home/ernando2/nodevenv/ernando-portofolio/20/
```

Node.js executable:

```text
/home/ernando2/nodevenv/ernando-portofolio/20/bin/node
```

npm executable:

```text
/home/ernando2/nodevenv/ernando-portofolio/20/bin/npm
```

Check versions:

```bash
/home/ernando2/nodevenv/ernando-portofolio/20/bin/node -v
```

```bash
/home/ernando2/nodevenv/ernando-portofolio/20/bin/npm -v
```

Expected versions:

```text
Node.js 20.x
npm 10.x
```

---

# 7. Environment File

The production `.env` file must remain on the server.

Production `.env` location:

```text
/home/ernando2/ernando-portofolio/.env
```

The production `.env` file MUST NOT be copied from Git.

The following information must never be committed to Git:

- APP_KEY
- database password
- database credentials
- admin password
- production secrets
- other private credentials

Production configuration should include:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://ernando.my.id
```

Database configuration:

```env
DB_CONNECTION=mysql
DB_HOST=...
DB_PORT=3306
DB_DATABASE=...
DB_USERNAME=...
DB_PASSWORD=...
```

Admin configuration:

```env
ADMIN_NAME=...
ADMIN_EMAIL=...
ADMIN_PASSWORD=...
```

Use the real production values only in:

```text
/home/ernando2/ernando-portofolio/.env
```

---

# 8. Git Repository

The cPanel Git Version Control repository is:

```text
/home/ernando2/repositories/ernandojanuarpratama
```

This directory is the Git working repository.

The repository should contain the application source code and deployment configuration.

The repository should NOT contain production-generated or server-specific files such as:

```text
.env
vendor/
node_modules/
storage/
```

unless there is a specific reason to do so.

---

# 9. cPanel Git Deployment

Deployment is controlled by:

```text
.cpanel.yml
```

The deployment configuration is responsible for moving the application from:

```text
/home/ernando2/repositories/ernandojanuarpratama
```

to:

```text
/home/ernando2/ernando-portofolio
```

and the public Laravel files to:

```text
/home/ernando2/public_html
```

The domain must continue using:

```text
/home/ernando2/public_html
```

as its document root.

---

# 10. Laravel Application Directory

The Laravel application is deployed to:

```text
/home/ernando2/ernando-portofolio
```

This directory should contain:

```text
app/
bootstrap/
config/
database/
resources/
routes/
storage/
vendor/
artisan
composer.json
composer.lock
.env
```

The Laravel application directory must not be directly exposed as the domain document root.

---

# 11. Public Web Directory

The public web files are deployed to:

```text
/home/ernando2/public_html
```

Expected files include:

```text
.htaccess
index.php
favicon.ico
robots.txt
og-image.png
build/
```

The public directory should NOT contain the entire Laravel application.

For example, the following should NOT be directly exposed through `public_html`:

```text
app/
bootstrap/
config/
database/
resources/
routes/
storage/
vendor/
.env
artisan
composer.json
```

---

# 12. Laravel Entry Point

The production web request enters through:

```text
/home/ernando2/public_html/index.php
```

The Laravel application itself is located at:

```text
/home/ernando2/ernando-portofolio
```

The production `index.php` must therefore reference the application directory correctly.

The Laravel application must not rely on:

```php
__DIR__ . '/../vendor/autoload.php'
```

if that would resolve to:

```text
/home/ernando2/vendor/
```

Instead, the production entry point should reference:

```text
/home/ernando2/ernando-portofolio
```

as configured in the production deployment.

---

# 13. Apache / LiteSpeed

The hosting server uses Apache/LiteSpeed-style `.htaccess` routing.

The public `.htaccess` is deployed to:

```text
/home/ernando2/public_html/.htaccess
```

The `.htaccess` is responsible for sending Laravel routes to:

```text
index.php
```

The application does NOT use Node.js/Express as its production web server.

Node.js is only used for frontend tooling such as Vite.

---

# 14. Vite and Frontend Assets

The project uses Vite to compile frontend assets.

The source configuration is stored in:

```text
vite.config.js
```

Frontend dependencies are defined in:

```text
package.json
package-lock.json
```

Install frontend dependencies with:

```bash
/home/ernando2/nodevenv/ernando-portofolio/20/bin/npm ci
```

Build production assets with:

```bash
/home/ernando2/nodevenv/ernando-portofolio/20/bin/npm run build
```

The generated assets are placed in:

```text
/home/ernando2/ernando-portofolio/public/build
```

The production web root must also contain:

```text
/home/ernando2/public_html/build
```

because the browser accesses these assets through the domain.

---

# 15. Composer Dependencies

After deploying application source code, Composer dependencies must exist in:

```text
/home/ernando2/ernando-portofolio/vendor
```

Production installation should use:

```bash
composer install --no-dev --optimize-autoloader
```

However, because Composer is not currently available as a global command on this hosting account, use the Composer binary provided by cPanel/hosting.

Do not copy the local development `vendor/` directory to production unless specifically required.

---

# 16. Database

The production database is MySQL.

Database configuration is stored in:

```text
/home/ernando2/ernando-portofolio/.env
```

After deploying database migrations, use:

```bash
php artisan migrate --force
```

Never use:

```bash
php artisan migrate:fresh
```

on the production database.

`migrate:fresh` will delete existing database tables and data.

---

# 17. Storage

Laravel storage is persistent server data.

Production storage location:

```text
/home/ernando2/ernando-portofolio/storage
```

Do NOT overwrite the production `storage/` directory during normal Git deployment.

This directory may contain:

- uploaded files
- generated documents
- logs
- framework cache
- application-generated data

Create the public storage link when necessary:

```bash
php artisan storage:link
```

---

# 18. Permissions

Laravel requires write access to:

```text
/home/ernando2/ernando-portofolio/storage
```

and:

```text
/home/ernando2/ernando-portofolio/bootstrap/cache
```

Recommended permissions:

```bash
chmod -R 775 /home/ernando2/ernando-portofolio/storage
```

```bash
chmod -R 775 /home/ernando2/ernando-portofolio/bootstrap/cache
```

Do not use `777` unless absolutely necessary.

---

# 19. Laravel Cache

After a production deployment, clear the existing Laravel cache:

```bash
php artisan optimize:clear
```

Then rebuild the production caches:

```bash
php artisan config:cache
```

```bash
php artisan route:cache
```

```bash
php artisan view:cache
```

Alternatively:

```bash
php artisan optimize
```

provided the application is confirmed to be compatible with the optimization command.

---

# 20. Normal Deployment Workflow

The normal deployment workflow is:

```text
Developer
   │
   │ git push
   ▼
GitHub
   │
   ▼
cPanel Git Version Control
   │
   │ Update from Remote
   ▼
/home/ernando2/repositories/ernandojanuarpratama
   │
   │ Deploy HEAD Commit
   ▼
/home/ernando2/ernando-portofolio
   │
   └── Laravel application
   │
   ▼
/home/ernando2/public_html
   │
   └── Public web files
   │
   ▼
https://ernando.my.id
```

---

# 21. Typical Update

After pushing changes to GitHub:

```bash
git push
```

use cPanel Git Version Control:

```text
Update from Remote
```

Then deploy:

```text
Deploy HEAD Commit
```

The `.cpanel.yml` file controls the deployment tasks.

---

# 22. When Composer Must Be Run

Composer installation is normally required when one of the following changes:

```text
composer.json
composer.lock
```

Run:

```bash
composer install --no-dev --optimize-autoloader
```

Do not run `composer update` on production unless there is a specific reason.

Production should use the versions defined in:

```text
composer.lock
```

---

# 23. When npm Must Be Run

Frontend dependencies should be reinstalled when:

```text
package.json
package-lock.json
```

change.

Use:

```bash
npm ci
```

Then build:

```bash
npm run build
```

If only Blade/PHP files changed and frontend dependencies did not change, a new `npm ci` is generally unnecessary.

---

# 24. When Database Migration Must Be Run

Run:

```bash
php artisan migrate --force
```

when new Laravel migrations are added.

Do not run migrations blindly after every deployment if there are no new migration files.

---

# 25. Post-Deployment Checks

After deployment, verify:

```text
https://ernando.my.id/
```

The portfolio landing page should load successfully.

Check:

```text
https://ernando.my.id/robots.txt
```

Check:

```text
https://ernando.my.id/sitemap.xml
```

Check:

```text
https://ernando.my.id/cv
```

The `/cv` endpoint may return 404 when a CV has not yet been uploaded through the admin system.

Check:

```text
https://ernando.my.id/admin
```

The admin login should be available.

---

# 26. Verify Vite Assets

If the page loads but CSS or JavaScript is missing, check:

```text
/home/ernando2/ernando-portofolio/public/build
```

and:

```text
/home/ernando2/public_html/build
```

Both locations should contain the compiled Vite assets required by the application.

---

# 27. Verify Laravel Logs

If the application returns HTTP 500, check:

```text
/home/ernando2/ernando-portofolio/storage/logs/
```

Laravel application logs can be inspected with:

```bash
ls -lah /home/ernando2/ernando-portofolio/storage/logs
```

Then inspect the latest log file.

Do not expose Laravel logs through `public_html`.

---

# 28. Production Security Rules

Never commit:

```text
.env
```

Never commit real:

```text
database passwords
admin passwords
API keys
APP_KEY
production secrets
```

Never expose:

```text
vendor/
storage/
bootstrap/
config/
database/
.env
artisan
composer.json
composer.lock
```

through the public document root.

The public document root must remain:

```text
/home/ernando2/public_html
```

---

# 29. Files That Should Remain Server-Side

The following files/directories should be maintained by the production server:

```text
/home/ernando2/ernando-portofolio/.env
/home/ernando2/ernando-portofolio/storage/
/home/ernando2/ernando-portofolio/vendor/
/home/ernando2/ernando-portofolio/node_modules/
```

These should not be blindly overwritten by Git deployment.

---

# 30. Rollback

For application source code, identify the previous working Git commit:

```bash
git log --oneline
```

Then deploy the desired commit through cPanel Git Version Control.

For database migrations, use:

```bash
php artisan migrate:rollback --step=1
```

only when the corresponding migration rollback is understood and safe.

Do not perform database rollbacks blindly in production.

---

# 31. Current Production Configuration Summary

```text
Domain:
https://ernando.my.id

Document Root:
/home/ernando2/public_html

Git Repository:
/home/ernando2/repositories/ernandojanuarpratama

Laravel Application:
/home/ernando2/ernando-portofolio

PHP:
/usr/local/bin/php

PHP Version:
8.5.9

Node.js:
/home/ernando2/nodevenv/ernando-portofolio/20/bin/node

Node.js Version:
20.20.2

npm:
/home/ernando2/nodevenv/ernando-portofolio/20/bin/npm

npm Version:
10.8.2

Composer:
Not available as a global shell command.

Web Server:
LiteSpeed / Apache

Production Framework:
Laravel

Frontend Build:
Vite
```

---

# 32. Important Notes

- The domain document root is intentionally `/home/ernando2/public_html`.
- Do not change the domain document root.
- The Laravel application remains in `/home/ernando2/ernando-portofolio`.
- The Git repository remains in `/home/ernando2/repositories/ernandojanuarpratama`.
- Node.js is used for Vite/frontend builds, not as the production web server.
- The old Express.js `app.js` is not used to serve the production website.
- Do not deploy the old Node.js Passenger configuration to the domain.
- Do not overwrite the production `.env`.
- Do not overwrite production `storage/`.
- Do not use `migrate:fresh` on production.
- Do not commit production credentials.
- `APP_DEBUG=false` must be used in production.
- Always verify the website after deployment.

---

# 33. Deployment Goal

The final deployment process should be:

```text
1. Developer changes code
        ↓
2. git commit
        ↓
3. git push
        ↓
4. cPanel "Update from Remote"
        ↓
5. cPanel "Deploy HEAD Commit"
        ↓
6. .cpanel.yml runs deployment tasks
        ↓
7. Laravel application updated
        ↓
8. Public files updated
        ↓
9. Vite assets updated
        ↓
10. Laravel cache refreshed
        ↓
11. https://ernando.my.id
```

The production architecture should remain separated between the Laravel application and the public document root.