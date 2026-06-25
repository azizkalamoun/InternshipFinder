# Internship Finder

**Internship Finder** is a Laravel 10 web application that helps computer science students discover internship opportunities and access report-writing guidance. It provides a curated directory of companies offering IT internships, with detail views and an embedded report template viewer.

---

## Key Features

- **Company Directory** — Browse a list of companies with name, address, language, star rating, and contact information (`resources/views/societes.blade.php`, `app/Http/Controllers/StaticController.php`)
- **Company Detail Modals** — Click any company card to open a modal with full description, contact details, logo, and an image gallery carousel (`public/js/script.js:52-106`, `resources/views/societes.blade.php:104-151`)
- **Client-Side Filtering (UI)** — Filter controls for language, region, and internship level in the companies page (`resources/views/societes.blade.php:45-81`, `public/js/script.js:147-162`)
- **Internship Report Guide** — Formatting directives and an embedded Google Drive PDF viewer that switches templates based on internship level (Initiation / Perfectionnement / Fin d'études) (`resources/views/guide_rapport.blade.php`, `public/js/script.js:164-204`)
- **Sanctum API Authentication** — Token-based API authentication via `Laravel\Sanctum\HasApiTokens` (`app/Models/User.php:14`, `config/sanctum.php`)
- **Web Scraping Command** — `artisan app:web-scraper` using Symfony BrowserKit/HttpClient (prototype stage with placeholder CSS selectors) (`app/Console/Commands/WebScraper.php`)

---

## Architecture Overview

The application follows a standard Laravel MVC pattern without service, action, or repository layers. Business logic resides directly in controllers.

### Request Lifecycle

```
HTTP Request
  → public/index.php
  → bootstrap/app.php
  → App\Http\Kernel (global + web middleware group)
  → StaticController
  → Eloquent Model (Company, Image)
  → Blade View
  → HTTP Response
```

### Dependency Organization

- **Controllers** handle request logic and return views (`app/Http/Controllers/`)
- **Models** define schema, relationships, and mass-assignment protection (`app/Models/`)
- **Blade Views** render HTML with server-injected data (`resources/views/`)
- **Frontend assets** (SCSS, JS) are compiled into `public/dist/` and `public/js/`

---

## Application Structure

```
app/
├── Console/
│   ├── Commands/
│   │   └── WebScraper.php              # artisan app:web-scraper
│   └── Kernel.php                       # Console kernel (no scheduled tasks)
├── Exceptions/
│   └── Handler.php                      # Exception handler
├── Http/
│   ├── Controllers/
│   │   ├── Controller.php               # Base controller (AuthorizesRequests, ValidatesRequests)
│   │   ├── CompanyController.php        # Empty placeholder
│   │   └── StaticController.php         # 4 page-serving methods
│   ├── Middleware/                       # Standard Laravel middleware stack
│   └── Kernel.php                       # HTTP kernel (web & api groups)
├── Models/
│   ├── Company.php                      # companies (MySQL), hasMany(Image)
│   ├── Image.php                        # images (MongoDB), belongsTo(Company)
│   └── User.php                         # users (MySQL), HasApiTokens, Notifiable
└── Providers/
    ├── AppServiceProvider.php           # Empty
    ├── AuthServiceProvider.php          # Empty policies array
    ├── BroadcastServiceProvider.php     # Broadcast routes
    ├── EventServiceProvider.php         # Registered → SendEmailVerificationNotification
    └── RouteServiceProvider.php         # API rate limiting (60/min), route loading
database/
├── factories/
│   └── UserFactory.php                  # Faker-based user factory
├── migrations/
│   ├── 2014_10_12_000000_create_users_table.php
│   ├── 2014_10_12_100000_create_password_reset_tokens_table.php
│   ├── 2019_08_19_000000_create_failed_jobs_table.php
│   ├── 2019_12_14_000001_create_personal_access_tokens_table.php
│   ├── 2023_11_24_211825_create_companies_table.php
│   └── 2023_11_24_222128_create_images_table.php   # MongoDB connection
├── seeders/
│   └── DatabaseSeeder.php               # Empty (no seed data)
resources/
├── css/
│   └── app.css                          # Empty
├── js/
│   ├── app.js                           # Imports bootstrap.js
│   └── bootstrap.js                     # Axios setup, Echo/Pusher stubs (commented out)
└── views/
    ├── index.blade.php                  # Homepage (ACCUEIL)
    ├── societes.blade.php               # Company listing + detail modals
    ├── guide_rapport.blade.php          # Report guide + PDF viewer
    └── a_propos.blade.php               # About page
routes/
├── web.php                              # 4 named GET routes
├── api.php                              # 1 Sanctum-protected route
├── console.php                          # inspire command
└── channels.php                         # Default user channel auth
tests/
├── Feature/
│   └── ExampleTest.php                  # GET / returns 200
├── Unit/
│   └── ExampleTest.php                  # assertTrue(true)
├── TestCase.php
└── CreatesApplication.php
public/
├── dist/                                # 16 compiled CSS files + source maps
├── fonts/                               # Montserrat family + FRADM
├── images/                              # 29 logo, icon, and company image files
├── js/
│   └── script.js                        # jQuery interactions, modal gallery, filtering
├── scss/                                # 8 source SCSS files
├── index.php
├── .htaccess
├── favicon.ico
└── robots.txt
```

### Directory Responsibilities

| Directory | Responsibility |
|-----------|---------------|
| `app/Console/Commands/` | Custom Artisan commands (web scraper) |
| `app/Http/Controllers/` | Request handling and view rendering |
| `app/Http/Middleware/` | Request filtering (auth, CSRF, etc.) |
| `app/Models/` | Eloquent models with relationships |
| `app/Providers/` | Service providers for framework bootstrapping |
| `database/migrations/` | Schema definitions (MySQL + MongoDB) |
| `database/seeders/` | Database seeding (empty) |
| `resources/views/` | Blade templates |
| `routes/` | Route definitions |
| `tests/` | PHPUnit test suites |
| `public/dist/` | Compiled CSS output |
| `public/scss/` | SCSS source files |
| `public/js/` | Compiled/plain JavaScript |

---

## Routing

### Web Routes (`routes/web.php`)

| Method | URI | Controller | Method | Route Name |
|--------|-----|-----------|--------|------------|
| GET | `/` | `StaticController` | `index` | `index` |
| GET | `/societes` | `StaticController` | `societes` | `societes` |
| GET | `/guide_rapport` | `StaticController` | `guide_rapport` | `guide_rapport` |
| GET | `/a_propos` | `StaticController` | `a_propos` | `a_propos` |

All web routes use the `web` middleware group (CSRF protection, sessions, cookie encryption, encrypted cookies, substitute bindings).

### API Routes (`routes/api.php`)

| Method | URI | Middleware | Returns |
|--------|-----|-----------|---------|
| GET | `/api/user` | `auth:sanctum` | Authenticated user |

The API group applies `ThrottleRequests:api` (rate limit: 60 requests/min as defined in `RouteServiceProvider`) and `SubstituteBindings`. Sanctum's `EnsureFrontendRequestsAreStateful` middleware is commented out.

No API versioning, route prefixes beyond the default `api/`, or route naming conventions are implemented.

---

## Controllers

**`StaticController`** (`app/Http/Controllers/StaticController.php`) — the only functional controller:

- `index()` — Returns the homepage view
- `societes(Company $company, Image $image)` — Fetches all companies and images, passes them to the `societes` view
- `guide_rapport()` — Returns the report guide view
- `a_propos()` — Returns the about page view

**`CompanyController`** — Exists as an empty file. No methods are defined.

**`Controller`** — Base class used by all controllers; imports `AuthorizesRequests` and `ValidatesRequests`.

---

## Database Layer

### Models

**`User`** (`app/Models/User.php`)
- Table: `users` (MySQL)
- Traits: `HasApiTokens`, `HasFactory`, `Notifiable`
- `$fillable`: `name`, `email`, `password`
- `$hidden`: `password`, `remember_token`
- `$casts`: `email_verified_at` → `datetime`, `password` → `hashed`

**`Company`** (`app/Models/Company.php`)
- Table: `companies` (MySQL)
- Trait: `HasFactory`
- `$fillable`: `name_company`, `adresse`, `logo_img`, `language`, `description`, `phone`, `email`, `full_location`, `linked_in_name`, `website`, `rating`
- Relationship: `images()` — `hasMany(Image::class)`

**`Image`** (`app/Models/Image.php`)
- Collection: `images` (MongoDB, via `mongodb/laravel-mongodb`)
- `$fillable`: `company_id`, `image_path`
- Relationship: `company()` — `belongsTo(Company::class)`

### Relationships

```
Company (MySQL)
  └── hasMany → Image (MongoDB, FK: company_id)
```

### Migrations

| Migration | Table/Collection | Key Columns |
|-----------|-----------------|-------------|
| `2014_10_12_000000_create_users_table` | `users` (MySQL) | `id`, `name`, `email` (unique), `email_verified_at`, `password`, `remember_token` |
| `2014_10_12_100000_create_password_reset_tokens_table` | `password_reset_tokens` (MySQL) | `email` (PK), `token` |
| `2019_08_19_000000_create_failed_jobs_table` | `failed_jobs` (MySQL) | `id`, `uuid` (unique), `connection`, `queue`, `payload`, `exception` |
| `2019_12_14_000001_create_personal_access_tokens_table` | `personal_access_tokens` (MySQL) | `id`, `tokenable` (morphs), `name`, `token` (unique), `abilities`, `last_used_at`, `expires_at` |
| `2023_11_24_211825_create_companies_table` | `companies` (MySQL) | `id`, `name_company`, `adresse`, `logo_img`, `language`, `description`, `phone`, `email`, `full_location`, `linked_in_name`, `website`, `rating` |
| `2023_11_24_222128_create_images_table` | `images` (MongoDB) | `_id`, `company_id` (FK → companies), `image_path` |

### Factories & Seeders

- `UserFactory` — Generates users with Faker data, includes an `unverified()` state
- `DatabaseSeeder` — Empty (no seed data); user factory calls are commented out

No Company or Image factories exist.

---

## Authentication & Authorization

- **Sanctum** (`laravel/sanctum ^3.3`, `config/sanctum.php`): API token authentication via `HasApiTokens` trait on the `User` model. The `personal_access_tokens` table stores tokens. Stateful domain configuration is present but `EnsureFrontendRequestsAreStateful` middleware is commented out in the API group.
- **Web Guard** — Session-based authentication (`config/auth.php`). The `Authenticate` middleware redirects unauthenticated users to the named `login` route.
- No policies, gates, roles, or permissions are defined. `AuthServiceProvider::$policies` is empty.

---

## Validation & Error Handling

- **Validation**: The base `Controller` uses `ValidatesRequests`, providing inline `$this->validate()` capability. No Form Request classes or custom validation rules exist.
- **Error Handling**: Default Laravel exception handler (`app/Exceptions/Handler.php`) with `dontFlash` for `current_password`, `password`, and `password_confirmation`. No custom exceptions or API error response formats.

---

## Frontend

- **Blade** templates with plain HTML/CSS/JavaScript (no frontend framework)
- **SCSS** — 8 source files in `public/scss/` compiled to 16 output files in `public/dist/` (with source maps)
- **jQuery 3.7** — Back-to-top button, modal gallery, image carousel, client-side filtering
- **Font Awesome 4.7** — Star ratings and social media icons
- **Vite** — Asset bundling via `laravel-vite-plugin` (`resources/js/app.js`)
- **Axios** — Bundled but unused at the page level (available via `window.axios`)
- **Montserrat** font family (22 variants + FRADM) in `public/fonts/`

### JavaScript (`public/js/script.js`)

| Function | Lines | Description |
|----------|-------|-------------|
| Back-to-top button | 1-17 | Shows/hides scroll-to-top button |
| Custom cursor | 19-49 | Animated circle cursor on homepage |
| Modal gallery | 52-145 | Company detail modals with image carousel |
| Company filtering | 147-162 | Filters `.item` elements by region (client-side only) |
| Report iframe | 164-204 | Switches Google Drive PDF preview by internship level |

---

## Backend Dependencies (`composer.json`)

| Package | Version | Purpose | Usage |
|---------|---------|---------|-------|
| `laravel/framework` | ^10.10 | Core MVC framework | Throughout application |
| `laravel/sanctum` | ^3.3 | API token authentication | `User` model trait, `/api/user` route, `personal_access_tokens` migration |
| `laravel/tinker` | ^2.8 | Artisan REPL | Development utility |
| `guzzlehttp/guzzle` | ^7.2 | HTTP client | Dependency for Symfony HttpClient in WebScraper |
| `mongodb/laravel-mongodb` | ^4.0 | MongoDB Eloquent driver | `images` collection migrations and model |
| `phpunit/phpunit` | ^10.1 | Testing framework | `phpunit.xml`, test suites |

## Frontend Dependencies (`package.json`)

| Package | Version | Purpose |
|---------|---------|---------|
| `axios` | ^1.6.1 | HTTP client |
| `laravel-vite-plugin` | ^0.8.0 | Laravel Vite integration |
| `vite` | ^4.0.0 | JavaScript asset bundler |

---

## Console Commands

**`app:web-scraper`** (`app/Console/Commands/WebScraper.php`)

A prototype command that:
- Targets `yellowpages.com.tn`, `kompass.com.tn`, `emploitic.com`, `linkedin.com`
- Uses `Symfony\Component\BrowserKit\HttpBrowser` and `Symfony\Component\HttpClient\HttpClient`
- Extracts data via placeholder CSS selectors (e.g., `your-selector-for-company-name`)
- Writes scraped data to `companies.json`

No scheduled tasks are configured in `Console\Kernel`.

---

## API Design

The API layer is minimal:

- **Single endpoint**: `GET /api/user` protected by `auth:sanctum`
- **Rate limiting**: 60 requests per minute per user/IP (`RouteServiceProvider`)
- **CORS**: Configured for all origins on `api/*` and `sanctum/csrf-cookie` paths (`config/cors.php`)
- No API resources, transformers, pagination, filtering, sorting, or search endpoints exist

---

## Testing

- **Framework**: PHPUnit 10 (`phpunit.xml`)
- **Test suites**: `Unit` and `Feature`
- **Test files**:
  - `tests/Feature/ExampleTest.php` — Asserts `GET /` returns 200
  - `tests/Unit/ExampleTest.php` — Asserts `true === true`
- **Environment settings** (`phpunit.xml`): `APP_ENV=testing`, `CACHE_DRIVER=array`, `QUEUE_CONNECTION=sync`, `SESSION_DRIVER=array`, `MAIL_MAILER=array`

```bash
php artisan test
# or
vendor/bin/phpunit
```

---

## Environment Configuration

Configuration is managed through `.env`:

| Variable | Default | Category |
|----------|---------|----------|
| `APP_NAME` | Laravel | Application |
| `APP_ENV` | local | Application |
| `APP_DEBUG` | true | Application |
| `APP_URL` | http://localhost | Application |
| `DB_CONNECTION` | mysql | Database |
| `DB_HOST` | 127.0.0.1 | Database |
| `DB_DATABASE` | project | Database |
| `SANCTUM_STATEFUL_DOMAINS` | localhost,localhost:3000,… | Authentication |
| `MAIL_MAILER` | smtp | Mail |
| `QUEUE_CONNECTION` | sync | Queue |
| `SESSION_DRIVER` | file | Session |
| `CACHE_DRIVER` | file | Cache |
| `FILESYSTEM_DISK` | local | Filesystem |

---

## Development Setup

**Requirements**: PHP ^8.1, Composer, Node.js, MySQL, MongoDB

```bash
# Clone and install
git clone <repository-url>
cd InternshipFinder
composer install
npm install

# Environment
cp .env.example .env
# Edit .env: set DB_DATABASE, MongoDB connection if needed

# Application setup
php artisan key:generate
php artisan migrate

# Development servers (terminal 1)
php artisan serve

# Terminal 2 (optional, for JS/SCSS)
npm run dev

# Run tests
php artisan test
```

---

## Deployment

No deployment configuration (Docker, Forge, Envoyer, GitHub Actions, etc.) is present in this repository. Standard Laravel deployment practices apply.

---

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT). This project inherits the same license as indicated in `composer.json`.
