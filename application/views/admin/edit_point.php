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

<div class="widget-header bordered d-flex align-items-center">
    <h2>Add Point</h2>
    <div class="widget-options">

    </div>
</div>
<div class="row row-flex">
  <div class="col-md-12">
    <div class="widget has-shadow">
        <div class="widget-body">
         <form class=" " id="form_edit">
            <div class="form-group row mb-5">
                <label class="col-lg-3 form-control-label">Departure</label>
                <div class="col-lg-9 select mb-3">
                    <select id="edit_departure" name="departure" class=" form-control">

                    </select>
                </div>
            </div>
            <div class="form-group row mb-5">
                <label class="col-lg-3 form-control-label">Arrival</label>
                <div class="col-lg-9 select mb-3">
                    <select id="edit_arrival" name="arrival" class="custom-select form-control">

                    </select>
                </div>
            </div>
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-3 form-control-label">Claim Point</label>
                <div class="col-lg-9">
                    <input id="edit_claim_poin" name="claim_poin" type="number" class="form-control">
                </div>
            </div>
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-3 form-control-label">Redeem Point</label>
                <div class="col-lg-9">
                    <input id="edit_redeem_poin" name="redeem_poin" type="number" class="form-control">
                </div>
            </div>
            <ul class="pager wizard text-right">
                <li class="previous d-inline-block disabled">
                    <a href="#/point" class="btn btn-secondary ripple">Cancel</a>
                </li>
                <li class="next d-inline-block">
                    <button type="submit" class="btn btn-info" id="submit_edit">Save</a>
                </li>
            </ul>
        </form>
        </div>
     </div>
  </div>
</div>
<script>
 $(document).ready(function(){

   var id_poin = location.hash.substr(13);
   var link_get =  `<?=base_url().'api/poin/show/' ?>${auth.token}?id_poin=${id_poin}`;
   var link_post =  `<?=base_url().'api/poin/edit/' ?>${auth.token}?id_poin=${id_poin}`;

   $('#edit_departure').selectpicker();
   $('#edit_arrival').selectpicker();

   $.ajax({
       url: `<?= base_url().'api/rute/show/' ?>${auth.token}`,
       type: 'GET',
       dataType: 'JSON',
       success: function(response){
         var departure = '<option value="">-- Pilih Departure --</option>';
         var arrival = '<option value="">-- Pilih Arrival --</option>';

         $.each (response.data, function(k, v){
           departure += `<option value="${v.id_rute}">${v.nama_rute}</option>`;
           arrival += `<option value="${v.id_rute}">${v.nama_rute}</option>`;
         });

         $('#edit_departure').html(departure).selectpicker('refresh');
         $('#edit_arrival').html(arrival).selectpicker('refresh');

         $.ajax({
             url: link_get,
             type: 'GET',
             dataType: 'JSON',
             success: function(response){
               $.each (response.data, function(k, v){
                   $('#edit_departure').selectpicker('val', v.departure);
                   $('#edit_arrival').selectpicker('val', v.arrival);
                   $('#edit_claim_poin').val(v.claim_poin);
                   $('#edit_reedem_poin').val(v.reedem_poin);
               });
             },

             error: function(){
               makeNotif('error', 'Tidak dapat mengakses server', 'bottomRight')
             },
           });
       },

       error: function(){
         makeNotif('error', 'Tidak dapat mengakses server', 'bottomRight')
       },
     });

//FORM EDIT

        $('#form_edit').on('submit', function(e){
          e.preventDefault();

          var departure = $('#edit_departure').val();
          var arrival = $('#edit_arrival').val();
          var claim_poin = $('#edit_claim_poin').val();
          var reedem_poin = $('#edit_reedem_poin').val();

         if (departure === '' || arrival === '' || claim_poin === '' || reedem_poin === '') {
           makeNotif('error', 'Form harus diisi dengan lengkap', 'bottomRight');
         } else {
            $.ajax({
                url: link_post,
                type: 'POST',
                dataType: 'JSON',
                data: $(this).serialize(),

                beforeSend: function(){
                  $('#submit_edit').addClass('disabled').html('<i class="la la-spinner animated infinite rotateIn"></i>');
                },

                success: function(response){
                  if (response.status === 200) {
                      makeNotif('success', response.message, 'bottomRight');
                      location.hash = '#/point'
                    } else {
                      makeNotif('error', response.message, 'bottomRight');
                      $('#submit_edit').removeClass('disabled').removeAttr('disabled').text('Save');
                    }
                },

                error: function(){
                  makeNotif('error', 'Tidak dapat mengakses server', 'bottomRight')
                 $('#submit_edit').removeClass('disabled').removeAttr('disabled').text('Save');
                },
              });
         }

      });




//FORM EDIT END
 });
</script>
