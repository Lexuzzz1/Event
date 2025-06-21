<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="<?php echo e(route('dashboard')); ?>" class="text-nowrap logo-img">
                <img src="<?php echo e(asset('assets/images/logos/logo.svg')); ?>" alt=""/>
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-6"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="<?php echo e(route('dashboard')); ?>" aria-expanded="false">
                        <i class="ti ti-atom"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <?php switch(auth()->user()->role_id):
                    case (1): ?>
                        <li class="sidebar-item">
                            <a class="sidebar-link justify-content-between"
                               href="<?php echo e(route('event.all')); ?>"
                               aria-expanded="false">
                                <div class="d-flex align-items-center gap-3">
                                <span class="d-flex">
                                <i class="ti ti-speakerphone"></i>
                                </span>
                                    <span class="hide-menu">Event</span>
                                </div>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link justify-content-between"
                               href="<?php echo e(route('event.history')); ?>"
                               aria-expanded="false">
                                <div class="d-flex align-items-center gap-3">
                                <span class="d-flex">
                                <i class="ti ti-calendar-stats"></i>
                                </span>
                                    <span class="hide-menu">History</span>
                                </div>
                            </a>
                        </li>
                        <?php break; ?>
                    <?php case (2): ?>
                        <li class="sidebar-item">
                            <a class="sidebar-link justify-content-between"
                               href="<?php echo e(route('user.index')); ?>"
                               aria-expanded="false">
                                <div class="d-flex align-items-center gap-3">
                                <span class="d-flex">
                                <i class="ti ti-user-circle"></i>
                                </span>
                                    <span class="hide-menu">User</span>
                                </div>
                            </a>
                        </li>
                        <?php break; ?>
                    <?php case (3): ?>
                        <li class="sidebar-item">
                            <a class="sidebar-link justify-content-between"
                               href="<?php echo e(route('event.index')); ?>"
                               aria-expanded="false">
                                <div class="d-flex align-items-center gap-3">
                                <span class="d-flex">
                                <i class="ti ti-speakerphone"></i>
                                </span>
                                    <span class="hide-menu">Event</span>
                                </div>
                            </a>
                        </li>
                        <?php break; ?>
                <?php endswitch; ?>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<?php /**PATH C:\Note\uas_pwl\uas_pwl\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>