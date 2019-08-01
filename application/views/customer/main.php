
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
        <title>Lion Passport Club</title>
        <meta name="description" content="Elisyam is a Web App and Admin Dashboard Template built with Bootstrap 4">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Google Fonts -->
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
        <script>
          WebFont.load({
            google: {"families":["Montserrat:400,500,600,700","Noto+Sans:400,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
        </script>
        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() ?>assets/img/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>assets/img/logo-lion-3.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>assets/img/logo-lion-3.png">
        <!-- Stylesheet -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/css/base/bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/css/base/elisyam-1.5.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap-select/bootstrap-select.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/animate/animate.min.css">
        <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
        <script type="text/javascript">
          var session = localStorage.getItem('ext_lion');
          var auth = JSON.parse(session);

          if(!session){
            window.location.replace(`<?= base_url() ?>auth`);
          }
        </script>

        <style>
          .db-social .jumbotron {
              margin: 0;
              background: url("<?= base_url() ?>assets/img/background-lion.jpg");
              background-repeat: no-repeat;
              background-attachment: fixed;
              background-size: cover;
              background-position: bottom center;
              color: #fff!important;
              height: 300px;
              position: relative;
              box-shadow: inset 0 0 20px rgba(0,0,0,.3);
              padding: 0;
          }
        </style>
    </head>
    <body id="page-top">

        <div id="preloader">
            <div class="canvas">
                <img src="<?= base_url() ?>assets/img/logo-lion-3.png" alt="logo" class="loader-logo">
                <div class="spinner"></div>   
            </div>
        </div>

        <div class="page db-social">
            <header class="header">
                <nav class="navbar fixed-top">

                    <div class="navbar-holder d-flex align-items-center align-middle justify-content-between">
                        <div class="navbar-header">
                            <a href="db-social.html" class="navbar-brand">
                                <div class="brand-image brand-big">
                                    <img src="<?= base_url() ?>assets/img/logo-lion-1.png" alt="logo" style="" class="logo-big">
                                </div>
                                <div class="brand-image brand-small">
                                    <img src="<?= base_url() ?>assets/img/logo-lion-1.png" alt="logo" class="logo-small">
                                </div>
                            </a>
                        </div>
                        <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center pull-right">
                            <li class="nav-item"><a href="#off-canvas" class="open-sidebar"><i class="la la-ellipsis-h"></i></a></li>
                        </ul>
                    </div>
                </nav>
            </header>

            <div class="page-content d-flex align-items-stretch">
                <div class="content-inner compact active">
					<div class="jumbotron jumbotron-fluid"></div>
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-xl-11">
                                <div class="widget head-profile has-shadow">
                                    <div class="widget-body pb-0">
                                        <div class="row d-flex align-items-center">
                                            <div class="col-xl-4 col-md-4 d-flex justify-content-lg-start justify-content-md-start justify-content-center">
                                                <ul>
                                                    <li>
                                                        <div class="counter" id="total_claim">0</div>
                                                        <div class="heading">Claim</div>
                                                    </li>
                                                    <li>
                                                        <div class="counter"><h1 class="text-danger" id="total_poin">0</h1></div>
                                                        <div class="heading">Total Poin</div>
                                                    </li>
                                                    <li>
                                                        <div class="counter" id="total_redeem">0</div>
                                                        <div class="heading">Redeem</div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-xl-4 col-md-4 d-flex justify-content-center">
                                                <div class="image-default">
                                                    <img class="rounded-circle" src="<?= base_url() ?>assets/img/logo-lion-3.png" alt="...">
                                                </div>
                                                <div class="infos">
                                                    <h2 id="session_nama">-</h2>
                                                    <div class="location" id="session_no_member">-</div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-md-4 d-flex justify-content-lg-end justify-content-md-end justify-content-center">
                                                <div class="follow">
                                                    <button class="btn btn-gradient-01" id="logout"><i class="la la-check"></i>Logout</button>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="head-nav nav nav-tabs justify-content-center">
                                            <li><a class="active" href="#/home">Home</a></li>
                                            <li><a href="#/claim">Claim</a></li>
                                            <li><a href="#/redeem">Redeem</a></li>
                                            <li><a href="#/riwayat">Riwayat</a></li>
                                            <li><a href="#/log_poin">Log Poin</a></li>
                                            <li><a href="#/profile">Profile</a></li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="row" id="page_content">
                                    <!-- MY CONTENT -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <footer class="main-footer">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 d-flex align-items-center justify-content-xl-start justify-content-lg-start justify-content-md-start justify-content-center">
                                <p class="text-gradient-02">Design By Muliani</p>
                            </div>
                        </div>
                    </footer>

                    <a href="#" class="go-top"><i class="la la-arrow-up"></i></a>

                    <div class="off-sidebar from-right">
                        <div class="off-sidebar-container">
                            <header class="off-sidebar-header">
                               <ul class="button-nav nav nav-tabs mt-3 mb-3 ml-3" role="tablist" id="weather-tab">
                                  <li><a class="active">Change Password</a></li>
                              </ul>
                                <a href="#off-canvas" class="off-sidebar-close"></a>
                            </header>
                            <div class="off-sidebar-content offcanvas-scroll auto-scroll">
                              <form id="form_password">
                                <div class="form-group">
                                  <label for="">Recent Password</label>
                                  <input type="password" name="password_lama" id="password_lama" class="form-control">
                                </div>
                                <div class="form-group">
                                  <label for="">New Password</label>
                                  <input type="password" name="password_baru" id="password_baru" class="form-control">
                                </div>
                                <div class="form-group">
                                  <label for="">Retype Password</label>
                                  <input type="password" id="retype_baru" class="form-control">
                                </div>
                                <div class="form-group" style="float: right">
                                  <input type="checkbox" id="show_pass">
                                  <label for="remeber">Show Password</label>
                                </div>
                                <button type="submit" id="btn_password" name="button" class="btn btn-info btn-block">Save Changes</button>
                              </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Begin Vendor Js -->
        <script src="<?= base_url() ?>assets/vendors/js/base/jquery.min.js"></script>
        <script src="<?= base_url() ?>assets/vendors/js/base/core.min.js"></script>
        <!-- End Vendor Js -->
        <!-- Begin Page Vendor Js -->
        <script src="<?= base_url() ?>assets/vendors/js/nicescroll/nicescroll.min.js"></script>
        <script src="<?= base_url() ?>assets/vendors/js/app/app.min.js"></script>
        
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <script src="<?= base_url() ?>assets/vendors/js/noty/noty.min.js"></script>
        <script src="<?= base_url() ?>assets/vendors/js/bootstrap-select/bootstrap-select.min.js"></script>
        <!-- End Page Vendor Js -->
        <script type="text/javascript">

          var makeNotif = (type, message, position) => {
            new Noty({
              type: type,
              layout: position,
              text: message,
              progressBar:true,
              timeout:2500,
              animation:{
                open:"animated bounceInRight",
                close:"animated bounceOutRight"
              }
            }).show();
          }

          var mainController = (() => {

            var loadContent = (link) => {
              $.get(`<?= base_url().'main/'?>${link}`,function(response){

                $('#page_content').html(response);
              });
            }

            var setupSession = () => {
              $('#session_no_member').text(auth.no_member);
              $('#session_nama').text(auth.nama);
              $('#session_email').text(auth.email);
            }

            var hashChange = () => {
              if (location.hash) {
                link = location.hash.substr(2);
                loadContent(link);
              }else {
                location.hash ='#/home';
              }

              $(window).on('hashchange',function(){
                link = location.hash.substr(2);
                loadContent(link);
              });
            }

            var showPass = () => {
              $('#show_pass').click(function(){
                if($(this).is(':checked')){
                  $('#password_lama').attr('type','text');
                  $('#password_baru').attr('type','text');
                  $('#retype_baru').attr('type','text');
                }else{
                  $('#password_lama').attr('type','password');
                  $('#password_baru').attr('type','password');
                  $('#retype_baru').attr('type','password');
                };
              });
            }

            var logoutAction = () => {
              $('#logout').on('click', function(){
                Swal.fire({
                  title: 'Are you sure to logout?',
                  text: "You need to login again!",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes',
                }).then((result) => {
                  if (result.value) {
                    $.ajax({
                      url: `<?= base_url() ?>ext/auth/logout_member/${auth.token}`,
                      type: 'GET',
                      dataType: 'JSON',
                      success: function(response){
                        if(response.status === 200){
                          localStorage.removeItem('ext_lion');
                          window.location.replace(`<?= base_url() ?>auth/`)
                        } else {
                          makeNotif('error', response.message, 'bottomRight');
                        }
                      },
                      error: function(){
                        makeNotif('error', 'Tidak dapat mengakses server', 'bottomRight');
                      }
                    })
                  }
                })
              });
            }

            var gantiPassword = () => {
              $('#form_password').on('submit', function(e){
                e.preventDefault();
                var password_lama = $('#password_lama').val();
                var password_baru = $('#password_baru').val();
                var retype_password = $('#retype_baru').val();

                if(password_lama === '' || password_baru === ''){
                  makeNotif('error', 'Silahkan isi form dengan lengkap', 'bottomRight')
                } else if(password_baru !== retype_password){
                  makeNotif('error', 'Password baru dan retype password harus sama', 'bottomRight')
                } else {
                  $.ajax({
                    url: `<?= base_url('ext/auth/password_member/') ?>${auth.token}`,
                    type: 'POST',
                    dataType: 'JSON',
                    data: $(this).serialize(),
                    beforeSend: function(){
                      $('#btn_password').addClass('disabled').html('<i class="la la-spinner animated infinite rotateOut"></i>');
                    },
                    success: function(response){
                      if(response.status === 200){
                        makeNotif('success', response.message, 'bottomRight');
                        $('#form_password')[0].reset();
                      } else {
                        makeNotif('error', response.message, 'bottomRight')
                      }
                      $('#btn_password').removeClass('disabled').html('Save Changes');
                    },
                    error: function(){
                      makeNotif('error', 'Tidak dapat mengakses server', 'bottomRight')
                    }
                  })
                }
              })
            }

            var getMyPoin = () => {
              $.ajax({
                url: `<?= base_url('ext/member/get_my_poin/') ?>${auth.token}`,
                type: 'GET',
                dataType: 'JSON',
                beforeSend: function(){
                    $('#total_claim').html('<i class="la la-spinner animated infinite rotateOut"></i>');
                    $('#total_redeem').html('<i class="la la-spinner animated infinite rotateOut"></i>');
                    $('#total_poin').html('<i class="la la-spinner animated infinite rotateOut"></i>');
                },
                success: function(res){
                    $('#total_claim').html(res.data.total_claim);
                    $('#total_redeem').html(res.data.total_redeem);
                    $('#total_poin').html(res.data.total_poin);
                },
                error: function(err){
                  $('#total_claim').html('<i class="la la-spinner animated infinite rotateOut"></i>');
                  $('#total_redeem').html('<i class="la la-spinner animated infinite rotateOut"></i>');
                  $('#total_poin').html('<i class="la la-spinner animated infinite rotateOut"></i>');

                  makeNotif('error', 'Tidak dapat mengakses server', 'bottomRight')
                }
              })
            }

            return {
              init: () => {
                getMyPoin();
                setupSession();
                hashChange();
                showPass();
                logoutAction();
                gantiPassword();
              }
            }
          })();

          $(document).ready(function(){
              mainController.init();
          });
        </script>
    </body>
</html>