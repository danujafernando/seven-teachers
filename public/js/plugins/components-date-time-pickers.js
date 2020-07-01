var ComponentsDateTimePickers = function () {

    var handleDatePickers = function () {

        if (jQuery().datepicker) {
            $('.closing_date').datepicker({
                format: "yyyy-mm-dd",
                orientation: "left",
                autoclose: true,
                startDate: new Date()
            });
            //$('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
        }

        /* Workaround to restrict daterange past date select: http://stackoverflow.com/questions/11933173/how-to-restrict-the-selectable-date-ranges-in-bootstrap-datepicker */
    
        // Workaround to fix datepicker position on window scroll
        $( document ).scroll(function(){
            $('#form_modal2 .closing_date').datepicker('place'); //#modal is the id of the modal
        });
    }

    return {
        //main function to initiate the module
        init: function () {
            handleDatePickers();
        }
    };

}();

if (App.isAngularJsApp() === false) { 
    jQuery(document).ready(function() {    
        ComponentsDateTimePickers.init(); 
    });
}