
<?php $__env->startSection('title', 'Registrations | UCMS'); ?>
<?php $__env->startSection('page-title', 'Event Registrations'); ?>
<?php $__env->startSection('eyebrow', 'Registration workflow'); ?>

<?php $__env->startSection('content'); ?>
    <div class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
            <thead class="bg-slate-50 text-xs uppercase tracking-[0.2em] text-slate-500"><tr><th class="px-5 py-4">Student</th><th class="px-5 py-4">Event</th><th class="px-5 py-4">Status</th><th class="px-5 py-4">Registered</th><th class="px-5 py-4">Remarks</th><th class="px-5 py-4">Action</th></tr></thead>
            <tbody class="divide-y divide-slate-200 bg-white">
                <?php $__empty_1 = true; $__currentLoopData = $registrations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registration): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="px-5 py-4 font-semibold"><?php echo e($registration->user->name); ?></td>
                        <td class="px-5 py-4"><?php echo e($registration->event->title); ?></td>
                        <td class="px-5 py-4"><?php echo e(ucfirst($registration->status)); ?></td>
                        <td class="px-5 py-4"><?php echo e($registration->registered_at?->format('d M Y, h:i A')); ?></td>
                        <td class="px-5 py-4"><?php echo e($registration->remarks ?? '-'); ?></td>
                        <td class="px-5 py-4">
                            <?php if(auth()->user()->isSuperAdmin() || (auth()->user()->isClubLeader() && auth()->user()->id === $registration->event->club->advisor_id)): ?>
                                <form method="POST" action="<?php echo e(route('registrations.review', ['event' => $registration->event, 'registration' => $registration])); ?>" class="inline-flex flex-wrap items-center gap-2">
                                    <?php echo csrf_field(); ?>
                                    <select name="remarks" class="rounded-2xl border border-slate-300 bg-slate-50 px-3 py-2 text-sm">
                                        <option value="present">Present</option>
                                        <option value="absent">Absent</option>
                                        <option value="late">Late</option>
                                    </select>
                                    <button name="status" value="approved" class="rounded-2xl bg-emerald-600 px-3 py-2 text-sm font-semibold text-white">Approve</button>
                                    <button name="status" value="declined" class="rounded-2xl bg-rose-600 px-3 py-2 text-sm font-semibold text-white">Decline</button>
                                </form>
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="6" class="px-5 py-16 text-center">No registrations found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php echo e($registrations->links()); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel-Projects\university-club-management-system\resources\views/registrations/index.blade.php ENDPATH**/ ?>