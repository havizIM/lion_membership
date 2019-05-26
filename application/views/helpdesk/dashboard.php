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
<script>
  var BASE_URL = '<?= base_url() ?>';
</script>
<script src="<?= base_url().'public/helpdesk/dashboard.js'?>"></script>
