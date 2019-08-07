<div class="col-xl-3 column">
    <div class="widget has-shadow">
        <div class="new-badge text-center">
            <div class="badge-img">
                <i class="la la-file"></i>
            </div>
            <div class="title">
                <div class="heading">Claim</div>
                <div class="text">Claim your BoardingPass</div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-9 column">
    <div class="widget has-shadow">
        <div class="widget-header bordered no-actions d-flex align-items-center">
            <h3>Claim Boarding Pass</h3>
        </div>
        <div class="widget-body">
            <form id="form_claim" class="form-horizontal">
                <div class="form-group row d-flex align-items-center mb-5">
                    <label class="col-lg-3 form-control-label">Kode Booking</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="kode_booking" maxlength="6" required>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center mb-5">
                    <label class="col-lg-3 form-control-label">Boarding Pass</label>
                    <div class="col-lg-9">
                        <button class="btn btn-block btn-info" type="button" id="cari_poin"><i class="la la-search"></i> Cari Rute</button><br>
                    </div>
                </div>

                <div class="widget has-shadow">
                    <div class="widget-header bordered br-radius no-actions d-flex align-items-center">
                        <h5><i>* Cari rute lalu Klik pilih, dan jangan lupa Upload Boarding Passmu</i></h5>
                    </div>
                    <div class="widget-body no-padding">
                        <ul class="ticket list-group w-100" id="detail_claim">
                            <!-- ROW DETAIL -->
                        </ul>
                    </div>
                </div>

                <button class="btn btn-block btn-md btn-primary" type="submit" id="submit_claim">Submit</button>
            </form>
        </div>
    </div>

    <div id="modal_poin" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cari Rute</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                        <span class="sr-only">close</span>
                    </button>
                </div>
                <form id="form_cari">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <select id="departure" name="departure" class="form-control" data-live-search="true"></select>
                            </div>
                            <div class="col-md-6">
                                <select id="arrival" name="arrival" class="form-control" data-live-search="true"></select>
                            </div>
                        </div><br>
                        <button type="submit" class="btn btn-primary btn-block" id="submit_cari">Cari</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12" id="content_poin">
                                <!-- RENDER POIN -->
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    var count = 0;

    var renderUI = (function(){
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
                html += 'Rute tidak ditemukan..'
            } else {
                $.each(data, function(k, v){
                    html += `
                        <div class="widget widget-11 has-shadow">
                            <div class="widget-header bordered d-flex align-items-center">
                                <h2>
                                    ${v.id_poin} - Claim point : ${v.claim_poin}
                                </h2>
                            </div>
                            <div class="widget-body p-0 widget-scroll" style="max-height: 450px; overflow: hidden; outline: none;" tabindex="3">       
                                <div class="timeline red">
                                    <div class="timeline-content d-flex align-items-center">
                                        <div class="timeline-icon">
                                            <i class="la la-paper-plane"></i>
                                        </div>
                                        <div class="d-flex flex-column mr-auto">
                                            <div class="title">
                                                ${v.departure} - ${v.departure_name}
                                            </div>
                                            <div class="time">Departure</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="timeline red">
                                    <div class="timeline-content d-flex align-items-center">
                                        <div class="timeline-icon">
                                            <i class="la la-paper-plane"></i>
                                        </div>
                                        <div class="d-flex flex-column mr-auto">
                                            <div class="title">
                                                ${v.arrival} - ${v.arrival_name}
                                            </div>
                                            <div class="time">Arrival</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="timeline blue">
                                    <div class="timeline-content d-flex align-items-center">
                                        <div class="timeline-icon">
                                            <button class="btn btn-lg btn-info pilih" data-id="${v.id_poin}" data-poin="${v.claim_poin}" data-id_dep="${v.departure}" data-id_arr="${v.arrival}" data-dep="${v.departure_name}" data-arr="${v.arrival_name}" type="button"><i class="la la-check"></i> Pilih</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `
                })
            }

            $('#content_poin').html(html);
        }

        var renderRow = function(data){
            count = count + 1;
            var html = `
                <li class="list-group-item" id="poin_${count}">
                    <div class="media">
                        <div class="media-body align-self-center">
                            <div class="username">
                                <h4>${data.id_poin} - Claim Poin : ${data.claim_poin}</h4>
                            </div><br/>
                            <div class="msg">
                                <div class="row">
                                    <div class="col-md-5">
                                        <center>
                                            <h3>${data.departure}</h3>
                                            <p>${data.departure_name}</p>
                                        </center>
                                    </div>
                                    <div class="col-md-2">
                                        <center>
                                            <i style="font-size: 50px" class="la la-arrow-right"></i>
                                        </center>
                                    </div>
                                    <div class="col-md-5">
                                        <center>
                                            <h3>${data.arrival}</h3>
                                            <p>${data.arrival_name}</p>
                                        </center>
                                    </div>
                                </div>
                            </div><br/>
                            <div class="status row">
                                <div class="col-md-6">
                                    <input type="hidden" name="id_poin[]" value="${data.id_poin}" />
                                    <input type="file" name="lampiran_claim[]" required />
                                </div>
                                <div class="col-md-6 text-right">
                                    <i class="la la-trash text-danger remove" data-id="${count}" style="cursor: pointer"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            `;
            
            $('#detail_claim').append(html);
        }

        return {
            renderDeparture,
            renderArrival,
            renderPoin,
            renderRow,
        }
    })();

    var claimController = ((UI) => {

        var openModal = () => {
            $('#cari_poin').on('click', function(){
                $('#modal_poin').modal('show');
            })
        }

        var getRoute = () => {
            $.ajax({
                url: `<?= base_url('ext/rute/show/') ?>${auth.token}`,
                type: 'GET',
                dataType: 'JSON',
                success: function(res){
                    UI.renderDeparture(res.data);
                    UI.renderArrival(res.data);
                },
                error: function(err){
                    makeNotif('error', 'Tidak dapat mengakses server', 'bottomRight')
                }
            })
        }

        var submitCari = () => {
            $('#form_cari').on('submit', function(e){
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

                            $('#submit_cari').text('Cari')
                        },
                        error: function(){
                            makeNotif('error', 'Tidak dapat mengakses server', 'bottomRight')
                            $('#submit_cari').text('Cari')
                        }
                    })
                }

            })
        }

        var submitClaim = () => {
            $('#form_claim').on('submit', function(e){
                e.preventDefault();

                $.ajax({
                    url: `<?= base_url('ext/claim/add/') ?>${auth.token}`,
                    type: 'POST',
                    dataType: 'JSON',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function(){
                        $('#submit_claim').text('Loading...')
                    },
                    success: function(res){
                        if(res.status === 200){
                            makeNotif('success', res.message, 'bottomRight');
                            $('#detail_claim').html('');
                            $('#content_poin').html('');
                            $('#form_claim')[0].reset();
                            $('#form_cari')[0].reset();
                            $('#departure').selectpicker('refresh');
                            $('#arrival').selectpicker('refresh');
                        } else {
                            makeNotif('error', res.message, 'bottomRight');
                        }
                        
                        $('#submit_claim').text('Submit')
                    },
                    error: function(){
                        makeNotif('error', 'Tidak dapat mengakses server', 'bottomRight')
                        $('#submit_claim').text('Submit')
                    }
                })
            })
        }

        var pilihPoin = () => {
            $('#content_poin').on('click', '.pilih', function(){
                var obj = {
                    id_poin: $(this).data('id'),
                    claim_poin: $(this).data('poin'),
                    departure: $(this).data('id_dep'),
                    departure_name: $(this).data('dep'),
                    arrival: $(this).data('id_arr'),
                    arrival_name: $(this).data('arr')
                }

                UI.renderRow(obj);

                $('#modal_poin').modal('hide');
                $('#departure').val('').selectpicker('refresh');
                $('#arrival').val('').selectpicker('refresh');
                $('#content_poin').html('');
            })
        }

        var removeRow = () => {
            $(document).on('click', '.remove', function(){
                var id = $(this).data('id');

                $('#poin_'+id).remove();
            })
        }
        
        return {
            init: () => {
                openModal();
                getRoute();
                submitCari();
                pilihPoin();
                submitClaim();
                removeRow();
            }
        }
    })(renderUI);

    $(document).ready(function(){
        claimController.init();
    })
</script>
