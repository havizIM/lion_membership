<!DOCTYPE html>
<!--
Item Name: Elisyam - Web App & Admin Dashboard Template
Version: 1.5
Author: SAEROX

** A license must be purchased in order to legally use this template for your project **
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>LPS Member - Login</title>
  <meta name="description" content="Elisyam is a Web App and Admin Dashboard Template built with Bootstrap 4">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Google Fonts -->
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
  <script>
    WebFont.load({
      google: {
        "families": ["Montserrat:400,500,600,700", "Noto+Sans:400,700"]
      },
      active: function () {
        sessionStorage.fonts = true;
      }
    });
  </script>
   <!-- Favicon -->
  <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() ?>assets/img/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>assets/img/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>assets/img/favicon/favicon-16x16.png">
  <!-- Stylesheet -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/css/base/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/css/base/elisyam-1.5.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/animate/animate.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/css/style-wizard.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
    integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

  <!-- Tweaks for older IEs-->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
<style>
  .bg-whites{
     /*this is just positional stuff*/
  margin:0;
  padding:0;
  position: absolute;
  top: 0;
  left:0;
  bottom: 0;
  width: 100%;  
  /*use multiple background-images first is highest z-order*/
  background-image: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/239518/birds1.svg"), url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/239518/birds2.svg"), url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/239518/clouds.svg"), linear-gradient(to bottom,  rgba(255,255,255,0), 40%,rgba(255,255,255,1) 60%), url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/239518/BG2.svg");
  background-size: 20%, 20%, 100%, 100%, 50px;
  background-repeat: no-repeat, no-repeat, no-repeat, repeat-x,repeat;
  background-position: 5% 40%, 95% 60%, center bottom;
  }

  .form-control.new-form{
    background-color: transparent;
    border: none;
    border-bottom: 1px solid #000000;
    border-radius: 0px;
  }

  .form-control.new-form:focus{
     border-bottom: 2px solid #5bc0de !important;
     box-shadow: 0 0 0 0.2rem transparent;
  }
  input[type="number"]::-webkit-outer-spin-button, input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }
  
  input[type="number"] {
      -moz-appearance: textfield;
  }
</style>

</head>

