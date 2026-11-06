

<?php $__env->startSection('title', 'Clubs | UCMS'); ?>
<?php $__env->startSection('page-title', 'Manage Clubs'); ?>
<?php $__env->startSection('eyebrow', 'Club management'); ?>

<?php $__env->startSection('content'); ?>
    <div class="space-y-6">
        <nav class="text-sm text-slate-500">
            <ol class="flex flex-wrap items-center gap-2">
                <li><a href="<?php echo e(route('dashboard')); ?>" class="transition hover:text-slate-900">Dashboard</a></li>
                <li>/</li>
                <li class="font-medium text-slate-900">Clubs</li>
            </ol>
        </nav>

        <form method="GET" class="grid gap-4 rounded-[2rem] border border-slate-200 bg-white p-4 shadow-sm lg:grid-cols-4">
            <div class="lg:col-span-2">
                <label class="mb-2 block text-sm font-semibold text-slate-700">Search</label>
                <input type="search" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search clubs by name, short name, or category" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10">
            </div>
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Status</label>
                <select name="status" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10">
                    <option value="">All</option>
                    <option value="active" <?php if(request('status') === 'active'): echo 'selected'; endif; ?>>Active</option>
                    <option value="inactive" <?php if(request('status') === 'inactive'): echo 'selected'; endif; ?>>Inactive</option>
                </select>
            </div>
            <div class="flex items-end gap-3">
                <button class="w-full rounded-2xl bg-blue-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-blue-500">Apply</button>
                <a href="<?php echo e(route('clubs.index')); ?>" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-center text-sm font-semibold text-slate-700 transition hover:border-slate-400">Reset</a>
            </div>
        </form>

        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-950">Clubs</h2>
                <p class="text-sm text-slate-500">Browse, search, and manage university clubs.</p>
            </div>
            <?php if(auth()->user()->isSuperAdmin() || auth()->user()->isClubLeader()): ?>
                <a href="<?php echo e(route('clubs.create')); ?>" class="inline-flex items-center rounded-2xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">Create Club</a>
            <?php endif; ?>
        </div>

        <div class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm">
            <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                <thead class="bg-slate-50 text-xs uppercase tracking-[0.2em] text-slate-500">
                    <tr>
                        <th class="px-5 py-4">Club</th>
                        <th class="px-5 py-4">Category</th>
                        <th class="px-5 py-4">Members</th>
                        <th class="px-5 py-4">Events</th>
                        <th class="px-5 py-4">Status</th>
                        <th class="px-5 py-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white">
                    <?php $__empty_1 = true; $__currentLoopData = $clubs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $club): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="px-5 py-4">
                                <div class="font-semibold text-slate-950"><?php echo e($club->name); ?></div>
                                <div class="text-xs text-slate-500"><?php echo e($club->short_name); ?></div>
                            </td>
                            <td class="px-5 py-4 text-slate-700"><?php echo e($club->category); ?></td>
                            <td class="px-5 py-4 text-slate-700"><?php echo e($club->members_count); ?></td>
                            <td class="px-5 py-4 text-slate-700"><?php echo e($club->events_count); ?></td>
                            <td class="px-5 py-4">
                                <span class="rounded-full px-3 py-1 text-xs font-semibold <?php echo e($club->status === 'active' ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-600'); ?>"><?php echo e(ucfirst($club->status)); ?></span>
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex flex-wrap gap-2">
                                    <a href="<?php echo e(route('clubs.show', $club)); ?>" class="rounded-full border border-slate-300 px-3 py-1.5 text-xs font-semibold text-slate-700">View</a>
                                    <?php if(auth()->user()->isSuperAdmin() || auth()->user()->isClubLeader()): ?>
                                        <a href="<?php echo e(route('clubs.edit', $club)); ?>" class="rounded-full border border-blue-200 px-3 py-1.5 text-xs font-semibold text-blue-700">Edit</a>
                                        <form method="POST" action="<?php echo e(route('clubs.destroy', $club)); ?>" onsubmit="return confirm('Delete this club?')">
                                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                            <button class="rounded-full border border-rose-200 px-3 py-1.5 text-xs font-semibold text-rose-700">Delete</button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="px-5 py-16 text-center">
                                <div class="mx-auto max-w-md rounded-[2rem] border border-dashed border-slate-300 bg-slate-50 p-8">
                                    <p class="text-lg font-semibold text-slate-900">No clubs found</p>
                                    <p class="mt-2 text-sm text-slate-500">Create the first club to start the university ecosystem.</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php echo e($clubs->links()); ?>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel-Projects\university-club-management-system\resources\views/clubs/index.blade.php ENDPATH**/ ?>