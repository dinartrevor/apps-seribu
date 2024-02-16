<?php
    $current_page = basename($_SERVER['PHP_SELF']);
?>

<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <a href="#" class="logo d-flex align-items-center text-center">
            <img src="../assets/img/logo-sttb2.png" alt="Apps Seribu" class="img-logo">
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="../assets/img/logo-sttb.jpg" alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2"><?= $_SESSION['user']['name']; ?></span>
                </a><!-- End Profile Image Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6><?= $_SESSION['user']['name']; ?></h6>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="bi bi-person"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="bi bi-box-arrow-right"></i>
                            <form action="../config/function/logout.php" method="POST">
                                <button type="submit" class="dropdown-item">Sign Out</button>
                            </form>
                        </a>
                    </li>
                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->
        </ul>
    </nav><!-- End Icons Navigation -->
</header><!-- End Header -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link <?php echo ($current_page == 'index.php') ? '' : 'collapsed'; ?>" href="index.php">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link <?php echo (strpos($current_page, 'user.php') !== false || strpos($current_page, 'role.php') !== false) ? '' : 'collapsed'; ?>"
               data-bs-target="#user-management-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-people-fill"></i><span>User Management</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="user-management-nav" class="nav-content collapse <?php echo (strpos($current_page, 'user.php') !== false || strpos($current_page, 'role.php') !== false) ? 'show' : ''; ?>" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="../admin/user.php" class="<?php echo (strpos($current_page, 'user.php') !== false) ? 'active' : ''; ?>">
                        <i class="bi bi-circle"></i><span>User</span>
                    </a>
                </li>
                <li>
                    <a href="../admin/role.php" class="<?php echo (strpos($current_page, 'role.php') !== false) ? 'active' : ''; ?>">http://192.168.1.228/#
                        <i class="bi bi-circle"></i><span>Role</span>
                    </a>
                </li>

                <li>
                    <a href="#" class="">
                        <i class="bi bi-circle"></i><span>Permission</span>
                    </a>
                </li>
                <!-- Add other user management links here -->
            </ul>
        </li>
        <!-- End User Management Nav -->
        <li class="nav-item">
            <a class="nav-link <?php echo (strpos($current_page, 'payment_method.php') !== false) ? '' : 'collapsed'; ?>"
               data-bs-target="#master-data-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-database-fill"></i><span>Master Data</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="master-data-nav" class="nav-content collapse <?php echo (strpos($current_page, 'payment_method.php') !== false) ? 'show' : ''; ?>" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="../admin/payment_method.php" class="<?php echo (strpos($current_page, 'payment_method.php') !== false) ? 'active' : ''; ?>">
                        <i class="bi bi-circle"></i><span>Metode Pembayaran</span>
                    </a>
                </li>
                <!-- Add other user management links here -->
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo (strpos($current_page, 'donation.php') !== false || strpos($current_page, 'donatur.php') !== false) ? '' : 'collapsed'; ?>"
               data-bs-target="#content-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-bookmarks-fill"></i><span>Content</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="content-nav" class="nav-content collapse <?php echo (strpos($current_page, 'donation.php') !== false || strpos($current_page, 'donatur.php') !== false) ? 'show' : ''; ?>" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="../admin/donation.php" class="<?php echo (strpos($current_page, 'donation.php') !== false) ? 'active' : ''; ?>">
                        <i class="bi bi-circle"></i><span>Donation</span>
                    </a>
                </li>
                <li>
                    <a href="../admin/donatur.php" class="<?php echo (strpos($current_page, 'donatur.php') !== false) ? 'active' : ''; ?>">
                        <i class="bi bi-circle"></i><span>Donatur</span>
                    </a>
                </li>
                <!-- Add other user management links here -->
            </ul>
        </li>
    </ul>
</aside><!-- End Sidebar-->
