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


<script type="text/javascript">
  $(document).ready(function(){
    var t_log = $('#t_log').DataTable({
      columnDefs: [{
        targets: [0, 1, 2, 3, 4],
        searchable: true
      }],
      autoWidth: false,
      responsive: true,
      processing: true,
      ajax: '<?= base_url('api/log/show/'); ?>'+auth.token,
      columns: [
        {"data": null, 'render': function(data, type, row){
            return moment(row.tgl_log, 'YYYY-MM-DD hh:mm:ss').format('LLL')
          }
        },
        {"data": 'nip'},
        {"data": 'nama_user'},
        {"data": 'keterangan'},
        {"data": 'kategori'}
      ],
      order: [[0, 'asc']]
    });
  });
</script>
