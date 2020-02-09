(function( $ ){
    $.fn.simpleDialog = function(options) {
        var settings = {
            'panelDiv' : '#simplePanel',
            'width' : 'auto',
            'maxHeight' : 500,
            'resizable' : false,
            'modal': true,
            'method': 'GET',
            'hideHref': false,
            'data': {},
            'beforeOpen': function () {},
            'beforeSend': function (xhr) {},
            'onComplete': function (result, link) {},
            'onClose': function () {}
        };
        if ( options ) { 
            settings = $.extend( settings, options );
        }
        if ($(settings.panelDiv).length == 0) {
            return;
        }
        $(settings.panelDiv).dialog({
            autoOpen: false,
            bgiframe: true,
            modal: settings.modal,
            resizable: settings.resizable,
            width: settings.width,
            maxHeight: settings.maxHeight,
            close: function() {
                settings.onClose.call(this);
                $(settings.panelDiv).html('');
            }
        });
        var tempthis = this;
        return this.each(function() {
            if (settings.hideHref) {
                $(this).data('href', $(this).attr('href')).attr('href', '#');
            }
            // oculta el atributo href y lo guarda en el valor data[href]
            $(this).click(function() {
                var $this = $(this);
                $(settings.panelDiv).html('<div class="loadingDiv">Cargando...</div>').dialog('open');
                $(settings.panelDiv).dialog('option', 'title', 'Cargando...');
                settings.beforeOpen.call(this);
                var href = $this.attr('href');
                if (settings.hideHref) {
                    href = $this.data('href');
                }
                $.ajax({
                    url: href,
                    type: settings.method,
                    data: settings.data,
                    beforeSend: function( xhr ) {
                        settings.beforeSend.call(this, xhr);
                    }
                })
                .done(function(result) {
                    if (result) {
                        $(settings.panelDiv).dialog('close');
                        var $title = $(settings.panelDiv).html(result).dialog('open').find('h1:first');
                        $(settings.panelDiv).dialog('option', 'title', $title.html());
                    }
                })
                .fail(function(jqXHR, textStatus){
                })
                .always(function(result){
                    settings.onComplete.call(this, result, $this);
                });                
                return false;
            });
        });
    };
})( jQuery );