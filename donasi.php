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
    <!-- Donasi Populer -->
    <div class="container mt-4">
		<div class="row">
			<div class="col-md-12">
				<h2>List Donasi</h2>
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
