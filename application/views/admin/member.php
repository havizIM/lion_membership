<style>
	.m-pencil i{
		position: relative;
		right: 5px;
		bottom: 2px;
	}
	.m-closed i{
	    position: relative;
	    left: 5px;
	    bottom: 0px;
	    font-size: 0.97rem;
	    font-weight: 900;
	}
	.m-closed .closed {
		position: relative;
		right: 5px;
	}
	.btn-shadow-2 {
		box-shadow: 0px 7px 20px 1px rgba(52, 40, 104, 0.37);
		transform: 
	}

	.widget-header-2 {
		padding: .85rem 1.4rem;
	}

	.widget-options .dropdown-menu button {
		color: #2c304d;
    font-weight: 500;
	}
	.widget-options .dropdown-menu button i {
		font-size: 1.6rem;
	    vertical-align: middle;
	    color: #aea9c3;
	    margin-right: .7rem;
	    transition: all 0.4s ease;
	}
	.widget-options .dropdown-menu .dropdown-item.edit:hover, .widget-options .dropdown-menu .dropdown-item.edit:focus {
		background: #17a2b8;
	}
	.widget-options .dropdown-menu .dropdown-item.delete:hover, .widget-options .dropdown-menu .dropdown-item.delete:focus {
		background: #d0577b;
	}
	.widget-options .dropdown-menu a:hover, .widget-options .dropdown-menu a:hover i {
		background: transparent;
   		color: #fff !important;
	}
	
	.widget-options .dropdown-menu .dropdown-item {
		padding:0.3rem 1.8rem !important;
	}
	
	.widget-options .dropdown-menu {
	  padding: 0.4rem 0rem !important;
	}
</style>
<div class="row">
    <div class="page-header">
      <div class="d-flex align-items-center">
          <h2 class="page-header-title">Member</h2>
          <div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item active"><a href="#/dashboard"><i class="la la-home"></i></a> - <a href="#/dashboard">Dashboard</a> - Member </li>
            </ul>
          </div>
      </div>
    </div>
</div>
 <!-- Begin Widget Header -->
<div class="widget-header bordered d-flex align-items-center">
    <h2>Data Member</h2>
    <div class="widget-options">
        <div class="dropdown">
            <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle">
                <i class="la la-ellipsis-h"></i>
            </button>
            <div class="dropdown-menu">
                <a href="#/add_member" class="dropdown-item edit" id="btn_add"> 
                    <i class="ion-plus-round"></i>Add member
                </a>
            </div>
        </div>
    </div>
</div>
<div class="row row-flex">
  <div class="col-md-12">
    <div class="widget has-shadow">
        <div class="widget-body">
         <div class="table-responsive">
            <table class="table" id="t_member">
              <thead>
                <tr>
                  <th>No. Member</th>
                  <th>No. Aplikasi</th>
                  <th>Gender</th>
                  <th>Nama</th>
                  <th>Kebangsaan</th>
                  <th>No. Identitas</th>
                  <th>No. Handphone</th>
                  <th>Email</th>
                  <th>Alamat</th>
                  <th>Kota</th>
                  <th>Kode Pos</th>
                  <th>Nama Perusahaan</th>
                  <th>No. Telepon</th>
                  <th>No. Fax</th>
                  <th>Jabatan</th>
                  <th>Bidang Usaha</th>
                  <th>Email Perusahaan</th>
                  <th>Alamat Surat</th>
                  <th>Alamat Perusahaan</th>
                  <th>Kota Perusahaan</th>
                  <th>Kode Pos Perusahaan</th>
                  <th>Status</th>
                  <th>Status Member</th>
                  <th>Tanggal Pengajuan</th>
                  <th>Tanggal Berlaku</th>
                  <th>Tanggal Expired</th>
                  <th>Lampiran Daftar</th>
                  <th class="text-center">Action</th>
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
	$(document).ready(function(){
		var link_get = '<?= base_url('api/member/show/'); ?>'+auth.token
	    var t_member = $('#t_member').DataTable({
	      columnDefs: [{
	        targets: [0],
	        searchable: true
	      }],
	      autoWidth: false,
	      responsive: true,
	      processing: true,
	      ajax: link_get,
	      columns: [
	        {"data": 'no_member'},
	        {"data": 'no_aplikasi'},
	        {"data": 'gender'},
	        {"data": 'nama'},
	        {"data": 'kebangsaan'},
	        {"data": 'no_identitas'},
	        {"data": 'no_handphone'},
	        {"data": 'email'},
	        {"data": 'alamat'},
	        {"data": 'kota'},
	        {"data": 'kode_pos'},
	        {"data": 'nama_perusahaan'},
	        {"data": 'no_tlp'},
	        {"data": 'no_fax'},
	        {"data": 'jabatan'},
	        {"data": 'bidang_usaha'},
	        {"data": 'email_perusahaan'},
	        {"data": 'alamat_surat'},
	        {"data": 'alamat_perusahaan'},
	        {"data": 'kota_perusahaan'},
	        {"data": 'kode_pos_perusahaan'},
	        {"data": 'status'},
	        {"data": 'status_member'},
	        {"data": 'tgl_pengajuan'},
	        {"data": 'berlaku_dari'},
	        {"data": 'berlaku_sampai'},
	        {"data": null, 'render': function(data, type, row){
            return `<a class="popup" id="popup" href="<?= base_url('doc/lampiran_daftar/')?>${row.lampiran_daftar}" target="__blank"><img src="<?= base_url('doc/lampiran_daftar/') ?>${row.lampiran_daftar}" style="width: 150px; height: 100px"/></a>`
          }
        },
	      ],
	      order: [[0, 'asc']]
	    });

	    //WIDGET OPTION HOVER
       $('.widget-options > .dropdown, .actions > .dropdown, .quick-actions > .dropdown').hover(function() {
    		$(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(350);
    	}, function () {
    		$(this).find('.dropdown-menu').stop(true, true).delay(100).fadeOut(350);
    	});
		 //WIDGET OPTION HOVER END
		 
		 $(document).on('click', '#popup', function(){
			$(this).magnificPopup({
				delegate: 'a',
				type: 'image'
				// other options
			});
		 });
		 

    Pusher.logToConsole = true;

    var pusher = new Pusher('4e09d24d839d5e63c48b', {
      cluster: 'ap1',
      forceTLS: true
    });

    var channel = pusher.subscribe('lion');
    channel.bind('member', function(data) {
      t_member.ajax.reload();
    });

	});
</script>