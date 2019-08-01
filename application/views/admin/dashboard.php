<div class="jumbotron jumbotron-fluid d-flex justify-content-center align-items-center text-center faq">
  <div class="container">
    <h1 style="letter-spacing: 25px; text-transform:uppercase;"><strong><span style="color:red;">Selamat</span> datang</strong></h1>
    <div class="searchbox">
      <input type="text" class="mt-4 text-center" placeholder="Lion Passport Club" readonly>
    </div>
  </div>
</div>

<div class="row row-flex" style="margin-bottom:15%;">
  <div class="col-md-3">
    <div class="widget widget-17 has-shadow">
        <div class="widget-body">
            <div class="row">
                <div class="col-md-7 col-7 d-flex flex-column justify-content-center align-items-center">
                    <div class="counter" id="data1">0</div>
                    <div class="total-visitors">Total Data Rute</div>
                </div>
                <div class="col-md-5 col-5 d-flex justify-content-center align-items-center">
                    <div class="visitors">
                        <div class="percent"><i class="la la-map text-danger" style="font-size: 75px"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="widget widget-17 has-shadow">
        <div class="widget-body">
            <div class="row">
                <div class="col-md-7 col-7 d-flex flex-column justify-content-center align-items-center">
                    <div class="counter" id="data2">0</div>
                    <div class="total-visitors">Total Data Point</div>
                </div>
                <div class="col-md-5 col-5 d-flex justify-content-center align-items-center">
                    <div class="visitors">
                        <div class="percent"><i class="la la-circle-o text-warning" style="font-size: 75px"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="widget widget-17 has-shadow">
        <div class="widget-body">
            <div class="row">
                <div class="col-md-7 col-7 d-flex flex-column justify-content-center align-items-center">
                    <div class="counter" id="data3">0</div>
                    <div class="total-visitors" style="font-size:13px; padding-bottom:5px">Total Data Aplication</div>
                </div>
                <div class="col-md-5 col-5 d-flex justify-content-center align-items-center">
                    <div class="visitors">
                        <div class="percent"><i class="la la-puzzle-piece text-info" style="font-size: 75px"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="widget widget-17 has-shadow">
        <div class="widget-body">
            <div class="row">
                <div class="col-md-7 col-7 d-flex flex-column justify-content-center align-items-center">
                    <div class="counter" id="data4">0</div>
                    <div class="total-visitors" style="font-size:13px;">Total Data Member</div>
                </div>
                <div class="col-md-5 col-5 d-flex justify-content-center align-items-center">
                    <div class="visitors">
                        <div class="percent"><i class="la la-user text-success" style="font-size: 75px"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>

</div>


<script type="text/javascript">
  $(document).ready(function() {
    var session = localStorage.getItem('lion_membership');
    var auth = JSON.parse(session);
    var token = auth.token


    var data1 = `<?= base_url().'api/rute/show/' ?>${token}`
    var data2 = `<?= base_url().'api/poin/show/' ?>${token}`
    var data3 = `<?= base_url().'api/aplikasi/show/' ?>${token}`
    var data4 = `<?= base_url().'api/member/show/' ?>${token}`


    $.ajax({
      url: data1,
      type: 'GET',
      dataType: 'JSON',
      // data: {},
      // beforeSend:function(){},
      success:function(response){
        $('#data1').text(response.data.length)
      },
      error:function(){}
    });

    $.ajax({
      url: data2,
      type: 'GET',
      dataType: 'JSON',
      // data: {},
      // beforeSend:function(){},
      success:function(response){
        $('#data2').text(response.data.length)
      },
      error:function(){}
    });

    $.ajax({
      url: data3,
      type: 'GET',
      dataType: 'JSON',
      // data: {},
      // beforeSend:function(){},
      success:function(response){
        $('#data3').text(response.data.length)
      },
      error:function(){}
    });

    $.ajax({
      url: data4,
      type: 'GET',
      dataType: 'JSON',
      // data: {},
      // beforeSend:function(){},
      success:function(response){
        $('#data4').text(response.data.length)
      },
      error:function(){}
    });

  });
</script>
