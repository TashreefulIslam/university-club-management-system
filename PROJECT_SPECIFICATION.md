You are a Senior Full Stack Laravel Developer with expertise in Laravel 12, Blade, Tailwind CSS, MySQL, responsive UI/UX design, database architecture, authentication, authorization, and modern software engineering best practices.

Your task is to build a complete production-quality web application named:

# University Club Management System (UCMS)

This is a university-level management system where students can explore university clubs, join clubs, register for events, participate in activities, and receive certificates. Administrators and club leaders manage the entire club ecosystem.

This project should be written as if it is going to be deployed to a real university, not just a CRUD demonstration.

------------------------------------------------------------
TECH STACK
------------------------------------------------------------

Backend
- Laravel 12

Frontend
- Laravel Blade
- Tailwind CSS (CDN)
- HTML5
- CSS3
- JavaScript (only where necessary)

Database
- MySQL (XAMPP)

Authentication
- Laravel Authentication

Storage
- Laravel Storage

PDF
- barryvdh/laravel-dompdf

------------------------------------------------------------
PROJECT GOALS
------------------------------------------------------------

The system must be

• Professional
• Clean Architecture
• Responsive
• Modern UI
• User Friendly
• Interactive
• Easy to navigate
• Proper validation
• Secure
• Well organized
• Maintainable
• Production-ready

Every feature must be fully functional.

Avoid placeholder implementations.

Avoid incomplete CRUD.

Avoid fake buttons.

Avoid unfinished pages.

------------------------------------------------------------
DESIGN REQUIREMENTS
------------------------------------------------------------

The frontend is extremely important.

Do NOT create generic AI-looking interfaces.

Design the UI like a professional frontend developer.

Requirements:

• Modern dashboard
• Beautiful cards
• Clean typography
• Proper spacing
• Rounded corners
• Smooth hover effects
• Nice shadows
• Consistent color palette
• Responsive sidebar
• Responsive navbar
• Mobile friendly
• Tablet friendly
• Desktop friendly

Every page should have

• Proper page title
• Breadcrumb
• Search
• Filter
• Responsive table
• Empty state
• Loading state (if needed)
• Success messages
• Error messages
• Confirmation dialog before delete

Use icons where appropriate.

Use badges for status.

Use modern buttons.

Avoid plain Bootstrap-style layouts.

------------------------------------------------------------
COLOR THEME
------------------------------------------------------------

Professional University Theme

Primary:
Blue

Secondary:
Indigo

Accent:
Emerald

Background:
Light Gray

Cards:
White

Use modern Tailwind components.

------------------------------------------------------------
USER ROLES
------------------------------------------------------------

There are three system roles.

1. Super Admin

Permissions

• Dashboard
• Manage Clubs
• Manage Events
• Manage Members
• Manage Users
• Approve Club Join Requests
• Assign Club Leaders
• Assign Member Roles
• Upload Gallery
• Manage Attendance
• Generate Certificates
• View Reports

------------------------------------------------------------

2. Club Leader

President
Vice-President

Can only manage their own club.

Permissions

• Dashboard
• Create Event
• Update Event
• Cancel Event
• View Members
• Approve Event Registration
• Upload Gallery
• Take Attendance
• Generate Certificates

Cannot

• Manage another club
• Delete other clubs
• Access Super Admin features

------------------------------------------------------------

3. Student

Permissions

• Register
• Login
• Dashboard
• Browse Clubs
• Search Clubs
• Join Club
• Leave Club
• View Events
• Register for Events
• Cancel Registration
• View Gallery
• Download Certificates
• Edit Profile

------------------------------------------------------------
MAIN MODULES
------------------------------------------------------------

MODULE 1
Authentication

Pages

Login

Register

Forgot Password

Reset Password

Logout

------------------------------------------------------------

MODULE 2
Dashboard

Admin Dashboard

Cards

Total Clubs

Total Members

Upcoming Events

Completed Events

Event Registrations

Certificates Generated

Recent Activities

Optional charts

Members per Club

Monthly Events

Student Dashboard

Cards

My Clubs

Registered Events

Upcoming Events

Certificates

Notifications

------------------------------------------------------------

