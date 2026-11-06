
<?php $__env->startSection('title', $club->name.' | UCMS'); ?>
<?php $__env->startSection('page-title', $club->name); ?>
<?php $__env->startSection('eyebrow', 'Club details'); ?>

<?php $__env->startSection('content'); ?>
    <div class="space-y-6">
        <nav class="text-sm text-slate-500"><ol class="flex flex-wrap items-center gap-2"><li><a href="<?php echo e(route('clubs.index')); ?>" class="transition hover:text-slate-900">Clubs</a></li><li>/</li><li class="font-medium text-slate-900"><?php echo e($club->short_name); ?></li></ol></nav>

        <section class="grid gap-6 lg:grid-cols-[1.1fr_0.9fr]">
            <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-blue-600"><?php echo e($club->category); ?></p>
                <h2 class="mt-2 text-3xl font-black text-slate-950"><?php echo e($club->name); ?></h2>
                <p class="mt-4 text-slate-600"><?php echo e($club->description); ?></p>
                <div class="mt-6 rounded-3xl bg-slate-50 p-5">
                    <p class="text-sm font-semibold text-slate-700">Mission</p>
                    <p class="mt-2 text-sm leading-6 text-slate-600"><?php echo e($club->mission); ?></p>
                </div>
            </div>
            <div class="space-y-4">
                <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-semibold text-slate-500">Advisor</p>
                    <p class="mt-2 text-xl font-bold text-slate-950"><?php echo e($club->advisor?->name ?? 'Not assigned'); ?></p>
                    <p class="mt-4 text-sm text-slate-500">Members: <?php echo e($club->members->count()); ?></p>
                    <p class="text-sm text-slate-500">Events: <?php echo e($club->events->count()); ?></p>
                </div>
                <?php if(auth()->user()->isStudent()): ?>
                    <form method="POST" action="<?php echo e(route('clubs.join', $club)); ?>">
                        <?php echo csrf_field(); ?>
                        <button class="w-full rounded-2xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white">Join Club</button>
                    </form>
                <?php endif; ?>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel-Projects\university-club-management-system\resources\views/clubs/show.blade.php ENDPATH**/ ?>