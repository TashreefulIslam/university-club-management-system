
<?php $__env->startSection('title', 'Gallery | UCMS'); ?>
<?php $__env->startSection('page-title', 'Club Gallery'); ?>
<?php $__env->startSection('eyebrow', 'Gallery management'); ?>

<?php $__env->startSection('content'); ?>
    <div class="space-y-6">
        <form method="POST" action="<?php echo e(route('galleries.store')); ?>" enctype="multipart/form-data" class="space-y-4 rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm"><?php echo csrf_field(); ?><div class="grid gap-4 lg:grid-cols-3"><div><label class="mb-2 block text-sm font-semibold">Club</label><select name="club_id" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3"><?php $__currentLoopData = $clubs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $club): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($club->id); ?>"><?php echo e($club->name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select></div><div><label class="mb-2 block text-sm font-semibold">Caption</label><input name="caption" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3"></div><div><label class="mb-2 block text-sm font-semibold">Image</label><input type="file" name="image" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3"></div></div><button class="rounded-2xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white">Upload</button></form>
        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
            <?php $__empty_1 = true; $__currentLoopData = $galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm">
                    <img src="<?php echo e(\Illuminate\Support\Facades\Storage::url($gallery->image_path)); ?>" alt="<?php echo e($gallery->caption); ?>" class="h-56 w-full object-cover">
                    <div class="p-5">
                        <p class="font-semibold"><?php echo e($gallery->caption ?? 'Untitled'); ?></p>
                        <p class="text-sm text-slate-500"><?php echo e($gallery->club->name); ?></p>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="rounded-[2rem] border border-dashed border-slate-300 bg-white p-10 text-center shadow-sm md:col-span-2 xl:col-span-3">No gallery items yet.</div>
            <?php endif; ?>
        </div>
        <?php echo e($galleries->links()); ?>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel-Projects\university-club-management-system\resources\views/galleries/index.blade.php ENDPATH**/ ?>