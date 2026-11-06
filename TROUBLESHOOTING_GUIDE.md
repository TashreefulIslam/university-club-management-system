# UCMS Troubleshooting Guide

Solve common issues step by step.

---

## Before You Start

1. Ensure PHP and MySQL are running
2. Run `php artisan serve` 
3. Run `npm run dev` (optional but recommended)
4. Access `http://127.0.0.1:8000`

---

## 🔴 Server Won't Start

### Problem: `php artisan serve` shows error

**Solution:**

1. Check PHP is installed:
```bash
php -v
```

2. Check `.env` file exists:
```bash
# Copy if missing:
copy .env.example .env
php artisan key:generate
```

3. Clear cache:
```bash
php artisan cache:clear
php artisan config:clear
```

4. Try again:
```bash
php artisan serve
```

---

## 🔴 Database Connection Error

### Problem: "SQLSTATE[HY000]: General error" or database-related errors

**Solution:**

1. **Check MySQL is running:**
   - Windows: Start XAMPP, click MySQL "Start" button
   - Verify it shows "Running" in green

2. **Check `.env` database config:**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ucms  # Change if your DB name is different
DB_USERNAME=root
DB_PASSWORD=       # Usually empty for XAMPP
```

3. **Verify database exists in MySQL:**
   - Open phpMyAdmin: `http://localhost/phpmyadmin`
   - Look for your database (e.g., `ucms`)
   - If missing, create it

4. **Run migrations:**
```bash
php artisan migrate
```

---

## 🔴 Landing Page Shows Errors

### Problem: Homepage or dashboard shows blank page or 500 error

**Solution:**

1. **Check logs for specific error:**
```bash
tail -f storage/logs/laravel.log
```

2. **Enable debug mode:**
   - Edit `.env`: Set `APP_DEBUG=true`
   - Refresh browser
   - Error message will show

3. **Clear all caches:**
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:cache --forget
```

4. **Regenerate app key if missing:**
```bash
php artisan key:generate
```

---

## 🔴 Dashboard Shows Same Content for All Roles

### Problem: Every user sees identical dashboard regardless of role

**Solution:**

1. **Verify user role in database:**
   - Open phpMyAdmin
   - Go to `users` table
   - Check the `role` column for your logged-in user
   - Valid values: `student`, `club_leader`, `super_admin`

2. **Update role if needed:**
```sql
UPDATE users SET role = 'super_admin' WHERE email = 'your_email@test.com';
```

3. **Refresh browser:**
   - Log out: Click "Logout" button
   - Log back in with same credentials
   - Dashboard should now show role-specific content

4. **Check if sidebar shows different links:**
   - Student: See "Browse clubs", "Browse events"
   - Leader: See "Create event", "Review registrations"
   - Admin: See "Create club", "Manage all clubs"

---

## 🔴 Can't Register/Create Accounts

### Problem: Registration form gives errors or doesn't submit

**Solution:**

1. **Check validation errors:**
   - Fill form and submit
   - Red error messages will appear below each field

2. **Common validation issues:**
   - Email already exists: Use different email
   - Password too weak: Use at least 8 characters
   - Password mismatch: Confirm password must match

3. **Check database can be written:**
```bash
php artisan migrate:refresh
```

4. **Verify CSRF token exists:**
   - Check browser console (F12) for CSRF errors
   - Check if `<meta name="csrf-token">` exists in page source

---

## 🔴 Can't Create Clubs/Events

### Problem: "Create Club" or "Create Event" buttons missing or redirect to 403 error

**Solution:**

1. **Check your role:**
   - Only Super Admin and Club Leader can create
   - 
   - Verify role in databasStudents cannot createe (see above)

2. **Check permissions in database:**
```sql
SELECT id, email, role FROM users WHERE id = YOUR_USER_ID;
```

3. **If you need to create:**
   - Log out
   - Log in as admin account
   - Or change your role to `club_leader`

4. **Verify routes exist:**
```bash
php artisan route:list | grep clubs
```

---

## 🔴 "Page Not Found" (404) Errors

### Problem: Click a link and get "404 Not Found"

**Solution:**

1. **Verify routes are registered:**
```bash
php artisan route:list
```

2. **Check route names match:**
   - In sidebar: `route('clubs.index')`
   - Verify route exists in `routes/web.php`

3. **Clear route cache:**
```bash
php artisan route:cache --forget
```

4. **If specific page missing:**
   - Check table exists in database:
```bash
php artisan migrate:refresh
```

---

## 🔴 Images/Files Not Uploading

### Problem: Can't upload club logo, event banner, or gallery images

**Solution:**

1. **Create public storage symlink:**
```bash
php artisan storage:link
```

2. **Check file permissions:**
   - Windows: Usually not an issue
   - Linux/Mac: Run `chmod 755 storage` and `chmod 755 public/storage`

3. **Verify storage directory exists:**
   - Check folder: `storage/app/public/`
   - Should exist after `php artisan storage:link`

4. **Check file size limits:**
   - Default max: Check `.env` or `php.ini`
   - Keep images under 5MB

5. **Verify upload form works:**
   - Check network tab in browser (F12)
   - Look for 413, 422, or 500 errors

---

## 🔴 Certificates Not Generating

### Problem: Certificate PDF generation fails or empty download

**Solution:**

1. **Check DomPDF is installed:**
```bash
composer require barryvdh/laravel-dompdf
```

2. **Verify certificate workflow:**
   - Attendance must be marked "Present" first
   - Can't generate for absent attendees
   - Check `attendances` table status

3. **Check PDF generation**
   - Go to "Event Registrations"
   - Find event with present attendees
   - Click "Generate Certificate"
   - Should create PDF in `storage/app/public/certificates/`

4. **PDF file permissions:**
```bash
chmod 755 storage/app/public/certificates/
```

5. **Storage link must exist:**
```bash
php artisan storage:link
```

---

## 🔴 Notifications Not Showing

### Problem: Notification bell is empty or no notifications appear

**Solution:**

1. **Notifications depend on actions:**
   - Club join requests
   - Registration approval/rejection
   - Certificate generation
   - Check if these actions have occurred

2. **If no notifications after actions:**
   - Check `notifications` table in database:
```bash
SELECT * FROM notifications ORDER BY created_at DESC LIMIT 5;
```

3. **Manually test notification:**
   - As admin: Approve a student's event registration
   - Student should see notification in top-right bell icon

4. **Mark as read:**
   - Click notification
   - Should be marked read and removed from count

---

## 🔴 Database Migrations Failed

### Problem: `php artisan migrate` gives errors

**Solution:**

1. **Check migration files exist:**
```bash
ls database/migrations/
```

2. **If missing tables, refresh:**
```bash
# WARNING: This deletes all data!
php artisan migrate:refresh

