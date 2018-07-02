var BsModal = window.BsModal || (function ($, webRoot) {
    var modalSize = {
        SMALL: 'modal-dialog-small',
        MEDIUM: 'modal-dialog-medium',
        BIG: 'modal-dialog-big',
    };
    var id = "main-panel";
    var size = 500;

    var build = function () {
        return '<div class="modal inmodal modal-custom" id="' + id + '" role="dialog" aria-hidden="true">' +
            '<div class="modal-dialog ' + size + '">' +
            '<div class="modal-content animated flipInY">' +
            '</div>' +
            '</div>' +
            '</div>';
    };
    var setSize = function (modalSize) {
        size = modalSize;
        return this;
    };
    var getContainer = function () {
        if ($('body #' + id).length == 0) {
            $('body').append(build());
        }
        return $("#" + id);
    };

    var load = function (uri, data, onCloseCallback) {
        var $container = getContainer();
        var data = data || {};
        data.asc = "ok";
        return $.post(webRoot + uri, data, function (response) {
            $container.find('.modal-content').html(response);
            $container.modal({
                show: true,
                keyboard: true,
                backdrop: 'static'
            });
            setTimeout(function(){
                showFirstInput($container);
            }, 300);
            if (typeof onCloseCallback == "undefined" || onCloseCallback == null) {
                onCloseCallback = function () {};
            }
            $container.on('hidden', onCloseCallback);
            $container.on('hidden.bs.modal', onCloseCallback);
        }, "html");
    };

    var showFirstInput = function($container){
        $container.find('input[type=text],textarea,select').filter(':visible:first').focus();
    };

    return {
        withPanelId: function (panelId) {
            id = panelId;
            return this;
        },
        hide: function (id) {
            if (typeof id != "undefined") {
                var $container = $('#' + id);
            } else {
                var $container = getContainer();
            }
            $container.modal('hide');
        },
        loadSmall: function (uri, data, onCloseCallback) {
            setSize(modalSize.SMALL);
            return load(uri, data, onCloseCallback);
        },
        loadMedium: function (uri, data, callback, onCloseCallback) {
            setSize(modalSize.MEDIUM);
            return load(uri, data, onCloseCallback);
        },
        loadBig: function (uri, data, callback, onCloseCallback) {
            setSize(modalSize.BIG);
            return load(uri, data, onCloseCallback);
        }
    };
})(jQuery, WEB_ROOT);