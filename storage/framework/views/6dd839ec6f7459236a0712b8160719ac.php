
<?php $__env->startSection('title', 'Create Club | UCMS'); ?>
<?php $__env->startSection('page-title', 'Create Club'); ?>
<?php $__env->startSection('eyebrow', 'Club management'); ?>

<?php $__env->startSection('content'); ?>
    <form method="POST" action="<?php echo e(route('clubs.store')); ?>" enctype="multipart/form-data" class="space-y-6 rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm lg:p-8">
        <?php echo csrf_field(); ?>
        <?php echo $__env->make('clubs.form', ['club' => null], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel-Projects\university-club-management-system\resources\views/clubs/create.blade.php ENDPATH**/ ?>