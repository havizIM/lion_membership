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
	.widget-options .dropdown-menu button:hover, .widget-options .dropdown-menu button:hover i {
		background: transparent;
   		color: #fff;
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
          <h2 class="page-header-title">Rute</h2>
          <div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item active"><a href="#/dashboard"><i class="la la-home"></i></a> - <a href="#/dashboard">Dashboard</a> - Rute </li>
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
            <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle">
                <i class="la la-ellipsis-h"></i>
            </button>
            <div class="dropdown-menu">
                <button type="button" class="dropdown-item edit" id="btn_add"> 
                    <i class="ion-plus-round"></i>Add Rute
                </button>
            </div>
        </div>
    </div>
</div>
<div class="row row-flex">
  <div class="col-md-12">
    <div class="widget has-shadow">
        <div class="widget-body">
         <div class="table-responsive">
            <table class="table" id="t_rute">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Rute</th>
                  <th class="text-center" style="width: 5%;">Action</th>
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

                              
                                   

<!-- MODAL ADD-->
<!-- Begin Centered Modal -->
        <div id="modal_add" class="modal fade">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Rute</h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                            <span class="sr-only">close</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    	<form id="form_add">
		                        <div class="form-group">
		                          <div>
		                              <div class="input-group">
		                                  <input type="text" class="form-control pass" placeholder="Silahkan Masukkan ID Rute" id="id_rute" name="id_rute">
		                                  <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-lock"></i></span>
		                              </div><!-- input-group -->
		                          </div>
		                      	</div>
		                      	<div class="form-group">
		                          	<div>
		                              <div class="input-group">
		                                  <input type="text" class="form-control pass" placeholder="Nama Rute" id="nama_rute" name="nama_rute">
		                                  <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-lock"></i></span>
		                      		  </div><!-- input-group -->
		                          	</div>
		                    	</div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                <button type="submit" id="submit_password" class="btn btn-gradient-03 waves-effect waves-light" id="submit_add">Save</button>
                            </div>
                      	</form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Centered Modal -->
<!-- MODAL ADD END-->

<!-- MODAL EDIT-->
<!-- Begin Centered Modal -->
        <div id="modal_edit" class="modal fade">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Rute</h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                            <span class="sr-only">close</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    	<form id="form_edit">
		                        <div class="form-group">
		                          <div>
		                              <div class="input-group">
		                                  <input type="text" class="form-control pass" id="edit_id_rute" name="id_rute">
		                                  <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-lock"></i></span>
		                              </div><!-- input-group -->
		                          </div>
		                      	</div>
		                      	<div class="form-group">
		                          	<div>
		                              <div class="input-group">
		                                  <input type="text" class="form-control pass" id="edit_nama_rute" name="nama_rute">
		                                  <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-lock"></i></span>
		                      		  </div><!-- input-group -->
		                          	</div>
		                    	</div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-gradient-03 waves-effect waves-light" id="submit_edit">Save Change</button>
                            </div>
                      	</form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Centered Modal -->
<!-- MODAL EDIT END-->
<script>
	

	$(document).ready(function(){

	var link_get = '<?= base_url('api/rute/show/'); ?>'+auth.token
		// alert(id_rute)
    var t_rute = $('#t_rute').DataTable({
      columnDefs: [{
        targets: [0],
        searchable: true
      }],
      autoWidth: false,
      responsive: true,
      processing: true,
      ajax: link_get,
      columns: [
        {"data": 'id_rute'},
        {"data": 'nama_rute'},
        {"data": null, 'render': function(data, type, row){
            return `<div class="btn-group" role="group" aria-label="Buttons Group">
			            <button type="button" class="btn btn-info btn-shadow-2 mb-2 m-pencil" id="btn_edit" data-id="${row.id_rute}"><i class="ti ti-pencil-alt"></i><span class="pencil">Edit</span></button>
			            <button type="button" class="btn btn-danger btn-shadow-2 mb-2 m-closed" id="btn_delete" data-id="${row.id_rute}" style="width: 100px;"><span class="closed">Delete</span><i class="ti ti-close"></i></button>
			        </div>`
          }
        },
      ],
      order: [[0, 'asc']]
    });

/*ADD RUTE*/
   $('#btn_add').on('click', function(){
   		$('#modal_add').modal('show')
   })

   $('#form_add').on('submit', function(e){
   		e.preventDefault();

   		var id_rute = $('#id_rute').val();
   		var nama_rute = $('#nama_rute').val();

   		if (id_rute === '' || nama_rute === '') {
   			makeNotif('error', 'Silahkan isi form dengan lengkap', 'bottomRight')
   		} else {
   			$.ajax({
   					url: '<?=base_url().'api/rute/add/' ?>'+auth.token,
   					type: 'POST',
   					dataType: 'JSON',
   					data: $(this).serialize(),
   			
   					beforeSend: function(){
   						$('#submit_add').addClass('disabled').html('<i class="la la-spinner animated infinite rotateIn"></i>');
   					},
   			
   					success: function(response){
   						if (response.status === 200) {
   							t_rute.ajax.reload();
   							makeNotif('success', response.message, 'bottomRight');
   							$('#form_add')[0].reset();
   						} else {
   							makeNotif('error', response.message, 'bottomRight')
   						}
   						$('#submit_add').removeClass('disabled').html('Save');
   						$('#modal_add').modal('hide');
   					},
   			
   					error: function(){
   							makeNotif('error', 'Tidak dapat mengakses server', 'bottomRight')
   					},
   				});
   		}
   });
/*ADD RUTE END*/


/*EDIT RUTE*/
	$(document).on('click', '#btn_edit', function(){
		// var id_jadwal = location.hash.substr(14);
		var id_rute = $(this).attr('data-id');
		var link_get = `<?= base_url('api/rute/show/') ?>${auth.token}?id_rute=${id_rute}`


      $.ajax({
        url: link_get,
        type: 'GET',
        dataType: 'JSON',
        success: function(response){
          $.each(response.data, function(k,v){
            $('#edit_id_rute').val(v.id_rute);
            $('#edit_nama_rute').val(v.nama_rute);
          });

          $('#modal_edit').modal('show');
        },
        error: function(){
          makeNotif('error', 'Tidak dapat mengakses server', 'bottomRight');
        }
      })
	});

	$('#form_edit').on('submit', function(e){
		e.preventDefault();

		var id_rute = $('#edit_id_rute').val();
		var nama_rute = $('#edit_nama_rute').val();
		var link_post = `<?=base_url().'api/rute/edit/' ?>${auth.token}?id_rute=${id_rute}`

		if (id_rute === '' || nama_rute === '') {
			makeNotif('error', 'Silahkan isi form dengan lengkap', 'bottomRight')
		} else {
			$.ajax({
					url: link_post,
					type: 'POST',
					dataType: 'JSON',
					data: $(this).serialize(),
			
					beforeSend: function(){
						$('#submit_edit').addClass('disabled').html('<i class="la la-spinner animated infinite rotateIn"></i>')
					},
			
					success: function(response){
						if (response.status === 200) {
   							t_rute.ajax.reload();
   							makeNotif('success', response.message, 'bottomRight');
   							$('#form_edit')[0].reset();
   						} else {
   							makeNotif('error', response.message, 'bottomRight')
   						}
   						$('#submit_edit').removeClass('disabled').html('Edit');
   						$('#modal_edit').modal('hide');
					},
			
					error: function(){
						makeNotif('error', 'Tidak dapat mengakses server', 'bottomRight');
					},
				});
		}

	});

/*DELETE RUTE*/
   $(document).on('click', '#btn_delete', function(){
      var id_rute = $(this).attr('data-id');
      var link_get = `<?= base_url('api/rute/delete/') ?>${auth.token}?id_rute=${id_rute}`;
  
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
              				 	t_rute.ajax.reload()
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

/*END DELETE RUTE*/

	//WIDGET OPTION HOVER
   $('.widget-options > .dropdown, .actions > .dropdown, .quick-actions > .dropdown').hover(function () {
		$(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(350);
	}, function () {
		$(this).find('.dropdown-menu').stop(true, true).delay(100).fadeOut(350);
	});
   //WIDGET OPTION HOVER END

  }); /*PENEUTUP MASAK*/


</script>
