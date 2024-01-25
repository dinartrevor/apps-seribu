$(document).ready(function () {
	if ($("#form-create").length > 0) {
		$("#form-create").validate({
            ignore: '*:not([name])',
            rules: {
                name: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                },
                npm: {
                    required: true,
                    number: true,
                },
            },
            messages: {
                name: {
                    required: function () {
                        toastr.error($('#name').attr('placeholder') + ' Harus Diisi')
                    },
                },
                email: {
                    required: function () {
                        toastr.error($('#email').attr('placeholder') + ' Harus Diisi')
                    },
                    email: function () {
                        toastr.error('Format Email Tidak Valid')
                    },
                },
                password: {
                    required: function () {
                        toastr.error($('#password').attr('placeholder') + ' Harus Diisi')
                    },
                },
                npm: {
                    required: function () {
                        toastr.error($('#npm').attr('placeholder') + ' Harus Diisi')
                    },
                    number: function () {
                        toastr.error('Format NPM Tidak Valid')
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
