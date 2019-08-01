
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
        <title>Manager | LPS</title>
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
        <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() ?>assets/img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>assets/img/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>assets/img/favicon/favicon-16x16.png">
        <!-- Stylesheet -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/css/base/bootstrap.min.css">
        <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/css/base/elisyam-1.5.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/animate/animate.min.css">

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.2/css/responsive.bootstrap4.min.css"/>

        <!-- <link rel="stylesheet" href="<?= base_url() ?>assets/css/datatables/datatables.min.css"> -->
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
        <script type="text/javascript">
          var session = localStorage.getItem('lion_membership');
          var auth = JSON.parse(session);

          if(!session){
            window.location.replace(`<?= base_url() ?>auth`);
          } else {
            if(auth.level !== 'manager'){
              window.location.replace(`<?= base_url() ?>${auth.level}/`);
            }
          }
        </script>
        <style>
             .default-sidebar>.side-navbar a .la-gift {
                color: #e7956c;
            }
            .default-sidebar>.side-navbar a .la-home {
                color: #1a9cfd;
            }

             .default-sidebar>.side-navbar a .la-tags {
                color: #e23f83;
            }

            .default-sidebar>.side-navbar a .ti-map-alt {
                color: #5cb85c;
            }

            .default-sidebar>.side-navbar a .la-file-text {
                color: #8e7ed0;
            }

            .default-sidebar>.side-navbar a .la-credit-card {
                color: #d6ac76;
            }
        </style>
    </head>
    <body id="page-top">
        <!-- Begin Preloader -->
        <div id="preloader">
            <div class="canvas">
                <img src="<?= base_url() ?>assets/img/logo-lion-2.png" alt="logo" class="loader-logo">
                <div class="spinner"></div>
            </div>
        </div>
        <!-- End Preloader -->
        <div class="page">
            <!-- Begin Header -->
            <header class="header">
                <nav class="navbar fixed-top">
                    <!-- Begin Topbar -->
                    <div class="navbar-holder d-flex align-items-center align-middle justify-content-between">
                        <!-- Begin Logo -->
                        <div class="navbar-header">
                            <a href="#/dashboard" class="navbar-brand">
                                <div class="brand-image brand-big">
                                    <img src="<?= base_url() ?>assets/img/logo-lion-1.png" alt="logo" class="logo-big">
                                </div>
                                <div class="brand-image brand-small">
                                    <img src="<?= base_url() ?>assets/img/logo-lion-3.png" alt="logo" class="logo-small">
                                </div>
                            </a>
                            <!-- Toggle Button -->
                            <a id="toggle-btn" href="#" class="menu-btn active">
                                <span></span>
                                <span></span>
                                <span></span>
                            </a>
                            <!-- End Toggle -->
                        </div>
                        <!-- End Logo -->
                        <!-- Begin Navbar Menu -->
                        <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center pull-right">
                            <!-- End Notifications -->
                            <!-- User -->
                            <li class="nav-item dropdown"><a id="notifications" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="la la-user animated infinite swing"></i></a>
                                <ul aria-labelledby="notifications" class="dropdown-menu notification">
                                    <li>
                                        <div class="notifications-header">
                                            <div class="title" id="session_name"></div>
                                            <div class="notifications-overlay"></div>
                                            <img src="<?= base_url() ?>assets/img/notifications/01.jpg" alt="..." class="img-fluid">
                                        </div>
                                    </li>
                                    <li>
                                        <a>
                                            <div class="message-icon">
                                                <i class="la la-user"></i>
                                            </div>
                                            <div class="message-body">
                                                <span class="date">NIP</span>
                                                <div class="message-body-heading" id="session_nip"></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <div class="message-icon">
                                                <i class="la la-user-plus"></i>
                                            </div>
                                            <div class="message-body">
                                                <span class="date">Level</span>
                                                <div class="message-body-heading" id="session_level"></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <div class="message-icon">
                                                <i class="la la-calendar-check-o"></i>
                                            </div>
                                            <div class="message-body">
                                                <span class="date">Tanggal Registrasi</span>
                                                <div class="message-body-heading" id="session_tgl"></div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- End Notifications -->
                            <li class="nav-item dropdown"><a id="user" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><img src="<?= base_url().'assets/user.jpg' ?>" alt="..." class="avatar rounded-circle"></a>
                                <ul aria-labelledby="user" class="user-size dropdown-menu">
                                    <li class="welcome">
                                        <a href="#" class="edit-profil"><i class="la la-gear"></i></a>
                                        <img src="<?= base_url().'assets/user.jpg' ?>" alt="..." class="rounded-circle">
                                    </li>
                                    <li><a rel="nofollow" class="dropdown-item logout text-center" style="cursor: pointer" id="logout"><i class="ti-power-off"></i></a></li>
                                </ul>
                            </li>
                            <!-- End User -->
                            <!-- Begin Quick Actions -->
                            <li class="nav-item"><a href="#off-canvas" class="open-sidebar"><i class="la la-lock"></i></a></li>
                            <!-- End Quick Actions -->
                        </ul>
                        <!-- End Navbar Menu -->
                    </div>
                    <!-- End Topbar -->
                </nav>
            </header>
            <!-- End Header -->
            <!-- Begin Page Content -->
            <div class="page-content d-flex align-items-stretch">
                <div class="default-sidebar">
                    <!-- Begin Side Navbar -->
                    <nav class="side-navbar box-scroll sidebar-scroll">
                        <!-- Begin Main Navigation -->
                        <ul class="list-unstyled">
                            <li><a href="#/dashboard"><i class="la la-home"></i><span>Dashboard</span></a></li>
                            <li><a href="#/point"><i class="la la-gift"></i><span>Point</span></a></li>
                            <li><a href="#/member"><i class="la la-credit-card"></i><span>Member</span></a></li>
                            <li><a href="#dropdown-app" aria-expanded="false" data-toggle="collapse"><i class="la la-puzzle-piece"></i><span>Laporan</span></a>
                                <ul id="dropdown-app" class="collapse list-unstyled pt-0">
                                    <li><a href="#/laporan_member">Laporan Member</a></li>
                                    <li><a href="#/laporan_claim">Laporan Claim</a></li>
                                    <li><a href="#/laporan_redeem">Laporan Redeem</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                    <!-- End Side Navbar -->
                </div>
                <!-- End Left Sidebar -->
                <div class="content-inner">
                    <div class="container-fluid" id="content">
                    </div>
                    <!-- End Container -->
                    <!-- Begin Page Footer-->
                    <footer class="main-footer">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 d-flex align-items-center justify-content-xl-start justify-content-lg-start justify-content-md-start justify-content-center">
                                <p class="text-gradient-02">Design By Muliani</p>
                            </div>
                        </div>
                    </footer>
                    <!-- End Page Footer -->
                    <a href="#" class="go-top"><i class="la la-arrow-up"></i></a>
                    <!-- Offcanvas Sidebar -->
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
                                  <label>Show Password</label>
                                </div>
                                <button type="submit" id="btn_password" name="button" class="btn btn-info btn-block">Save Changes</button>
                              </form>
                            </div>

                        </div>
                        <!-- End Offsidebar Container -->
                    </div>
                    <!-- End Offcanvas Sidebar -->
                </div>
            </div>
            <!-- End Page Content -->
        </div>
        <!-- Begin Vendor Js -->
        <script src="<?= base_url() ?>assets/vendors/js/base/jquery.min.js"></script>
        <script src="<?= base_url() ?>assets/vendors/js/base/core.min.js"></script>
        <!-- End Vendor Js -->
        <!-- Begin Page Vendor Js -->
        <script src="<?= base_url() ?>assets/vendors/js/nicescroll/nicescroll.min.js"></script>
        <script src="<?= base_url() ?>assets/vendors/js/app/app.min.js"></script>
        <script src="<?= base_url() ?>assets/vendors/js/noty/noty.min.js"></script>
        <script src="<?= base_url() ?>assets/vendors/js/moment/moment.js"></script>
        <script src="<?= base_url() ?>assets/js/jquery.PrintArea.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.2/js/dataTables.responsive.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.2/js/responsive.bootstrap4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

        <script type="text/javascript">
          function load_content(link) {
            $.get(`<?= base_url().'manager/'?>${link}`,function(response){

              $('#content').html(response);
            });
          };

          function makeNotif(type, message, position){
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

          $(document).ready(function(){
            var session = localStorage.getItem('lion_membership');
            var auth = JSON.parse(session);
            var link;

            <!-- Display Session -->
              $('#session_name').text(auth.nama_user);
              $('#session_nip').text(auth.nip);
              $('#session_level').text(auth.level);
              $('#session_tgl').text(auth.tgl_registrasi);
            <!-- End Display Session -->

            <!-- Load Halaman -->
            if (location.hash) {
              link = location.hash.substr(2);
              load_content(link);
            }else {
              location.hash ='#/dashboard';
            }

            $(window).on('hashchange',function(){
              link = location.hash.substr(2);
              load_content(link);
            });
            <!-- End Load Halaman -->

            <!-- Show Password -->
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
            <!-- End Show Password -->

            <!-- Logout Action -->
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
                    url: `<?= base_url() ?>api/auth/logout_user/${auth.token}`,
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(response){
                      if(response.status === 200){
                        localStorage.clear();
                        window.location.replace(`<?= base_url() ?>auth`)
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
            <!-- Logout Action -->

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
                  url: `<?= base_url('api/auth/password_user/') ?>${auth.token}`,
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
          });
        </script>
        <!-- End Page Vendor Js -->
    </body>
</html>
