var DOM = {
    register: '#form_register',
    login: '#form_login',
    pass: '#form_pass',
    wizard: '#rootwizard',
    submit_register: '#submit_register',
    kode: '#kirim_kode',
    check_pass: '#checkbox-password',
    show_fp: '#forgot_password',
    hide_fp: '#btm_cancel',
}

var setupAuthPage = (function () {

    var makeNotif = function (type, message, position) {
        new Noty({
            type: type,
            layout: position,
            text: message,
            progressBar: true,
            timeout: 5000,
            animation: {
                open: "animated bounceInRight",
                close: "animated bounceOutRight"
            }
        }).show();
    }

    var setupWizard = function () {
        $(DOM.wizard).bootstrapWizard({
            onTabShow: function (tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index + 1;
                var $percent = ($current / $total) * 100;
                $('#rootwizard .progressbar').css({
                    width: $percent + '%'
                });
            },
            onNext: function (tab, navigation, index) {
                var valid = $(DOM.register).valid();

                if (!valid) {
                    // $validator.focusInvalid();
                    return false;
                }
            }

        });
    }

    var setupFile = function () {
        $(document).on('change', ':file', function () {
            var input = $(this),
                numFiles = input.get(0).files ? input.get(0).files.length : 1,
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [numFiles, label]);
        });

        $(document).ready(function () {
            $(':file').on('fileselect', function (event, numFiles, label) {

                var input = $(this).parents('.input-group').find(':text'),
                    log = numFiles > 1 ? numFiles + ' files selected' : label;

                if (input.length) {
                    input.val(log);
                } else {
                    if (log) alert(log);
                }

            });
        });
    }

    var setupShowPass = function () {
        $(DOM.check_pass).click(function () {
            if ($(this).is(':checked')) {
                $('#password').attr('type', 'text');
            } else {
                $('#password').attr('type', 'password');
            };
        });
    }

    var setupForgotPass = function () {
        $(DOM.show_fp).on('click', function () {
            $('#form_forgot_pass').show('slow', function () {
                $('#email_customer').focus()
            });
        });
    }

    var hideFormPassword = function () {
        $('#btn_cancel').on('click', function () {
            $('#form_forgot_pass').hide('slow')
        });
    }

    var getKode = function () {
        $(DOM.kode).on('click', function () {
            var email = $('#email').val();

            if (email === '') {
                makeNotif('error', 'Email harus diisi terlebih dahulu', 'bottomRight')
            } else {
                $.ajax({
                    url: `${BASE_URL}ext/auth/send_verify`,
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        email: email
                    },
                    beforeSend: function () {
                        $(this).addClass('disabled').html(`<i class="fa fa-spinner fa-spin"></i>`)
                    },
                    success: function (response) {
                        if (response.status === 200) {
                            makeNotif('success', response.message, 'bottomRight')
                        } else {
                            makeNotif('error', response.message, 'bottomRight')
                            $(this).removeClass('disabled').html(`Kirim`)
                        }

                    },
                    error: function (err) {
                        makeNotif('error', 'Tidak dapat mengakases server', 'bottomRight')
                        $(this).removeClass('disabled').html(`Kirim`)

                    }

                })
            }
        });
    }

    var submitLogin = function () {
        $(DOM.login).on('submit', function (e) {
            e.preventDefault();

            var no_member = $('#no_member').val();
            var password = $('#password').val();

            if (no_member === '' || password === '') {
                makeNotif('error', 'No Member atau password harus diisi', 'bottomRight')
            } else {
                $.ajax({
                    url: `${BASE_URL}ext/auth/login_member`,
                    type: 'POST',
                    dataType: 'JSON',
                    data: $(this).serialize(),
                    beforeSend: function () {
                        $('#submit_login').addClass('disabled').html('<i class="fa fa-spin fa-circle-o-notch"></i>');
                    },
                    success: function (response) {
                        if (response.status === 200) {
                            localStorage.setItem('ext_lion', JSON.stringify(response.data));
                            window.location.replace(`${BASE_URL}main/`)
                        } else {
                            makeNotif('error', response.message, 'bottomRight');
                            $('#submit_login').removeClass('disabled').html('Log In');
                        }

                    },
                    error: function (err) {
                        makeNotif('error', 'Tidak dapat mengakses server', 'bottomRight');
                        $('#submit_login').removeClass('disabled').html('Log In');

                    }
                })
            }
        });
    }

    var submitForgotPass = function () {
        $(DOM.pass).on('submit', function (e) {
            e.preventDefault();

            var email = $('#email_forgot').val();

            if (email === '') {
                makeNotif('error', 'Email harus diisi', 'bottomRight')
            } else {
                $.ajax({
                    url: `${BASE_URL}ext/auth/lupa_password`,
                    type: 'POST',
                    dataType: 'JSON',
                    data: $(this).serialize(),
                    beforeSend: function () {
                        $('#send_pass').addClass('disabled').html('<i class="fa fa-spin fa-circle-o-notch"></i>');;
                    },
                    success: function (response) {
                        if (response.status === 200) {
                            makeNotif('success', response.message, 'bottomRight');
                        } else {
                            makeNotif('error', response.message, 'bottomRight');
                        }
                        $('#send_pass').removeClass('disabled').html('Kirim');

                    },
                    error: function () {
                        makeNotif('error', 'Tidak dapat mengakses server', 'bottomRight');
                        $('#send_pass').removeClass('disabled').html('Kirim');
                    }
                })
            }
        });
    }

    var submitRegister = function () {
        $(DOM.register).validate({
            rules: {
                gender: "required",
                nama: "required",
                alamat: "required",
                kota: "required",
                kode_pos: "required",
                no_handphone: "required",
                kebangsaan: "required",
                no_identitas: "required",
                email: "required",
                alamat_surat: "required",
                kode_verifikasi: "required",
                select_file: "required"
            },
            messages: {
                gender: "This Field is required",
                nama: "This Field is required",
                alamat: "This Field is required",
                kota: "This Field is required",
                kode_pos: "This Field is required",
                no_handphone: "This Field is required",
                kebangsaan: "This Field is required",
                no_identitas: "This Field is required",
                email: "This Field is required",
                alamat_surat: "This Field is required",
                kode_verifikasi: "This Field is required",
                select_file: "This Field is required"
            },
            success: function (error, element) {
                $(element).removeClass('is-invalid');
            },
            errorPlacement: function (error, element) {
                var name = $(element).attr("id");

                $(element).addClass('is-invalid');
                $('#invalid-' + name).text(error.text());
            },
            submitHandler: function (form) {
                $.ajax({
                    url: `${BASE_URL}ext/auth/register_customer`,
                    type: 'POST',
                    dataType: 'JSON',
                    data: new FormData(form),
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $('#submit_regis').addClass('disabled').html(`<i class="fa fa-spinner fa-spin"></i>`)
                    },
                    success: function (response) {
                        if (response.status === 200) {
                            $('.switch').click()
                            $('#form_register')[0].reset()
                            makeNotif('success', response.message, 'bottomRight')
                            $('form fieldset:first').show();
                            $('form fieldset:last').hide();
                            $('.form-wizard').removeClass('active').removeClass('activated')
                            $('.form-wizard:first').addClass('active')

                        } else {
                            makeNotif('error', response.message, 'bottomRight')
                        }
                        $('#submit_regis').removeClass('disabled').html(`Submit`)

                    },
                    error: function (err) {
                        makeNotif('error', 'Tidak dapat mengakases server', 'bottomRight')
                        $('#submit_regis').removeClass('disabled').html(`Submit`)
                        $('form fieldset:last').show();
                        console.log(err)
                    }

                })
            }
        })
    }

    var loginWithFB = (email) => {
        $.ajax({
            url: `${BASE_URL}ext/auth/login_fb`,
            type: 'POST',
            dataType: 'JSON',
            data: {email: email},
            success: function (res) {
                if (res.status === 200) {
                    localStorage.setItem('ext_lion', JSON.stringify(res.data));
                    window.location.replace(`${BASE_URL}main/`)
                } else {
                    FB.logout();
                    makeNotif('error', res.message, 'bottomRight');
                }

            },
            error: function (err) {
                FB.logout();
                makeNotif('error', 'Tidak dapat mengakses server', 'bottomRight');
            }
        })
    }

    var getFbUserData = function(){
        FB.api('/me', { locale: 'en_US', fields: 'id,first_name,last_name,email,link,gender,locale,picture' },
            function(response){
                loginWithFB(response.email)
            }
        );
    }

    var getAuth = function(response){
        if (response.authResponse) {
            getFbUserData();
        } else {
            makeNotif('error', 'Anda membatalkan login dengan facebook', 'bottomRight')
        }
    }

    var facebookAuth = function(){
        $('#btn_facebook').on('click', function () {
            FB.login(getAuth, {scope: 'email'})
        })
    }

    var facebookInit = function(){
            $.ajaxSetup({ cache: true });
            $.getScript('https://connect.facebook.net/en_US/sdk.js', function () {
                FB.init({
                    appId: '367278160632509',
                    version: 'v4.0'
                });

                facebookAuth();
            });
    }

    return {
        init: function () {
            console.log('App is running');
            facebookInit();
            setupWizard();
            setupShowPass();
            setupForgotPass();
            getKode();
            submitRegister();
            submitForgotPass();
            submitLogin();
            setupFile();
            hideFormPassword();
        }
    }
})();

$(document).ready(function () {
    setupAuthPage.init();
})