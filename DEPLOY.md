# Deployment Guide

Production deployment notes for the Ernando Januar Pratama portfolio (Laravel + MySQL + Vite).

## Requirements
- PHP 8.3+ (extensions: `pdo_mysql`, `gd`, `fileinfo`)
- Composer 2
- Node.js 20+ / npm
- MySQL 8+
- Web server: Nginx (sample below), Apache, or Caddy

## Server setup
```bash
# 1. Copy code to server, then inside project root:
composer install --no-dev --optimize-autoloader

# 2. Build frontend assets
npm ci
npm run build

# 3. Environment
cp .env.example .env
#   APP_ENV=production
#   APP_DEBUG=false
#   APP_URL=https://your-domain.com
#   DB_CONNECTION=mysql, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD
#   ADMIN_NAME / ADMIN_EMAIL / ADMIN_PASSWORD (admin credentials)

php artisan key:generate

# 4. Database + storage
php artisan migrate --force
php artisan storage:link

# 5. Cache
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 6. Permissions (Laravel defaults)
chmod -R 775 storage bootstrap/cache
```

## Nginx sample
```nginx
server {
    listen 443 ssl http2;
    server_name your-domain.com;

    root /var/www/ernando-portfolio/public;
    index index.php;

    # Force HTTPS (app also forces https:// scheme in production)
    # ssl_certificate / ssl_certificate_key ...

    add_header X-Content-Type-Options nosniff;
    add_header X-Frame-Options DENY;
    add_header Referrer-Policy strict-origin-when-cross-origin;

    location / {
        try_files $uri /index.php?$query_string;
    }

    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock; # adjust version
    }

    location ~ /\.(?!well-known).* { deny all; }
}
```

## Post-deploy checks
- `https://your-domain.com/` — landing renders, images load
- `https://your-domain.com/robots.txt` — disallows `/admin`, points to sitemap
- `https://your-domain.com/sitemap.xml` — single URL entry with `lastmod`
- `https://your-domain.com/cv` — downloads `{name}-CV.pdf` (404 until a CV is uploaded in admin)
- `/admin` — login, dashboard, CRUD; uploads under `storage/app/public`

## Updates
```bash
git pull
composer install --no-dev --optimize-autoloader   # only if composer.lock changed
npm ci && npm run build                            # only if frontend changed
php artisan migrate --force
php artisan optimize:clear && php artisan config:cache route:cache view:cache
```

## Rollback
```bash
php artisan migrate:rollback --step=1
```

## Notes
- No queues/scheduler are used in this app.
- `APP_DEBUG=false` required in production; never commit real `.env`.
- Email is mailto-based (no SMTP required).