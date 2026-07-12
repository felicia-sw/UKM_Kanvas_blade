# UKM Kanvas

Web app for the UKM Kanvas student art organization: public event listings and
art gallery, member registration with WhatsApp payment confirmation (Fonnte),
merchandise shop with cart/checkout, member dues, and an admin panel for
events, artworks, finances, and order verification.

**Stack:** Laravel 12 (Blade), Bootstrap 5 (CDN), MySQL (production) /
SQLite (tests), Cloudinary for image hosting, Fonnte for WhatsApp.

## Local setup

```bash
composer install
cp .env.example .env          # fill in CLOUDINARY_URL + FONNTE_TOKEN if needed
php artisan key:generate
# point DB_* at your local MySQL (or use sqlite), then:
php artisan migrate --seed
php artisan serve
```

Seeded accounts (local only — change these anywhere public):

| Role   | Email               | Password        |
| ------ | ------------------- | --------------- |
| Admin  | admin@gmail.com     | adminKanvas123  |
| Member | student@kanvas.com  | password        |

Without `CLOUDINARY_URL` the app still runs; image uploads fail gracefully
and store no file. Without `FONNTE_TOKEN` WhatsApp confirmations are skipped
(the admin sees a note when verifying payments).

## Tests

```bash
php artisan test
```

Feature tests run on in-memory SQLite (see `phpunit.xml`) and cover auth,
authorization/ownership, event registration, and merchandise checkout.
Cloudinary is faked via `Tests\Concerns\FakesCloudinary`.

## Code style

```bash
./vendor/bin/pint
```

## Deployment

Pushing to `main` triggers `.github/workflows/infinity-free.yml`, which
builds `vendor/` (composer, PHP 8.3) and `public/build` (Vite) in CI and
FTP-syncs to InfinityFree. The server keeps its own `.env` (edited via the
InfinityFree file manager; deploys never touch it), and database migrations
must be applied manually through phpMyAdmin — InfinityFree has no SSH.

Note: no Blade view currently loads the Vite bundle (`@vite`); the frontend
runs on the CDN links plus the static files in `public/css` and `public/js`.