<body class="bg-white">
  <!-- Begin Preloader -->
  <div id="preloader">
      <div class="canvas">
          <img src="<?= base_url() ?>assets/img/logo-lion-2.png" alt="logo" class="loader-logo">
          <div class="spinner"></div>
      </div>
  </div>
  <!-- End Preloader -->
  <!-- Begin Container -->
  <div class="container-fluid no-padding h-100">
    <div class="row flex-row h-100 bg-whites">
      <!-- Begin Left Content -->
      <div class="col-xl-3 col-lg-5 col-md-5 col-sm-12 col-12 no-padding">
        <div class="elisyam-bg background-03" style="opacity:0.7;">
          <div class="elisyam-overlay" style="background: linear-gradient(135deg,#405be0 0%,rgba(152, 137, 156, 0) 100%);"></div>
          <div class="authentication-col-content-2 mx-auto text-center">
             <div class="logo-centered">
                <a href="db-default.html">
                    <img src="<?= base_url() ?>assets/img/logo-lion-2.png" alt="logo">
                </a>
            </div>
            <h1>Lion Passport System</h1>
            <span class="description">
                Sistem Informasi Pengelolaan Poin Membership
            </span>
            <ul class="login-nav nav nav-tabs mt-5 justify-content-center" role="tablist" id="animate-tab">
              <li><a class="active switch" data-toggle="tab" href="#singin" role="tab" id="singin-tab" data-easein="zoomInUp" i>Sign In</a></li>
              <li><a data-toggle="tab" href="#signup" role="tab" id="signup-tab" data-easein="zoomInRight">Sign Up</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- End Left Content -->
      <!-- Begin Right Content -->
      <div class="col-xl-9 col-lg-7 col-md-7 col-sm-12 col-12 my-auto no-padding">
        <!-- Begin Form -->
        <div class="authentication-form-2 mx-auto">
          <div class="tab-content" id="animate-tab-content">
            <!-- Begin Sign In -->
            <div role="tabpanel" class="tab-pane show active" id="singin" aria-labelledby="singin-tab">
              <h3>Sign In To LPS</h3>
              <form id="form_login_member">
                  <div class="group material-input">
                    <input type="text" name="no_member" id="no_member" style="background: transparent;">
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>No. Member</label>
                  </div>
                  <div class="group material-input">
                    <input type="password" name="password" id="password" style="background: transparent;">
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Password</label>
                  </div>
                
                  <div class="row">
                    <div class="col text-left">
                      <div class="styled-checkbox">
                        <input type="checkbox" name="checkbox" id="checkbox-password">
                        <label for="checkbox-password">Show Password</label>
                      </div>
                    </div>
                    <div class="col text-right">
                      <a id="forgot_password" style="cursor: pointer;">Forgot Password ?</a>
                    </div>
                  </div>
                  <div class="sign-btn text-center">
                    <button type="submit" class="btn btn-lg btn-gradient-01" id="submit_login">
                      Sign In
                    </button>
                  </div>
              </form>
              <form id="form_forgot_pass" style="margin-top: 50px; display:none ">
                  <div class="group material-input">
                      <input type="email" name="email_customer" id="email_customer" style="background: transparent;">
                          <span class="highlight"></span>
                          <span class="bar"></span>
                      <label>Email Customer</label>
                      <small>
                       Kami akan mengirimkan password baru ke email anda
                      </small>
                  </div>

                    <div class="form-group m-t-40" style="float: right">
                    <div class="col-xs-12">
                      <button type="button" class="btn btn-danger ripple mr-1 mb-2" type="submit" id="btn_cancel" name="btn_cancel">Cancel</button>
                      <button type="submit" class="btn btn-info ripple mr-1 mb-2" type="submit" id="btn_forgot_pass" name="btn_forgot_pass">Send</button>
                    </div>
                  </div>
              </form>  
            </div>
            <!-- End Sign In -->
            
            <!-- Begin Sign Up -->
            <div role="tabpanel" class="tab-pane" id="signup" aria-labelledby="signup-tab">
              <h3>Create An Account</h3>
              <div class="card-body wizard-content">
                <form id="form_register" class="" enctype="multipart/form-data">

                  <div class="wizards" style="padding-bottom: 20px;">
                    <div class="progressbar">
                      <div class="progress-line" data-number-of-steps="3">
                      </div>
                    </div>
                    <div class="form-wizard active">
                      <div class="wizard-icon"><i class="fa fa-user"></i></div>
                      <p class="text-center">Data Pribadi</p>
                    </div>
                    <div class="form-wizard">
                      <div class="wizard-icon"><i class="fa fa-key"></i></div>
                      <p class="text-center">Data Pekerjaan</p>
                    </div>
                    <div class="form-wizard">
                      <div class="wizard-icon"><i class="fa fa-globe"></i></div>
                      <p class="text-center">Lain-lain</p>
                    </div>
                  </div>

                  <fieldset>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleFormControlSelect1">Gender</label>
                              <select class="form-control new-form" id="gender" name="gender">
                                <option value="">-</option>
                                <option value="Mr">Mr</option>
                                <option value="Mrs">Mrs</option>
                                <option value="Ms">Ms</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-8">
                            <div class="form-group">
                              <label>Nama</label>
                              <input class="form-control new-form" type="text" name="nama" id="nama">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleFormControlSelect1">Kebangsaan</label>
                              <select class="form-control new-form" id="kebangsaan" name="kebangsaan">
                                <option value="">-</option>
                                <option value="WNI">WNI</option>
                                <option value="WNA">WNA</option>
                              </select>
                            </div>

                          </div>
                          <div class="col-md-8">
                            <div class="form-group">
                              <label>No Identitas</label>
                              <input class="form-control new-form" type="text" name="no_identitas" id="no_identitas">
                            </div>
                          </div>
                        </div>
                      </div>


                      <div class="col-md-4">
                        <div class="form-group">
                          <label>No. Handphone</label>
                          <input class="form-control new-form" type="number" name="no_handphone" id="no_handphone">
                        </div>
                      </div>
                      <div class="col-md-8">
                        <div class="form-group">
                          <label>Email</label>
                          <input class="form-control new-form" type="email" name="email" id="email">
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="col-lg-1 form-control-label d-flex justify-content-lg-end"
                            style="margin-left: 10px;">Alamat</label>
                          <textarea rows="5" cols="20" class="form-control new-form" placeholder="Silahkan isi alamat dengan lengkap" id="alamat" name="alamat"></textarea>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Kota</label>
                              <input class="form-control new-form" type="text" name="kota" id="kota">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Kode Pos</label>
                              <input class="form-control new-form" type="text" name="kode_pos" id="kode_pos">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="wizard-buttons">
                      <button type="button" class="btn btn-next btn-style">Next</button>
                    </div>
                  </fieldset>

                  <fieldset>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Nama Perusahaan</label>
                          <input class="form-control new-form" name="nama_perusahaan" id="nama_perusahaan">
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Jabatan</label>
                              <input class="form-control new-form" type="text" name="jabatan" id="jabatan">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Bidang Usaha</label>
                              <input class="form-control new-form" type="text" name="bidang_usaha" id="bidang_usaha">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Telepon</label>
                              <input class="form-control new-form" type="text" name="no_tlp" id="no_tlp">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Fax</label>
                              <input class="form-control new-form" type="text" name="no_fax" id="no_fax">
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-8">
                            <label>Email Perusahaan</label>
                            <input class="form-control new-form" type="text" name="email_perusahaan" id="email_perusahaan">
                          </div>

                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleFormControlSelect1">Alamat Surat</label>
                              <select class="form-control new-form" id="alamat_surat" name="alamat_surat">
                                <option value="">-</option>
                                <option value="Rumah">Rumah</option>
                                <option value="Kantor">Kantor</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Alamat Perusahaan</label>
                          <textarea rows="5" cols="20" class="form-control new-form"
                            placeholder="Silahkan isi alamat dengan lengkap" id="alamat_perusahaan"
                            name="alamat_perusahaan"></textarea>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Kota</label>
                              <input class="form-control new-form" type="text" name="kota_perusahaan" id="kota_perusahaan">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Kode Pos</label>
                              <input class="form-control new-form" type="text" name="kode_pos_perusahaan"
                                id="kode_pos_perusahaan">
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>

                    <div class="wizard-buttons" style="float: right !important;">
                      <button type="button" class="btn btn-previous">Previous</button>
                      <button type="button" class="btn btn-next btn-style">Next</button>
                    </div>
                  </fieldset>

                  <fieldset>
                    <div class="row">
                      <div class="col-lg-12" style="margin-bottom: 20px;">
                        <div class="form-group">
                          <label>Kode Verifikasi</label>
                          <div class="input-group">
                            <input type="text" class="form-control new-form" id="kode_verifikasi" name="kode_verifikasi">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-primary ripple" id="kirim_kode">
                                Kirim
                              </button>
                            </span>
                          </div>
                          <small>
                            Silahkan tekan tombol <b>kirim</b> untuk mendapat kode verifikasi lewat email
                          </small>
                        </div>
                      </div>

                      <div class="col-lg-12 col-sm-12 col-12">
                        <div class="form-group">
                          <label class="m-b-10">Daftar Lampiran</label>
                          <div class="input-group">
                            <input type="text" class="form-control new-form" readonly style="height: 44px;">
                            <label class="input-group-btn">
                              <span class="btn btn-primary">
                                Browse&hellip; <input type="file" style="display: none;" id="lampiran_daftar"
                                  name="lampiran_daftar" multiple>
                              </span>
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>


                    <div class="wizard-buttons" style="float: right !important;">
                      <button type="button" class="btn btn-previous">Previous</button>
                      <button type="submit" class="btn btn-style" id="submit_regis">Submit</button>
                    </div>
                  </fieldset>
                </form>
              </div>
            </div>
            <!-- End Sign Up -->
          </div>
        </div>
        <!-- End Form -->
      </div>
      <!-- End Right Content -->
    </div>
    <!-- End Row -->
  </div>
  <!-- End Container -->
  <script type="text/javascript">
    var BASE_URL = '<?= base_url() ?>'
  </script>
  <!-- Begin Vendor Js -->
  <script src="<?= base_url() ?>assets/vendors/js/base/jquery.min.js"></script>
  <script src="<?= base_url() ?>assets/vendors/js/base/core.min.js"></script>
  <!-- End Vendor Js -->
  <!-- Begin Page Vendor Js -->
  <script src="<?= base_url() ?>assets/vendors/js/app/app.min.js"></script>
  <!-- End Page Vendor Js -->
  <!-- Begin Page Snippets -->
  <script src="<?= base_url() ?>assets/js/components/tabs/animated-tabs.min.js"></script>
  <script src="<?= base_url() ?>assets/js/components/wizard/jquery.steps.min.js"></script>
  <!-- End Page Snippets -->
  <script src="<?= base_url() ?>assets/vendors/js/noty/noty.min.js"></script>
  <script src="<?= base_url('public/auth.js') ?>"></script>
</body>

</html>