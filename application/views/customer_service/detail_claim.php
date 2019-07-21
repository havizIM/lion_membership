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
          <h2 class="page-header-title">Detail Claim</h2>
          <div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item active"><a href="#/dashboard"><i class="la la-home"></i></a> - <a href="#/claim">Aplikasi</a> - Detail Claim </li>
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
                                        <div class="about-title">Kode Booking:</div>
                                        <div class="about-text">${data.kode_booking}</div>
                                    </div>
                                    <div class="about-infos d-flex flex-column">
                                        <div class="about-title">No Member:</div>
                                        <div class="about-text">${data.member.no_member}.</div>
                                    </div>
                                    <div class="about-infos d-flex flex-column">
                                        <div class="about-title">Nama:</div>
                                        <div class="about-text">
                                            ${data.member.gender} ${data.member.nama}
                                        </div>
                                    </div>
                                    <div class="about-infos d-flex flex-column">
                                        <div class="about-title">Tanggal Claim:</div>
                                        <div class="about-text">${data.tgl_claim}</div>
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
                                        <div class="about-title">Status:</div>
                                        <div class="about-text">`
                                        if (data.status_claim === "Proses") {
                                            html+=` <div class="about-text badge-text badge-text-small info">${data.status_claim}</div>`
                                        } else if (data.status_claim === "Valid"){
                                            html+=` <div class="about-text badge-text badge-text-small success">${data.status_claim}</div>`
                                        } else {
                                            html+=` <div class="about-text badge-text badge-text-small danger">${data.status_claim}</div>`
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

                        if(data.status_claim === 'Proses'){
                        html +=`
                                <div class="widget has-shadow" style="max-height: 150px;">
                                    <div class="widget-header bg-primary bordered br-radius no-actions d-flex align-items-center" style="padding:1rem;">
                                      <span class="m-r-10"><i class="la la-pencil-square"></i></span>  <h4>Aksi</h4>
                                    </div>
                                    <div class="widget-body text-center">
                                        <div class="btn-group" style="width: 100%">
                                            <button type="button" class="btn btn-gradient-03 mr-1 mb-2 btn-lg h-50" id="btn_validasi" data-id="${data.id_claim}" style="width: 100%"><i class="mdi mdi-check"></i>Validasi</button>
                                            <button type="button" class="btn btn-gradient-05 mr-1 mb-2 btn-lg h-50" id="btn_tolak" data-id="${data.id_claim}" style="width: 100%"><i class="mdi mdi-check"></i>Tolak Validasi</button>
                                        </div>
                                       </div>
                                </div>`
							}  
                         html+= `<div class="widget has-shadow">
                                    <div class="widget-header bg-primary bordered br-radius no-actions d-flex align-items-center" style="padding:1rem;">
                                      <span class="m-r-10"><i class="la la-suitcase"></i></span> <h4>Pekerjaan</h4>
                                    </div>
                                    <div class="widget-body pd">
                                        <div class="row">
                                            <div class="table-responsive">
                                            <table class="table table-stripped">
                                                <thead>  
                                                    <tr>
                                                        <th>ID Detail</th>
                                                        <th>ID Claim</th>
                                                        <th>ID Poin</th>
                                                        <th>Departure</th>
                                                        <th>Arrival</th>
                                                        <th>Claim Poin</th>
                                                    </tr>
                                                </thead> 

                                                <tbody>` 
                                                    $.each(data.detail, function(k, v){
                                                        html += `
                                                        <tr>
                                                            <td>${v.id_claim_detail}</td>
                                                            <td>${v.id_claim}</td>
                                                            <td>${v.id_poin}</td>
                                                            <td>${v.departure} - ${v.nama_departure}</td>
                                                            <td>${v.arrival} - ${v.nama_arrival}</td>
                                                            <td>${v.claim_poin}</td>
                                                        </tr>
                                                        `
                                                    });
                                        html +=` </tbody>
                                            </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>`;

                //LAMPIRAN
                html +=`
                <div class="col-xl-12 column">
                    <div class="widget has-shadow">
                        <div class="widget-header bg-primary bordered br-radius no-actions d-flex align-items-center" style="padding:1rem;">
                          <span class="m-r-10"><i class="la la-copy"></i></span>  <h4>Lampiran</h4>
                        </div>
                        <div class="widget-body">`

                        $.each(data.detail, function(k, v){
                            html += `
                            <div class="row">
                                <div class="col-md-12 about-infos d-flex flex-column">
                                    <h4>${v.nama_departure}(${v.departure}) <i class="la la-arrow-right"></i> ${v.nama_arrival}(${v.arrival})</h4>
                                    <img src="<?= base_url() ?>doc/lampiran_claim/${v.lampiran_claim}" onerror="this.onerror=null;this.src='<?= base_url() ?>assets/img/error/undraw_problem_solving_ft81.svg';" style="width: 100%; height: 500px;">
                                </div>
                            </div><br />
                            `
                        });
                            
                html += `    
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

        var ID_CLAIM = location.hash.substr(8);

        var getData = function(){
            // alert(ID_CLAIM)
            $.ajax({
                url: `<?= base_url('api/claim/show/'); ?>${auth.token}?id_claim=${ID_CLAIM}`,
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
                    location.hash = '#/claim'
                }
            }) 
        }

        // var validMmeber = function(){
        //     $(document).on('click', '#btn_validasi', function(){
        //         var id_claim = $(this).attr('data-id');
        //         var link_get = `<?= base_url('api/claim/valid/') ?>${auth.token}?id_claim=${id_claim}`;
                
        //       Swal.fire({
        //         title: 'Konfirmasi Validasi Member',
        //         text: "Member akan valid secara permanent",
        //         type: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Yes',
        //       }).then((result) => {
        //       	if (result.value) {
        //             $.ajax({
        //                 url: `<?= base_url('api/claim/valid/') ?>${auth.token}?id_claim=${id_claim}`,
        //                 type: 'GET',
        //                 success: function(response){
        //                     if(response.status === 200){
        //                         getData()
        //                         swal.close();
        //                         makeNotif('success', response.description, response.message, 'bottom-left');
        //                         location.hash = '#/detail_claim';
        //                     } else {
        //                         makeNotif('error', response.description, response.message, 'bottom-left');
        //                     }
        //                 }
        //             })      
              		
        //       	}
        //       });
		// 	});
        // }

         var validMmeber = function(){
            $(document).on('click', '#btn_validasi', function(){
                var id_claim = $(this).attr('data-id');
                var link_get = `<?= base_url('api/claim/valid/') ?>${auth.token}?id_claim=${id_claim}`;
  
              Swal.fire({
                title: 'Konfirmasi Validasi Member',
                text: "Validasi Member secara permanent",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
              }).then((result) => {
              	if (result.value) {
                      console.log(id_claim)
              		$.ajax({
              				url: `<?= base_url('api/claim/valid/') ?>${auth.token}?id_claim=${id_claim}`,
              				 type: 'GET',
                            dataType: 'JSON',
                            success: function(response){
                            if(response.status === 200){
                                getData()
                                swal.close();
                                makeNotif('success', response.description, response.message, 'bottom-left');
                            } else {
                                makeNotif('error', response.description, response.message, 'bottom-left');
                            }
                            },
                            error: function(err){
                            makeNotif('error', 'Error', 'Tidak dapat mengakses server', 'bottom-left');
                            console.log(err);
                            }
                            });
              		}
              });
			});
        }
        
        var invalidMmeber = function(){
            $(document).on('click', '#btn_tolak', function(){
                var id_claim = $(this).attr('data-id');
                var link_get = `<?= base_url('api/claim/tidak_valid/') ?>${auth.token}?id_claim=${id_claim}`;
  
              Swal.fire({
                title: 'Konfirmasi Tolak Member',
                text: "Tolak Member secara permanent",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
              }).then((result) => {
              	if (result.value) {
                      console.log(id_claim)
              		$.ajax({
              				url: `<?= base_url('api/claim/tidak_valid/') ?>${auth.token}?id_claim=${id_claim}`,
              				 type: 'GET',
                            dataType: 'JSON',
                            success: function(response){
                            if(response.status === 200){
                                getData()
                                swal.close();
                                makeNotif('success', response.description, response.message, 'bottom-left');
                            } else {
                                makeNotif('error', response.description, response.message, 'bottom-left');
                            }
                            },
                            error: function(err){
                            makeNotif('error', 'Error', 'Tidak dapat mengakses server', 'bottom-left');
                            console.log(err);
                            }
                            });
              		}
              });
			});
        }
        

        return {
            init : function(){
                getData();
                validMmeber();
                invalidMmeber();
             
            }
        }

    })(renderUI)

    $(document).ready(function(){
        loadData.init();
        
    })

</script>