<?php $__env->startSection('title', 'Users'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row pt-10 mt-10">
        <div class="col-12 mt-10 pt-10">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="card-title">Data Users</h4>
                            <p class="card-subtitle">
                            </p>
                        </div>
                        <div>
                            <a href="<?php echo e(route('user.create')); ?>" class="btn btn-outline-primary mx-3 mt-2 d-block">
                                Create User
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive mt-4">
                        <table class="table mb-0 text-nowrap varient-table align-middle fs-3">
                            <thead>
                            <tr>
                                <th scope="col" class="px-0 text-muted">
                                    Name
                                </th>
                                <th scope="col" class="px-0 text-muted">
                                    Role
                                </th>
                                <th scope="col" class="px-0 text-muted">
                                    Email
                                </th>
                                <th scope="col" class="px-0 text-muted">
                                    Status
                                </th>
                                <th scope="col" class="px-0 text-muted text-center">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="px-0"><?php echo e($user->name); ?></td>
                                    <td class="px-0 text-capitalize"><?php echo e($user->role->name); ?></td>
                                    <td class="px-0"><?php echo e($user->email); ?></td>
                                    <td class="px-0 text-capitalize">
                                        <?php if($user->status == 1): ?>
                                            Aktif
                                        <?php elseif($user->status == 0): ?>
                                            Non Aktif
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-0 text-center">
                                        <a href="<?php echo e(route('user.edit', $user->id)); ?>" class="btn btn-warning">
                                            <i class="ti ti-edit"></i>
                                        </a>
                                        <?php if($user->status == 1): ?>
                                            <button type="button" class="btn btn-danger"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal"
                                                    data-user-id="<?php echo e($user->id); ?>">
                                                <i class="ti ti-x"></i>
                                            </button>
                                        <?php elseif($user->status == 0): ?>
                                            <button type="button" class="btn btn-success"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#activeModal"
                                                    data-user-id="<?php echo e($user->id); ?>">
                                                <i class="ti ti-check"></i>
                                            </button>
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
    <!-- Modal Non active -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="#" id="deleteUserForm">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Nonaktifkan User?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        User akan dinonaktifkan. Kamu bisa mengaktifkannya kembali nanti.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-success" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Nonaktifkan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal Non active -->
    <div class="modal fade" id="activeModal" tabindex="-1" aria-labelledby="activeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="" id="activeUserForm">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Aktifkan User?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        User akan diaktifkan. Kamu bisa mengnonaktifkannya kembali nanti.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Aktifkan</button>
                    </div>
                </div>
            </form>
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

        const deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const userId = button.getAttribute('data-user-id');
            const form = document.getElementById('deleteUserForm');
            form.action = `/user/${userId}/deactivate`;
        });

        const activeModal = document.getElementById('activeModal');
        activeModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const userId = button.getAttribute('data-user-id');
            const form = document.getElementById('activeUserForm');
            form.action = `/user/${userId}/activate`;
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Note\uas_pwl\uas_pwl\resources\views/user/index.blade.php ENDPATH**/ ?>