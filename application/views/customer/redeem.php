<div class="col-xl-3 column">
    <div class="widget has-shadow">
        <div class="new-badge text-center">
            <div class="badge-img">
                <i class="la la-file"></i>
            </div>
            <div class="title">
                <div class="heading">Redeem</div>
                <div class="text">Redeem your Points</div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-9 column">
    <div class="widget has-shadow">
        <div class="widget-header bordered no-actions d-flex align-items-center">
            <h3>Redeem Your Points</h3>
        </div>
        <div class="widget-body">
            <form id="cari_poin" class="form-horizontal">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <select id="departure" name="departure" class="form-control" data-live-search="true"></select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <select id="arrival" name="arrival" class="form-control" data-live-search="true"></select>
                        </div>
                    </div>
                </div>

                <button class="btn btn-block btn-md btn-primary" type="submit" id="submit_cari">Cari Rute</button>
            </form>
        </div>
    </div>

    <div class="widget has-shadow" id="content_poin">
        
    </div>

    <div id="modal_redeem" class="modal fade">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Redeem Your Poin</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                        <span class="sr-only">close</span>
                    </button>
                </div>
                <form id="form_redeem">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">No Flight / No Penerbangan</label>
                            <div class="input-group">
                                <input type="hidden" name="id_poin" id="id_poin">
                                <input type="text" class="form-control" id="no_flight" name="no_flight">
                                <span class="input-group-addon addon-primary"><a href="http://www.lionair.co.id/id" target="__blank" class="text-white">Cari Fight</a></span>
                            </div>
                            <i>* Klik tombol cari flight untuk mencari penerbangan yang dinginkan.</i>
                        </div>
                        <div class="form-group">
                            <label for="">Gender</label>
                            <select class="form-control" id="gender_pessenger" name="gender_pessenger">
                                <option value="">-</option>
                                <option value="Mr">Mr</option>
                                <option value="Mrs">Mrs</option>
                                <option value="Ms">Ms</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Pessenger</label>
                            <input type="text" class="form-control" id="nama_pessenger" name="nama_pessenger">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-shadow" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="submit_redeem">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>




