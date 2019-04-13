<div class="row">
    <div class="page-header">
      <div class="d-flex align-items-center">
          <h2 class="page-header-title">Dashboard</h2>
          <div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item active"><i class="ti ti-home"></i> Dashboard</li>
            </ul>
          </div>
      </div>
    </div>
</div>

<div class="row row-flex">
  <div class="col-md-6">
    <div class="widget widget-17 has-shadow">
        <div class="widget-body">
            <div class="row">
                <div class="col-md-7 col-7 d-flex flex-column justify-content-center align-items-center">
                    <div class="counter" id="count_log">0</div>
                    <div class="total-visitors">Total Log</div>
                </div>
                <div class="col-md-5 col-5 d-flex justify-content-center align-items-center">
                    <div class="visitors">
                        <div class="percent"><i class="la la-recycle" style="font-size: 75px"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="widget widget-17 has-shadow">
        <div class="widget-body">
            <div class="row">
                <div class="col-md-7 col-7 d-flex flex-column justify-content-center align-items-center">
                    <div class="counter" id="count_user">0</div>
                    <div class="total-visitors">Total User</div>
                </div>
                <div class="col-md-5 col-5 d-flex justify-content-center align-items-center">
                    <div class="visitors">
                        <div class="percent"><i class="la la-user" style="font-size: 75px"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

<div class="row row-flex">
  <div class="col-md-6">
    <div class="widget has-shadow">
        <div class="widget-header bordered no-actions d-flex align-items-center">
            <h4>Log Activities</h4>
        </div>
        <div class="widget-body">
          <canvas id="logChart" height="180"></canvas>
        </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="widget has-shadow">
        <div class="widget-header bordered no-actions d-flex align-items-center">
            <h4>User Classified</h4>
        </div>
        <div class="widget-body">
          <canvas id="userChart" height="180"></canvas>
        </div>
    </div>
  </div>
</div>

<script type="text/javascript">

  $(document).ready(function(){

    var userChart = new Chart(document.getElementById('userChart').getContext('2d'),{
      type : 'doughnut',
      data : {
        labels : [],
        datasets: [{
          data : [],
          backgroundColor: [
            "#17a2b8",
            "#28a745",
            "#ffc107",
          ]
        }],
      },

      options : {
        legend : {
          display : true,
        },
        responsive : true,
        tooltips: {
          enabled: true,
        }
      }
    })

    var logChart = new Chart(document.getElementById('logChart').getContext('2d'),{
    type: 'line',
    data: {
      labels:[
        'Jan',
        'Feb',
        'Mar',
        'Apr',
        'May',
        'Jun',
        'Jul',
        'Aug',
        'Sep',
        'Oct',
        'Nov',
        'Dec',
      ],
      datasets:[{
        label: 'Log by month',
        data: [],
        borderColor: "rgba(0, 176, 228, 0.75)",
        backgroundColor: "transparent",
        pointBorderColor: "rgba(0, 176, 228, 0)",
        pointBackgroundColor: "rgba(0, 176, 228, 0.9)",
        pointBorderWidth: 1,
      }],
    },
    options:{
      responsive : true,
      legend : {
        display : true,
      },
    },
  });

    $.ajax({
      url: `<?= base_url('api/log/statistic/') ?>${auth.token}`,
      type: 'GET',
      dataType: 'JSON',
      success: function(response){
        $.each(response.data.log_by_month, function(k, v){
          logChart.data.datasets[0].data.push(v);
        });
        $('#count_log').text(response.data.total_log);
        logChart.update();
      }
    });

    $.ajax({
      url: `<?= base_url('api/user/statistic/') ?>${auth.token}`,
      type: 'GET',
      dataType: 'JSON',
      success: function(response){
        var total = 0;
        $.each(response.data, function(k, v){
          userChart.data.labels.push(v.level);
          userChart.data.datasets[0].data.push(v.jml_user);

          total += parseInt(v.jml_user);
        });
        $('#count_user').text(total);
        userChart.update();
      }
    })

  })
</script>
