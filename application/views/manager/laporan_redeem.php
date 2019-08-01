<div class="row">
    <div class="page-header">
      <div class="d-flex align-items-center">
          <h2 class="page-header-title">Laporan Redeem</h2>
          <div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item active"><a href="#/dashboard"><i class="la la-home"></i></a> - <a href="#/dashboard">Dashboard</a> - Laporan Redeem </li>
            </ul>
          </div>
      </div>
    </div>
</div>

<div class="row flex-row">
    <div class="col-12">
        <!-- Form -->
        <div class="widget has-shadow">
            <div class="widget-header bordered no-actions d-flex align-items-center">
                <h4>Filter Laporan Redeem</h4>
            </div>
            <div class="widget-body">
                <form id="form_laporan">
                    <div class="form-group row">
                        <label class="col-lg-3 form-control-label">Pilih Bulan</label>
                        <div class="col-lg-9 select mb-3">
                            <select name="bulan" id="bulan" class="custom-select form-control">
                                <option value="">-</option>
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 form-control-label">Pilih Tahun</label>
                        <div class="col-lg-9 select mb-3">
                            <select name="tahun" id="tahun" class="custom-select form-control">
                                <option value="">-</option>
                                <option value="2019">2019</option>
                                <option value="2018">2018</option>
                                <option value="2017">2017</option>
                            </select>
                        </div>
                    </div>
                    <div class="text-right">
                        <button class="btn btn-info btn-md" id="submit_lap">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Form -->
    </div>
</div>

<div class="row" id="content_laporan">
    

<script>

    var renderUI = (() => {
        return {
            renderData: (data) => {
                var html = '';
                var bulan = $('#bulan').val();
                var tahun = $('#tahun').val();
                var list_bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

                html += `
                        <div class="col-xl-12">
                            <div class="invoice has-shadow printableArea">
                                <div class="invoice-container">
                                    <div class="invoice-top">
                                        <div class="row d-flex align-items-center">
                                            <div class="col-xl-6 col-md-6 col-sm-6 col-6"></div>
                                            <div class="col-xl-6 col-md-6 col-sm-6 col-6 d-flex justify-content-end">
                                                <div class="actions dark">
                                                    <div class="dropdown">
                                                        <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle">
                                                            <i class="la la-ellipsis-h"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a id="print" style="cursor: pointer" class="dropdown-item"> 
                                                                <i class="la la-print"></i>Print
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="invoice-header">
                                        <div class="row d-flex align-items-center">
                                            <div class="col-xl-2 col-md-2 col-sm-12 d-flex justify-content-xl-start justify-content-md-center justify-content-center mb-2">
                                                <div class="invoice-logo">
                                                    <img src="<?= base_url() ?>assets/img/logo-lion-2.png" alt="logo" style="width: 95%">
                                                </div>
                                            </div>
                                            <div class="col-xl-5 col-md-5 col-sm-6 d-flex justify-content-xl-start justify-content-md-center justify-content-center mb-2">
                                                <div class="details">
                                                    <ul>
                                                        <li class="company-name">PT. Lion Mentari Airlines</li>
                                                        <li>Jl. Gajah Mada no 7 Jakarta Pusat</li>
                                                        <li>Telp: (021) 63798000</li>
                                                        <li>Email: adm.lionpasspor@liongroup.com</li>
                                                        <li>http://www.lionair.co.id/id</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="invoice-date d-flex justify-content-xl-end justify-content-center">
                                        <span>Laporan Redeem Per ${list_bulan[bulan-1]} - ${tahun}</span>
                                    </div>
                                    <div class="col-xl-12 desc-tables">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th class="text-left">ID Redeem</th>
                                                        <th class="text-left">Member</th>
                                                        <th class="text-left">Tanggal</th>
                                                        <th class="text-center">Jumlah Poin</th>
                                                    </tr>
                                                </thead>
                                                <tbody>`
                                                    
                                                    if(data.length === 0){
                                                        html += `
                                                            <tr>
                                                                <td colspan="4"><center>Tidak ada data tersedia</center></td>
                                                            </tr>
                                                        `
                                                    } else {
                                                        var grand_total = 0;

                                                        $.each(data, function(k, v){
                                                            html += `
                                                                <tr>
                                                                    <td class="text-left">${v.id_redeem}</td>
                                                                    <td class="text-left">
                                                                        ${v.member.no_member}
                                                                        <br>
                                                                        <div class="description">
                                                                            ${v.member.gender}. ${v.member.nama}
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-left">${v.tgl_redeem}</td>
                                                                    <td class="text-center">`
                                                                    var total = 0;
                                                                    
                                                                    $.each(v.detail, function(k1, v1){
                                                                        total += parseInt(v1.redeem_poin)
                                                                    })

                                                                    html += `${total}`

                                                            html +=
                                                                    `</td>
                                                                </tr>
                                                            `
                                                            grand_total += parseInt(total);
                                                        })
                                                    }
                                                
                            html+=
                                                `</tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="invoice-footer">
                                    <div class="invoice-container">
                                        <div class="row d-flex align-items-center">
                                            <div class="col-xl-6 col-md-6 col-sm-6 d-flex justify-content-xl-start justify-content-md-start justify-content-center mb-2">
                                                
                                            </div>
                                            <div class="col-xl-6 col-md-6 col-sm-6 d-flex justify-content-xl-end justify-content-md-end justify-content-center">
                                                <div class="total">
                                                    <div class="title">Total Poin Redeem</div>
                                                    <div class="number">${grand_total} Poin</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                $('#content_laporan').html(html);
            }
        }
    })();
    
    var laporanController = ((UI) => {

        var printLaporan = () => {
            $('#content_laporan').on('click', '#print', function(){
                var mode = 'iframe';
                var close = mode == "popup";
                var options = {
                    mode: mode,
                    popClose: close
                };

                $("div.printableArea").printArea(options);
            })
        }

        var submitLaporan = () => {
            $('#form_laporan').on('submit', function(e){
                e.preventDefault();

                var bulan = $('#bulan').val();
                var tahun = $('#tahun').val();

                if(bulan === '' || tahun === ''){
                    makeNotif('warning', 'Filter harus diisi', 'bottomRight');
                } else {
                    $.ajax({
                        url: `<?= base_url('api/redeem/laporan/') ?>${auth.token}?bulan=${bulan}&tahun=${tahun}`,
                        type: 'GET',
                        dataType: 'JSON',
                        beforeSend: function(){
                            $('#submit_lap').html('Loading...')
                        },
                        success: function(res){
                            if(res.status === 200){
                                UI.renderData(res.data);
                            } else {
                                makeNotif('error', res.message, 'bottomRight');
                            }

                            $('#submit_lap').html('Submit')
                        },
                        error: function(){
                            makeNotif('error', res.message, 'bottomRight');

                            $('#submit_lap').html('Submit')
                        }
                    })
                }
            })
        }

        return {
            init: () => {
                submitLaporan();
                printLaporan();
            }
        }
    })(renderUI);

    $(document).ready(function(){
        laporanController.init();
    })
</script>