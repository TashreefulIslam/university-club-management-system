# UCMS Quick Start Guide

Get UCMS up and running in 10 minutes.

---

## ✅ Prerequisites

Make sure you have:
- ✅ PHP 8.2+ installed
- ✅ Composer installed
- ✅ Node.js and npm installed
- ✅ MySQL running (XAMPP or similar)
- ✅ Dependencies installed (`composer install`, `npm install`)
- ✅ Database migrated (`php artisan migrate`)
- ✅ Environment file configured (`.env`)

---

## 🚀 Start the Project

### Terminal 1: Start Laravel Server

```bash
php artisan serve
```

You should see:
```
Starting Laravel development server: http://127.0.0.1:8000
```

### Terminal 2: Build Frontend Assets (Optional but recommended)

```bash
npm run dev
```

This watches Tailwind CSS changes in real-time.

---

## 🎯 Testing the Three Roles

### Step 1: Create Three Test Users

1. Go to `http://127.0.0.1:8000`
2. Click **"Register as Student"**
3. Create three accounts:
   - **User 1:** Email `student@test.com` (will remain Student)
   - **User 2:** Email `leader@test.com` (will become Club Leader)
   - **User 3:** Email `admin@test.com` (will become Super Admin)

### Step 2: Assign Roles in Database

1. Open phpMyAdmin or MySQL client
2. Find the `users` table
3. Update roles:
   - `student@test.com` → role = `student` (already is)
   - `leader@test.com` → role = `club_leader`
   - `admin@test.com` → role = `super_admin`

### Step 3: Log In and Test Each Role

---

## 📋 Role Workflows

### 🎓 STUDENT WORKFLOW

**Login as:** `student@test.com`

**What You'll See:**
- Dashboard with: My Clubs, Registered Events, Upcoming Events, My Certificates
- Quick buttons to "Browse clubs", "Browse events", "View certificates"
- Sidebar with: Dashboard, Clubs, Events, My Memberships, Event Registrations, Gallery, Certificates, etc.

**What You Can Do:**
1. **Browse Clubs**
   - Click "Clubs" in sidebar
   - See all available clubs
   - Click any club to view details

2. **Join a Club**
   - Go to Clubs
   - Find a club
   - Click "Join Club" button
   - You'll become a member

3. **Browse Events**
   - Click "Events" in sidebar
   - See all upcoming events
   - Click event to view details

4. **Register for Event**
   - Go to Events
   - Find an event you want to attend
   - Click "Register" button
   - Status will be "pending" until club leader approves

5. **View My Registrations**
   - Click "Event Registrations" in sidebar
   - See all your event registrations and their approval status

6. **View Certificates**
   - Click "Certificates" in sidebar
   - After event attendance is marked and certificate is generated, you'll see it here
   - Click "Download" to get the PDF

7. **Edit Profile**
   - Click "My Profile" in sidebar
   - Add phone, department, batch, bio
   - Track profile completion %

---

### 👔 CLUB LEADER WORKFLOW

**Login as:** `leader@test.com`

**What You'll See:**
- Dashboard with: Total Clubs, Total Members, Upcoming Events, Certificates Generated
- Quick buttons to "Create event", "Review registrations", "Upload media"
- Sidebar shows same navigation as students + admin capabilities

**What You Can Do:**

1. **Create Events** (for your club)
   - Click "Create event for your club" on dashboard, OR
   - Click "Events" → "Create"
   - Fill in:
     - Event Title (e.g., "Web Dev Workshop")
     - Club (select your club)
     - Description
     - Venue (e.g., "Lab 204")
     - Event Date & Time
     - Registration Deadline
     - Maximum Participants
     - Upload event banner
   - Click "Create"
   - Event is live immediately

2. **Review Event Registrations**
   - Click "Review registrations" on dashboard, OR
   - Go to "Event Registrations"
   - Find your event
   - Review pending registrations
   - For each: Click "Approve" or "Reject"
   - Approved students can now attend

3. **Mark Attendance**
   - After event happens, go to the event details
   - Click "Mark Attendance"
   - For each approved participant, select: "Present" or "Absent"
   - Click "Save Attendance"

4. **Generate Certificates**
   - Go to "Event Registrations"
   - Find students marked as "Present"
   - Click "Generate Certificate" button
   - System creates PDF and stores it
   - Student gets notification and can download

5. **Upload Event Gallery**
   - Go to "Gallery"
   - Click "Upload Image"
   - Select photo from computer
   - Add caption (e.g., "Participants at workshop")
   - Click "Upload"
   - Photo appears in club/event gallery

6. **View Members**
   - Click "My Memberships" in sidebar
   - See all members in your club

