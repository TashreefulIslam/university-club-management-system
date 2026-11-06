
<?php $__env->startSection('title', $event->title.' | UCMS'); ?>
<?php $__env->startSection('page-title', $event->title); ?>
<?php $__env->startSection('eyebrow', 'Event details'); ?>

<?php $__env->startSection('content'); ?>
    <div class="space-y-6">
        <nav class="text-sm text-slate-500"><ol class="flex flex-wrap items-center gap-2"><li><a href="<?php echo e(route('events.index')); ?>" class="transition hover:text-slate-900">Events</a></li><li>/</li><li class="font-medium text-slate-900"><?php echo e($event->title); ?></li></ol></nav>

        <section class="grid gap-6 lg:grid-cols-[1.1fr_0.9fr]">
            <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-blue-600"><?php echo e($event->club?->name); ?></p>
                <h2 class="mt-2 text-3xl font-black text-slate-950"><?php echo e($event->title); ?></h2>
                <p class="mt-4 text-slate-600"><?php echo e($event->description); ?></p>
            </div>
            <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm space-y-3">
                <p class="text-sm text-slate-500">Venue: <span class="font-semibold text-slate-900"><?php echo e($event->venue); ?></span></p>
                <p class="text-sm text-slate-500">Date: <span class="font-semibold text-slate-900"><?php echo e($event->event_date?->format('d M Y')); ?></span></p>
                <p class="text-sm text-slate-500">Time: <span class="font-semibold text-slate-900"><?php echo e($event->start_time?->format('H:i')); ?> - <?php echo e($event->end_time?->format('H:i')); ?></span></p>
                <p class="text-sm text-slate-500">Status: <span class="font-semibold text-slate-900"><?php echo e(ucfirst($event->status)); ?></span></p>
                <?php if(auth()->user()->isStudent()): ?>
                    <form method="POST" action="<?php echo e(route('events.register', $event)); ?>"><?php echo csrf_field(); ?><button class="w-full rounded-2xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white">Register for Event</button></form>
                <?php endif; ?>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel-Projects\university-club-management-system\resources\views/events/show.blade.php ENDPATH**/ ?>