<script>
    var renderUI = (() => {
        var renderDeparture = function(data){
            var departure = '<option value="">-- Pilih Departure --</option>';

            $.each (data, function(k, v){
                    departure += `<option value="${v.id_rute}">${v.nama_rute}</option>`;
            });

            $('#departure').html(departure).selectpicker('refresh');
        }
        
        var renderArrival = function(data){
            var arrival = '<option value="">-- Pilih Arrival --</option>';

            $.each (data, function(k, v){
                arrival += `<option value="${v.id_rute}">${v.nama_rute}</option>`;
            });

            $('#arrival').html(arrival).selectpicker('refresh');
        }

        var renderPoin = function(data){
            var html = '';

            if(data.length === 0){
                html += `
                    <div class="widget-header bordered no-actions d-flex align-items-center">
                        <h3>Rute Tidak Ditemukan...</h3>
                    </div>
                `
            } else {
                $.each(data, function(k, v){
                    html += `
                        <div class="widget-header bordered bg-info no-actions d-flex align-items-center">
                            <h4 style="color: white"><span class="text-danger">${v.id_poin}</span> - Redeem Poin : ${v.redeem_poin}</h3>
                        </div>
                        <div class="widget-body">
                            <li class="list-group-item">
                                <div class="media">
                                    <div class="media-body align-self-center">
                                        <div class="msg">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <center>
                                                        <p class="text-info">Departure</p>
                                                        <h3>${v.departure}</h3>
                                                        <p>${v.departure_name}</p>
                                                    </center>
                                                </div>
                                                <div class="col-md-2">
                                                    <center>
                                                        <i style="font-size: 50px" class="la la-arrow-right"></i>
                                                    </center>
                                                </div>
                                                <div class="col-md-5">
                                                    <center>
                                                        <p class="text-info">Arrival</p>
                                                        <h3>${v.arrival}</h3>
                                                        <p>${v.arrival_name}</p>
                                                    </center>
                                                </div>
                                            </div>
                                        </div><br/>
                                        <div class="status row">
                                            <div class="col-md-12 text-right">
                                                <button class="btn btn-md btn-primary pilih" data-id="${v.id_poin}" data-poin="${v.redeem_poin}" data-id_dep="${v.departure}" data-id_arr="${v.arrival}" data-dep="${v.departure_name}" data-arr="${v.arrival_name}">Pilih</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </div>
                    `
                })
            }

            $('#content_poin').html(html);
        }
        
        var openFormModal = (data) => {
            $('#form_redeem')[0].reset();
            $('#id_poin').val(data.id_poin);
            $('#modal_redeem').modal('show')
        }

        return {
            renderDeparture,
            renderArrival,
            renderPoin,
            openFormModal
        }
    })();

    var redeemController = ((UI) => {
        var submitRedeem = () => {
            $('#form_redeem').on('submit', function(e){
                e.preventDefault();

                var id_poin             = $('#id_poin').val();
                var no_flight           = $('#no_flight').val();
                var gender_pessenger    = $('#gender_pessenger').val();
                var nama_pessenger      = $('#nama_pessenger').val();

                if(id_poin === '' || no_flight === '' || gender_pessenger === '' || nama_pessenger === ''){
                    makeNotif('warning', 'Silahkan isi data dengan lengkap', 'bottomRight')
                } else {
                    $.ajax({
                        url: `<?= base_url('ext/redeem/add/') ?>${auth.token}`,
                        type: 'POST',
                        dataType: 'JSON',
                        data: $(this).serialize(),
                        beforeSend: function(){
                            $('#submit_redeem').html('Loading...')
                        },
                        success: function(res){
                            if(res.status === 200){
                                makeNotif('success', res.message, 'bottomRight')
                                $('#modal_redeem').modal('hide')
                            } else {
                                makeNotif('error', res.message, 'bottomRight')
                            }
                            $('#submit_redeem').html('Submit')
                        },
                        error: function(err){
                            $('#submit_redeem').html('Submit')
                            makeNotif('error', 'Tidak dapat mengakses server', 'bottomRight')
                        }
                    })
                }
            })
        }

        var cariPoin = () => {
            $('#cari_poin').on('submit', function(e){
                e.preventDefault();

                var departure   = $('#departure').val();
                var arrival     = $('#arrival').val();

                if(departure === '' || arrival === ''){
                    makeNotif('error', 'Silahkan pilih rute yang tersedia', 'bottomRight')
                } else {
                    $.ajax({
                        url: `<?= base_url('ext/poin/show/') ?>${auth.token}?departure=${departure}&arrival=${arrival}`,
                        type: 'GET',
                        dataType: 'JSON',
                        beforeSend: function(){
                            $('#submit_cari').text('Loading...')
                        },
                        success: function(res){
                            UI.renderPoin(res.data);

                            $('#submit_cari').text('Cari Rute')
                        },
                        error: function(){
                            makeNotif('error', 'Tidak dapat mengakses server', 'bottomRight')
                            $('#submit_cari').text('Cari Rute')
                        }
                    })
                }
            })
        }

        var getRoute = () => {
            $.ajax({
                url: `<?= base_url('ext/rute/show/') ?>${auth.token}`,
                type: 'GET',
                dataType: 'JSON',
                success: function(res){
                    console.log(res)
                    UI.renderDeparture(res.data);
                    UI.renderArrival(res.data);
                },
                error: function(err){
                    makeNotif('error', 'Tidak dapat mengakses server', 'bottomRight')
                }
            })
        }

        var pilihPoin = () => {
            $('#content_poin').on('click', '.pilih', function(){
                var obj = {
                    id_poin: $(this).data('id'),
                    redeem_poin: $(this).data('poin'),
                    departure: $(this).data('id_dep'),
                    departure_name: $(this).data('dep'),
                    arrival: $(this).data('id_arr'),
                    arrival_name: $(this).data('arr')
                }

                $.ajax({
                    url: `<?= base_url('ext/member/get_my_poin/') ?>${auth.token}`,
                    type: 'GET',
                    dataType: 'JSON',
                    beforeSend: function(){
                        $(this).html('Loading...');
                    },
                    success: function(res){
                        if(res.status === 200){
                            if(res.data.total_poin < obj.redeem_poin){
                                makeNotif('warning', 'Poin anda tidak mencukupi', 'bottomRight')
                            } else {
                                UI.openFormModal(obj);
                            }

                            $(this).html('Pilih');
                        } else {
                            $(this).html('Pilih');
                            makeNotif('error', 'Tidak dapat mengakses server', 'bottomRight')
                        }
                    },
                    error: function(err){
                        makeNotif('error', 'Tidak dapat mengakses server', 'bottomRight')
                    }
                })
            })
        }

        return {
            init: () => {
                submitRedeem();
                getRoute();
                cariPoin();
                pilihPoin();
            }
        }
    })(renderUI);

    $(document).ready(function(){
        redeemController.init();
    })
</script>
