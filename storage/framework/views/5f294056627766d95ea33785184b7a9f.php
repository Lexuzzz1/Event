<?php $__env->startSection('title', 'Event Detail'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row pt-10 mt-10">
        <div class="col-12 mt-10 pt-10">
            <div class="card shadow">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4"><?php echo e($event->name); ?></h2>

                    <?php if($event->poster): ?>
                        <div class="mb-4 text-center">
                            <img src="<?php echo e(asset('storage/' . $event->poster)); ?>" alt="Poster"
                                 class="img-fluid rounded shadow" style="max-height: 350px; object-fit: cover;">
                        </div>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-md-6">
                            <dl class="row">
                                <dt class="col-sm-4">Date</dt>
                                <dd class="col-sm-8"><?php echo e(\Carbon\Carbon::parse($event->date)->format('d F Y')); ?></dd>

                                <dt class="col-sm-4">Time</dt>
                                <dd class="col-sm-8"><?php echo e(\Carbon\Carbon::parse($event->time)->format('H:i')); ?></dd>

                                <dt class="col-sm-4">Location</dt>
                                <dd class="col-sm-8"><?php echo e($event->location); ?></dd>

                                <dt class="col-sm-4">Speaker</dt>
                                <dd class="col-sm-8"><?php echo e($event->speaker); ?></dd>
                            </dl>
                        </div>
                        <div class="col-md-6">
                            <dl class="row">
                                <dt class="col-sm-5">Registration Fee</dt>
                                <dd class="col-sm-7">Rp <?php echo e(number_format($event->registration_fee, 0, ',', '.')); ?></dd>

                                <dt class="col-sm-5">Max Participants</dt>
                                <dd class="col-sm-7"><?php echo e($event->max_participants); ?></dd>

                            </dl>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <p>Description</p>
                            <p><?php echo e($event->description ?? '-'); ?></p>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        
                        <?php if(auth()->guard()->guest()): ?>
                            <a href="<?php echo e(route('login')); ?>" class="btn btn-primary px-4">Login to Register</a>
                        <?php else: ?>
                            <?php
                                $isRegistered = $event->registrations->where('user_id', auth()->id())->first();
                                $isPassed = \Carbon\Carbon::parse($event->date)->isPast();
                                $isFull = $event->registrations->count() >= $event->max_participants;
                            ?>

                            <?php if($isPassed): ?>
                                <button class="btn btn-secondary px-4" disabled>Event Has Passed</button>
                            <?php elseif($isFull && !$isRegistered): ?>
                                <button class="btn btn-danger px-4" disabled>Kuota Penuh</button>
                            <?php elseif(!$isRegistered): ?>
                                <form action="<?php echo e(route('event.register', $event->id)); ?>" method="POST"
                                      style="display: inline;">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-primary px-4">Register</button>
                                </form>
                            <?php else: ?>
                                <?php if($event->registration_fee == 0): ?>
                                    <button class="btn btn-success px-4" disabled>Anda Sudah Terdaftar</button>
                                <?php else: ?>
                                    <?php switch($isRegistered->payment_status):
                                        case ('pending'): ?>
                                            <a href="<?php echo e(route('payment.upload', $event->id)); ?>"
                                               class="btn btn-warning px-4">
                                                Upload Payment Proof
                                            </a>
                                            <?php break; ?>
                                        <?php case ('paid'): ?>
                                            <button class="btn btn-warning px-4" disabled>Menunggu Verifikasi</button>
                                            <?php break; ?>
                                        <?php case ('verified'): ?>
                                            <button class="btn btn-success px-4" disabled>Anda Sudah Terdaftar</button>
                                            <?php break; ?>
                                        <?php default: ?>
                                            <a href="<?php echo e(route('payment.upload', $event->id)); ?>"
                                               class="btn btn-warning px-4">
                                                Upload Payment Proof
                                            </a>
                                    <?php endswitch; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>

                    <div class="mt-4 text-center">
                        <a href="<?php echo e(route('event.all')); ?>" class="btn btn-outline-secondary">Back to Events</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Note\uas_pwl\uas_pwl\resources\views/event/detail.blade.php ENDPATH**/ ?>