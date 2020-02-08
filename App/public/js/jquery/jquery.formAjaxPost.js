(function( $ ){
    var methods = {
        init: function (options) {
            var settings = {
                'beforeSend': function(xhr){
                },
                'onErrors': function ($form, errors) {
                    $form.find('div.help-block').remove();
                    $form.find('div.has-error').removeClass('has-error');
                    $(errors).each(function(i, el) {
                        $form.find('#' + el.field)
                            .parents('div.form-group')
                            .first()
                            .addClass('has-error');
                        //.append('<div class="help-block">'+el.message+'</div>');
                        $form.find('#' + el.field)
                            .parent()
                            .append('<div class="help-block">'+el.message+'</div>');
                    });
                },
                'onSuccess': function (response) {
                    location.reload(true);
                },
                'previousValidation': function(){
                    return true;
                }
            };
            if ( options ) {
                settings = $.extend( settings, options );
            }
            var tempthis = this;
            return this.each(function() {
                $(this).off('submit');
                $(this).submit(function() {
                    var $this = $(this);
                    if(settings.previousValidation.call(this)){
                        $.ajax({
                            url: $this.attr('action'),
                            type: "POST",
                            data: $this.serialize(),
                            beforeSend: function( xhr ) {
                                settings.beforeSend.call(this, xhr);
                            }
                        })
                            .done(function(data) {
                                var result = eval(data);
                                if (!result.success) {
                                    settings.onErrors.call(this, $this, result.errors);
                                } else {
                                    settings.onSuccess.call(this, result);
                                }
                            })
                            .fail(function(jqXHR, textStatus){
                                alert("ERROR: error en envío de datos");
                            });
                    }
                    /*
                     $.post($this.attr('action'),
                     $this.serialize(),
                     function(data){
                     var result = eval(data);
                     if (!result.success) {
                     settings.onErrors.call(this, $this, result.errors);
                     } else {
                     settings.onSuccess.call(this, result);
                     }
                     }
                     );
                     */
                    return false;
                });
            });
        },
        destroy: function (options) {
            return this.each(function() {
                $(this).unbind('submit');
            });
        }
    };
    $.fn.formAjaxPost = function(method) {
        if ( methods[method] ) {
            return methods[method].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return methods.init.apply( this, arguments );
        } else {
            $.error( 'Method ' +  method + ' does not exist on jQuery.sumarTabla' );
        }
    };
    $.fn.numericOnly = function () {
        return this.each(function () {
            $(this).keydown(function (e) {
                var key = e.charCode || e.keyCode || 0;
                // allow backspace, tab, delete, enter, arrows, numbers and keypad numbers ONLY
                // home, end, period, and numpad decimal
                return (
                key == 8 ||
                key == 9 ||
                key == 13 ||
                key == 46 ||
                key == 110 ||
                key == 190 ||
                (key >= 35 && key <= 40) ||
                (key >= 48 && key <= 57) ||
                (key >= 96 && key <= 105));
            });
        });
    };
    $.fn.changeValSelect = function (select, valorDefecto){
        var selectType=$(select);
        for(var i = 0, j = selectType.options.length; i < j; ++i) {
            if(selectType.options[i].innerHTML.trim() == valorDefecto.trim()) {
                selectType.selectedIndex = i;
            }
        }
    };


})( jQuery );