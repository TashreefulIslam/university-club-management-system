
<?php $__env->startSection('title', 'Members | UCMS'); ?>
<?php $__env->startSection('page-title', 'Manage Members'); ?>
<?php $__env->startSection('eyebrow', 'Membership management'); ?>

<?php $__env->startSection('content'); ?>
    <div class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
            <thead class="bg-slate-50 text-xs uppercase tracking-[0.2em] text-slate-500"><tr><th class="px-5 py-4">Student</th><th class="px-5 py-4">Club</th><th class="px-5 py-4">Role</th><th class="px-5 py-4">Status</th><th class="px-5 py-4">Join date</th><th class="px-5 py-4">Action</th></tr></thead>
            <tbody class="divide-y divide-slate-200 bg-white">
                <?php $__empty_1 = true; $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="px-5 py-4 font-semibold"><?php echo e($member->user->name); ?></td>
                        <td class="px-5 py-4"><?php echo e($member->club->name); ?></td>
                        <td class="px-5 py-4"><?php echo e(str_replace('_', ' ', $member->role)); ?></td>
                        <td class="px-5 py-4"><?php echo e(ucfirst($member->status)); ?></td>
                        <td class="px-5 py-4"><?php echo e($member->joined_at?->format('d M Y')); ?></td>
                        <td class="px-5 py-4">
                            <?php if(auth()->user()->isSuperAdmin() || (auth()->user()->isClubLeader() && auth()->user()->id === $member->club->advisor_id)): ?>
                                <form method="POST" action="<?php echo e(route('members.review', $member)); ?>" class="inline-flex gap-2">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="remarks" value="" />
                                    <button name="status" value="approved" class="rounded-2xl bg-emerald-600 px-3 py-2 text-sm font-semibold text-white">Approve</button>
                                    <button name="status" value="declined" class="rounded-2xl bg-rose-600 px-3 py-2 text-sm font-semibold text-white">Decline</button>
                                </form>
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="6" class="px-5 py-16 text-center">No members found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php echo e($members->links()); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel-Projects\university-club-management-system\resources\views/members/index.blade.php ENDPATH**/ ?>