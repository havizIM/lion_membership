<style>
.widget-body.pd {
    padding: 2.2em;
}
</style>
<div class="row">
    <div class="page-header">
      <div class="d-flex align-items-center">
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
                                <div class="widget-header bordered no-actions d-flex align-items-center">
                                    <h4>Data Pribadi</h4>
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
                            <div class="widget-header bordered no-actions d-flex align-items-center">
                                <h4>Lain-lain</h4>
                            </div>
                            <div class="widget-body">
                                 <div class="about-infos d-flex flex-column">
                                        <div class="about-title">Lampiran:</div>
                                        <div class="about-text">${data.lampiran}</div>
                                    </div>
                                    <div class="about-infos d-flex flex-column">
                                        <div class="about-title">Status:</div>
                                        <div class="about-text">${data.status_claim}</div>
                                    </div>
                                    <div class="about-infos d-flex flex-column">
                                        <div class="about-title">Keterangan:</div>
                                        <div class="about-text">${data.keterangan}</div>
                                    </div>
                            </div>
                        </div>

                       
                        
                    </div>`;

                //PEKERJAAN
                html +=`<div class="col-xl-7 column">`

                        if(data.status_claim === 'Proses'){
                        html +=`
                                <div class="widget has-shadow" style="max-height: 150px;">
                                    <div class="widget-header bordered no-actions d-flex align-items-center">
                                        <h4>Aksi</h4>
                                    </div>
                                    <div class="widget-body text-center">
                                        <div class="btn-group" style="width: 100%">
                                            <button type="button" class="btn btn-md btn-success" id="validasi_member" data-id="${data.no_member}" style="width: 100%"><i class="mdi mdi-check"></i>Validasi</button>
                                            <button type="button" class="btn btn-md btn-warning" id="tolak_member" data-id="${data.no_member}" style="width: 100%"><i class="mdi mdi-check"></i>Tolak Validasi</button>
                                        </div>
                                       </div>
                                </div>`
							}
                         html+= `<div class="widget has-shadow">
                                    <div class="widget-header bordered no-actions d-flex align-items-center">
                                        <h4>Pekerjaan</h4>
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
                        <div class="widget-header bordered no-actions d-flex align-items-center">
                            <h4>Lampiran</h4>
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
        

        return {
            init : function(){
                getData();
             
            }
        }

    })(renderUI)

    $(document).ready(function(){
        loadData.init();
        
    })

</script>