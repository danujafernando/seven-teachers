var ComponentsSelect2 = function() {

    var handleDemo = function() {

        // Set the "bootstrap" theme as the default theme for all Select2
        // widgets.
        //
        // @see https://github.com/select2/select2/issues/2927
        $.fn.select2.defaults.set("theme", "bootstrap");

        var placeholder = "Select a subject";

        $("#subject").select2({
            placeholder: placeholder,
            width: null
        });
        var placeholder2 = "Select a teacher";
        $("#teacher").select2({
            placeholder: placeholder2,
            width: null
        });
        var placeholder3 = "Select a medium";
        $("#medium").select2({
            placeholder: placeholder3,
            width: null
        });
        var placeholder4 = "Select a day";
        $("#day").select2({
            placeholder: placeholder4,
            width: null
        });
        var placeholder5 = "Select a start at";
        $("#start_at").select2({
            placeholder: placeholder5,
            width: null
        });
        var placeholder6 = "Select a end at";
        $("#end_at").select2({
            placeholder: placeholder6,
            width: null
        });
        var placeholder7 = "Select a grade";
        $("#grade").select2({
            placeholder: placeholder7,
            width: null
        });
    }

    return {
        //main function to initiate the module
        init: function() {
            handleDemo();
        }
    };

}();

if (App.isAngularJsApp() === false) {
    jQuery(document).ready(function() {
        ComponentsSelect2.init();
    });
}