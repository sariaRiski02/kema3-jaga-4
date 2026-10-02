# Repository Guide

## Project
- Laravel 13 application for village resident and family records; requires PHP 8.3 or newer.
- Web routes are in `routes/web.php`. Controllers coordinate requests, `app/Services/` contains resident/statistics logic, `app/Models/` defines Eloquent data, and `app/Http/Requests/` holds validation and input normalization.
- The UI is primarily Blade under `resources/views/`, with Livewire components in `resources/views/components/`. Resident import/export uses Laravel Excel; PDF exports use Dompdf.

## Data And Behavior
- Treat NIK and family numbers as 16-digit strings, not integers, so leading zeroes are preserved.
- Resident records use soft deletes. Check whether a query should include deleted records before changing resident counts or uniqueness behavior.
- Keep resident validation, import normalization, forms, and exports consistent when changing resident fields or allowed values. Import templates and their behavior are documented/tested in `resources/views/dashboard/import-resident.blade.php` and `tests/Feature/ImportTemplateTest.php`.
- Family membership is represented by `FamilyRelationship`; preserve its relationship and head-of-family semantics when changing family workflows.
- User-facing labels and validation messages are Indonesian; keep them consistent with the existing screens.

## Verification
- Run the test suite with `composer test` (equivalent to `php artisan test` after clearing config).
- PHPUnit is configured to use SQLite in-memory for tests (`phpunit.xml`). Prefer focused tests while iterating, then run the full suite for behavior changes.
- `composer dev` starts the Laravel server, queue listener, log tail, and Vite together; it requires the frontend dependencies to be installed.
- Use Laravel Pint for PHP formatting: `vendor/bin/pint`.

## Change Boundaries
- Follow existing Laravel conventions and modify only the layer that owns the behavior; add or update feature tests for user-visible or data-integrity changes.
- Do not edit generated files under `public/build/` unless the task specifically requires generated assets.
- Check `git status` before editing and preserve unrelated user changes.