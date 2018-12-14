$(function () {
    $.fn.datepicker.defaults.language = 'es';
    $.fn.datepicker.defaults.format = "mm-dd-yyyy";
    $.fn.datepicker.defaults.autoclose = true;
    $.fn.datepicker.defaults.todayBtn = 'linked';
    $.fn.bootstrapDP = $.fn.datepicker.noConflict();
});