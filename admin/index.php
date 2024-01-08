<?php 
	require_once '../config/helper.php';
  session_start();
	checkIsNotUser();
?>

<!DOCTYPE html>
<html lang="en">
	<?php include '../layouts/head.php'; ?>
	<body class="d-flex flex-column min-vh-100">
		<?php include '../layouts/sidebar.php'; ?>
			<main id="main" class="main">
				<div class="pagetitle">
				<h1>Dashboard</h1>
				<nav>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Dashboard</li>
					</ol>
				</nav>
			</div>
			<section class="section dashboard">
				<div class="row">
					<div class="col-md-12  text-center">
						<div class="card shadow">
							<div class="card-header">
								<img src="../assets/img/logo-sttb.jpg" alt="" height="120">
							</div>
							<div class="card-body">
								<div class="alert alert-info" role="alert">
									<h4 class="alert-heading">Welcome <?= $_SESSION['user']['name']; ?></h4>
									<p>Happy <?= date('l'); ?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
    	</main>
		<?php include '../layouts/footer.php'; ?>
		<?php include '../layouts/script.php'; ?>

	</body>
</html>
