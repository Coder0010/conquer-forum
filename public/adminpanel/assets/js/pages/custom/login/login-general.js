'use strict';

// Class Definition
var KTLogin = function() {
    var _login;

    var _showForm = function(form) {
        var cls = 'login-' + form + '-on';
        var form = 'kt_login_' + form + '_form';

        _login.removeClass('login-signin-on');
        _login.removeClass('login-forgot-on');
        _login.removeClass('login-reset-on');

        _login.addClass(cls);

        KTUtil.animateClass(KTUtil.getById(form), 'animate__animated animate__backInUp');
    }

    var _handleSignInForm = function() {
        if($('#kt_login_signin_form').length){

            var validation;

            validation = FormValidation.formValidation(
                KTUtil.getById('kt_login_signin_form'),
                {
                    fields: {
                        email: {
                            validators: {
                                notEmpty: {
                                    message: 'email is required'
                                },
                                emailAddress: {
                                    message: 'The value is not a valid email address'
                                }
                            }
                        },
                        password: {
                            validators: {
                                notEmpty: {
                                    message: 'Password is required'
                                }
                            }
                        }
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        submitButton: new FormValidation.plugins.SubmitButton(),
                        defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                        bootstrap: new FormValidation.plugins.Bootstrap()
                    }
                }
            );

            var _signin_submit = KTUtil.getById('kt_login_signin_submit');
            KTUtil.addEvent(_signin_submit, 'click', function() {
                KTUtil.btnWait(_signin_submit, 'spinner spinner-right spinner-white pr-15', 'Please wait');

                setTimeout(function() {
                    KTUtil.btnRelease(_signin_submit);
                }, 1000);
            });
            $(_signin_submit).on('click', function (e) {
                e.preventDefault();
                validation.validate().then(function(status) {
                    if (status != 'Valid') {
                        console.log(status+ ' _signin_submit form validation');
                    }
                });
            });

            $('#kt_login_forgot').on('click', function (e) {
                e.preventDefault();
                window.history.pushState('object or string', 'forget password', '/admin/password/reset-form');
                _showForm('forgot');
            });
        }
    }

    var _handleForgotForm = function(e) {
        if($('#kt_login_forgot_form').length){
            var validation;

            validation = FormValidation.formValidation(
                KTUtil.getById('kt_login_forgot_form'),
                {
                    fields: {
                        email: {
                            validators: {
                                notEmpty: {
                                    message: 'Email address is required'
                                },
                                emailAddress: {
                                    message: 'The value is not a valid email address'
                                }
                            }
                        }
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        submitButton: new FormValidation.plugins.SubmitButton(),
                        defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                        bootstrap: new FormValidation.plugins.Bootstrap()
                    }
                }
            );

            var _forget_submit = KTUtil.getById('kt_login_forgot_submit');
            KTUtil.addEvent(_forget_submit, 'click', function() {
                KTUtil.btnWait(_forget_submit, 'spinner spinner-right spinner-white pr-15', 'Please wait');

                setTimeout(function() {
                    KTUtil.btnRelease(_forget_submit);
                }, 1000);
            });

            $(_forget_submit).on('click', function (e) {
                e.preventDefault();
                validation.validate().then(function(status) {
                    if (status != 'Valid') {
                        console.log(status+ ' _forget_submit form validation');
                    }
                });
            });

            $('#kt_login_forgot_cancel').on('click', function (e) {
                e.preventDefault();
                window.history.pushState('object or string', 'login', '/admin/login');
                _showForm('signin');
            });
        }
    }

    var _handleResetForm = function(e) {
        if($('#kt_login_reset_form').length){
            var validation;

            validation = FormValidation.formValidation(
                KTUtil.getById('kt_login_reset_form'),
                {
                    fields: {
                        email: {
                            validators: {
                                notEmpty: {
                                    message: 'Email address is required'
                                },
                                emailAddress: {
                                    message: 'The value is not a valid email address'
                                }
                            },
                        },
                        password: {
                            validators: {
                                notEmpty: {
                                    message: 'Password is required'
                                }
                            }
                        },
                        password_confirmation: {
                            validators: {
                                notEmpty: {
                                    message: 'password confirmation is required'
                                }
                            }
                        }
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        submitButton: new FormValidation.plugins.SubmitButton(),
                        defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                        bootstrap: new FormValidation.plugins.Bootstrap()
                    }
                }
            );

            var _reset_submit = KTUtil.getById('kt_login_reset_submit');
            KTUtil.addEvent(_reset_submit, 'click', function() {
                KTUtil.btnWait(_reset_submit, 'spinner spinner-right spinner-white pr-15', 'Please wait');

                setTimeout(function() {
                    KTUtil.btnRelease(_reset_submit);
                }, 1000);
            });

            $(_reset_submit).on('click', function (e) {
                e.preventDefault();
                validation.validate().then(function(status) {
                    if (status != 'Valid') {
                        console.log(status+ ' _reset_submit form validation');
                    }
                });
            });
        }
    }

    return {
        init: function() {
            _login = $('#kt_login');

            _handleSignInForm();
            _handleForgotForm();
            _handleResetForm();
        }
    };
}();

jQuery(document).ready(function() {
    KTLogin.init();
});
