function makeNotif(type, message, position) {
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

function scroll_to_class(element_class, removed_height) {
    var scroll_to = $(element_class).offset().top - removed_height;
    if ($(window).scrollTop() != scroll_to) {
        $('html, body').stop().animate({
            scrollTop: scroll_to
        }, 0);
    }
}

$(document).ready(function () {
    $('form fieldset:first').fadeIn('slow');

    $('form input[type="text"], input[type="date"], input[type="file"], input[type="number"], input[type="url"], input[type="password"],  input[type="email"],  input[type="tel"], form textarea, form select')
        .on('focus', function () {
            $(this).parent().removeClass('has-danger');
            $(this).removeClass('form-control-danger');
        });

    $('form .btn-next').on('click', function () {
        var parent_fieldset = $(this).parents('fieldset');
        var next_step = true;
        var current_active_step = $(this).parents('form').find('.form-wizard.active');

        parent_fieldset.find('input[type="text"], input[type="file"],  input[type="date"], input[type="number"], input[type="password"], input[type="email"], input[type="tel"], input[type="url"], textarea, select, input[type="hidden"]').each(function () {
            if ($(this).val() == "") {
                $(this).parent().addClass('has-danger');
                $(this).addClass('form-control-danger');
                next_step = false;
            } else {
                $(this).parent().removeClass('has-danger');
                $(this).removeClass('form-control-danger');
            }
        });

        if (next_step) {
            parent_fieldset.fadeOut(400, function () {
                current_active_step.removeClass('active').addClass('activated').next().addClass('active');
                $(this).next().fadeIn();
                scroll_to_class($('form'), 20);
            });
        }

    });

    // previous step
    $('form .btn-previous').on('click', function () {
        var current_active_step = $(this).parents('form').find('.form-wizard.active');

        $(this).parents('fieldset').fadeOut(400, function () {
            current_active_step.removeClass('active').prev().removeClass('activated').addClass('active');
            $(this).prev().fadeIn();
            scroll_to_class($('form'), 20);
        });
    });

    $('#form_register').on('submit', function (e) {
        e.preventDefault();


        $(this).find(
            'input[type="text"], input[type="date"], input[type="file"], input[type="number"], input[type="password"], input[type="email"], input[type="tel"], input[type="url"], textarea, select, input[type="hidden"]'
        ).each(function () {
            if ($(this).val() == "") {
                $(this).parent().addClass('has-danger');
                $(this).addClass('form-control-danger');
                makeNotif('warning', 'Masih ada field yang belum terisi', 'bottomRight')
            } else {
                $(this).parent().removeClass('has-danger');
                $(this).removeClass('form-control-danger');
            }
        });

        $.ajax({
            url: `${BASE_URL}api/auth/register_customer`,
            type: 'POST',
            dataType: 'JSON',
            data: new FormData(this),
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
                    $('form fieldset:last').show();
                }
                $('#submit_regis').removeClass('disabled').html(`Submit`)

            },
            error: function (err) {
                makeNotif('error', 'Tidak dapat mengakases server', 'bottomRight')
                $('#submit_regis').removeClass('disabled').html(`Submit`)
                $('form fieldset:last').show();
            }

        })
    });



    $('#kirim_kode').on('click', function () {
        var email = $('#email').val();

        if (email === '') {
            makeNotif('error', 'Email harus diisi terlebih dahulu', 'bottomRight')
        } else {
            $.ajax({
                url: `${BASE_URL}api/auth/send_verify`,
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

    // if(){

    // }else if(){

    // }else{

    // }

    //LOGIN EKSTERNAL
    $('#form_login_customer').on('submit', function (e) {
        e.preventDefault();

        var email = $('#email').val();
        var password = $('#password').val();

        if (email === '' || password === '') {
            makeNotif('error', 'Email atau password harus diisi', 'bottomCenter')
        } else {
            $.ajax({
                url: `${BASE_URL}api/auth/login_member`,
                type: 'POST',
                dataType: 'JSON',
                data: $(this).serialize(),
                beforeSend: function () {
                    $('#submit_login').addClass('disabled').html('<i class="fa fa-spin fa-circle-o-notch"></i>');
                },
                success: function (response) {
                    if (response.status === 200) {
                        localStorage.setItem('ext_bppt', JSON.stringify(response.data));
                        window.location.replace(`${BASE_URL}main/`)
                    } else {
                        makeNotif('error', response.message, 'bottomCenter');
                        $('#submit_login').removeClass('disabled').html('Log In');
                    }

                },
                error: function () {
                    makeNotif('error', 'Tidak dapat mengakses server', 'bottomCenter');
                    $('#submit_login').removeClass('disabled').html('Log In');
                }
            })
        }
    });



    $('#checkbox-password').click(function () {
        if ($(this).is(':checked')) {
            $('#password').attr('type', 'text');
        } else {
            $('#password').attr('type', 'password');
        };
    });

    $('#form_forgot_pass').on('submit', function (e) {
        e.preventDefault();

        var email = $('#email_forgot').val();

        if (email === '') {
            makeNotif('error', 'Email harus diisi', 'bottomCenter')
        } else {
            $.ajax({
                url: `${BASE_URL}api/auth/lupa_password`,
                type: 'POST',
                dataType: 'JSON',
                data: $(this).serialize(),
                beforeSend: function () {
                    $('#send_pass').addClass('disabled').html('<i class="fa fa-spin fa-circle-o-notch"></i>');;
                },
                success: function (response) {
                    if (response.status === 200) {
                        makeNotif('success', response.message, 'bottomCenter');
                    } else {
                        makeNotif('error', response.message, 'bottomCenter');
                    }
                    $('#send_pass').removeClass('disabled').html('Kirim');

                },
                error: function () {
                    makeNotif('error', 'Tidak dapat mengakses server', 'bottomCenter');
                    $('#send_pass').removeClass('disabled').html('Kirim');
                }
            })
        }
    });

    $('#forgot_password').on('click', function () {
        $('#form_forgot_pass').show('slow', function () {
            $('#email_customer').focus()
        });
    });

    $('#btn_cancel').on('click', function () {
        $('#form_forgot_pass').fadeOut();
        a
    });

    // We can attach the `fileselect` event to all file inputs on the page
    $(document).on('change', ':file', function () {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });

    // We can watch for our custom `fileselect` event like this
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

});