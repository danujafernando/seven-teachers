var ComponentsEditors = function () {

    var handleJobDescriptionSummernote = function () {
        $('#job_description').summernote({height: 300});
        //API:
        //var sHTML = $('#summernote_1').code(); // get code
        //$('#summernote_1').destroy(); // destroy
    }
    var handleAboutUsSummernote = function () {
        $('#about_us_page_content').summernote({height: 300});
        //API:
        //var sHTML = $('#summernote_1').code(); // get code
        //$('#summernote_1').destroy(); // destroy
    }
    var handleContactUsSummernote = function () {
        $('#contact_us_page_content').summernote({height: 300});
        //API:
        //var sHTML = $('#summernote_1').code(); // get code
        //$('#summernote_1').destroy(); // destroy
    }
    return {
        //main function to initiate the module
        init: function () {
            handleJobDescriptionSummernote();
            handleAboutUsSummernote();
            handleContactUsSummernote();
        }
    };

}();

jQuery(document).ready(function() {    
   ComponentsEditors.init();
});