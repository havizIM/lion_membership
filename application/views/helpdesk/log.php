<div class="row">
    <div class="page-header">
      <div class="d-flex align-items-center">
          <h2 class="page-header-title">Log User</h2>
          <div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#/dashboard"><i class="ti ti-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item active">Log</li>
            </ul>
          </div>
      </div>
    </div>
</div>

<div class="row flex-row">
  <div class="col-md-12">
    <div class="widget has-shadow">
        <div class="widget-header bordered no-actions d-flex align-items-center">
            <h4>Data Log</h4>
        </div>
        <div class="widget-body">
          <div class="table-responsive">
            <table class="table" id="t_log">
              <thead>
                <tr>
                  <th>Tanggal</th>
                  <th>ID</th>
                  <th>Nama User</th>
                  <th>Keterangan</th>
                  <th>Kategori</th>
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
<script>
  var BASE_URL = '<?= base_url() ?>';
</script>
<script src="<?= base_url().'public/helpdesk/log.js' ?>"></script>
