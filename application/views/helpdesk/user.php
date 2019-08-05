<div class="row">
    <div class="page-header">
      <div class="d-flex align-items-center">
          <h2 class="page-header-title">Data User</h2>
          <div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item active"><a href="#/dashboard"><i class="la la-home"></i></a> - <a href="#/dashboard">Dashboard</a> - User </li>
            </ul>
          </div>
      </div>
    </div>
</div>
<!-- Begin Widget Header -->
<div class="widget-header bordered d-flex align-items-center">
    <h2>Data Rute</h2>
    <div class="widget-options">
        <div class="dropdown">
            <div class="my-fancy-container">
              <button type="button" class="dropdown-toggle" id="add_user">
              <span class='la la-plus-circle fz'></span>
              <span class="my-text">Add</span>
              </button>
          </div>
        </div>
    </div>
</div>

<div class="row flex-row">
  <div class="col-md-12">
    <div class="widget has-shadow">
        <div class="widget-body">
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
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
    </div>
  </div>
</div>

<div class="row">
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
                  <input type="text" name="id_karyawan" id="id_karyawan" class="form-control">
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
                  <input type="hidden" name="id_karyawan" id="edit_karyawan">
                  <button type="button" class="btn btn-shadow" data-dismiss="modal">Close</button>
                  <button type="submit" id="submit_edit" class="btn btn-primary">Save Changes</button>
              </div>
            </form>
          </div>
      </div>
  </div>
</div>
<script type="text/javascript">
  var BASE_URL = '<?= base_url() ?>';
</script>
<script src="<?=base_url('public/helpdesk/user.js') ?>">

</script>
<script type="text/javascript">

</script>
