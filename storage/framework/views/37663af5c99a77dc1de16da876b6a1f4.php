<?php ($currentEvent = $event ?? null); ?>
<div class="grid gap-5 lg:grid-cols-2">
    <div>
        <label class="mb-2 block text-sm font-semibold text-slate-700">Club</label>
        <select name="club_id" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10">
            <?php $__currentLoopData = $clubs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $club): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($club->id); ?>" <?php if((string) old('club_id', $currentEvent?->club_id) === (string) $club->id): echo 'selected'; endif; ?>><?php echo e($club->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold text-slate-700">Status</label>
        <select name="status" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10">
            <?php $__currentLoopData = ['upcoming','running','completed','cancelled']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($status); ?>" <?php if(old('status', $currentEvent?->status ?? 'upcoming') === $status): echo 'selected'; endif; ?>><?php echo e(ucfirst($status)); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <div><label class="mb-2 block text-sm font-semibold text-slate-700">Title</label><input name="title" value="<?php echo e(old('title', $currentEvent?->title)); ?>" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10"></div>
    <div><label class="mb-2 block text-sm font-semibold text-slate-700">Venue</label><input name="venue" value="<?php echo e(old('venue', $currentEvent?->venue)); ?>" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10"></div>
    <div><label class="mb-2 block text-sm font-semibold text-slate-700">Event date</label><input type="date" name="event_date" value="<?php echo e(old('event_date', $currentEvent?->event_date?->format('Y-m-d'))); ?>" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10"></div>
    <div><label class="mb-2 block text-sm font-semibold text-slate-700">Registration deadline</label><input type="date" name="registration_deadline" value="<?php echo e(old('registration_deadline', optional($currentEvent?->registration_deadline)->format('Y-m-d'))); ?>" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10"></div>
    <div><label class="mb-2 block text-sm font-semibold text-slate-700">Start time</label><input type="time" name="start_time" value="<?php echo e(old('start_time', $currentEvent?->start_time?->format('H:i'))); ?>" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10"></div>
    <div><label class="mb-2 block text-sm font-semibold text-slate-700">End time</label><input type="time" name="end_time" value="<?php echo e(old('end_time', $currentEvent?->end_time?->format('H:i'))); ?>" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10"></div>
    <div><label class="mb-2 block text-sm font-semibold text-slate-700">Maximum participants</label><input type="number" name="maximum_participants" value="<?php echo e(old('maximum_participants', $currentEvent?->maximum_participants)); ?>" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10"></div>
    <div><label class="mb-2 block text-sm font-semibold text-slate-700">Banner</label><input type="file" name="banner" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3"></div>
</div>
<div><label class="mb-2 block text-sm font-semibold text-slate-700">Description</label><textarea name="description" rows="6" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10"><?php echo e(old('description', $currentEvent?->description)); ?></textarea></div>
<div class="flex items-center gap-3"><button class="rounded-2xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white">Save Event</button><a href="<?php echo e(route('events.index')); ?>" class="rounded-2xl border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700">Cancel</a></div><?php /**PATH D:\Laravel-Projects\university-club-management-system\resources\views/events/form.blade.php ENDPATH**/ ?>