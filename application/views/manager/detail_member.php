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
          <h2 class="page-header-title">Detail Member</h2>
          <div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item active"><a href="#/dashboard"><i class="la la-home"></i></a> - <a href="#/member">Member</a> - Detail Member </li>
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
            renderMember: function(data){
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
                                    <div class="about-title">Berlaku dari :</div>
                                    <div class="about-text">${data.berlaku_dari}</div>
                                </div>
                                    <div class="about-infos d-flex flex-column">
                                    <div class="about-title">Berlaku sampai :</div>
                                    <div class="about-text">${data.berlaku_sampai}</div>
                                </div>
                                <div class="about-infos d-flex flex-column">
                                    <div class="about-title">Tipe kartu :</div>
                                    <div class="about-text">${data.tipe}</div>
                                </div>
                                <div class="about-infos d-flex flex-column">
                                    <div class="about-title">Status :</div>
                                    <div class="about-text">${data.status_member}</div>
                                </div>
                            </div>
                        </div>
                        
                    </div>`;

                //PEKERJAAN
                html +=`<div class="col-xl-7 column">
                        <div class="widget widget-16 has-shadow" style="max-height: 130px">
                            <div class="widget-body">
                                <div class="row">
                                    <div class="col-xl-12 d-flex flex-column justify-content-center align-items-center">
                                        <div class="counter" style="color: #e76c90">${data.no_member.replace(/\W/gi, '').replace(/(.{4})/g, '$1 ')}</div>
                                        <div class="total-views">No Member</div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                        <span class="m-r-10"><i class="la la-copy"></i></span><h4>Tipe Card</h4>
                    </div>
                    <div class="widget-body">
                        <div class="row">
                            <div class="col-md-12 about-infos d-flex flex-column" style="padding-top: 100px">
                                <center>
                                    <div class="widget has-shadow" style="border-radius: 12px; height: 240px; width: 380px; background-color: ${data.tipe === 'Blue' ? 'navy' : '#DAA520'};">
                                        <div style="background-image: url(<?= base_url('assets/id.svg') ?>); background-size: 100% 80%; background-repeat: no-repeat; height: 100%; width: 100%; position: relative; top: 25px;">
                                        
                                        </div>
                                        <center style="position: relative; top: -250px;"><img src="<?= base_url('assets/logo_lion.png') ?>" ></img></center>
                                    </div>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-12 column">
                <div class="widget has-shadow">
                    <div class="widget-header bg-primary bordered br-radius no-actions d-flex align-items-center" style="padding:1rem;">
                        
                        <span class="m-r-10"><i class="la la-suitcase"></i></span> <h4>Log Poin</h4>
                        
                    </div>
                    <div class="widget-body">
                        <table class="table">
                            <thead>
                                <th>Kode Booking</th>
                                <th>Tanggal</th>
                                <th>Tipe</th>
                                <th>Departure</th>
                                <th>Arrival</th>
                                <th>Poin</th>
                            </thead>
                            <tbody>`
                                var total_poin = 0;
                                
                                $.each(data.log, function(k, v){
                                    if(v.type === 'claim'){
                                        total_poin    += parseInt(v.claim_poin);
                                    } else {
                                        total_poin    -= parseInt(v.redeem_poin);
                                    }

                                    html += `
                                    <tr>
                                        <td>${v.kode_booking}</td>
                                        <td>${v.tgl_log}</td>
                                        <td>${v.type}</td>
                                        <td>${v.departure} - ${v.nama_departure}</td>
                                        <td>${v.arrival} - ${v.nama_arrival}</td>
                                        <td>${v.type === 'claim' ? `<i class="la la-plus text-success"></i> ${v.claim_poin}` : `<i class="la la-minus text-danger"></i> ${v.redeem_poin}`}</td>
                                    </tr>
                                    `;
                                });

            html += `
                            </tbody>
                        </table>
                        <h4>Total Poin : <b class="text-success">${total_poin}</b></h4>
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

        var NO_MEMBER = location.hash.substr(9);

        var getData = function(){
            // alert(NO_MEMBER)
            $.ajax({
                url: `<?= base_url('api/member/show/'); ?>${auth.token}?no_member=${NO_MEMBER}`,
                type: 'GET',
                dataType: 'JSON',
                success: function(response){
                    if(response.status === 200){
                        if(response.data.length !== 1){
                            UI.renderNoData();
                        } else {
                            $.each(response.data, function(k, v){
                                UI.renderMember(v);
                            })
                        }
                    } else {
                        UI.renderNoData();
                    }
                },
                error: function(err){
                    location.hash = '#/member'
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