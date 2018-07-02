var BsModalLogin = window.BsModalLogin || (function ($, webRoot) {
    var panel = {
        LOGIN: "login",
        REGISTER: "register",
        REMEMBER: "remember",
    };

    var paths = {
        LOAD_PANEL: "main/auth/loadPanel",
        REGISTER: "main/auth/register",
        LOGOUT: "main/auth/logout",
        OPTIONS: "main/auth/options",
        SIGN_IN: "main/auth/signin",
        SIGN_IN_FACEBOOK: "main/auth/signinFacebook",
        EMAIL_VERIFICATION: "main/auth/verifyEquals",
    };

    var onSaveCallback = null;
    var onCloseCallback = null;
    var panelId = "login-panel";
    var data = {};

    var initButtons = function(){
        $("#"+panelId+" [cho-login-panel-btn]").click(function(){
            return BsModalLogin.loginPanel(this);
        });
        $("#"+panelId+" [cho-sign-in-btn]").click(function(){
            return BsModalLogin.signIn(this);
        });
        $("#"+panelId+" [cho-remember-panel-btn]").click(function(){
            return BsModalLogin.rememberPanel(this);
        });
        $("#"+panelId+" [cho-remember-btn]").click(function(){
            return BsModalLogin.remember(this);
        });
        $("#"+panelId+" [cho-register-panel-btn]").click(function(){
            return BsModalLogin.registerPanel(this);
        });
        $("#"+panelId+" [cho-register-btn]").click(function(){
            return BsModalLogin.register(this);
        });
        $("#"+panelId+" [cho-facebook-sign-in-btn]").click(function(){
            return BsModalLogin.signInFacebook(this);
        });
    };

    var initOptions = function(){
        $.post(webRoot + paths.OPTIONS, function (response) {
            $("#navbar").html(response);
            $('a[data-id=btn-login]').click(function(){
                BsModalLogin.loginPanel();
            });
        }, "html");
    };

    var loadPanel = function () {
        BsModal.withPanelId(panelId)
            .loadSmall(paths.LOAD_PANEL, data, onCloseCallback)
            .done(function () {
                initButtons();
                onSaveCallback = initOptions;
                if (data.panel == panel.REGISTER) {
                    $.validationEngineLanguage.allRules.ajaxUsername = {
                        "url": webRoot + paths.EMAIL_VERIFICATION,
                        "alertText": "Este email ya ha sido utilizado.",
                        "alertTextLoad": "Validando..."
                    };
                }
            });
    };

    var processSaveCallback = function (response) {
        if (typeof onSaveCallback == "function") {
            onSaveCallback(response);
        }
        BsModal.hide(panelId);
    };

    var showErrorMessage = function ($currentForm, message) {
        $currentForm.find('.error-message').remove();
        var div = document.createElement('div');
        div.className = "error-message alert alert-danger";
        div.innerHTML = message;
        $currentForm.find(".modal-body").prepend(div);
    };

    var resetLoginStatus = function () {
        processSaveCallback({
            status: 'ERROR',
            message: '',
            email: '',
            pictureUrl: ''
        });
    };

    var loginFacebook = function () {
        var $form = $("#" + panelId + " form");
        $.post(webRoot + paths.SIGN_IN_FACEBOOK, function (response) {
            if (response.status == "OK") {
                processSaveCallback(response);
            } else {
                showErrorMessage($form, response.message);
                if (response.login == "FACEBOOK_EMAIL_REQUIRED") {
                    FacebookApi.logout();
                    initOptions();
                }
            }
        }, "json");
    };

    return {
        options: function () {
            initOptions();
        },
        loginPanel: function () {
            data.panel = panel.LOGIN;
            loadPanel();
        },
        registerPanel: function () {
            data.panel = panel.REGISTER;
            loadPanel();
        },
        rememberPanel: function () {
            data.panel = panel.REMEMBER;
            loadPanel();
        },
        signIn: function (obj) {
            var $form = $(obj).closest('form');
            $form.validationEngine({
                promptPosition: "topRight",
                scroll: false
            });
            if ($form.validationEngine('validate')) {
                $.post(webRoot + paths.SIGN_IN, $form.serialize(), function (response) {
                    if (response.status == "OK") {
                        processSaveCallback(response);
                    } else {
                        showErrorMessage($form, response.message);
                    }
                }, "json");
            }
            return false;
        },
        signInFacebook: function () {
            FacebookApi.listenStatus(function (response) {
                if (response.status === 'connected') {
                    // Logged into your app and Facebook.
                    if (false) {
                        FacebookApi.logout();
                        resetLoginStatus();
                    } else {
                        loginFacebook();
                    }
                    //} else if (response.status === 'not_authorized') {
                    //    // The person is logged into Facebook, but not your app.
                    //    this.initOptions();
                    //    console.log('Please log ' +'into this app.');
                } else {
                    // The person is not logged into Facebook, so we're not sure if
                    // they are logged into this app or not.
                    resetLoginStatus();
                }
            }).login(function () {
                loginFacebook();
            });
        },
        register: function (obj) {
            var $form = $(obj).closest('form');
            $form.validationEngine({
                promptPosition: "topRight",
                scroll: false
            });
            if ($form.validationEngine('validate')) {
                $.post(webRoot + paths.REGISTER, $form.serialize(), function (response) {
                    if (response.status == "OK") {
                        processSaveCallback(response);
                    } else {
                        showErrorMessage($form, response.message);
                    }
                }, "json");
            }
            return false;
        },
        remember: function () {
            return false;
        },
        logout: function () {
            return $.post(webRoot + paths.LOGOUT, {}, function (response) {}, "json");
        }
    };
})(jQuery, WEB_ROOT);