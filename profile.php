<?php
    require_once 'config/helper.php';
    session_start();
    if(!empty($_SESSION['user'])){
        $user =  getUserProfile($_SESSION['user']['npm']);
        $isVerify = $user['status'] == 2 ? 2 : '';
        $isDisabled = $user['status'] == 2 ? 'disabled' : '';
    }else{

		header('Location: index.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'layouts_frontend/head.php'; ?>
<link rel="stylesheet" href="assets/vendor/toastr/toastr.css">

<body>
    <input type="hidden" id="isVerify" value="<?= @$isVerify ?>">
    <?php include 'layouts_frontend/navbar.php'; ?>
	<div class="container mt-2">
        <div class="row">
            <!-- Banner Card Full Image -->
            <div class="col-12">
                <div class="card bg-dark text-white card-height">
                    <img src="assets/img/banner-seribu.png" class="card-img opacity-25 img-height" alt="Banner">
                    <div class="card-img-overlay d-flex align-items-center justify-content-center">
                        <div class="text-center">
                            <h1 class="card-title">Satu Rupiah Satu Harapan <br>#SeribuSenyuman</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Section -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4">
                <!-- Improved Profile Information Design -->
                <div class="card shadow">
                    <img src="assets/img/logo-sttb2.png" class="card-img-top mt-3"  alt="Profile Picture">
                    <div class="card-body mt-4">
                        <h5 class="card-title"><?= @$user['name'] ?></h5>
                        <p class="card-title"><?= @$user['email'] ?></p>
                        <p class="card-title"><?= @$user['npm'] ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <!-- Improved Card Design -->
                <div class="card shadow">
                    <div class="card-header">
                        <ul class="nav nav-pills card-header-pills">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-edit-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-edit-profile" role="tab" aria-controls="pills-edit-profile" aria-selected="true">Profil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-donasi-tab" data-bs-toggle="pill" data-bs-target="#pills-donasi" role="tab" aria-controls="pills-donasi" aria-selected="false" <?= @$isDisabled ?>>Donasi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-password-tab" data-bs-toggle="pill" data-bs-target="#pills-password" role="tab" aria-controls="pills-password" aria-selected="false">Ganti Password</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <!-- Tabs Content -->
                        <div class="tab-content">
                            <!-- Edit Profile Content -->
                            <div class="tab-pane fade show active" id="pills-edit-profile" role="tabpanel" aria-labelledby="pills-edit-profile-tab" tabindex="0">
                                <form action="config/function/update_profile.php" method="post" id="form-profile">
                                    <!-- Your edit profile form fields go here -->
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name:</label>
                                        <input type="text" id="name" name="name" value="<?= @$user['name'] ?>" class="form-control" placeholder="Nama">
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email:</label>
                                        <input type="email" id="email" name="email" value="<?= @$user['email'] ?>"  class="form-control" placeholder="Email">
                                    </div>

                                    <!-- Add more fields as needed -->

                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </form>
                            </div>

                            <!-- Donasi Content -->
                            <div class="tab-pane fade" id="pills-donasi" role="tabpanel" aria-labelledby="pills-donasi-tab" tabindex="0">
                                <!-- Your Donasi content goes here -->
                            </div>

                            <!-- Change Password Content -->
                            <div class="tab-pane fade" id="pills-password" role="tabpanel" aria-labelledby="pills-password-tab" tabindex="0">
                                <!-- Your change password form can be added here -->
                                <form action="config/function/change_password.php" method="post" id="form-change-password">
                                    <!-- Add your form fields (current password, new password, etc.) here -->
                                    <div class="mb-3">
                                        <label for="current-password" class="form-label">Kata sandi saat ini:</label>
                                        <input type="password" id="current_password" name="current_password" class="form-control" placeholder="Kata sandi saat ini">
                                    </div>

                                    <div class="mb-3">
                                        <label for="new-password" class="form-label">Kata Sandi Baru:</label>
                                        <input type="password" id="new_password" name="new_password" class="form-control" placeholder="Kata sandi Baru">
                                    </div>

                                    <div class="mb-3">
                                        <label for="confirm-password" class="form-label">Konfirmasi Kata Sandi:</label>
                                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Konfirmasi sandi Baru">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'layouts_frontend/footer.php'; ?>
    <?php include 'layouts_frontend/script.php'; ?>
    <script src="assets/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="assets/vendor/toastr/toastr.min.js"></script>
    <script src='assets/js/validationJs/profile.js'></script>
    
	<script>
		$(document).ready(function () {
			<?php if(!empty($_SESSION['message_success'])): ?>
				Swal.fire({
					title: '<?php echo $_SESSION['message_success']; ?>',
					icon: "success"
				});
				<?php unset($_SESSION['message_success']); ?>
			<?php endif; ?>

			<?php if(!empty($_SESSION['message_error'])): ?>
				Swal.fire({
					title: '<?php echo $_SESSION['message_error']; ?>',
					icon: "error"
				});
				<?php unset($_SESSION['message_error']); ?>
			<?php endif; ?>
		});
	</script>
</body>

</html>
