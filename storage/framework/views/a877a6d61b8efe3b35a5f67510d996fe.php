
<?php $__env->startSection('title', 'Create Event | UCMS'); ?>
<?php $__env->startSection('page-title', 'Create Event'); ?>
<?php $__env->startSection('eyebrow', 'Event management'); ?>

<?php $__env->startSection('content'); ?>
    <form method="POST" action="<?php echo e(route('events.store')); ?>" enctype="multipart/form-data" class="space-y-6 rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm lg:p-8">
        <?php echo csrf_field(); ?>
        <?php echo $__env->make('events.form', ['event' => null], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel-Projects\university-club-management-system\resources\views/events/create.blade.php ENDPATH**/ ?>