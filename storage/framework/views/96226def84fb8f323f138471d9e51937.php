
<?php $__env->startSection('title', 'Users | UCMS'); ?>
<?php $__env->startSection('page-title', 'Manage Users'); ?>
<?php $__env->startSection('eyebrow', 'User management'); ?>

<?php $__env->startSection('content'); ?>
    <div class="space-y-6">
        <div class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 text-xs uppercase tracking-[0.2em] text-slate-500">
                    <tr>
                        <th class="px-5 py-4">Name</th>
                        <th class="px-5 py-4">Email</th>
                        <th class="px-5 py-4">Role</th>
                        <th class="px-5 py-4">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white">
                    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="px-5 py-4 font-semibold"><?php echo e($user->name); ?></td>
                            <td class="px-5 py-4"><?php echo e($user->email); ?></td>
                            <td class="px-5 py-4">
                                <form method="POST" action="<?php echo e(route('users.role', $user)); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PATCH'); ?>
                                    <select name="role" class="rounded-2xl border border-slate-300 bg-slate-50 px-3 py-2">
                                        <option value="<?php echo e(\App\Models\User::ROLE_STUDENT); ?>" <?php if($user->role === \App\Models\User::ROLE_STUDENT): echo 'selected'; endif; ?>>Student</option>
                                        <option value="<?php echo e(\App\Models\User::ROLE_CLUB_LEADER); ?>" <?php if($user->role === \App\Models\User::ROLE_CLUB_LEADER): echo 'selected'; endif; ?>>Club Leader</option>
                                        <option value="<?php echo e(\App\Models\User::ROLE_SUPER_ADMIN); ?>" <?php if($user->role === \App\Models\User::ROLE_SUPER_ADMIN): echo 'selected'; endif; ?>>Super Admin</option>
                                    </select>
                                    <button class="ml-2 rounded-2xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white">Save</button>
                                </form>
                            </td>
                            <td class="px-5 py-4">
                                <?php if(auth()->user()->id !== $user->id): ?>
                                    <form method="POST" action="<?php echo e(route('users.destroy', $user)); ?>" onsubmit="return confirm('Delete this user?');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button class="rounded-2xl bg-rose-600 px-4 py-2 text-sm font-semibold text-white">Delete</button>
                                    </form>
                                <?php else: ?>
                                    <button class="rounded-2xl bg-slate-200 px-4 py-2 text-sm font-semibold text-slate-700" disabled>Cannot delete self</button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="4" class="px-5 py-16 text-center">No users found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php echo e($users->links()); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel-Projects\university-club-management-system\resources\views/users/index.blade.php ENDPATH**/ ?>