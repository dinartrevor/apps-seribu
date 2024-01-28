<?php
    $current_page = basename($_SERVER['PHP_SELF']);
?>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">SERIBU STTB</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link <?php echo (strpos($current_page, 'index.php') !== false) ? 'active' : ''; ?>" href="index.php">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Donasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Tentang Kami</a>
                </li>
                <?php if(!empty($_SESSION['user'])){ ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo (strpos($current_page, 'profile.php') !== false) ? 'active' : ''; ?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= $user['name'] ?> <i class="bi bi-person-fill"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Buat Donasi</a></li>
                            <li><a class="dropdown-item" href="config/function/logout.php">Logout</a></li>
                        </ul>
                    </li>
                <?php }else{?>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">
                        Login <i class="bi bi-person-fill"></i>
                    </a>
                </li>
                <?php }?>
            </ul>
        </div>
    </div>
</nav>
