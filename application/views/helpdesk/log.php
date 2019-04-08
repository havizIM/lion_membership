<div class="row">
    <div class="page-header">
      <div class="d-flex align-items-center">
          <h2 class="page-header-title">Log User</h2>
          <div>

          </div>
      </div>
    </div>
</div>

<div class="row">
  <div class="table-responsive">
    <table class="table" id="t_log">
      <thead>
        <tr>
          <th>Tanggal</th>
          <th>NIP</th>
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
