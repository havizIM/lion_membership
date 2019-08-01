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
<div class="col-xl-9 column">

</div>

<script>

    var renderUI = (() => {
        return {
            renderProfile: (data) => {
                console.log(data)

                var html = '';

                if(data.length === 0){
                    html += `
                    
                    `
                } else {
                    $.each(data, function(k, v){
                        html += `
                        
                        `
                    })
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
