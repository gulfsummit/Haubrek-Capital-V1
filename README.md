# Hauberk Capital

Bilingual corporate website and content-management system built with Laravel, Blade, and Filament. Public pages use database-backed content alongside Blade templates and static design assets; administrators manage much of that content through Filament.

## Technology

- PHP `^8.1` and Laravel `^10.10`
- Filament `3.3`
- Blade-rendered public site with English and Arabic content
- Vite for selected frontend assets; additional assets live under `public/design`
- Eloquent models, migrations, and seeders for site content and submissions

## Project Layout

- `app/Http/Controllers/Admin/FrontendController.php`: main public-page and form controller
- `app/Filament/Admin`: CMS resources, pages, and admin forms
- `app/Models`: database-backed page content and submission models
- `routes/web.php`: public routes, locale switching, forms, and sitemap endpoints
- `database/migrations` and `database/seeders`: schema and initial data
- `database/backups`: SQL database snapshots; treat them as sensitive data
- `resources/views`: public Blade pages and shared templates
- `public/design`: static public-site assets
- `scripts`: operational shell scripts; inspect before running
- `docs`: project state, Git baseline, and implementation guides

## Local Setup

Requirements: PHP 8.1+, Composer, Node.js/npm, and a database configured for this environment.

```sh
composer install
npm install
```

Create `.env` from `.env.example` if needed. Configure the application URL, database, mail, storage, and reCAPTCHA settings for your environment. Do not copy production secrets into documentation or commit `.env`.

```sh
php artisan key:generate
```

After confirming the configured database is the intended local database and has an appropriate backup, prepare it and start the app:

```sh
php artisan migrate
php artisan storage:link
php artisan serve
```

For Vite-managed asset work, run this in a separate terminal:

```sh
npm run dev
```

Useful checks:

```sh
php artisan route:list
php artisan migrate:status
php artisan test
npm run build
```

## Documentation

- [Project state and architecture](docs/PROJECT_STATE.md): codebase structure, request flow, setup, and current cautions.
- [Git change snapshot](docs/GIT_CHANGE_SNAPSHOT_2026-09-26.md): local baseline and limits of Git authorship evidence.
- [Working with this project](docs/SOP_WORKING_WITH_THIS_PROJECT.md): detailed development workflow and implementation notes.
- [Page builder components](docs/SOP_PAGE_BUILDER_COMPONENTS.md): guidance for dynamic Filament-managed sections.
- [reCAPTCHA setup](docs/RECAPTCHA_SETUP.md): environment configuration and form integration.
- [Newsletter popup guide](docs/NEWSLETTER_POPUP_GUIDE.md): editing and triggering the newsletter popup.

## Important Notes

- This working copy was copied from a live environment, but has not been verified against a known production revision. See the Git snapshot before starting work.
- The active Git repository was initialized from scratch on 2026-09-26. Its initial project snapshot has not been committed yet; the previous Git metadata is preserved in the sibling directory `../hauberk-capital-git-backup-20260926`.
- Review both staged and unstaged diffs before changing shared files: `git diff --cached` and `git diff` may show different versions of a file.
- SQL dumps under `database/backups` may contain production data. Check them for personal information and secrets before loading, sharing, or committing them.
- `scripts/fix-permissions.sh` uses `sudo` and clears Laravel's cached views/cache; run it only when that maintenance is intended for the current environment.
- `DatabaseSeeder` currently invokes only a subset of the available seeders; inspect the relevant seeder before assuming all CMS content is populated.
