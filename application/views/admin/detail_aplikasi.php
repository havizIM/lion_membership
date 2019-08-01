<style>

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
      <div class="d-flex align-items-center">
          <h2 class="page-header-title">Detail Aplikasi</h2>
          <div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item active"><a href="#/dashboard"><i class="la la-home"></i></a> - <a href="#/application">Aplikasi</a> - Detail Aplikasi </li>
            </ul>
          </div>
      </div>
    </div>
</div>

<div class="row flex-row about" id="content_app">
    
    <!-- Begin Column -->
    <div class="col-xl-7 column">


    </div>

</div>

<div id="modal_terima" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Pembuatan Member</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">close</span>
                </button>
            </div>
            <form id="form_confirm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">No Aplikasi</label>
                        <input type="text" readonly class="form-control" id="no_aplikasi" name="no_aplikasi">
                    </div>
                    <div class="form-group">
                        <label for="">No Member</label>
                        <input type="number" class="form-control" id="no_member" name="no_member">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-shadow" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="submit">Terima</button>
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
                                   <span class="m-r-10"><i class="la la-user"></i></span> <h4>Data Pribadi</h4>
                                </div>
                                <div class="widget-body">
                                    <div class="about-infos d-flex flex-column">
                                        <div class="about-title">Nama:</div>
                                        <div class="about-text">
                                            ${data.gender} ${data.nama}
                                        </div>
                                    </div>
                                    <div class="about-infos d-flex flex-column">
                                        <div class="about-title">No Identitas:</div>
                                        <div class="about-text">${data.no_identitas}</div>
                                    </div>
                                    <div class="about-infos d-flex flex-column">
                                        <div class="about-title">Kebangsaan:</div>
                                        <div class="about-text">${data.kebangsaan}.</div>
                                    </div>
                                    <div class="about-infos d-flex flex-column">
                                        <div class="about-title">No Handphone:</div>
                                        <div class="about-text">${data.no_handphone}</div>
                                    </div>
                                    <div class="about-infos d-flex flex-column">
                                        <div class="about-title">Email:</div>
                                        <div class="about-text">${data.email}</div>
                                    </div>
                                    <div class="about-infos d-flex flex-column">
                                        <div class="about-title">Alamat:</div>
                                        <div class="about-text">${data.alamat}</div>
                                    </div>
                                    <div class="about-infos d-flex flex-column">
                                        <div class="about-title">Kota:</div>
                                        <div class="about-text">${data.kota}</div>
                                    </div>
                                    <div class="about-infos d-flex flex-column">
                                        <div class="about-title">Kode Pos:</div>
                                        <div class="about-text">${data.kode_pos}</div>
                                    </div>
                                </div>
                            </div>`
               
                //LAIN-LAIN
                html +=`<div class="widget has-shadow">
                             <div class="widget-header bg-primary bordered br-radius no-actions d-flex align-items-center" style="padding:1rem;">
                               <span class="m-r-10"><i class="la la-navicon"></i></span> <h4>Lain-lain</h4>
                            </div>
                            <div class="widget-body">
                                <div class="about-infos d-flex flex-column">
                                    <div class="about-title">No Aplikasi:</div>
                                    <div class="about-text">${data.no_aplikasi}</div>
                                </div>
                                    <div class="about-infos d-flex flex-column">
                                    <div class="about-title">Tamggal Pengajuan:</div>
                                    <div class="about-text">${data.tgl_pengajuan}</div>
                                </div>
                                <div class="about-infos d-flex flex-column">
                                    <div class="about-title">Alamat Surat:</div>
                                    <div class="about-text">${data.alamat_surat}</div>
                                </div>
                            </div>
                        </div>

                        <div class="widget has-shadow">
                           <div class="widget-header bg-primary bordered br-radius no-actions d-flex align-items-center" style="padding:1rem;">
                                <span class="m-r-10"><i class="la la-bell-o"></i></span>  <h4>Status</h4>
                            </div>
                            <div class="widget-body text-center">`
                                if(data.status === 'Proses'){
                                    html+= `<div class=btn-group><button type="button" class="btn btn-info btn-shadow-2 mb-2 m-pencil" data-id="${data.no_aplikasi}" id="btn_terima"><i class="ti ti-pencil-alt"></i><span class="pencil">Terima</span></button>
                                            <button type="button" class="btn btn-danger btn-shadow-2 mb-2 m-closed" id="btn_tolak" data-id="${data.no_aplikasi}" style="width: 100px;"><span class="closed">Tolak</span><i class="ti ti-close"></i></button></div>`
                                }else if(data.status === 'Terima'){
                                    html+=	`<div class="text-center badge-text badge-text-small success">${data.status} <i class="ion-checkmark"></i></div>`
                                }else{
                                    html+= `<div class="text-center badge-text badge-text-small danger">${data.status} <i class="ion-close"></i></div>`
                                }
                    html+= `</div>
                        </div>
                        
                    </div>`;

                //PEKERJAAN
                html +=`<div class="col-xl-7 column">
                        <div class="widget has-shadow">
                            <div class="widget-header bg-primary bordered br-radius no-actions d-flex align-items-center" style="padding:1rem;">
                               <span class="m-r-10"><i class="la la-suitcase"></i></span> <h4>Pekerjaan</h4>
                            </div>
                            <div class="widget-body">
                                <div class="row">
                                    <div class="col-md-6 about-infos d-flex flex-column">
                                        <div class="about-title">Nama Perusahaan:</div>
                                        <div class="about-text">${data.nama_perusahaan}</div>
                                    </div>
                                    <div class="col-md-6 about-infos d-flex flex-column">
                                        <div class="about-title">Jabatan:</div>
                                        <div class="about-text">${data.jabatan}</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 about-infos d-flex flex-column">
                                        <div class="about-title">Bidang Usaha:</div>
                                        <div class="about-text">${data.bidang_usaha}</div>
                                    </div>
                                    <div class="col-md-6 about-infos d-flex flex-column">
                                        <div class="about-title">Email Perusahaan:</div>
                                        <div class="about-text">${data.email_perusahaan}</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 about-infos d-flex flex-column">
                                        <div class="about-title">Telepon:</div>
                                        <div class="about-text">${data.no_tlp}</div>
                                    </div>
                                    <div class="col-md-6 about-infos d-flex flex-column">
                                        <div class="about-title">Fax:</div>
                                        <div class="about-text">${data.no_fax}</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 about-infos d-flex flex-column">
                                        <div class="about-title">Alamat Perusahaan:</div>
                                        <div class="about-text">${data.alamat_perusahaan}</div>
                                    </div>
                                    <div class="col-md-6 about-infos d-flex flex-column">
                                        <div class="about-title">Kota:</div>
                                        <div class="about-text">${data.kota}</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 about-infos d-flex flex-column">
                                        <div class="about-title">Kode Pos:</div>
                                        <div class="about-text">${data.kode_pos}</div>
                                    </div>
                                </div>
                            </div>
                        </div>`

                //LAMPIRAN
                html +=`<div class="widget has-shadow">
                    <div class="widget-header bg-primary bordered br-radius no-actions d-flex align-items-center" style="padding:1rem;">
                        <span class="m-r-10"><i class="la la-copy"></i></span>  <h4>Lampiran</h4>
                    </div>
                    <div class="widget-body">
                        <div class="row">
                            <div class="col-md-12 about-infos d-flex flex-column">
                                <embed src="<?= base_url() ?>doc/lampiran_daftar/${data.lampiran_daftar}" style="width: 100%; height: 500px;">
                            </div>
                        </div>
                    </div>
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

        var NO_APLIKASI = location.hash.substr(11);

        var getData = function(){
            // alert(NO_APLIKASI)
            $.ajax({
                url: `<?= base_url('api/aplikasi/show/'); ?>${auth.token}?no_aplikasi=${NO_APLIKASI}`,
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
                    location.hash = '#/application'
                }
            }) 
        }

        var actionTolak = function(){
             //TOLAK APLIKASI
	    $(document).on('click', '#btn_tolak', function(){
            var no_aplikasi = $(this).attr('data-id');
            var link_get = `<?= base_url('api/aplikasi/tolak_aplikasi/') ?>${auth.token}?no_aplikasi=${no_aplikasi}`;
  
              Swal.fire({
                title: 'Konfirmasi Tolak Aplikasi',
                text: "Aplikasi akan ditolak secara permanent",
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
              				 	getData()
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
        };

        var actionTerima = function(){
            $(document).on('click', '#btn_terima', function(){
				var no_aplikasi = $(this).attr('data-id');

                $('#no_aplikasi').val(no_aplikasi);
                $('#modal_terima').modal('show');
			});
        }

        var submitForm = function(){
            $('#form_confirm').on('submit', function(e){
                e.preventDefault();

                var no_aplikasi = $('#no_aplikasi').val();
                var no_member   = $('#no_member').val();

                if(no_aplikasi === '' || no_member === ''){
                    makeNotif('error', 'Silahkan isi no member', 'bottomRight');
                } else {
                    $.ajax({
                        url: `<?= base_url('api/aplikasi/terima_aplikasi/') ?>${auth.token}?no_aplikasi=${no_aplikasi}`,
                        type: 'POST',
                        data: $(this).serialize(),
                        dataType: 'JSON',
                        beforeSend: function(){
                            $('#submit').html('<i class="la la-spinner animated infinite rotateIn"></i>')
                        },
                        success: function(response){
                            $('#submit').html('Terima')
                            if (response.status === 200) {
                                getData()
                                $('#modal_terima').modal('hide');
                                makeNotif('success', response.message, 'bottomRight');
                            } else {
                                makeNotif('error', response.message, 'bottomRight');
                            }	
                        },
                
                        error: function(){
                            $('#submit').html('Terima')
                            makeNotif('error', 'Tidak dapat mengakses server', 'bottomRight');
                        },
                    });
                }
                       
            })
        }

        return {
            init : function(){
                getData();
                actionTolak();
                actionTerima();
                submitForm();
            }
        }

    })(renderUI)

    $(document).ready(function(){
        loadData.init();
        
    })

</script>