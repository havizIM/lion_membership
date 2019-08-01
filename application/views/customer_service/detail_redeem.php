<style>
.widget-body.pd {
    padding: 2.2em;
}

.h-50 {
 height: 50px !important;
}

.hc-darknavy{
    background-color:#2c304d;
}

.hc-darknavy h4 {
    color: #fff !important;
}

.bg-primary h4 {
    color: #fff !important;
}

.bordered.br-radius{
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

.m-r-10 {
    margin-right:10px;
}

.m-r-10 i {
    font-size:25px;
}
</style>
<div class="row">
    <div class="page-header">
      <div class="d-flex align-items-center" style="padding:1rem;">
          <h2 class="page-header-title">Detail Redeem</h2>
          <div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item active"><a href="#/dashboard"><i class="la la-home"></i></a> - <a href="#/redeem">Redeem</a> - Detail Redeem </li>
            </ul>
          </div>
      </div>
    </div>
</div>

<div class="row flex-row about" id="content_app">

    
</div>

<div id="modal_tolak" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Penolakan Pengajuan Redeem</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">close</span>
                </button>
            </div>
            <form id="form_tolak">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">ID Redeem</label>
                        <input type="text" readonly class="form-control" id="id_redeem" name="id_redeem">
                    </div>
                    <div class="form-group">
                        <label for="">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-shadow" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Row -->
<script>
 var renderUI = (function(){
        
        return {
            renderProfile: function(data){
                var html = '';
                
                //DATA PRIBADI
                html += `<div class="col-xl-5">
                            <div class="widget has-shadow">
                                <div class="widget-header bg-primary bordered br-radius no-actions d-flex align-items-center" style="padding:1rem;">
                                   <span class="m-r-10"><i class="la la-user"></i></span> <h4>Data Member</h4>
                                </div>
                                <div class="widget-body">
                                    <div class="about-infos d-flex flex-column">
                                        <div class="about-title">No Member:</div>
                                        <div class="about-text">${data.member.no_member}</div>
                                    </div>
                                    <div class="about-infos d-flex flex-column">
                                        <div class="about-title">Nama:</div>
                                        <div class="about-text">
                                            ${data.member.gender} ${data.member.nama}
                                        </div>
                                    </div>
                                    <div class="about-infos d-flex flex-column">
                                        <div class="about-title">Tanggal Redeem:</div>
                                        <div class="about-text">${data.tgl_redeem}</div>
                                    </div>
                                </div>
                            </div>`
                            
                //LAIN-LAIN
                html +=`<div class="widget has-shadow">
                            <div class="widget-header bg-primary bordered br-radius no-actions d-flex align-items-center" style="padding:1rem;">
                               <span class="m-r-10"><i class="la la-navicon"></i></span> <h4>Status</h4>
                            </div>
                            <div class="widget-body">
                                    <div class="about-infos d-flex flex-column">
                                        <div class="about-title">Status:</div>
                                        <div class="about-text">`
                                        if (data.status_redeem === "Proses") {
                                            html+=` <div class="about-text badge-text badge-text-small info">${data.status_redeem}</div>`
                                        } else if (data.status_redeem === "Valid"){
                                            html+=` <div class="about-text badge-text badge-text-small success">${data.status_redeem}</div>`
                                        } else {
                                            html+=` <div class="about-text badge-text badge-text-small danger">${data.status_redeem}</div>`
                                        }
                            html+=`</div>
                                    </div>
                                    <div class="about-infos d-flex flex-column">
                                        <div class="about-title">Keterangan:</div>
                                        <div class="about-text">${data.keterangan !== '' ? data.keterangan : '-'}</div>
                                    </div>
                            </div>
                        </div>

                       
                        
                    </div>`;

                //PEKERJAAN
                html +=`<div class="col-xl-7 column">`

                        if(data.status_redeem === 'Proses'){
                        html +=`
                                <div class="widget has-shadow" style="max-height: 150px;">
                                    <div class="widget-header bg-primary bordered br-radius no-actions d-flex align-items-center" style="padding:1rem;">
                                      <span class="m-r-10"><i class="la la-pencil-square"></i></span>  <h4>Aksi</h4>
                                    </div>
                                    <div class="widget-body text-center">
                                        <div class="btn-group" style="width: 100%">
                                            <button type="button" class="btn btn-gradient-03 mr-1 mb-2 btn-lg h-50" id="btn_approve" data-id="${data.id_redeem}" style="width: 100%"><i class="mdi mdi-check"></i>Approve Redeem</button>
                                            <button type="button" class="btn btn-gradient-05 mr-1 mb-2 btn-lg h-50" id="btn_tolak" data-id="${data.id_redeem}" style="width: 100%"><i class="mdi mdi-check"></i>Tolak Redeem</button>
                                        </div>
                                       </div>
                                </div>`
							}  
                         html+= `<div class="widget has-shadow">
                                    <div class="widget-header bg-primary bordered br-radius no-actions d-flex align-items-center">
                                      <span class="m-r-10"><i class="la la-file"></i></span>  <h4>Detail Redeem</h4>
                                    </div>
                                    <div class="widget-body no-padding">
                                        
                                        <ul class="ticket list-group w-100">`

                                        if(data.detail.length === 0){
                                            html += `
                                                <li class="list-group-item">
                                                    <h4>Tidak ada detail redeem</h4>
                                                </li>
                                            `
                                        } else {
                                            $.each(data.detail, function(k, v){
                                                html += `
                                                <li class="list-group-item">
                                                    <div class="media">
                                                        <div class="media-body align-self-center">
                                                            <div class="username">
                                                                <h4>${v.gender_pessenger}. ${v.nama_pessenger}</h4>
                                                            </div><br/>
                                                            <div class="msg">
                                                                <div class="row">
                                                                    <div class="col-md-5">
                                                                        <center>
                                                                            <h3>${v.departure}</h3>
                                                                            <p>${v.nama_departure}</p>
                                                                        </center>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <center>
                                                                            <i style="font-size: 50px" class="la la-arrow-right"></i>
                                                                        </center>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <center>
                                                                            <h3>${v.arrival}</h3>
                                                                            <p>${v.nama_arrival}</p>
                                                                        </center>
                                                                    </div>
                                                                </div>
                                                            </div><br/>
                                                            <div class="status text-right"><span class="open mr-2 text-info">${v.no_flight}</span>(Poin Ditukar : <span class="text-success">${v.redeem_poin}</span>)</div>
                                                        </div>
                                                    </div>
                                                </li>
                                            `
                                            })
                                        }
                                            

                        html += 
                                        `</ul>
                                    </div>
                                </div>`;

               

               


                $('#content_app').html(html);
            },
            renderNoData: function(){
                console.log('No Data');
            }
        }

    })()

    var loadData = (function(UI){

        var ID_REDEEM = location.hash.substr(9);

        var getData = function(){
            $.ajax({
                url: `<?= base_url('api/redeem/show/'); ?>${auth.token}?id_redeem=${ID_REDEEM}`,
                type: 'GET',
                dataType: 'JSON',
                success: function(response){
                    if(response.status === 200){
                        if(response.data.length !== 1){
                            UI.renderNoData();
                        } else {
                            $.each(response.data, function(k, v){
                                UI.renderProfile(v);
                            })
                        }
                    } else {
                        UI.renderNoData();
                    }
                },
                error: function(err){
                    location.hash = '#/redeem'
                }
            }) 
        }

         var approveRedeem = function(){
            $(document).on('click', '#btn_approve', function(){
                var id_redeem = $(this).attr('data-id');
  
              Swal.fire({
                title: 'Konfirmasi Approve Redeem?',
                text: "Data akan diproses menjadi status Approve",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
              }).then((result) => {
              	if (result.value) {
              		$.ajax({
              				url: `<?= base_url('api/redeem/approve/') ?>${auth.token}?id_redeem=${id_redeem}`,
              				type: 'GET',
                            dataType: 'JSON',
                            success: function(response){
                            if(response.status === 200){
                                getData()
                                swal.close();
                                makeNotif('success', response.message, 'bottomRight');
                            } else {
                                makeNotif('error', response.message, 'bottomRight');
                            }
                            },
                            error: function(err){
                                makeNotif('success', 'Tidak dapat mengakses server', 'bottomRight');
                                console.log(err);
                            }
                            });
              		}
              });
			});
        }

        var tolakRedeem = function(){
            $(document).on('click', '#btn_tolak', function(){
				var id_redeem = $(this).attr('data-id');

                $('#id_redeem').val(id_redeem);
                $('#modal_tolak').modal('show');
			});
        }
        
        var submitForm = function(){
            $('#form_tolak').on('submit', function(e){
                e.preventDefault();

                var id_redeem = $('#id_redeem').val();
                var keterangan   = $('#keterangan').val();

                if(id_redeem === '' || keterangan === ''){
                    makeNotif('error', 'Silahkan isi no member', 'bottomRight');
                } else {
                    $.ajax({
                        url: `<?= base_url('api/redeem/tolak/') ?>${auth.token}?id_redeem=${id_redeem}`,
                        type: 'POST',
                        data: $(this).serialize(),
                        dataType: 'JSON',
                        beforeSend: function(){
                            $('#submit').html('<i class="la la-spinner animated infinite rotateIn"></i>')
                        },
                        success: function(response){
                            $('#submit').html('Submit')
                            if (response.status === 200) {
                                getData()
                                $('#modal_tolak').modal('hide');
                                makeNotif('success', response.message, 'bottomRight');
                            } else {
                                makeNotif('error', response.message, 'bottomRight');
                            }	
                        },
                
                        error: function(){
                            $('#submit').html('Submit')
                            makeNotif('error', 'Tidak dapat mengakses server', 'bottomRight');
                        },
                    });
                }
                       
            })
        }
        

        return {
            init : function(){
                getData();
                approveRedeem();
                tolakRedeem();
                submitForm();
             
            }
        }

    })(renderUI)

    $(document).ready(function(){
        loadData.init();
        
    })

</script>