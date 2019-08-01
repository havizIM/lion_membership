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
                <div class="tab-pane fade show active" id="i-d-tab-1" role="tabpanel" aria-labelledby="i-drop-tab-1">
                    Nam sagittis nec velit vitae molestie. Donec eget luctus sem. Nullam tortor tortor, consequat id lacinia nec, tempus in diam. Phasellus vel molestie purus, ac hendrerit risus. Phasellus non purus lacinia purus fringilla hendrerit. Sed pharetra odio a ante volutpat aliquam id non lacus.
                </div>
                <div class="tab-pane fade" id="i-d-tab-2" role="tabpanel" aria-labelledby="i-drop-tab-2">
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
                var html = '';

                if(data.length === 0){
                    html += `
                    
                    `
                } else {
                    html += `
                    
                    `
                }
            },
            renderRedeem: (data) => {
                var html = '';
                
                if(data.length === 0){
                     html += `
                    
                    `
                } else {
                     html += `
                    
                    `
                }
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
        
        return {
            init: () => {
                getClaim();
                getRedeem();
            }
        }
    })(renderUI);

    $(document).ready(function(){
        riwayatController.init();
    })
</script>
