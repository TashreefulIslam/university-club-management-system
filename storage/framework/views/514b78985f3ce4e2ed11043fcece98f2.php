
<?php $__env->startSection('title', 'Profile | UCMS'); ?>
<?php $__env->startSection('page-title', 'Edit Profile'); ?>
<?php $__env->startSection('eyebrow', 'Student profile'); ?>

<?php $__env->startSection('content'); ?>
    <form method="POST" action="<?php echo e(route('profile.update')); ?>" enctype="multipart/form-data" class="space-y-6 rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm lg:p-8">
        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
        <div class="grid gap-5 lg:grid-cols-2">
            <div><label class="mb-2 block text-sm font-semibold text-slate-700">Name</label><input name="name" value="<?php echo e(old('name', auth()->user()->name)); ?>" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3"></div>
            <div><label class="mb-2 block text-sm font-semibold text-slate-700">Email</label><input name="email" value="<?php echo e(old('email', auth()->user()->email)); ?>" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3"></div>
            <div><label class="mb-2 block text-sm font-semibold text-slate-700">Phone</label><input name="phone" value="<?php echo e(old('phone', auth()->user()->phone)); ?>" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3"></div>
            <div><label class="mb-2 block text-sm font-semibold text-slate-700">Department</label><input name="department" value="<?php echo e(old('department', auth()->user()->department)); ?>" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3"></div>
            <div><label class="mb-2 block text-sm font-semibold text-slate-700">Batch</label><input name="batch" value="<?php echo e(old('batch', auth()->user()->batch)); ?>" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3"></div>
            <!-- <div><label class="mb-2 block text-sm font-semibold text-slate-700">Profile photo</label><input type="file" name="profile_photo" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3"></div> -->
        </div>
        <div><label class="mb-2 block text-sm font-semibold text-slate-700">Bio</label><textarea name="bio" rows="5" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3"><?php echo e(old('bio', auth()->user()->bio)); ?></textarea></div>
        <div class="grid gap-5 lg:grid-cols-2">
            <div><label class="mb-2 block text-sm font-semibold text-slate-700">New password</label><input type="password" name="password" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3"></div>
            <div><label class="mb-2 block text-sm font-semibold text-slate-700">Confirm password</label><input type="password" name="password_confirmation" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3"></div>
        </div>
        <button class="rounded-2xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white">Save Profile</button>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel-Projects\university-club-management-system\resources\views/profile/edit.blade.php ENDPATH**/ ?>