# Or just run migrations:
php artisan migrate
```

3. **Check specific migration error:**
```bash
php artisan migrate --verbose
```

4. **If foreign key error:**
   - MySQL might have strict mode enabled
   - Create `.env` setting:
```env
DB_STRICT_MODE=false
```

---

## 🔴 Sidebar/Navigation Not Showing

### Problem: Sidebar is missing or shows limited menu items

**Solution:**

1. **Check you're logged in:**
   - If not logged in, sidebar is hidden
   - Go to `/login` and log in

2. **Check authenticated layout:**
   - Sidebar comes from `resources/views/layouts/app.blade.php`
   - Verify file exists and has proper syntax

3. **Clear view cache:**
```bash
php artisan view:clear
```

4. **Verify all navigation routes exist:**
   - Each sidebar link should point to real route
   - Check routes/web.php for these routes

---

## 🔴 Assets (CSS/JavaScript) Not Loading

### Problem: Page looks broken, no colors, buttons don't work

**Solution:**

1. **Build frontend assets:**
```bash
npm run build
```

2. **Or watch for changes:**
```bash
npm run dev
```
(Keep this running in separate terminal while coding)

3. **Check `/public` folder has assets:**
   - Should see: `/public/build/manifest.json`
   - Should see: `/public/build/assets/` folder

4. **Clear Vite cache:**
```bash
rm -rf node_modules/.vite
npm run build
```

5. **If still broken, reinstall:**
```bash
npm install
npm run build
```

---

## 🔴 CORS or AJAX Errors

### Problem: Browser console shows CORS errors or AJAX requests failing

**Solution:**

1. **For local development:**
   - Usually not an issue with `php artisan serve`
   - Verify both server and app URL match

2. **Check request URL:**
   - Browser DevTools (F12) → Network tab
   - Look at failed requests
   - Verify URL path is correct

3. **Check CSRF token:**
   - In `<head>`: Should see `<meta name="csrf-token" content="...">`
   - In form: Should have `{{ csrf_field() }}`

---

## 🟡 Performance Issues

### Problem: Page loads slowly or times out

**Solution:**

1. **Enable query debugging:**
```env
APP_DEBUG=true
```

2. **Check database queries:**
   - Use Laravel Debugbar or Log Viewer
   - Look for N+1 query problems

3. **Clear all caches:**
```bash
php artisan optimize:clear
```

4. **Restart servers:**
```bash
# Terminal 1
php artisan serve

# Terminal 2
npm run dev
```

---

## 🔍 Finding More Details

### Get detailed error info:

1. **Check Laravel logs:**
```bash
tail -f storage/logs/laravel.log
```

2. **Check database:**
```sql
SELECT * FROM users;
SELECT * FROM clubs;
SELECT * FROM events;
```

3. **Check routes:**
```bash
php artisan route:list
```

4. **Check migrations:**
```bash
php artisan migrate:status
```

---

## 📞 Still Not Working?

1. **Verify all prerequisites:**
   - PHP 8.2+
   - MySQL running
   - Composer packages installed
   - Database migrated

2. **Try the nuclear option:**
```bash
php artisan migrate:refresh
php artisan cache:clear
php artisan config:clear
php artisan view:clear
npm install
npm run build
```

3. **Restart everything:**
   - Stop all terminals
   - Stop MySQL
   - Start MySQL
   - Run `php artisan serve` and `npm run dev` again

---

**Last Updated:** 2026-07-08  
**UCMS Version:** 1.0
