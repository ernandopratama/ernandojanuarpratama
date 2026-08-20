# Ernando Januar Pratama — Portfolio

Personal portfolio website built with **Laravel, Blade, Tailwind CSS, Node.js, Vite, and MySQL**.

This project presents my professional profile, work experience, education, technical skills, projects, and social links through a responsive portfolio website. It also includes an authenticated admin CMS for managing portfolio content.

## Features

### Public Portfolio

- Profile and introduction
- Professional experience
- Project portfolio
- Technical skills
- Education history
- Social links
- Responsive design
- Dynamic content from MySQL
- Project and skill relationships

### Admin CMS

- Admin authentication
- Login and logout
- Protected admin routes
- Dashboard with portfolio statistics
- Profile management
- Experience CRUD
- Project CRUD
- Project thumbnail upload
- Project-Skill management
- Skill CRUD
- Education CRUD
- Social Link CRUD
- Form validation
- Flash messages
- Responsive admin interface

## Tech Stack

| Technology | Usage |
|---|---|
| Laravel | Backend framework |
| PHP | Application language |
| Blade | Server-side templating |
| Tailwind CSS | UI styling |
| Node.js | Frontend tooling |
| Vite | Asset bundling |
| MySQL | Database |
| Eloquent ORM | Database interaction |
| Git | Version control |

## Architecture

```text
Public Portfolio
       ↓
PortfolioController
       ↓
Eloquent Models
       ↓
MySQL

Admin CMS
       ↓
Admin Controllers
       ↓
Eloquent Models
       ↓
MySQL
       ↓
Public Portfolio
```

## Requirements

- PHP 8.2+
- Composer
- Node.js 20+
- npm
- MySQL 8+
- Git

Check your environment:

```bash
php -v
composer -V
node -v
npm -v
mysql --version
```

## Installation

Clone the repository:

```bash
git clone <repository-url>
cd ernando-portfolio
```

Install PHP dependencies:

```bash
composer install
```

Install Node dependencies:

```bash
npm install
```

Create the environment file:

```bash
cp .env.example .env
```

Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

## Database Configuration

Create a MySQL database and configure `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ernando_portfolio
DB_USERNAME=root
DB_PASSWORD=
```

Run migrations:

```bash
php artisan migrate
```

Run seeders when available:

```bash
php artisan db:seed
```

Or:

```bash
php artisan migrate --seed
```

## Storage

Create the Laravel public storage link:

```bash
php artisan storage:link
```

Profile images, CV files, and project thumbnails use Laravel's public storage disk.

## Development

Start Laravel:

```bash
php artisan serve
```

In another terminal:

```bash
npm run dev
```

Public portfolio:

```text
http://127.0.0.1:8000
```

Admin area:

```text
http://127.0.0.1:8000/admin
```

Admin login:

```text
http://127.0.0.1:8000/admin/login
```

## Production Build

Build frontend assets:

```bash
npm run build
```

Clear Laravel caches:

```bash
php artisan optimize:clear
```

For production deployments, cache configuration/routes/views as appropriate:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Authentication

The admin area uses Laravel session-based authentication.

Admin routes are protected by the `admin` middleware.

```text
/admin
   ↓
Not authenticated
   ↓
/admin/login
   ↓
Login
   ↓
Admin authorization
   ↓
/admin
```

Logout uses POST and invalidates the authenticated session.

## Portfolio Data

The public portfolio uses the same MySQL database as the admin CMS.

```text
MySQL
  ↓
Eloquent
  ↓
PortfolioController
  ↓
Blade Components
  ↓
Public Portfolio
```

Changes made through the admin panel are reflected on the public portfolio.

## Main Data Entities

```text
Profile
Experience
Project
Skill
Education
Social Link

Project
   ↕
Project-Skill
   ↕
Skill
```

## Project Structure

```text
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/
│   │   └── PortfolioController.php
│   ├── Middleware/
│   └── Requests/
│       └── Admin/
│
├── Models/
│
database/
├── migrations/
├── seeders/
└── factories/

resources/
├── css/
├── js/
└── views/
    ├── portfolio/
    │   └── components/
    └── admin/

routes/
└── web.php

public/
└── storage/
```

## Design System

Primary colors:

```text
#0A2947
#8B5E3C
#D3D4C0
#F3E4C9
```

Typography:

- Plus Jakarta Sans
- JetBrains Mono

The public portfolio design originated from Google Stitch and was implemented using Laravel Blade and Tailwind CSS.

## Development Phases

### Phase 1 — Public Landing Page

- [x] Landing page
- [x] Blade component structure
- [x] Tailwind CSS
- [x] Responsive design
- [x] Google Stitch design implementation

### Phase 2 — Frontend

- [x] Public portfolio UI
- [x] Responsive behavior
- [x] Animations
- [x] Interactive components

### Phase 3 — Database

- [x] Profile
- [x] Experience
- [x] Project
- [x] Skill
- [x] Education
- [x] Social Link
- [x] Project-Skill relationship
- [x] Dynamic landing page

### Phase 4 — Authentication

- [x] Admin login
- [x] Logout
- [x] Admin middleware
- [x] Session authentication
- [x] Admin authorization

### Phase 5 — Admin CMS

- [x] Dashboard
- [x] Profile management
- [x] Experience CRUD
- [x] Project CRUD
- [x] Project thumbnail upload
- [x] Project-Skill synchronization
- [x] Skill CRUD
- [x] Education CRUD
- [x] Social Link CRUD

## Git Workflow

Check repository status:

```bash
git status
```

Add the README:

```bash
git add README.md
```

Commit:

```bash
git commit -m "docs: add project README"
```

Push:

```bash
git push origin main
```

## Environment Variables

Do not commit `.env`.

Use `.env.example` as the configuration template.

Example:

```env
APP_NAME=
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

Keep actual credentials only in `.env`.

## Testing

Run:

```bash
php artisan test
```

Before committing changes, verify:

```bash
php artisan optimize:clear
php artisan route:list
php artisan migrate:status
php artisan test
npm run build
```

## License

This is a personal portfolio project.

Personal content, profile information, project information, images, and original assets are owned by the respective author unless otherwise stated.
