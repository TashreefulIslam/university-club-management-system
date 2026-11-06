Production checklist for UCMS

1. Environment
- Set `APP_ENV=production` and `APP_DEBUG=false` in `.env`.
- Set `APP_URL` to your production URL (e.g. https://example.com).
- Ensure `APP_KEY` is set: `php artisan key:generate --ansi`.

2. Dependencies & build
- Install PHP deps: `composer install --optimize-autoloader --no-dev`.
- Install node deps & build (if using frontend assets):
  - `npm ci`
  - `npm run build`

3. Storage & file system
- Ensure `public/storage` exists and points to `storage/app/public`:

```bash
php artisan storage:link
```

- If using S3 or CDN, configure `FILESYSTEM_DRIVER`/`FILESYSTEM_DISK` in `.env` and verify `config/filesystems.php`.

4. Database
- Run migrations and seeders (if applicable):

```bash
php artisan migrate --force
php artisan db:seed --class=DatabaseSeeder --force
```

5. Caching & config
- Cache config/routes/views for performance:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

6. Queues & scheduler
- Configure queue worker (supervisor/systemd) to run `php artisan queue:work --sleep=3 --tries=3`.
- Ensure scheduler runs every minute via cron:

```
* * * * * cd /path/to/your/app && php artisan schedule:run >> /dev/null 2>&1
```

7. HTTPS, headers, and security
- Serve via HTTPS (Let’s Encrypt or another CA).
- Set secure cookies and proper session domain in `.env`.
- Set `SESSION_SECURE_COOKIE=true` and `SESSION_DRIVER` appropriately.

8. File permissions
- Ensure web server user can write to `storage/` and `bootstrap/cache`.

9. Monitoring & backups
- Set up logging & error monitoring (Sentry, Loggly, etc.).
- Schedule regular DB backups and media backups.

10. Final checks
- Run `php artisan migrate --force` and verify.
- Check that profile/club/event/gallery images load (visit pages).
- Verify role-restricted pages: `users`, `members`, `registrations`.

Notes:
- If you use a cloud disk (S3), prefer `Storage::url($path)` in views (already used in gallery). The application now uses `Storage::url()` for gallery images to support multiple disks.
- Keep `APP_DEBUG=false` in production to avoid leaking sensitive information.
