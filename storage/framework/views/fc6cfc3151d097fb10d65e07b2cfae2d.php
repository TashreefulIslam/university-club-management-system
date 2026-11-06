<?php ($currentClub = $club ?? null); ?>
<div class="grid gap-5 lg:grid-cols-2">
    <div>
        <label class="mb-2 block text-sm font-semibold text-slate-700">Club name</label>
        <input name="name" value="<?php echo e(old('name', $currentClub?->name)); ?>" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10">
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold text-slate-700">Short name</label>
        <input name="short_name" value="<?php echo e(old('short_name', $currentClub?->short_name)); ?>" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10">
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold text-slate-700">Category</label>
        <input name="category" value="<?php echo e(old('category', $currentClub?->category)); ?>" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10">
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold text-slate-700">Status</label>
        <select name="status" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10">
            <?php $__currentLoopData = ['active' => 'Active', 'inactive' => 'Inactive']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($value); ?>" <?php if(old('status', $currentClub?->status ?? 'active') === $value): echo 'selected'; endif; ?>><?php echo e($label); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold text-slate-700">Advisor</label>
        <select name="advisor_id" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10">
            <option value="">Select advisor</option>
            <?php $__currentLoopData = $advisors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $advisor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($advisor->id); ?>" <?php if((string) old('advisor_id', $currentClub?->advisor_id) === (string) $advisor->id): echo 'selected'; endif; ?>><?php echo e($advisor->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <!-- <div>
        <label class="mb-2 block text-sm font-semibold text-slate-700">Logo</label>
        <input type="file" name="logo" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3">
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold text-slate-700">Banner</label>
        <input type="file" name="banner" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3">
    </div> -->
</div>
<div>
    <label class="mb-2 block text-sm font-semibold text-slate-700">Description</label>
    <textarea name="description" rows="5" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10"><?php echo e(old('description', $currentClub?->description)); ?></textarea>
</div>
<div>
    <label class="mb-2 block text-sm font-semibold text-slate-700">Mission</label>
    <textarea name="mission" rows="5" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10"><?php echo e(old('mission', $currentClub?->mission)); ?></textarea>
</div>
<div class="flex items-center gap-3">
    <button class="rounded-2xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white">Save Club</button>
    <a href="<?php echo e(route('clubs.index')); ?>" class="rounded-2xl border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700">Cancel</a>
</div><?php /**PATH D:\Laravel-Projects\university-club-management-system\resources\views/clubs/form.blade.php ENDPATH**/ ?>