MODULE 3
Club Management

Complete CRUD

Fields

Club Name

Short Name

Description

Mission

Logo

Banner

Advisor

Category

Status

Created Date

------------------------------------------------------------

MODULE 4
Member Management

Each club has members.

Fields

Student

Role

Join Date

Status

Member Roles

President

Vice President

Secretary

Treasurer

Executive Member

General Member

Admin can

Assign Role

Promote

Demote

Remove

Student can

Join Club

Leave Club

------------------------------------------------------------

MODULE 5
Event Management

Complete CRUD

Fields

Club

Title

Description

Venue

Date

Start Time

End Time

Registration Deadline

Maximum Participants

Banner

Status

Upcoming

Running

Completed

Cancelled

------------------------------------------------------------

MODULE 6
Event Registration

Workflow

Student opens event

↓

Clicks Register

↓

Registration stored

↓

Admin/Club Leader views registrations

↓

Approve or Reject

Registration Fields

Student

Event

Status

Registered At

Remarks

------------------------------------------------------------

MODULE 7
Attendance

After event

Display all registered students

Allow

Present

Absent

Late

Save attendance

------------------------------------------------------------

MODULE 8
Club Gallery

Each club has its own gallery.

Fields

Image

Caption

Related Event

Upload Date

Uploaded By

Admin and Club Leader

Upload

Edit

Delete

Students

View only

------------------------------------------------------------

MODULE 9
Certificate Generation

Generate certificate only if

Attendance == Present

Generate downloadable PDF.

Certificate contains

University Logo

Student Name

Student ID

Club Name

Event Name

Date

Organizer

President Signature

Advisor Signature

Certificate Number

Optional QR Code

------------------------------------------------------------

MODULE 10
Profile

Student can edit

Profile Photo

Phone

Department

Batch

Bio

Password

------------------------------------------------------------

MODULE 11
Search

Search

Club

Event

Member

Student

------------------------------------------------------------

MODULE 12
Notifications

Examples

Registration Successful

Join Request Approved

Certificate Ready

Upcoming Event

------------------------------------------------------------
DATABASE TABLES
------------------------------------------------------------

users

clubs

club_members

events

event_registrations

attendances

galleries

certificates

Design migrations with proper

Foreign Keys

Indexes

Constraints

Cascade rules

------------------------------------------------------------
MODEL RELATIONSHIPS
------------------------------------------------------------

User

hasMany ClubMembership

Club

hasMany Members

Club

hasMany Events

Event

belongsTo Club

Event

hasMany Registrations

Registration

belongsTo User

Registration

belongsTo Event

Registration

hasOne Attendance

Attendance

belongsTo Registration

Club

hasMany Gallery

Certificate

belongsTo User

Certificate

belongsTo Event

------------------------------------------------------------
VALIDATION
------------------------------------------------------------

Every form must include

Server-side validation

Proper error messages

Unique validation

Required validation

Image validation

File size validation

------------------------------------------------------------
SECURITY
------------------------------------------------------------

Use

Authentication

Authorization

Middleware

Role-based access

Mass assignment protection

CSRF protection

Validation

Prevent unauthorized access

------------------------------------------------------------
PROJECT STRUCTURE
------------------------------------------------------------

Use proper Laravel architecture.

Controllers

Models

Policies (if needed)

Form Requests (preferred)

Blade Layouts

Reusable Blade Components

Service classes when appropriate

Keep code clean and modular.

------------------------------------------------------------
CODING STANDARDS
------------------------------------------------------------

Follow Laravel best practices.

Use meaningful variable names.

Avoid duplicate code.

Comment only where necessary.

Maintain readable code.

------------------------------------------------------------
IMPORTANT DEVELOPMENT RULES
------------------------------------------------------------

Do NOT generate the whole project at once.

Work module by module.

For every module:

1. Design database changes.
2. Create migrations.
3. Create models and relationships.
4. Create controllers.
5. Create routes.
6. Build Blade UI.
7. Add validation.
8. Test functionality.
9. Confirm the module works completely.
10. Then continue to the next module.

Never skip steps.

Never leave TODOs or unfinished implementations.

Treat every feature as production-ready before moving to the next one.