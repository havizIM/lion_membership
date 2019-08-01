<style>
.flex-row>[class*='col-']>.widget.height {
    height: none;
}
</style>
<div class="col-xl-3 column">
    <div class="widget has-shadow">
        <div class="new-badge text-center">
            <div class="badge-img">
                <i class="la la-user"></i>
            </div>
            <div class="title">
                <div class="heading">Profile</div>
                <div class="text">Your private information</div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-9 column about" id="profile">

</div>

<script>

    var renderUI = (() => {
        return {
            renderProfile: (data) => {
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
                            <div class="row flex-row">
                                    <div class="col-xl-5">
                                        <div class="widget has-shadow">
                                            <div class="widget-header bordered no-actions d-flex align-items-center">
                                                <h4>Data Pribadi</h4>
                                            </div>
                                            <div class="widget-body">
                                                <div class="about-infos d-flex flex-column">
                                                    <div class="about-title">Nama:</div>
                                                    <div class="about-text">
                                                    ${v.gender}. ${v.nama}
                                                    </div>
                                                </div>
                                                <div class="about-infos d-flex flex-column">
                                                    <div class="about-title">Kebangsaan:</div>
                                                    <div class="about-text">${v.kebangsaan}</div>
                                                </div>
                                                <div class="about-infos d-flex flex-column">
                                                    <div class="about-title">No Identitas:</div>
                                                    <div class="about-text">${v.no_identitas}.</div>
                                                </div>
                                                <div class="about-infos d-flex flex-column">
                                                    <div class="about-title">No. Handphone:</div>
                                                    <div class="about-text">${v.no_handphone}</div>
                                                </div>
                                                <div class="about-infos d-flex flex-column">
                                                    <div class="about-title">Email:</div>
                                                    <div class="about-text">${v.email}</div>
                                                </div>
                                                <div class="about-infos d-flex flex-column">
                                                    <div class="about-title">Alamat:</div>
                                                    <div class="about-text">${v.alamat} ${v.kota} ${v.kode_pos}</div>
                                                </div>
                                            </div>
                                        </div>

                                         <div class="widget has-shadow">
                                            <div class="widget-header bordered no-actions d-flex align-items-center">
                                                <h4>Data Perusahaan</h4>
                                            </div>
                                            <div class="widget-body">
                                                <div class="about-infos d-flex flex-column">
                                                    <div class="about-title">Nama Perusahaan:</div>
                                                    <div class="about-text">
                                                    ${v.nama_perusahaan}.
                                                    </div>
                                                </div>
                                                <div class="about-infos d-flex flex-column">
                                                    <div class="about-title">Telepon:</div>
                                                    <div class="about-text">${v.no_tlp}</div>
                                                </div>
                                                <div class="about-infos d-flex flex-column">
                                                    <div class="about-title">Fax:</div>
                                                    <div class="about-text">${v.no_fax}</div>
                                                </div>
                                                <div class="about-infos d-flex flex-column">
                                                    <div class="about-title">Email Perusahaan:</div>
                                                    <div class="about-text">${v.email_perusahaan}</div>
                                                </div>
                                                <div class="about-infos d-flex flex-column">
                                                    <div class="about-title">Alamat Surat:</div>
                                                    <div class="about-text">${v.alamat_surat}</div>
                                                </div>
                                                <div class="about-infos d-flex flex-column">
                                                    <div class="about-title">Alamat Perusahaan</div>
                                                    <div class="about-text">${v.alamat_perusahaan} ${v.kota_perusahaan} ${v.kode_pos_perusahaan}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-7 column">
                                     <div class="widget" style="background-color:transparent;">
                                            <div class="container">
                                            <img src="<?= base_url() ?>assets/img/undraw_resume_1hqp.svg" alt="" style="height: 500px; display:block; margin: 0 auto">
                                            </div>
                                    </div>
                                        <div class="widget has-shadow">
                                            <div class="widget-header bordered no-actions d-flex align-items-center">
                                                <h4>Data Pekerjaan</h4>
                                            </div>
                                            <div class="widget-body">
                                                <div class="row">
                                                    <div class="col-md-6 about-infos d-flex flex-column">
                                                         <div class="about-title">Bidang Usaha:</div>
                                                        <div class="about-text">${v.bidang_usaha}.</div>
                                                    </div>
                                                    <div class="col-md-6 about-infos d-flex flex-column">
                                                        <div class="about-title">Jabatan:</div>
                                                        <div class="about-text">${v.jabatan}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="widget height has-shadow" style="height:none;">
                                            <div class="widget-header bordered no-actions d-flex align-items-center">
                                                <h4>Kelengkapan</h4>
                                            </div>
                                            <div class="widget-body">
                                                <div class="row">
                                                    <div class="col-md-6 about-infos d-flex flex-column">
                                                        <div class="about-title">Tanggal Berlaku:</div>
                                                        <div class="about-text">${v.berlaku_dari}</div>
                                                    </div>
                                                    <div class="col-md-6 about-infos d-flex flex-column">
                                                        <div class="about-title">Berlaku Sampai:</div>
                                                        <div class="about-text">${v.berlaku_sampai}</div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 about-infos d-flex flex-column">
                                                        <div class="about-title">Tanggal Pengajuan:</div>
                                                        <div class="about-text">${v.tgl_pengajuan}</div>
                                                    </div>
                                                    <div class="col-md-6 about-infos d-flex flex-column">
                                                        <div class="about-title">Status Member:</div>
                                                        <div class="about-text">${v.status_member}</div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 about-infos d-flex flex-column">
                                                        <div class="about-title">Status:</div>
                                                        <div class="about-text">${v.status}</div>
                                                    </div>
                                                    <div class="col-md-6 about-infos d-flex flex-column">
                                                        <div class="about-title">Tipe:</div>
                                                        <div class="about-text">${v.tipe}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                </div>
                        `
                    })
                    $('#profile').html(html);
                }

                $('#content_profile').html(html);
            }
        }
    })();

    var profileController = ((UI) => {
        var getProfile = () => {
            $.ajax({
                url: `<?= base_url('ext/member/profile/') ?>${auth.token}`,
                type: 'GET',
                dataType: 'JSON',
                success: function(res){
                    UI.renderProfile(res.data);
                },
                error: function(err){
                    makeNotif('error', 'Tidak dapat mengakses server', 'bottomRight')
                }
            })
        }

        return {
            init: () => {
                getProfile();
            }
        }
    })(renderUI);

    $(document).ready(function(){
        profileController.init();
    })

</script>
