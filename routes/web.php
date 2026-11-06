<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\ClubMemberController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventRegistrationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\ResetPasswordLinkController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/forgot-password', [ResetPasswordLinkController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [ResetPasswordLinkController::class, 'store'])->name('password.email');

    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');
});

Route::middleware('auth')->group(function (): void {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/search', [SearchController::class, 'index'])->name('search.index');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::patch('/notifications/{notification}/read', [NotificationController::class, 'markRead'])->name('notifications.read');

    Route::get('/clubs', [ClubController::class, 'index'])->name('clubs.index');

    Route::get('/events', [EventController::class, 'index'])->name('events.index');

    Route::get('/members', [ClubMemberController::class, 'index'])->name('members.index');

    Route::get('/registrations', [EventRegistrationController::class, 'index'])->name('registrations.index');

    Route::get('/gallery', [GalleryController::class, 'index'])->name('galleries.index');

    Route::get('/certificates', [CertificateController::class, 'index'])->name('certificates.index');
    Route::get('/certificates/{certificate}/download', [CertificateController::class, 'download'])->name('certificates.download');

    Route::middleware('role:'.\App\Models\User::ROLE_SUPER_ADMIN.','.\App\Models\User::ROLE_CLUB_LEADER)->group(function (): void {
        Route::get('/clubs/create', [ClubController::class, 'create'])->name('clubs.create');
        Route::post('/clubs', [ClubController::class, 'store'])->name('clubs.store');
        Route::get('/clubs/{club}/edit', [ClubController::class, 'edit'])->name('clubs.edit');
        Route::put('/clubs/{club}', [ClubController::class, 'update'])->name('clubs.update');
        Route::delete('/clubs/{club}', [ClubController::class, 'destroy'])->name('clubs.destroy');

        Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
        Route::post('/events', [EventController::class, 'store'])->name('events.store');
        Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
        Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
        Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');

        Route::post('/gallery', [GalleryController::class, 'store'])->name('galleries.store');
        Route::put('/gallery/{gallery}', [GalleryController::class, 'update'])->name('galleries.update');
        Route::delete('/gallery/{gallery}', [GalleryController::class, 'destroy'])->name('galleries.destroy');

        Route::get('/events/{event}/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
        Route::post('/events/{event}/attendance', [AttendanceController::class, 'store'])->name('attendance.store');

        Route::post('/events/{event}/registrations/{registration}', [EventRegistrationController::class, 'updateReview'])->name('registrations.review');
        Route::delete('/registrations/{registration}', [EventRegistrationController::class, 'destroy'])->name('registrations.destroy');

        Route::post('/members/{clubMember}/review', [ClubMemberController::class, 'review'])->name('members.review');

        Route::post('/events/{event}/attendance/{attendance}/certificate', [CertificateController::class, 'store'])->name('certificates.store');
        Route::post('/events/{event}/registrations/{registration}/certificate', [CertificateController::class, 'issueFromRegistration'])->name('certificates.issue');
    });

    Route::post('/clubs/{club}/join', [ClubMemberController::class, 'join'])->name('clubs.join');
    Route::delete('/clubs/{club}/leave', [ClubMemberController::class, 'leave'])->name('clubs.leave');
    Route::patch('/members/{clubMember}/role', [ClubMemberController::class, 'updateRole'])->name('members.role');
    Route::delete('/members/{clubMember}', [ClubMemberController::class, 'destroy'])->name('members.destroy');

    Route::post('/events/{event}/register', [EventRegistrationController::class, 'store'])->name('events.register');
    Route::delete('/registrations/{registration}/cancel', [EventRegistrationController::class, 'destroy'])->name('registrations.cancel');

    // Super Admin user management
    Route::middleware('role:'.\App\Models\User::ROLE_SUPER_ADMIN)->group(function (): void {
        Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
        Route::patch('/users/{user}/role', [\App\Http\Controllers\UserController::class, 'updateRole'])->name('users.role');
        Route::delete('/users/{user}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
    });

    // Place show routes after management routes to avoid catching 'create' as an {id}
    Route::get('/clubs/{club}', [ClubController::class, 'show'])->name('clubs.show');
    Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
});
