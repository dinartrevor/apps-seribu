<?php
    require_once 'config/helper.php';
    session_start();
    if(!empty($_SESSION['user'])){
        $user =  getUserProfile($_SESSION['user']['npm']);
        $isVerify = $user['status'] == 2 ? 2 : '';
    }

    $payment_methods = getAllPaymentMethod();
    $donations = getAllDonation();
?>
<!DOCTYPE html>
<html lang="en">
    <?php include 'layouts_frontend/head.php'; ?>
<body>
    <input type="hidden" id="isVerify" value="<?= @$isVerify ?>">
    <?php include 'layouts_frontend/navbar.php'; ?>
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
				<h2>Donasi Terbaru <span class="float-end"><a href="donasi.php" class="btn btn-link see-more-link">Lihat Selengkapnya...</a></span></h2>
			</div>
		</div>
        <div class="row">
            <!-- Card Donasi Populer 1 -->
            <?php if(!empty($donations)){
                $limitedDonations = array_slice($donations, 0, 3);
                foreach($limitedDonations as $donation){
                    $timestamp = strtotime($donation['created_at']);
                    $formattedDate = strftime('%A, %d %B %Y', $timestamp);
            ?>
            <div class="col-md-4">
                <div class="card shadow p-3 mb-5 bg-body rounded">
                    <img src="<?= $donation['image'] ?  'uploads/'.$donation['image'] : 'https://via.placeholder.com/300' ?>" class="card-img-top" alt="Donasi 1">
                    <div class="card-body">
                        <h5 class="card-title"><?= $donation['title'] ?></h5>
                        <p class="card-text"><?= $donation['notes'] ?></p>
                        <div class="progress mb-2">
                            <div class="progress-bar bg-success" role="progressbar" style="width: <?= ($donation['donor_amount']/intval($donation['amount'])) * 100 ?>%;"
                                aria-valuenow="<?= ($donation['donor_amount']/intval($donation['amount'])) * 100 ?>" aria-valuemin="0" aria-valuemax="100">
                                Rp <?= number_format($donation['donor_amount']) ?> / Rp <?= number_format($donation['amount']) ?>
                            </div>
                        </div>
						<p class="card-text"><strong>Pembuat : </strong><?= $donation['name'] ?>  - <?= $formattedDate ?></p>
                        <p class="card-text"><strong>Target : Rp <?= number_format($donation['amount']) ?></strong> </p>
                        <?php if (empty($isVerify) && !empty(@$user)) { ?>
                        <a href="#" class="btn btn-primary" onclick="clickDonor('<?= $donation['id']  ?>')">Donasi Sekarang</a>
                        <?php }else{ ?>
                            <a href="login.php" class="btn btn-primary">Donasi Sekarang</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php }

                }
            ?>
        </div>
    </div>
    <!-- Banner -->
    <div class="container mt-2">
        <div class="row">
            <!-- Banner Card Full Image -->
            <div class="col-12">
                <div class="card bg-dark text-white card-height">
                    <img src="assets/img/banner-seribu.png" class="card-img opacity-25 img-height" alt="Banner">
                    <div class="card-img-overlay d-flex align-items-center justify-content-center">
                        <div class="text-center">
                            <h1 class="card-title">Satu Rupiah Satu Harapan <br>#SeribuSenyuman</h1>
                            <?php if (empty($isVerify) && !empty(@$user)) { ?>
                                <a href="#" class="btn btn-primary btn-lg mt-3" data-bs-toggle="modal" data-bs-target="#donationModal">Donasi Sekarang</a>
                            <?php }else{ ?>
                                <a href="login.php" class="btn btn-primary btn-lg mt-3">Donasi Sekarang</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php (empty(@$isVerify) && !empty(@$user)) ? include 'modal/donation.php' : ''; ?>
    <?php (empty(@$isVerify) && !empty(@$user)) ? include 'modal/donor.php' : ''; ?>
    <?php include 'layouts_frontend/footer.php'; ?>
	<?php include 'layouts_frontend/script.php'; ?>
    <script>

        $(document).ready(function () {
            $("#donor_payment_method_id").on("change", function() {
                let account_number = $(this).find(':selected').attr('data-number');
                let account_name = $(this).find(':selected').attr('data-name');
                $("#donor_number").html('Nomor Rekening : ' + account_number);
                $("#donor_name").html('Atas Nama : ' + account_name);
            });
        });

        function clickDonor(id){
            $("#donation_id").val(id);
            getAllPaymentUser(id);
        }
        function getAllPaymentUser(id){
            $.ajax({
                url: '<?= "config/function/payment_method_user.php" ?>',
                type: 'GET',
                data : {
                    id : id
                }
            }).done(function (response) {
                response = JSON.parse(response);
                console.log(response);
                if(response.status){
                    let data = response.data;
                    if(data.length > 0){
                        let html = `<option value="" selected disabled>Pilih Metode Pembayaran</option>`;
                        for (let i = 0; i < data.length; i++) {
                            html +=`<option value="${data[i].id}" ${data[i].selected} data-name="${data[i].account_holder_name}" data-number="${data[i].account_number}">${data[i].name}</option>`
                        }
                        $('#donor_payment_method_id').html(html);
                    }
                    $("#donorModal").modal('show');
                }
            })
            .fail(function () {
                console.log("error");
            });
        }
    </script>
</body>

</html>
