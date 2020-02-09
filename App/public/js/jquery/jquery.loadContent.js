(function( $ ){
    $.fn.loadContent = function(options) {
        var settings = {
            'mainContainer' : '#mainContent',
            'method': 'GET',
            'hideHref': false,
            'containerClass': 'loadContentContainer',
            'containerClassTemp': 'loadContentContainerTemp',
            'data': {},
            'beforeSend': function (xhr) {},
            'onSuccess': function (result) {},
            'onComplete': function (result, link) {},
            'onError': function (xhr) {}
        };
        var isRel = $(this).is('[rel]');
        var containerId = isRel? $(this).attr('rel')+'Div': '';
        var containerDiv = isRel? $('#'+containerId): null;
        if ( options ) {
            settings = $.extend( settings, options );
        }
        if ($(settings.mainContainer).length === 0) {
            return;
        }
        return this.each(function() {
            var mainContent = $(settings.mainContainer);
            // oculta el atributo href y lo guarda en el valor data[href]
            if (settings.hideHref) {
                $(this).data('href', $(this).attr('href')).attr('href', '#');
            }
            // settings info
            var isRel = $(this).is('[rel]');
            var containerId = isRel? $(this).attr('rel')+'Div': '';
            var containerDiv = isRel? $('#'+containerId): null;
            $(this).off('click');
            $(this).click(function() {
                var $this = $(this);
                var href = $this.attr('href');
                if (settings.hideHref) {
                    href = $this.data('href');
                }
                if(isRel && containerDiv.length){
                    $('.'+settings.containerClass).hide();
                    $('.'+settings.containerClassTemp).remove();
                    containerDiv.fadeIn();
                }else{
                    $.ajax({
                        url: href,
                        type: settings.method,
                        data: settings.data,
                        beforeSend: function( xhr ) {
                            settings.beforeSend.call(this, xhr);
                            mainContent.mask('Cargando...');
                        }
                    })
                    .done(function(results) {
                        if (results) {
                            $('.'+settings.containerClass).hide();
                            $('.'+settings.containerClassTemp).remove();
                            if(isRel){
                                //alert('<div id="'+containerId+'" class="'+settings.containerClass+'">'+results+'</div>');
                                mainContent.append('<div id="'+containerId+'" class="'+settings.containerClass+'">'+results+'</div>');
                            }else{
                                mainContent.append('<div class="'+settings.containerClass+' '+settings.containerClassTemp+'">'+results+'</div>');
                            }
                        }
                    })
                    .fail(function(xhr, textStatus){
                        settings.onError.call(this, xhr);
                    })
                    .always(function(result){
                        if(mainContent.isMasked()){
                            mainContent.unmask();
                        }
                        settings.onComplete.call(this, result, $this);
                    });
                }
                return false;
            });
        });
    };
})( jQuery );