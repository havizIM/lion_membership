<div class="col-xl-3 column">
    <div class="widget has-shadow">
        <div class="new-badge text-center">
            <div class="badge-img">
                <i class="la la-recycle"></i>
            </div>
            <div class="title">
                <div class="heading">Log Poin</div>
                <div class="text">Your history</div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-9 column">
    <div class="widget widget-11 has-shadow">
        <!-- Begin Widget Header -->
        <div class="widget-header bordered d-flex align-items-center">
            <h2>Your Poin History</h2>
        </div>

        <div class="widget-body p-0" style="max-height:450px;" id="content_log">
            <!-- LOG CONTENT -->
        </div>
        
    </div>
</div>

<script>

    var renderUI = (() => {
        return {
            renderPoin: (data) => {
                console.log(data)

                var html = '';

                if(data.length === 0){
                    html += `
                        
                    `
                } else {
                    $.each(data, function(k, v){
                        html += `
                            <div class="timeline ${v.type === 'claim' ? 'green' : 'red'}">
                                <div class="timeline-content d-flex align-items-center">
                                    <div class="timeline-icon">
                                        <h5>${v.type === 'claim' ? `<i class="la la-plus text-success"></i> ${v.claim_poin}` : `<i class="la la-minus text-danger"></i> ${v.redeem_poin}`}</h5>
                                    </div>
                                    <div class="d-flex flex-column mr-auto">
                                        <div class="title">
                                            ${v.departure} (${v.nama_departure}) - ${v.arrival} (${v.nama_arrival})
                                        </div>
                                        <div class="time">${v.tgl_log}</div>
                                    </div>
                                </div>
                            </div>
                        `
                    })
                }

                $('#content_log').html(html);
            }
        }
    })();

    var poinController = ((UI) => {
        var getPoin = () => {
            $.ajax({
                url: `<?= base_url('ext/member/log_poin/') ?>${auth.token}`,
                type: 'GET',
                dataType: 'JSON',
                success: function(res){
                    UI.renderPoin(res.data);
                },
                error: function(err){
                    makeNotif('error', 'Tidak dapat mengakses server', 'bottomRight')
                }
            })
        }

        var setupScroll = () => {
            $('#content_log').niceScroll();
        }

        return {
            init: () => {
                getPoin();
                setupScroll();
            }
        }
    })(renderUI);

    $(document).ready(function(){
        poinController.init();
    })

</script>
