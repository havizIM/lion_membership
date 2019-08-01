
<style>
.pos {
    position: relative;
    right: 15px;
    margin-left: 10px;
    font-size: 20px;
    color: #fff;
}

.pos2 {git
    position: relative;
    bottom: 100%;
    margin-bottom: -100px;
}
</style>
<div class="col-xl-3 column">
    <div class="widget has-shadow">
        <div class="new-badge text-center">
            <div class="badge-img">
                <i class="la la-arrows-h"></i>
            </div>
            <div class="title">
                <div class="heading">Riwayat</div>
                <div class="text">See your progress</div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-9 column">
    <div class="widget has-shadow">
        <div class="widget-header bordered no-actions d-flex align-items-center">
            <h4>Riwayat Pengajuan</h4>
        </div>
        <div class="widget-body">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="i-drop-tab-1" data-toggle="tab" href="#i-d-tab-1" role="tab" aria-controls="i-d-tab-1" aria-selected="true"><i class="ion-leaf mr-2"></i>Claim</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="i-drop-tab-2" data-toggle="tab" href="#i-d-tab-2" role="tab" aria-controls="i-d-tab-2" aria-selected="false"><i class="ion-pinpoint mr-2"></i>Redeem</a>
                </li>
            </ul>
            <div class="tab-content pt-3">
                <div class="tab-pane fade show active" id="i-d-tab-1" role="tabpanel" aria-labelledby="i-drop-tab-1" style="max-height:450px;">
                   
                </div>
                <div class="tab-pane fade" id="i-d-tab-2" role="tabpanel" aria-labelledby="i-drop-tab-2" style="max-height:450px;">
                    Mauris venenatis rutrum augue vulputate fringilla. Aliquam euismod tempor neque. Ut urna tortor, mattis vitae gravida in, consectetur at est. Nulla eu purus et justo porttitor luctus. Cras sed urna vitae quam interdum varius vel sollicitudin lectus. Proin ullamcorper lacinia justo, eget porta odio egestas sed.
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var renderUI = (() => {
        return{
            renderClaim: (data) => {
                console.log(data)
                var html = '';

                if(data.length === 0){
                    html += `
                         <div class="container">
                            <div class="contain">
                                <div class="row">
                                    <div class="col-md-12">
                                        <img src="<?= base_url() ?>assets/img/undraw_online_resume_qyys.svg" alt="" style="height: 500px; display:block; margin: 0 auto"> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    `
                } else {
                    $.each(data, function(k, v){
                        html += `
                                <div class="col-xl-12 column about">
                                        <div class="widget height has-shadow" style="height:none;">
                                            <div class="widget-header bordered no-actions d-flex align-items-center" style="background:#2c304d;">
                                                <span class="pos"><i class="la la-file-text"></i></span><h4 class="text-white">Detail</h4>
                                            </div>
                                            <div class="widget-body">
                                                <div class="row">
                                                    <div class="col-md-4 about-infos d-flex flex-column">
                                                        <div class="about-title">ID Claim:</div>
                                                        <div class="about-text">${v.id_claim}</div>
                                                    </div>
                                                    <div class="col-md-4 about-infos d-flex flex-column">
                                                        <div class="about-title">Kode Booking:</div>
                                                        <div class="about-text">2${v.kode_booking}</div>
                                                    </div>
                                                    <div class="col-md-4 about-infos d-flex flex-column">
                                                        <div class="about-title">Keterangan:</div>
                                                        <div class="about-text">${v.keterangan}</div>
                                                    </div>
                                                   
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4 about-infos d-flex flex-column">
                                                        <div class="about-title">Nama:</div>
                                                        <div class="about-text">${v.member.gender} ${v.member.nama}</div>
                                                    </div>
                                                    <div class="col-md-4 about-infos d-flex flex-column">
                                                        <div class="about-title">No. Member:</div>
                                                        <div class="about-text">${v.member.no_member}</div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4 about-infos d-flex flex-column">
                                                        <div class="about-title">Status Claim:</div>
                                                        `
                                                        if (v.status_claim === "Proses") {
                                                            html +=`<span style="width:100px;"><span class="badge-text badge-text-small info">${v.status_claim}</span></span>`
                                                        } else if (v.status_claim === "Valid") {
                                                            html +=`<span style="width:100px;"><span class="badge-text badge-text-small success">${v.status_claim}</span></span>`
                                                        } else {
                                                            html +=`<span style="width:100px;"><span class="badge-text badge-text-small danger">${v.status_claim}</span></span>`
                                                        }
                                                      html+= `</div>
                                                    <div class="col-md-4 about-infos d-flex flex-column">
                                                        <div class="about-title">Tanggal Claim:</div>
                                                        <div class="about-text">${v.tgl_claim}</div>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    `
                    });
                    
                }
                $('#i-d-tab-1').html(html);
            },
            renderRedeem: (data) => {
                console.log(data)
                var html = '';
                
                if(data.length === 0){
                     html += `
                        <div class="container">
                            <div class="contain">
                                <div class="row">
                                    <div class="col-md-12">
                                            <img src="<?= base_url() ?>assets/img/undraw_online_resume_qyys.svg" alt="" style="height: 500px; display:block; margin: 0 auto"> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    `
                } else {
                    $.each(data, function(k, v){
                          html += `
                        <div class="col-xl-12 column about">
                                        <div class="widget height has-shadow" style="height:none;">
                                            <div class="widget-header bordered no-actions d-flex align-items-center" style="background:#2c304d;">
                                                <span class="pos"><i class="la la-file-text"></i></span><h4 class="text-white">Detail</h4>
                                            </div>
                                            <div class="widget-body">
                                                <div class="row">
                                                    <div class="col-md-4 about-infos d-flex flex-column">
                                                        <div class="about-title">ID Claim:</div>
                                                        <div class="about-text">${v.id_redeem}</div>
                                                    </div>
                                                    <div class="col-md-4 about-infos d-flex flex-column">
                                                       <div class="about-title">Tanggal Redeem:</div>
                                                        <div class="about-text">${v.tgl_redeem}</div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4 about-infos d-flex flex-column">
                                                        <div class="about-title">Nama:</div>
                                                        <div class="about-text">${v.member.gender}. ${v.member.nama}</div>
                                                    </div>
                                                    <div class="col-md-4 about-infos d-flex flex-column">
                                                        <div class="about-title">No. Member:</div>
                                                        <div class="about-text">${v.member.no_member}</div>
                                                    </div>
                                                     
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4 about-infos d-flex flex-column">
                                                        <div class="about-title">Status Claim:</div>
                                                        `
                                                        if (v.status_redeem === "Proses") {
                                                            html +=`<span style="width:100px;"><span class="badge-text badge-text-small info">${v.status_redeem}</span></span>`
                                                        } else if (v.status_redeem === "Approve") {
                                                            html +=`<span style="width:100px;"><span class="badge-text badge-text-small success">${v.status_redeem}</span></span>`
                                                        } else {
                                                            html +=`<span style="width:100px;"><span class="badge-text badge-text-small danger">${v.status_redeem}</span></span>`
                                                        }
                                                      html+= `</div>
                                                    <div class="col-md-4 about-infos d-flex flex-column">
                                                         <div class="about-title">Keterangan:</div>
                                                        <div class="about-text">${v.keterangan}</div>
                                                    </div>
                                                    <div class="col-md-4 about-infos d-flex flex-column">
                                                    <div class="pos2">
                                                         <img src="<?= base_url() ?>assets/img/undraw_transfer_files_6tns.svg" alt="" style="height: 500px; display:block; margin: 0 auto"> 
                                                    </div>
                                                    </div>
                                                </div>
                                                        
                                            </div>
                                        </div>
                                       
                                    </div>

                    `
                    });
                   
                }
                $('#i-d-tab-2').html(html);
            }
        }
    })();

    var riwayatController = ((UI) => {
        var getClaim = () => {
            $.ajax({
                url: `<?= base_url('ext/claim/show/') ?>${auth.token}`,
                type: 'GET',
                dataType: 'JSON',
                success: function(res){
                    UI.renderClaim(res.data);
                },
                error: function(err){
                    makeNotif('error', 'Tidak dapat mengakses server', 'bottomRight')
                }
            })
        }

        var getRedeem = () => {
            $.ajax({
                url: `<?= base_url('ext/redeem/show/') ?>${auth.token}`,
                type: 'GET',
                dataType: 'JSON',
                success: function(res){
                    UI.renderRedeem(res.data);
                },
                error: function(err){
                    makeNotif('error', 'Tidak dapat mengakses server', 'bottomRight')
                }
            })
        }
        
        var setupScroll = () => {
            $('#i-d-tab-1').niceScroll();
            $('#i-d-tab-2').niceScroll();
        }

        return {
            init: () => {
                getClaim();
                getRedeem();
                setupScroll()
            }
        }
    })(renderUI);

    $(document).ready(function(){
        riwayatController.init();
    })
</script>
