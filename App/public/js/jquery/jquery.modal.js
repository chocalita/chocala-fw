var BsModal = window.BsModal || (function($, webRoot){
        var Modal = function(){
            this.WITH_SMALL = 'modal-dialog-small';
            this.WITH_MEDIUM = 'modal-dialog-medium';
            this.WITH_BIG = 'modal-dialog-big';
            this.id = "main-panel";
            this.width = 500;
            this.template = "";
        };
        Modal.prototype = {
            withIdPanel:function(id){
                this.id = id;
                return this;
            },
            withWidth:function(width){
                this.width = width;
                return this;
            },
            build:function(){
                return '<div class="modal inmodal modal-custom" id="'+this.id+'" role="dialog" aria-hidden="true">' +
                            '<div class="modal-dialog '+this.width+'">' +
                                '<div class="modal-content animated flipInY">' +
                                '</div>'+
                            '</div>'+
                        '</div>';
            },
            getContainer:function(){
                if($('body #'+this.id).length == 0){
                    $('body').append(this.build());
                }
                return $("#"+this.id);
            },
            container:function(){
                return $("#"+this.id);
            },
            getId:function(){
                return this.id;
            },
            hide:function(id){
                if (typeof id != "undefined") {
                    var $container = $('#'+id);
                } else {
                    var $container = this.getContainer();
                }
                $container.modal('hide');
            },
            showFirstInput:function($container){
                $container.find('input[type=text],textarea,select').filter(':visible:first').focus();
            },
            load:function(uri, data, onCloseCallback){
                var $this = this;
                var $container = this.getContainer();
                var data = data || {};
                data.asc = "ok";
                return $.post(webRoot+uri, data, function(response){
                    $container.find('.modal-content').html(response);
                    $container.modal({
                        show: true,
                        keyboard: true,
                        backdrop: 'static'
                    });
                    // setTimeout(function(){
                    //     $this.showFirstInput($container);
                    // }, 300);
                    if(typeof onCloseCallback == "undefined" || onCloseCallback == null) {
                        onCloseCallback = function(){};
                    }
                    $container.on('hidden', onCloseCallback);
                    $container.on('hidden.bs.modal', onCloseCallback);
                }, "html");
            },
            loadSmall:function(uri, data, onCloseCallback){
                return this.withWidth(this.WITH_SMALL).load(uri, data, onCloseCallback);
            },
            loadMedium:function(uri, data, callback, onCloseCallback){
                return this.withWidth(this.WITH_MEDIUM).load(uri, data, onCloseCallback);
            },
            loadBig:function(uri, data, callback, onCloseCallback){
                return this.withWidth(this.WITH_BIG).load(uri, data, onCloseCallback);
            }
        };
        return new Modal();
    })(jQuery, WEB_ROOT);