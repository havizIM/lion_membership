
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
         <form class="form_horizontal" id="form_add">
            <div class="form-group row mb-5">
                <label class="col-lg-3 form-control-label">Departure</label>
                <div class="col-lg-9 select mb-3">
                  <select id="departure" name="departure" class="form-control" data-live-search="true"></select>
                </div>
            </div>
            <div class="form-group row mb-5">
                <label class="col-lg-3 form-control-label">Arrival</label>
                <div class="col-lg-9 select mb-3">
                    <select id="arrival" name="arrival" class="form-control" data-live-search="true">

                    </select>
                </div>
            </div>
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-3 form-control-label">Claim Point</label>
                <div class="col-lg-9">
                    <input id="claim_poin" name="claim_poin" type="number" class="form-control">
                </div>
            </div>
            <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-3 form-control-label">Reedem Point</label>
                <div class="col-lg-9">
                    <input id="reedem_poin" name="reedem_poin" type="number" class="form-control">
                </div>
            </div>
            <ul class="pager wizard text-right">
                <li class="previous d-inline-block disabled">
                    <a href="#/point" class="btn btn-secondary ripple">Cancel</a>
                </li>
                <li class="next d-inline-block">
                    <button type="submit" class="btn btn-info" id="submit_add">Save</a>
                </li>
            </ul>
        </form>
        </div>
     </div>
  </div>
</div>

<script>
  $(document).ready(function(){

    $('#departure').selectpicker();
    $('#arrival').selectpicker();

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

          $('#departure').html(departure).selectpicker('refresh');
          $('#arrival').html(arrival).selectpicker('refresh');
        },

        error: function(){
          makeNotif('error', 'Tidak dapat mengakses server', 'bottomRight')
        },
      });

//FORM ADD
        $('#form_add').on('submit', function(e){
          e.preventDefault();

          var link_post = `<?=base_url().'api/poin/add/' ?>${auth.token}`

          var departure = $('#departure').val();
          var arrival = $('#arrival').val();
          var claim_poin = $('#claim_poin').val();
          var reedem_poin = $('#reedem_poin').val();

          if (departure === '' || arrival === '' || claim_poin === '' || reedem_poin === '') {
            makeNotif('error', 'Silahkan isi form dengan lengkap', 'bottomRight')
          } else {
            $.ajax({
                url: link_post,
                type: 'POST',
                dataType: 'JSON',
                data: $(this).serialize(),

                beforeSend: function(){
                  $('#submit_add').addClass('disabled').html('<i class="la la-spinner animated infinite rotateIn"></i>');
                },

                success: function(response){
                  if (response.status === 200) {
                    makeNotif('success', response.message, 'bottomRight');
                    location.hash = '#/point'
                  } else {
                    makeNotif('error', response.message, 'bottomRight')
                    $('#submit_add').removeClass('disabled').html('Save');
                  }

                },

                error: function(){
                    makeNotif('error', 'Tidak dapat mengakses server', 'bottomRight')
                    $('#submit_add').removeClass('disabled').html('Save');
                },
              });
          }

        });
//FORM ADD END


  });

</script>
