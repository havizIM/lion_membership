<div class="row">
    <div class="page-header">
      <div class="d-flex align-items-center">
          <h2 class="page-header-title">Data User</h2>
          <div>

          </div>
      </div>
    </div>
</div>

<div class="row">
  <div class="table-responsive">
    <table class="table" id="t_user">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Password</th>
          <th>Level</th>
          <th>Register Date</th>
          <th>Status</th>
          <th style="text-align: center; background-color: #5bc0de; color: #fff; cursor: pointer" id="add_user">
            <i class="la la-plus"></i>
          </th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </div>

  <div id="modal_add" class="modal fade">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <form id="form_add">
              <div class="modal-header">
                  <h4 class="modal-title">Add User</h4>
                  <button type="button" class="close" data-dismiss="modal">
                      <span aria-hidden="true">×</span>
                      <span class="sr-only">close</span>
                  </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="">ID</label>
                  <input type="text" name="nip" id="add_nip" class="form-control">
                </div>
                <div class="form-group">
                  <label for="">Name</label>
                  <input type="text" name="nama_user" id="add_nama_user" class="form-control">
                </div>
                <div class="form-group">
                  <label for="">Level</label>
                  <select class="form-control" name="level" id="add_level">
                    <option value="">-- Choose Level --</option>
                    <option value="Admin">Admin</option>
                    <option value="Customer Service">Customer Service</option>
                    <option value="Manager">Manager</option>
                  </select>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-shadow" data-dismiss="modal">Close</button>
                  <button type="submit" id="submit_add" class="btn btn-primary">Save</button>
              </div>
            </form>
          </div>
      </div>
  </div>

  <div id="modal_edit" class="modal fade">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <form id="form_edit">
              <div class="modal-header">
                  <h4 class="modal-title">Edit User</h4>
                  <button type="button" class="close" data-dismiss="modal">
                      <span aria-hidden="true">×</span>
                      <span class="sr-only">close</span>
                  </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="">Name</label>
                  <input type="text" name="nama_user" id="edit_nama_user" class="form-control">
                </div>
                <div class="form-group">
                  <label for="">Level</label>
                  <select class="form-control" name="level" id="edit_level">
                    <option value="">-- Choose Level --</option>
                    <option value="Admin">Admin</option>
                    <option value="Customer Service">Customer Service</option>
                    <option value="Manager">Manager</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="">Status</label>
                  <select class="form-control" name="status" id="edit_status">
                    <option value="">-- Choose Status --</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Nonaktif">Nonaktif</option>
                  </select>
                </div>
              </div>
              <div class="modal-footer">
                  <input type="hidden" name="nip" id="edit_nip">
                  <button type="button" class="btn btn-shadow" data-dismiss="modal">Close</button>
                  <button type="submit" id="submit_edit" class="btn btn-primary">Save Changes</button>
              </div>
            </form>
          </div>
      </div>
  </div>
</div>

<script type="text/javascript">
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
      ajax: '<?= base_url('api/user/show/'); ?>'+auth.token,
      columns: [
        {"data": 'nip'},
        {"data": 'nama_user'},
        {"data": 'password'},
        {"data": 'level'},
        {"data": null, 'render': function(data, type, row){
            return moment(row.tgl_registrasi, 'YYYY-MM-DD hh:mm:ss').format('LLL')
          }
        },
        {"data": 'status'},
        {"data": null, 'render': function(data, type, row){
            return `<div class="btn-group" role="group"><button type="button" class="btn btn-success" id="edit_user" data-id="${row.nip}"><i class="la la-edit"></i></button> <button type="button" class="btn btn-danger" id="delete_user" data-id="${row.nip}"><i class="la la-close"></i></button></div>`
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

      var nip = $('#add_nip').val();
      var nama_user = $('#add_nama_user').val();
      var level = $('#add_level').val();

      if(nip === '' || nama_user === '' || level === ''){
        makeNotif('error', 'Please enter the value', 'bottomRight');
      } else {
        $.ajax({
          url: `<?= base_url('api/user/add/') ?>`+auth.token,
          type: 'POST',
          dataType: 'JSON',
          data: $(this).serialize(),
          beforeSend: function(){
            $('#submit_add').addClass('disabled').html('<i class="la la-spinner animated infinite rotateOut"></i>');
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
          }
        })
      }
    });
    <!-- End Submit Add -->

    <!-- Submit Edit -->
    $('#form_edit').on('submit', function(e){
      e.preventDefault();

      var nip       = $('#edit_nip').val();
      var nama_user = $('#edit_nama_user').val();
      var level     = $('#edit_level').val();
      var status    = $('#edit_status').val();

      if(nip === '' || nama_user === '' || level === '' || status === ''){
        makeNotif('error', 'Please enter the value', 'bottomRight');
      } else {
        $.ajax({
          url: `<?= base_url('api/user/edit/') ?>${auth.token}?nip=${nip}`,
          type: 'POST',
          dataType: 'JSON',
          data: $(this).serialize(),
          beforeSend: function(){
            $('#submit_edit').addClass('disabled').html('<i class="la la-spinner animated infinite rotateOut"></i>');
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
          }
        })
      }
    });
    <!-- End Submit Edit -->

    <!-- Delete User -->
    $(document).on('click', '#delete_user', function(){
      var nip = $(this).attr('data-id');

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
            url: `<?= base_url('api/user/delete/') ?>${auth.token}?nip=${nip}`,
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
      var nip = $(this).attr('data-id');

      $.ajax({
        url: `<?= base_url('api/user/show/') ?>${auth.token}?nip=${nip}`,
        type: 'GET',
        dataType: 'JSON',
        success: function(response){
          $.each(response.data, function(k,v){
            $('#edit_nip').val(v.nip);
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

  });
</script>
