<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" crossorigin="anonymous">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <title>Apps Seribu STTB</title>
    <link rel="stylesheet" href="assets/css/style_frontend.css">
</head>
<body>

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
                        <a class="nav-link active" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Donasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-person-fill"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Jumbotron Cover Gambar -->
    <div class="jumbotron">
        <div class="container"></div>
    </div>

    <!-- Apa yang kita lakukan -->
	<div class="container mt-4">
        <div class="row">
            <!-- Carousel on the left -->
            <div class="col-md-6">
                <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="https://www.eventbrite.co.uk/blog/wp-content/uploads/2022/06/Promote-charity-event.png" class="d-block w-100" alt="Carousel 1">
                        </div>
                        <div class="carousel-item">
                            <img src="https://media.licdn.com/dms/image/D4E12AQEtZohUmTWjSw/article-cover_image-shrink_720_1280/0/1663601217867?e=2147483647&v=beta&t=HUll-bKKwVOMB8uxiZa94tf1OTi1qwXN9DVdOoQiAt8" class="d-block w-100" alt="Carousel 2">
                        </div>
                        <div class="carousel-item">
                            <img src="https://corona.jakarta.go.id/img/logo/ksbb-umkm-banner.svg" class="d-block w-100" alt="Carousel 3">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <!-- Text description on the right -->
            <div class="col-md-6">
				<div class="card shadow-sm p-4 mb-5 bg-body rounded">
					<h3>Aplikasi Seribu untuk Mahasiswa STTB</h3>
					<p>
						Banyak mahasiswa di seluruh Indonesia yang menghadapi tantangan keuangan selama masa kuliah mereka.
						Beberapa dari mereka mungkin kesulitan memenuhi kebutuhan dasar seperti biaya makan, transportasi, atau pembelian buku. Melihat realitas ini,
						Program ini diharapkan membangun solidaritas dan memberikan kontribusi positif bagi mahasiswa yang memerlukan,
						kami memperkenalkan program donasi yang simpel namun bermakna :
					</p>
					<h4 class="fw-bold">Satu Rupiah Satu Harapan</h4>
				</div>
			</div>
        </div>
    </div>


    <!-- Donasi Populer -->
    <div class="container mt-4">
		<div class="row">
			<div class="col-md-12">
				<h2>Donasi Terbaru <span class="float-end"><a href="#" class="btn btn-link see-more-link">Lihat Selengkapnya...</a></span></h2>
			</div>
		</div>
        <div class="row">
            <!-- Card Donasi Populer 1 -->
            <div class="col-md-4">
                <div class="card shadow p-3 mb-5 bg-body rounded">
                    <img src="https://via.placeholder.com/300" class="card-img-top" alt="Donasi 1">
                    <div class="card-body">
                        <h5 class="card-title">Donasi untuk Pendidikan</h5>
                        <p class="card-text">Bantu kami menyediakan buku dan alat tulis untuk anak-anak kurang mampu.</p>
                        <div class="progress mb-2">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 50%"
                                aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">Rp 70,000 / Rp 100,000</div>
                        </div>
						<p class="card-text"><strong>Donor:</strong> Dinar Abdul Hollik - January 21, 2024</p>
                        <a href="#" class="btn btn-primary">Donasi Sekarang</a>
                    </div>
                </div>
            </div>

            <!-- Card Donasi Populer 2 -->
            <div class="col-md-4">
                <div class="card shadow p-3 mb-5 bg-body rounded">
                    <img src="https://via.placeholder.com/300" class="card-img-top" alt="Donasi 2">
                    <div class="card-body">
                        <h5 class="card-title">Donasi untuk Kesehatan</h5>
                        <p class="card-text">Bantu kami memberikan akses kesehatan yang lebih baik untuk masyarakat.</p>
                        <div class="progress mb-2">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 50%"
                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">Rp 70,000 / Rp 100,000</div>
                        </div>
						<p class="card-text"><strong>Donor:</strong> Rizky Oktaviandy - January 21, 2024</p>
                        <a href="#" class="btn btn-primary">Donasi Sekarang</a>
                    </div>
                </div>
            </div>

            <!-- Card Donasi Populer 3 -->
            <div class="col-md-4">
                <div class="card shadow p-3 mb-5 bg-body rounded">
                    <img src="https://via.placeholder.com/300" class="card-img-top" alt="Donasi 3">
                    <div class="card-body">
                        <h5 class="card-title">Donasi untuk Lingkungan</h5>
                        <p class="card-text">Dukung upaya kami dalam menjaga keberlanjutan lingkungan hidup.</p>
                        <div class="progress mb-2">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 50%"
                                aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">Rp 70,000 / Rp 100,000</div>
                        </div>
						<p class="card-text"><strong>Donor:</strong> Yogi Saputra - January 21, 2024</p>
                        <a href="#" class="btn btn-primary">Donasi Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Our Team -->
    <div class="container mt-4">
        <div class="row">
            <!-- Banner Card Full Image -->
            <div class="col-md-12">
                <div class="card bg-dark text-white">
                    <img src="assets/img/banner-seribu.png" class="card-img opacity-25" alt="Our Team Banner">
                    <div class="card-img-overlay d-flex align-items-center justify-content-center">
                        <div class="text-center">
                            <h1 class="card-title">Satu Rupiah Satu Harapan <br>#SeribuHarapan</h1>
                            <a href="#" class="btn btn-primary btn-lg mt-4">Donasi Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


	 <!-- Footer -->
	 <footer class="footer text-light text-center py-3 mt-4">
        <p>&copy; <?= date('Y'); ?> Seribu STTB. All rights reserved.</p>
    </footer>
    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
