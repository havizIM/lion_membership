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
          <h2 class="page-header-title">Claim</h2>
          <div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item active"><a href="#/dashboard"><i class="la la-home"></i></a> - <a href="#/dashboard">Dashboard</a> - Claim </li>
            </ul>
          </div>
      </div>
    </div>
</div>
 <!-- Begin Widget Header -->
<div class="widget-header bordered d-flex align-items-center">
    <h2>Data Claim</h2>
</div>
<div class="row row-flex">
  <div class="col-md-12">
    <div class="widget has-shadow">
        <div class="widget-body">
         <div class="table-responsive">
            <table class="table" id="t_claim">
              <thead>
                <tr>
                  <th>ID Claim</th>
                  <th>Kode Booking</th>
                  <th>No Member</th>
                  <th>Nama</th>
                  <th>Tanggal Claim</th>
                  <th>Status Claim</th>
                  <th>Keterangan</th>
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
		var link_get = '<?= base_url('api/claim/show/'); ?>'+auth.token
	    var t_claim = $('#t_claim').DataTable({
	      columnDefs: [{
	        targets: [0],
	        searchable: true
	      }],
	      autoWidth: false,
	      responsive: true,
	      processing: true,
	      ajax: link_get,
	      columns: [
	        {"data": null, 'render': function(data, type, row){
                return `<a href="#/claim/${row.id_claim}">${row.id_claim}</a>`;
				}
			},
	        {"data": 'kode_booking'},
	        {"data": 'member.no_member'},
	         {"data": null, 'render': function(data, type, row){
				return `${row.member.gender}. ${row.member.nama}`
				}
			},
	        {"data": 'tgl_claim'},
	        {"data": 'status_claim'},
	        {"data": 'keterangan'}
	      ],
	      order: [[0, 'asc']]
	    });

	    //WIDGET OPTION HOVER
       $('.widget-options > .dropdown, .actions > .dropdown, .quick-actions > .dropdown').hover(function () {
    		$(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(350);
    	}, function () {
    		$(this).find('.dropdown-menu').stop(true, true).delay(100).fadeOut(350);
    	});
     //WIDGET OPTION HOVER END

    Pusher.logToConsole = true;

    var pusher = new Pusher('4e09d24d839d5e63c48b', {
      cluster: 'ap1',
      forceTLS: true
    });

    var channel = pusher.subscribe('lion');
    channel.bind('claim', function(data) {
      t_claim.ajax.reload();
    });

	});
</script>