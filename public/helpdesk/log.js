console.log("log is running");
$(document).ready(function() {
  var t_log = $("#t_log").DataTable({
    columnDefs: [
      {
        targets: [0, 1, 2, 3, 4],
        searchable: true
      }
    ],
    autoWidth: false,
    responsive: true,
    processing: true,
    ajax: BASE_URL + "api/log/show/" + auth.token,
    columns: [
      {
        data: null,
        render: function(data, type, row) {
          return moment(row.tgl_log, "YYYY-MM-DD hh:mm:ss").format("LLL");
        }
      },
      { data: "id_karyawan" },
      { data: "nama_user" },
      { data: "keterangan" },
      { data: "kategori" }
    ],
    order: [[0, "asc"]]
  });

  Pusher.logToConsole = true;

  var pusher = new Pusher("4e09d24d839d5e63c48b", {
    cluster: "ap1",
    forceTLS: true
  });

  var channel = pusher.subscribe("lion");
  channel.bind("log", function(data) {
    t_log.ajax.reload();
  });
});
