$.fn.btnLoadingOn = function (options) {
    var $i = $(this).find("i");
    if($i.length == 0){
        $(this).prepend('<i class="fa fa-refresh spin to-delete"></i>');
    }else{
        $i.attr('last-class', $i.attr('class'));
        $i.attr('class', 'fa fa-refresh spin to-remove-refresh');
    }
    $(this).addClass('disabled');
    $(this).attr('disabled', 'disabled');
    return this;
}
$.fn.btnLoadingOff = function (options) {
    var $i = $(this).find("i");
    $(this).find("i.to-delete").remove();
    $i.attr('class', $i.attr('last-class'));
    $(this).removeClass('disabled');
    $(this).removeAttr('disabled');
    return this;
}
