function load_content(link) {
  if (link) {
    $.get(BASE_URL + `helpdesk/${link}`, function (response) {
      $('#content').html(response);
    });
  } else {
    location.hash = "#/dashboard"
  }

};

function makeNotif(type, message, position) {
  new Noty({
    type: type,
    layout: position,
    text: message,
    progressBar: true,
    timeout: 2500,
    animation: {
      open: "animated bounceInRight",
      close: "animated bounceOutRight"
    }
  }).show();
}

$(document).ready(function () {
  var session = localStorage.getItem('lion_membership');
  var auth = JSON.parse(session);
  var link;

  //Display Session
  $('#session_name').text(auth.nama_user);
  $('#session_nip').text(auth.id_karyawan);
  $('#session_level').text(auth.level);
  $('#session_tgl').text(auth.tgl_registrasi);

  //Load Halaman
  if (location.hash) {
    link = location.hash.substr(2);
    load_content(link);
  } else {
    location.hash = '#/dashboard';
  }

  $(window).on('hashchange', function () {
    link = location.hash.substr(2);
    load_content(link);
  });

  //Show Password
  $('#show_pass').click(function () {
    if ($(this).is(':checked')) {
      $('#password_lama').attr('type', 'text');
      $('#password_baru').attr('type', 'text');
      $('#retype_baru').attr('type', 'text');
    } else {
      $('#password_lama').attr('type', 'password');
      $('#password_baru').attr('type', 'password');
      $('#retype_baru').attr('type', 'password');
    };
  });
  //Logout Action
  $('#logout').on('click', function () {
    Swal.fire({
      title: 'Are you sure to logout?',
      text: "You need to login again!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes',
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: `${BASE_URL}api/auth/logout_user/${auth.token}`,
          type: 'GET',
          dataType: 'JSON',
          success: function (response) {
            if (response.status === 200) {
              localStorage.removeItem('lion_membership');
              window.location.replace(`${BASE_URL}auth/login_admin`)
            } else {
              makeNotif('error', response.message, 'bottomRight');
            }
          },
          error: function () {
            makeNotif('error', 'Tidak dapat mengakses server', 'bottomRight');
          }
        })
      }
    })
  });

  $('#form_password').on('submit', function (e) {
    e.preventDefault();
    var password_lama = $('#password_lama').val();
    var password_baru = $('#password_baru').val();
    var retype_password = $('#retype_baru').val();

    if (password_lama === '' || password_baru === '') {
      makeNotif('error', 'Silahkan isi form dengan lengkap', 'bottomRight')
    } else if (password_baru !== retype_password) {
      makeNotif('error', 'Password baru dan retype password harus sama', 'bottomRight')
    } else {
      $.ajax({
        url: `${BASE_URL}api/auth/password_user/${auth.token}`,
        type: 'POST',
        dataType: 'JSON',
        data: $(this).serialize(),
        beforeSend: function () {
          $('#btn_password').addClass('disabled').html('<i class="la la-spinner animated infinite rotateOut"></i>');
        },
        success: function (response) {
          if (response.status === 200) {
            makeNotif('success', response.message, 'bottomRight');
            $('#form_password')[0].reset();
          } else {
            makeNotif('error', response.message, 'bottomRight')
          }
          $('#btn_password').removeClass('disabled').html('Save Changes');
        },
        error: function () {
          makeNotif('error', 'Tidak dapat mengakses server', 'bottomRight')
        }
      })
    }

  })
});