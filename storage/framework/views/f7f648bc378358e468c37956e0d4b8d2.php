<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', config('app.name', 'UCMS')); ?></title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800" rel="stylesheet" />
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="bg-slate-100 text-slate-900 antialiased">
    <div class="min-h-screen lg:flex">
        <aside data-sidebar class="fixed inset-y-0 left-0 z-40 w-72 -translate-x-full border-r border-slate-800 bg-slate-950 text-slate-100 transition-transform duration-300 lg:static lg:z-auto lg:w-72 lg:translate-x-0">
            <div class="flex h-full flex-col">
                <div class="flex items-center gap-3 border-b border-white/10 px-6 py-6">
                    <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-500 text-lg font-bold text-white shadow-lg shadow-blue-500/20">U</span>
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-blue-300">UCMS</p>
                        <p class="text-sm text-slate-400"><?php echo e(auth()->user()?->roleLabel() ?? 'User Dashboard'); ?></p>
                    </div>
                </div>

                <nav class="flex-1 space-y-2 px-4 py-6 text-sm font-medium">
                    <a href="<?php echo e(route('dashboard')); ?>" class="flex items-center gap-3 rounded-2xl bg-white/10 px-4 py-3 text-white shadow-sm transition hover:bg-white/15">
                        <span class="h-2.5 w-2.5 rounded-full bg-emerald-400"></span>
                        Dashboard
                    </a>



                    <a href="<?php echo e(route('clubs.index')); ?>" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-300 transition hover:bg-white/5 hover:text-white">
                        <span class="h-2.5 w-2.5 rounded-full bg-indigo-400"></span>
                        Clubs
                    </a>

                    <a href="<?php echo e(route('events.index')); ?>" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-300 transition hover:bg-white/5 hover:text-white">
                        <span class="h-2.5 w-2.5 rounded-full bg-pink-400"></span>
                        Events
                    </a>

                    <a href="<?php echo e(route('members.index')); ?>" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-300 transition hover:bg-white/5 hover:text-white">
                        <span class="h-2.5 w-2.5 rounded-full bg-amber-400"></span>
                        My Memberships
                    </a>

                    <a href="<?php echo e(route('registrations.index')); ?>" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-300 transition hover:bg-white/5 hover:text-white">
                        <span class="h-2.5 w-2.5 rounded-full bg-rose-400"></span>
                        Event Registrations
                    </a>

                    <a href="<?php echo e(route('galleries.index')); ?>" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-300 transition hover:bg-white/5 hover:text-white">
                        <span class="h-2.5 w-2.5 rounded-full bg-pink-500"></span>
                        Gallery
                    </a>

                    <a href="<?php echo e(route('certificates.index')); ?>" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-300 transition hover:bg-white/5 hover:text-white">
                        <span class="h-2.5 w-2.5 rounded-full bg-emerald-400"></span>
                        Certificates
                    </a>

                    <a href="<?php echo e(route('search.index')); ?>" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-300 transition hover:bg-white/5 hover:text-white">
                        <span class="h-2.5 w-2.5 rounded-full bg-sky-400"></span>
                        Search
                    </a>

                    

                    <a href="<?php echo e(route('profile.edit')); ?>" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-300 transition hover:bg-white/5 hover:text-white">
                        <span class="h-2.5 w-2.5 rounded-full bg-slate-400"></span>
                        My Profile
                    </a>

                    <?php if(auth()->user()?->isClubLeader() || auth()->user()?->isSuperAdmin()): ?>
                        <div class="mt-3 border-t border-white/5 pt-3"></div>
                        <p class="px-4 pt-2 text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Management</p>
                        <?php if(auth()->user()?->isSuperAdmin()): ?>
                            <a href="<?php echo e(route('clubs.create')); ?>" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-300 transition hover:bg-white/5 hover:text-white">
                                <span class="h-2.5 w-2.5 rounded-full bg-blue-300"></span>
                                Create Club
                            </a>
                            <a href="<?php echo e(route('users.index')); ?>" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-300 transition hover:bg-white/5 hover:text-white">
                                <span class="h-2.5 w-2.5 rounded-full bg-green-300"></span>
                                Manage Users
                            </a>
                        <?php endif; ?>

                        <a href="<?php echo e(route('events.create')); ?>" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-300 transition hover:bg-white/5 hover:text-white">
                            <span class="h-2.5 w-2.5 rounded-full bg-indigo-300"></span>
                            Create Event
                        </a>
                    <?php endif; ?>
                </nav>

                <div class="border-t border-white/10 p-4">
                    <div class="rounded-2xl bg-white/5 p-4">
                        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Signed in as</p>
                        <p class="mt-1 text-sm font-semibold text-white"><?php echo e(auth()->user()?->name); ?></p>
                        <p class="text-sm text-slate-400"><?php echo e(auth()->user()?->email); ?></p>
                    </div>
                </div>
            </div>
        </aside>

        <div data-sidebar-overlay class="fixed inset-0 z-30 hidden bg-slate-950/60 lg:hidden"></div>

        <div class="flex min-h-screen flex-1 flex-col">
            <header class="sticky top-0 z-20 border-b border-slate-200 bg-white/90 backdrop-blur">
                <div class="flex items-center justify-between gap-4 px-4 py-4 sm:px-6 lg:px-8">
                    <div class="flex items-center gap-3">
                        <button type="button" data-sidebar-toggle class="inline-flex h-11 w-11 items-center justify-center rounded-2xl border border-slate-200 bg-white text-slate-700 shadow-sm transition hover:border-blue-200 hover:text-blue-600 lg:hidden">
                            <span class="sr-only">Open sidebar</span>
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path d="M4 6h16M4 12h16M4 18h16" stroke-linecap="round" />
                            </svg>
                        </button>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-blue-600"><?php echo $__env->yieldContent('eyebrow', 'University Club Management System'); ?></p>
                            <h1 class="text-xl font-semibold text-slate-900"><?php echo $__env->yieldContent('page-title', 'Dashboard'); ?></h1>
                        </div>
                    </div>

                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path d="M10 17l5-5-5-5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M15 12H3" stroke-linecap="round" />
                                <path d="M21 21V3" stroke-linecap="round" />
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </header>

            <main class="flex-1 px-4 py-6 sm:px-6 lg:px-8 lg:py-8">
                <?php if(session('success')): ?>
                    <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800 shadow-sm">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                    <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-800 shadow-sm">
                        <?php echo e(session('error')); ?>

                    </div>
                <?php endif; ?>

                <?php echo $__env->yieldContent('content'); ?>
            </main>
        </div>
    </div>
</body>
</html><?php /**PATH D:\Laravel-Projects\university-club-management-system\resources\views/layouts/app.blade.php ENDPATH**/ ?>