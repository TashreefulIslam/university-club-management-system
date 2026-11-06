
<?php $__env->startSection('title', 'Notifications | UCMS'); ?>
<?php $__env->startSection('page-title', 'Notifications'); ?>
<?php $__env->startSection('eyebrow', 'System notifications'); ?>

<?php $__env->startSection('content'); ?>
    <div class="space-y-6">
        <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-sm text-slate-500">Unread</p>
            <p class="mt-2 text-3xl font-black text-slate-950"><?php echo e($unreadCount); ?></p>
        </div>
        <div class="space-y-4">
            <?php $__empty_1 = true; $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="font-semibold text-slate-950"><?php echo e($notification->data['title'] ?? 'Notification'); ?></p>
                            <p class="mt-1 text-sm text-slate-500"><?php echo e($notification->data['message'] ?? ''); ?></p>
                        </div>
                        <?php if(is_null($notification->read_at)): ?>
                            <form method="POST" action="<?php echo e(route('notifications.read', $notification->id)); ?>"><?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?><button class="rounded-full bg-blue-600 px-4 py-2 text-xs font-semibold text-white">Mark read</button></form>
                        <?php else: ?>
                            <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">Read</span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="rounded-[2rem] border border-dashed border-slate-300 bg-white p-10 text-center shadow-sm">
                    <p class="text-lg font-semibold text-slate-900">No notifications yet</p>
                </div>
            <?php endif; ?>
        </div>
        <?php echo e($notifications->links()); ?>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel-Projects\university-club-management-system\resources\views/notifications/index.blade.php ENDPATH**/ ?>