<?php $__env->startSection('title', 'Upload Bukti Pembayaran'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="mb-4">Upload Bukti Pembayaran untuk :</h3>
                <p><strong><?php echo e($event->name); ?></strong></p>

                <form action="<?php echo e(route('payment.upload.submit', $event->id)); ?>" method="POST"
                      enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label for="proof_of_payment" class="form-label">Bukti Pembayaran</label>
                        <input type="file" class="form-control" id="proof_of_payment" name="proof_of_payment" required>
                        <?php $__errorArgs = ['proof_of_payment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <button type="submit" class="btn btn-primary">Upload</button>
                    <a href="<?php echo e(route('event.all', $event->id)); ?>" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Note\uas_pwl\uas_pwl\resources\views/payment/upload.blade.php ENDPATH**/ ?>