  <!-- Script Bootstrap -->
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/select2/select2.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="assets/vendor/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/vendor/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/vendor/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="assets/vendor/sweetalert2/sweetalert2.min.js"></script>
<script>
    $(document).ready(function () {
        if($("#isVerify").val() != ""){
            Swal.fire({
                title: "Akun Anda Belum Di Verifikasi Admin !!",
                icon: "warning"
            });
        }
        $('*select[data-selectModalCreatejs="true"]').select2({
            dropdownParent: $('#donationModal'),
			width: '100%',
    	});
        $('*select[data-selectModalDonorCreatejs="true"]').select2({
            dropdownParent: $('#donorModal'),
			width: '100%',
    	});
        $('#data-table').DataTable();
        $(".number-only").keyup(function(e) {
            var regex = /^[0-9]+$/;
            if (regex.test(this.value) !== true) {
                this.value = this.value.replace(/[^0-9]+/, '');
            }
        });
        $(".currency").on("keyup", function() {
            value = $(this).val().replace(/,/g, '');
            if (!$.isNumeric(value) || value == NaN) {
                $(this).val('0').trigger('change');
                value = 0;
            }
            $(this).val(parseFloat(value, 10).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
        });

        $('#addInputBtn').on('click', () => {
            let dataPaymentMethods = $("#json_payment_method").val() ? JSON.parse($("#json_payment_method").val()) : "";
            let totalInput = parseInt($('#totalInput').val());
            let paymentMethod = `<select name="payment_method_id[]" id="payment_method_id${totalInput + 1}" class="form-select"  aria-labelledby="payment_method"  data-selectModalCreatejs="true" data-placeholder="Metode Pembayaran">`;
            if(dataPaymentMethods.length > 0) {
                    paymentMethod += `<option value="" selected disabled>Pilih Metode Pembayaran</option>`;
                dataPaymentMethods.forEach(element => {
                    paymentMethod += `<option value="${element.id}">${element.name}</option>`;
                });
            }
            paymentMethod += `</select>`;
            const accountNumber = `<input type="text" name="account_number[]" class="form-control number-only" id="account_number${totalInput + 1}" placeholder="Nomor Rekening" aria-labelledby="account_number" />`;
            const accountHolder = `<input type="text" name="account_holder_name[]" class="form-control" id="account_holder_name${totalInput + 1}" placeholder="Atas Nama" aria-labelledby="account_holder_name" />`;

            $(accountNumber).insertAfter(`#account_number${totalInput}`);
            $(accountHolder).insertAfter(`#account_holder_name${totalInput}`);
            $(paymentMethod).insertAfter(`#payment_method_id${totalInput}`);
            $('#totalInput').val(totalInput + 1).trigger('change');
            init();
        });

        $('#removeInputBtn').on('click', () => {
            let totalInput = parseInt($('#totalInput').val());

            if (totalInput > 1) {
                $(`#payment_method_id${totalInput}`).select2('destroy');
                $(`#payment_method_id${totalInput}`).remove();
                $(`#account_number${totalInput}`).remove();
                $(`#account_holder_name${totalInput}`).remove();
                $('#totalInput').val(totalInput - 1).trigger('change');
            }

            init();
        });

        $('#totalInput').change(function () {
            if (parseInt($(this).val()) <= 1) {
                $('#removeInputBtn').attr('disabled', true);
            } else {
                $('#removeInputBtn').removeAttr('disabled');
            }
        });
    });
    function init() {
        $('*select[data-selectModalCreatejs="true"]').select2({
            dropdownParent: $('#donationModal'),
            width: '100%',
        });
        $(".number-only").keyup(function(e) {
            var regex = /^[0-9]+$/;
            if (regex.test(this.value) !== true) {
                this.value = this.value.replace(/[^0-9]+/, '');
            }
        });
        $(".currency").on("keyup", function() {
            value = $(this).val().replace(/,/g, '');
            if (!$.isNumeric(value) || value == NaN) {
                $(this).val('0').trigger('change');
                value = 0;
            }
            $(this).val(parseFloat(value, 10).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
        });
    }
</script>
