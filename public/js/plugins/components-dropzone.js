var ComponentsDropZone = function() {


    return {
        //main function to initiate the module
        init: function() {
        }
    };

}();

if (App.isAngularJsApp() === false) {
    jQuery(document).ready(function() {
        ComponentsDropZone.init();
    });
}
