$(document).ready(function () {
	if ($("#form-create").length > 0) {
		$("#form-create").validate({
            ignore: '*:not([name])',
            rules: {
                name: {
                    required: true,
                },
                permission: {
                    required: true,
                },
            },
            messages: {
                name: {
                    required: function () {
                        toastr.error($('#name').attr('placeholder') + ' Harus Diisi')
                    },
                },
                permission: {
                    required: function () {
                        toastr.error($('#permission').attr('placeholder') + ' Harus Diisi')
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
