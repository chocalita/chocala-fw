var BsModalLogin = window.BsModalLogin || (function ($, webRoot) {
        var ModalLogin = function () {
            this.LOGIN = "login";
            this.REGISTER = "register";
            this.REMEMBER = "remember";
            this.url = "main/auth/loginPanel";
            this.urlRegister = "main/auth/register";
            this.urlLogout = "main/auth/logout";
            this.urlSignIn = "main/auth/signin";
            this.urlSignInFacebook = "main/auth/signinFacebook";
            this.urlEmail = "main/auth/verifyEquals";
            this.onSaveCallback = null;
            this.onCloseCallback = null;
            this.panelId = "login-panel";
            this.data = {};
        };
        ModalLogin.prototype = {
            showErrorMessage:function($currentForm, message){
                $currentForm.find('.error-message').remove();
                var div = document.createElement('div');
                div.className = "error-message alert alert-danger";
                div.innerHTML = message;
                $currentForm.find(".modal-body").prepend(div);
            },
            load: function (data, onCloseCallback, onSaveCallback) {
                this.data = data || {};
                this.onCloseCallback = onCloseCallback || null;
                if (typeof onSaveCallback == 'function') {
                    this.onSaveCallback = onSaveCallback;
                }
                return this.loadPanel();
            },
            loadPanel: function () {
                var $this = this;
                BsModal.withIdPanel(this.panelId)
                    .loadSmall(this.url, this.data, this.onCloseCallback)
                    .done(function(){
                        if ($this.data.panel == $this.REGISTER) {
                            $.validationEngineLanguage.allRules.ajaxUsername = {
                                "url": webRoot + $this.urlEmail,
                                "alertText": "Este email ya ha sido utilizado.",
                                "alertTextLoad": "Validando..."
                            };
                        }
                    });
            },
            loginPanel: function () {
                this.data.panel = this.LOGIN;
                this.loadPanel();
            },
            registerPanel: function () {
                this.data.panel = this.REGISTER;
                this.loadPanel();
            },
            rememberPanel: function () {
                this.data.panel = this.REMEMBER;
                this.loadPanel();
            },
            signIn: function (obj) {
                var $this = this;
                var $form = $(obj).closest('form');
                $("#loginForm").validationEngine({
                    promptPosition: "topRight",
                    scroll: false
                });
                if ($("#loginForm").validationEngine('validate')) {
                    $.post(webRoot + this.urlSignIn, $form.serialize(), function (response) {
                        if (response.status == "OK") {
                            $this.processSaveCallback(response);
                        } else {
                            $this.showErrorMessage($form, response.message);
                        }
                    }, "json");
                }
                return false;
            },
            remember:function(){
                return false;
            },
            processSaveCallback:function(response){
                var $this = this;
                if (typeof $this.onSaveCallback == "function") {
                    $this.onSaveCallback(response);
                }else{
                    alert('Bingo!');
                }
                BsModal.hide($this.panelId);
            },
            loginFacebook:function(callback){
                var $this = this;
                var $form = $("#"+this.panelId+" form");
                $.post(webRoot + this.urlSignInFacebook, function (response) {
                    if (response.status == "OK") {
                        $this.processSaveCallback(response);
                        if (typeof callback != "undefined") {
                            callback(response);
                        }
                    } else {
                        $this.showErrorMessage($form, response.message);
                        if (response.login == "FACEBOOK_EMAIL_REQUIRED") {
                            oFacebook.logout();
                        }
                    }
                }, "json");
            },
            resetLoginStatus: function(){
                this.processSaveCallback({
                    status: 'ERROR',
                    message: '',
                    email: '',
                    pictureUrl: ''
                });
            },
            signInFacebook: function(){
                var $this = this;
                FacebookApi.listenStatus(function(response){
                    if (response.status === 'connected') {
                        // Logged into your app and Facebook.
                        if(false){
                            FacebookApi.logout();
                            $this.resetLoginStatus();
                        }else{
                            $this.loginFacebook();
                        }
                        //} else if (response.status === 'not_authorized') {
                        //    // The person is logged into Facebook, but not your app.
                        //    this.initOptions();
                        //    console.log('Please log ' +'into this app.');
                    } else {
                        // The person is not logged into Facebook, so we're not sure if
                        // they are logged into this app or not.
                        $this.resetLoginStatus();
                    }
                }).login(function(response){
                    $this.loginFacebook(response)
                });
            },
            register: function (obj) {
                var $this = this;
                var $form = $(obj).closest('form');
                $("#loginForm").validationEngine({
                    promptPosition: "topRight",
                    scroll: false
                });
                if ($("#loginForm").validationEngine('validate')) {
                    $.post(webRoot + this.urlRegister, $form.serialize(), function (response) {
                        if (response.status == "OK") {
                            $this.processSaveCallback(response);
                        } else {
                            $this.showErrorMessage($form, response.message);
                        }
                    }, "json");
                }
                return false;
            },
            logout: function () {
                return $.post(webRoot + this.urlLogout, {}, function (response) {

                }, "json");
            }
        };
        return new ModalLogin();
    })(jQuery, WEB_ROOT);