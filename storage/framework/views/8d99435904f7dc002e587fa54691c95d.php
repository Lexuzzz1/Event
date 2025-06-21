<?php $__env->startSection('title', 'Events'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row pt-10 mt-10">
        <div class="col-12 mt-10 pt-10">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="card-title">Data Event</h4>
                            <p class="card-subtitle">
                                Daftar semua event yang terdaftar.
                            </p>
                        </div>
                        <div>
                            <a href="<?php echo e(route('event.create')); ?>" class="btn btn-outline-primary mx-3 mt-2 d-block">
                                Buat Event
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive mt-4">
                        <table class="table mb-0 text-nowrap varient-table align-middle fs-3">
                            <thead>
                            <tr>
                                <th scope="col" class="px-0 text-muted">Nama Event</th>
                                <th scope="col" class="px-0 text-muted">Tanggal</th>
                                <th scope="col" class="px-0 text-muted">Waktu</th>
                                <th scope="col" class="px-0 text-muted">Lokasi</th>
                                <th scope="col" class="px-0 text-muted">Pemateri</th>
                                <th scope="col" class="px-0 text-muted">Status</th>
                                <th scope="col" class="px-0 text-muted text-center">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="px-0"><?php echo e(Str::limit(strip_tags($event->name), 10, '...')); ?></td>
                                    <td class="px-0"><?php echo e(\Carbon\Carbon::parse($event->date)->format('d M Y')); ?></td>
                                    <td class="px-0"><?php echo e($event->time); ?></td>
                                    <td class="px-0"><?php echo e(Str::limit(strip_tags($event->location), 10, '...')); ?></td>
                                    <td class="px-0"><?php echo e(Str::limit(strip_tags($event->speaker), 10, '...')); ?></td>
                                    <td class="px-0 text-capitalize">
                                        <?php if($event->status == 'active'): ?>
                                            Aktif
                                        <?php elseif($event->status == 'inactive'): ?>
                                            Nonaktif
                                        <?php elseif($event->status == 'pass'): ?>
                                            Selesai
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-0 text-center">
                                        <?php if($event->status === 'pass' || $event->created_by !== auth()->id()): ?>
                                            <a href="<?php echo e(route('event.view', $event->id)); ?>"
                                               class="btn btn-secondary btn-sm">View Only</a>
                                        <?php else: ?>
                                            <a href="<?php echo e(route('event.edit', $event->id)); ?>" class="btn btn-warning">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <?php if( session('success') ): ?>
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div class="toast align-items-center border-0 show" role="alert" aria-live="assertive"
                 aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <?php echo e(session('success')); ?>

                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                            aria-label="Close"></button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <script>
        const toastElList = [].slice.call(document.querySelectorAll('.toast'))
        const toastList = toastElList.map(function (toastEl) {
            return new bootstrap.Toast(toastEl).show();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Note\uas_pwl\uas_pwl\resources\views/event/index.blade.php ENDPATH**/ ?>