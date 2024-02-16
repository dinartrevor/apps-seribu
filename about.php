<?php
    require_once 'config/helper.php';
    session_start();
    if(!empty($_SESSION['user'])){
        $user =  getUserProfile($_SESSION['user']['npm']);
        $isVerify = $user['status'] == 2 ? 2 : '';
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
    <div class="container mt-4">
        <h2>Team Kami</h2>
        <div class="row">
            <!-- Card Anggota Tim 1 -->
            <div class="col-md-4">
                <div class="shadow p-3 mb-5 bg-body rounded">
                    <img src="assets/img/goku.jpeg" class="card-img-top height-500px" alt="Dinar Abdul Hollik Firdaus">
                    <div class="card-body mt-3">
                        <h5 class="card-title">Dinar Abdul Hollik Firdaus</h5>
                        <p class="card-text">Posisi: Programmer</p>
                    </div>
                </div>
            </div>

            <!-- Card Anggota Tim 2 -->
            <div class="col-md-4">
                <div class="shadow p-3 mb-5 bg-body rounded">
                    <img src="assets/img/luffy.jpg" class="card-img-top height-500px" alt="Rizky Oktaviandy">
                    <div class="card-body mt-3">
                        <h5 class="card-title">Rizky Oktaviandy</h5>
                        <p class="card-text">Posisi: Programmer</p>
                    </div>
                </div>
            </div>

            <!-- Card Anggota Tim 3 -->
            <div class="col-md-4">
                <div class="shadow p-3 mb-5 bg-body rounded">
                    <img src="assets/img/naruto.jpg" class="card-img-top height-500px" alt="Yogi Saputra">
                    <div class="card-body mt-3">
                        <h5 class="card-title">Yogi Saputra</h5>
                        <p class="card-text">Posisi: Programmer</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