---

### 🔑 SUPER ADMIN WORKFLOW

**Login as:** `admin@test.com`

**What You'll See:**
- Dashboard with: Total Clubs (platform-wide), Total Members, Upcoming Events, Certificates Generated
- Quick buttons to "Create a new club", "Create an event", "Manage all clubs"
- Sidebar shows all navigation + full admin capabilities

**What You Can Do:**

1. **Create Clubs** (platform-wide)
   - Click "Create a new club" on dashboard, OR
   - Go to "Clubs" → "Create"
   - Fill in:
     - Club Name (e.g., "Robotics Club")
     - Short Name (e.g., "ROBOTICS") - must be unique
     - Description
     - Mission statement
     - Category (e.g., "Technology", "Sports", "Arts")
     - Status (active/inactive)
     - Upload logo image
     - Upload banner image
     - Assign advisor (optional - another user)
   - Click "Create"
   - Club is live

2. **Create Events** (global)
   - Similar to Club Leader
   - Can assign to any club
   - Events are platform-wide visible

3. **Manage All Members**
   - Go to "My Memberships"
   - See all club memberships across platform
   - Can edit member roles or remove members

4. **Approve Registrations** (all events)
   - Go to "Event Registrations"
   - See registrations from ALL events
   - Approve or reject as needed

5. **Mark Attendance** (all events)
   - Similar to Club Leader but for any event

6. **Generate Certificates** (all events)
   - Similar to Club Leader but for any event
   - Can generate for attendees of any event

7. **Assign Club Leaders**
   - Go to "My Memberships"
   - Find a member of a club
   - Click "Edit Member"
   - Change role from "member" to "club_leader"
   - Save

8. **Manage Galleries** (all clubs/events)
   - Go to "Gallery"
   - Upload media for any club/event
   - Can edit or delete any media

---

## 🧪 Full End-to-End Test

**Complete workflow in 15 minutes:**

1. **Admin:** Create club "Tech Club"
2. **Admin:** Create event "Web Dev Workshop" under Tech Club
3. **Admin:** Assign leader@test.com as Club Leader
4. **Student:** Log in, join "Tech Club"
5. **Student:** Register for "Web Dev Workshop"
6. **Leader:** Log in, approve student's registration
7. **Leader:** Mark student as "Present" after event
8. **Leader:** Generate certificate
9. **Student:** Log in, download certificate

---

## 📊 Sidebar Navigation

Every user sees these menu items:
- **Dashboard** - Overview with role-specific stats
- **Clubs** - Browse or manage clubs
- **Events** - Browse or manage events
- **My Memberships** - Your club memberships
- **Event Registrations** - Your or pending registrations to review
- **Gallery** - Club/event photos
- **Certificates** - Your certificates or all certificates (admin)
- **Search** - Search clubs and events
- **Notifications** - System notifications
- **My Profile** - Edit your profile info

---

## 🐛 Common Issues & Fixes

| Issue | Solution |
|-------|----------|
| "Dashboard looks the same for all roles" | Refresh browser, verify role in database, log out and log back in |
| Can't create club/event | Verify you're Super Admin or Club Leader (check database role column) |
| Can't find Event Registration option | Go to "Event Registrations" in sidebar, or click event and look for registration button |
| Gallery not showing images | Run `php artisan storage:link` to create public storage symlink |
| PDF download not working | Ensure public/storage symlink exists, check storage permissions |
| "No events available to register" | Create an event first (as Club Leader or Admin) |

---

## ⚙️ Database Role Reference

To change a user's role in MySQL:

```sql
UPDATE users SET role = 'super_admin' WHERE email = 'admin@test.com';
UPDATE users SET role = 'club_leader' WHERE email = 'leader@test.com';
UPDATE users SET role = 'student' WHERE email = 'student@test.com';
```

Valid roles:
- `student` - Browse, join, register
- `club_leader` - Create events, approve registrations, mark attendance
- `super_admin` - Full platform control

---

## 📚 More Information

- **Full Guide:** Read [USAGE_GUIDE.md](USAGE_GUIDE.md) for detailed documentation
- **Project Info:** See [README.md](README.md) for architecture and features
- **Specification:** See [PROJECT_SPECIFICATION.md](PROJECT_SPECIFICATION.md) for requirements

---

## ✨ You're Ready!

1. ✅ Server running
2. ✅ Three test users created
3. ✅ Roles assigned
4. ✅ Ready to test all workflows

**Start testing now:** Go to `http://127.0.0.1:8000` and log in! 🚀

---

**Last Updated:** 2026-07-08  
**UCMS Version:** 1.0
