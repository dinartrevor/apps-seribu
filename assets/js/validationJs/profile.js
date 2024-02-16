$(document).ready(function () {
	if ($("#form-profile").length > 0) {
		  $("#form-profile").validate({
        ignore: '*:not([name])',
        rules: {
          name: {
              required: true,
          },
          email: {
              required: true,
              email: true,
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
        },
        debug: true,
        submitHandler: function (form) {
            form.submit();
            return false;
        }
    });
	}
  if ($("#form-change-password").length > 0) {
    $("#form-change-password").validate({
      ignore: '*:not([name])',
      rules: {
          current_password: {
              required: true,
          },
          new_password: {
              required: true,
          },
          confirm_password: {
              required: true,
              equalTo: "#new_password", // Custom rule for matching passwords
          },
      },
      messages: {
          current_password: {
              required: function () {
                  toastr.error($('#current_password').attr('placeholder') + ' Harus Diisi');
              },
          },
          new_password: {
              required: function () {
                  toastr.error($('#new_password').attr('placeholder') + ' Harus Diisi');
              },
          },
          confirm_password: {
              required: function () {
                  toastr.error($('#confirm_password').attr('placeholder') + ' Harus Diisi');
              },
              equalTo: function () {
                  toastr.error('Konfirmasi Password harus sama dengan Password Baru');
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
