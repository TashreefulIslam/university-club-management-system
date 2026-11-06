
<?php $__env->startSection('title', 'Certificates | UCMS'); ?>
<?php $__env->startSection('page-title', 'Certificates'); ?>
<?php $__env->startSection('eyebrow', 'Certificate generation'); ?>

<?php $__env->startSection('content'); ?>
    <div class="space-y-6">
        <?php if($eligibleRegistrations->isNotEmpty()): ?>
            <div class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 bg-slate-50 px-6 py-4">
                    <h3 class="text-lg font-semibold text-slate-900">Eligible for certificate</h3>
                    <p class="text-sm text-slate-600">Approved registrations marked as present and not yet issued.</p>
                </div>
                <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                    <thead class="bg-white text-xs uppercase tracking-[0.2em] text-slate-500">
                        <tr>
                            <th class="px-5 py-4">Student</th>
                            <th class="px-5 py-4">Event</th>
                            <th class="px-5 py-4">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        <?php $__currentLoopData = $eligibleRegistrations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registration): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="px-5 py-4 font-semibold"><?php echo e($registration->user->name); ?></td>
                                <td class="px-5 py-4"><?php echo e($registration->event->title); ?></td>
                                <td class="px-5 py-4">
                                    <form method="POST" action="<?php echo e(route('certificates.issue', ['event' => $registration->event, 'registration' => $registration])); ?>">
                                        <?php echo csrf_field(); ?>
                                        <button class="rounded-full bg-emerald-600 px-4 py-2 text-xs font-semibold text-white">Issue certificate</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        <div class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 bg-slate-50 px-6 py-4">
                <h3 class="text-lg font-semibold text-slate-900">Issued certificates</h3>
            </div>
            <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                <thead class="bg-white text-xs uppercase tracking-[0.2em] text-slate-500">
                    <tr>
                        <th class="px-5 py-4">Certificate #</th>
                        <th class="px-5 py-4">Student</th>
                        <th class="px-5 py-4">Event</th>
                        <th class="px-5 py-4">Issued</th>
                        <th class="px-5 py-4">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white">
                    <?php $__empty_1 = true; $__currentLoopData = $certificates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $certificate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="px-5 py-4 font-semibold"><?php echo e($certificate->certificate_number); ?></td>
                            <td class="px-5 py-4"><?php echo e($certificate->user->name); ?></td>
                            <td class="px-5 py-4"><?php echo e($certificate->event->title); ?></td>
                            <td class="px-5 py-4"><?php echo e($certificate->issued_at?->format('d M Y')); ?></td>
                            <td class="px-5 py-4">
                                <a href="<?php echo e(route('certificates.download', $certificate)); ?>" class="rounded-full bg-blue-600 px-4 py-2 text-xs font-semibold text-white">Download</a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="5" class="px-5 py-16 text-center">No certificates generated yet.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php echo e($certificates->links()); ?>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel-Projects\university-club-management-system\resources\views/certificates/index.blade.php ENDPATH**/ ?>