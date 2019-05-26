$(document).ready(function(){

  <!-- Load Data to table -->
  var t_user = $('#t_user').DataTable({
    columnDefs: [{
      targets: [0, 2, 3, 4, 5],
      searchable: false
    },{
      targets: [6],
      orderable: false
    }],
    autoWidth: false,
    language: {
      search: 'Search Name: _INPUT_',
    },
    responsive: true,
    processing: true,
    ajax: BASE_URL+'api/user/show/'+auth.token,
    columns: [
      {"data": 'id_karyawan'},
      {"data": 'nama_user'},
      {"data": 'password'},
      {"data": 'level'},
      {"data": null, 'render': function(data, type, row){
          return moment(row.tgl_registrasi, 'YYYY-MM-DD hh:mm:ss').format('LLL')
        }
      },
      {"data": 'status'},
      {"data": null, 'render': function(data, type, row){
          return `<div class="btn-group" role="group"><button type="button" class="btn btn-success" id="edit_user" data-id="${row.id_karyawan}"><i class="la la-edit"></i></button> <button type="button" class="btn btn-danger" id="delete_user" data-id="${row.id_karyawan}"><i class="la la-close"></i></button></div>`
        }
      },
    ],
    order: [[4, 'desc']]
  });
  <!-- End Load Data to table -->

  <!-- Show Form Add -->
  $('#add_user').on('click', function(){
    $('#modal_add').modal('show');
    $('#form_add')[0].reset();
  });
  <!-- End Show Form Add -->

  <!-- Submit Add -->
  $('#form_add').on('submit', function(e){
    e.preventDefault();

    var id_karyawan = $('#add_karyawan').val();
    var nama_user = $('#add_nama_user').val();
    var level = $('#add_level').val();

    if(id_karyawan === '' || nama_user === '' || level === ''){
      makeNotif('error', 'Please enter the value', 'bottomRight');
    } else {
      $.ajax({
        url: BASE_URL+`api/user/add/`+auth.token,
        type: 'POST',
        dataType: 'JSON',
        data: $(this).serialize(),
        beforeSend: function(){
          $('#submit_add').addClass('disabled').html('<i class="la la-spinner animated infinite rotateIn"></i>');
        },
        success: function(response){
          if(response.status === 200){
            t_user.ajax.reload();
            makeNotif('success', response.message, 'bottomRight');
            $('#modal_add').modal('hide');
          } else {
            makeNotif('error', response.message, 'bottomRight');
          }

          $('#submit_add').removeClass('disabled').html('Save');
        },
        error: function(){
          makeNotif('error', 'Tidak dapat mengakses server', 'bottomRight');
          $('#submit_add').removeClass('disabled').html('Save');
        }
      })
    }
  });
  <!-- End Submit Add -->

  <!-- Submit Edit -->
  $('#form_edit').on('submit', function(e){
    e.preventDefault();

    var id_karyawan = $('#edit_karyawan').val();
    var nama_user = $('#edit_nama_user').val();
    var level     = $('#edit_level').val();
    var status    = $('#edit_status').val();

    if(id_karyawan === '' || nama_user === '' || level === '' || status === ''){
      makeNotif('error', 'Please enter the value', 'bottomRight');
    } else {
      $.ajax({
        url: BASE_URL+`api/user/edit/${auth.token}?id_karyawan=${id_karyawan}`,
        type: 'POST',
        dataType: 'JSON',
        data: $(this).serialize(),
        beforeSend: function(){
          $('#submit_edit').addClass('disabled').html('<i class="la la-spinner animated infinite rotateIn"></i>');
        },
        success: function(response){
          if(response.status === 200){
            t_user.ajax.reload();
            makeNotif('success', response.message, 'bottomRight');
            $('#modal_edit').modal('hide');
          } else {
            makeNotif('error', response.message, 'bottomRight');
          }

          $('#submit_edit').removeClass('disabled').html('Save Changes');
        },
        error: function(){
          makeNotif('error', 'Tidak dapat mengakses server', 'bottomRight');
          $('#submit_edit').removeClass('disabled').html('Save Changes');
        }
      })
    }
  });
  <!-- End Submit Edit -->

  <!-- Delete User -->
  $(document).on('click', '#delete_user', function(){
    var id_karyawan = $(this).attr('data-id');

    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: BASE_URL+`api/user/delete/${auth.token}?id_karyawan=${id_karyawan}`,
          type: 'GET',
          dataType: 'JSON',
          success: function(response){
            if(response.status === 200){
              t_user.ajax.reload();
              makeNotif('success', response.message, 'bottomRight');
            } else {
              makeNotif('error', response.message, 'bottomRight');
            }
          },
          error: function(){
            makeNotif('error', 'Tidak dapat mengakses server', 'bottomRight');
          }
        })
      }
    })
  });
  <!-- End Delete User -->

  <!-- Edit User -->
  $(document).on('click', '#edit_user', function(){
    var id_karyawan = $(this).attr('data-id');

    $.ajax({
      url: BASE_URL+`api/user/show/${auth.token}?id_karyawan=${id_karyawan}`,
      type: 'GET',
      dataType: 'JSON',
      success: function(response){
        $.each(response.data, function(k,v){
          $('#edit_karyawan').val(v.id_karyawan);
          $('#edit_nama_user').val(v.nama_user);
          $('#edit_status').val(v.status);
          $('#edit_level').val(v.level);
        });

        $('#modal_edit').modal('show');
      },
      error: function(){
        makeNotif('error', 'Tidak dapat mengakses server', 'bottomRight');
      }
    })
  });
  <!-- End Edit User -->

  Pusher.logToConsole = true;

  var pusher = new Pusher('4e09d24d839d5e63c48b', {
    cluster: 'ap1',
    forceTLS: true
  });

  var channel = pusher.subscribe('lion');
  channel.bind('user', function(data) {
    t_user.ajax.reload();
  });

});
