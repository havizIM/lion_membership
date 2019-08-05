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
          <h2 class="page-header-title">Point</h2>
          <div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item active"><a href="#/dashboard"><i class="la la-home"></i></a> - <a href="#/dashboard">Dashboard</a> - Point </li>
            </ul>
          </div>
      </div>
    </div>
</div>
 <!-- Begin Widget Header -->
<div class="widget-header bordered d-flex align-items-center">
    <h2>Data Point</h2>
    <div class="widget-options">
        <div class="dropdown">
            <div class="my-fancy-container">
              <a href="#/add_point" class="dropdown-toggle" id="add_user">
              <span class='la la-plus-circle fz'></span>
              <span class="my-text">Add Poin</span>
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
            <table class="table" id="t_point">
              <thead>
                <tr>
                  <th>ID Point</th>
                  <th>Departure</th>
                  <th>Departure Name</th>
                  <th>Arrival</th>
                  <th>Arrival Name</th>
                  <th>Claim Point</th>
                  <th>Redeem Point</th>
                  <th class="text-center" style="width: 15%;">Action</th>
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
		var link_get = '<?= base_url('api/poin/show/'); ?>'+auth.token
	    var t_point = $('#t_point').DataTable({
	      columnDefs: [{
	        targets: [0],
	        searchable: true
	      }],
	      autoWidth: false,
	      responsive: true,
	      processing: true,
	      ajax: link_get,
	      columns: [
	        {"data": 'id_poin'},
	        {"data": 'departure'},
	        {"data": 'departure_name'},
	        {"data": 'arrival'},
	        {"data": 'arrival_name'},
	        {"data": 'claim_poin'},
	        {"data": 'redeem_poin'},
	        {"data": null, 'render': function(data, type, row){
	            return `<a href="#/edit_point/${row.id_poin}" class="btn btn-info btn-shadow-2 mb-2 m-pencil" id="btn_edit"><i class="ti ti-pencil-alt"></i><span class="pencil">Edit</span></a><button type="button" class="btn btn-danger btn-shadow-2 mb-2 m-closed" id="btn_delete" data-id="${row.id_poin}" style="width: 100px;"><span class="closed">Delete</span><i class="ti ti-close"></i></button>`
	          }
	        },
	      ],
	      order: [[0, 'asc']]
	    });


	    //DELETE OPTION
	    $(document).on('click', '#btn_delete', function(){
      var id_poin = $(this).attr('data-id');
      var link_get = `<?= base_url('api/poin/delete/') ?>${auth.token}?id_poin=${id_poin}`;
  
              Swal.fire({
                title: 'Are you sure to Delete?',
                text: "Data will delete permanently!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
              }).then((result) => {
              	if (result.value) {
              		$.ajax({
              				url: link_get,
              				type: 'GET',
              				dataType: 'JSON',
              				success: function(response){
              				 if (response.status === 200) {
              				 	t_point.ajax.reload()
              					makeNotif('success', response.message, 'bottomRight');
              				 } else {
              				 	makeNotif('error', response.message, 'bottomRight');
              				 }	
              				},
              		
              				error: function(){
              					makeNotif('error', 'Tidak dapat mengakses server', 'bottomRight');
              				},
              			});
              		}
              });
          });

	    //DELETE OPTION


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
    channel.bind('point', function(data) {
      t_point.ajax.reload();
    });

	});
</script>