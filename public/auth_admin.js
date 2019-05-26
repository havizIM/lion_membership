 $(document).ready(function () {

     $('#form_login').on('submit', function (e) {
         e.preventDefault();

         var id_karyawan = $('#id_karyawan').val();
         var password = $('#password').val();

         if (id_karyawan === '' || password === '') {
             new Noty({
                 type: "error",
                 layout: "topRight",
                 text: 'ID and Password is required',
                 progressBar: true,
                 timeout: 2500,
                 animation: {
                     open: "animated bounceInRight",
                     close: "animated bounceOutRight"
                 }
             }).show();
         } else {

             $.ajax({
                 url: `${BASE_URL}api/auth/login_user`,
                 type: 'POST',
                 data: $(this).serialize(),
                 beforeSend: function () {
                     $('#submit_login').addClass('disabled').html('<i class="la la-spinner animated infinite rotateOut"></i>');
                 },
                 success: function (response) {
                     if (response.status === 200) {
                         localStorage.setItem('lion_membership', JSON.stringify(response.data));
                         window.location.replace(`${BASE_URL}${response.data.level}/`)
                     } else {
                         new Noty({
                             type: "error",
                             layout: "topRight",
                             text: response.message,
                             progressBar: true,
                             timeout: 2500,
                             animation: {
                                 open: "animated bounceInRight",
                                 close: "animated bounceOutRight"
                             }
                         }).show();
                         $('#submit_login').removeClass('disabled').html('Log In');
                     }
                 },
                 error: function () {
                     new Noty({
                         type: "info",
                         layout: "topRight",
                         text: "Hey this is an informations notification.",
                         progressBar: true,
                         timeout: 2500,
                         animation: {
                             open: "animated bounceInRight",
                             close: "animated bounceOutRight"
                         }
                     }).show();
                     $('#submit_login').removeClass('disabled').html('Log In');
                 }
             })
         }
     });

     $('#show_pass').click(function () {
         if ($(this).is(':checked')) {
             $('#password').attr('type', 'text');
         } else {
             $('#password').attr('type', 'password');
         };
     });

 });