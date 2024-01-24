$(document).ready(function () {
	if ($("#form-create").length > 0) {
		$("#form-create").validate({
            ignore: '*:not([name])',
            rules: {
                name: {
                    required: true,
                },
            },
            messages: {
                name: {
                    required: function () {
                        toastr.error($('#name').attr('placeholder') + ' Harus Diisi')
                    },
                },
            },
            debug: true,
            submitHandler: function (form) {
                form.submit();
                return false;
            }
        });
	}
});
