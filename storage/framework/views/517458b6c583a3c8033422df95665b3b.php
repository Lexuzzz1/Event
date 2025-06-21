<?php $__env->startSection('title', 'Event'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row pt-10 mt-10">
        <div class="col-12 mt-10 pt-10">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">Incoming Event!</h4>
                            <p class="card-subtitle">
                                Event yang Akan Segera Datang!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex align-items-center">
                        <div class="row">
                            <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-6">
                                    <div class="card h-100">
                                        <?php if($event->poster): ?>
                                            <img src="<?php echo e(asset('storage/' . $event->poster)); ?>" class="card-img-top"
                                                 alt="Event Poster" style="height: 200px; object-fit: cover;">
                                        <?php else: ?>
                                            <img src="<?php echo e(asset('assets/images/default-poster.jpg')); ?>"
                                                 class="card-img-top" alt="No Poster"
                                                 style="height: 200px; object-fit: cover;">
                                        <?php endif; ?>

                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo e(Str::limit(strip_tags($event->name), 20, '...')); ?></h5>
                                            <p class="card-text">
                                                <?php echo e(Str::limit(strip_tags($event->description), 20, '...')); ?>

                                            </p>

                                            <a href="<?php echo e(route('event.detail', $event->id)); ?>" class="btn btn-primary">See
                                                More</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Note\uas_pwl\uas_pwl\resources\views/event/all.blade.php ENDPATH**/ ?>