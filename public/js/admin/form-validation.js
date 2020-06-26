var FORM = function() {

    var handleUser = function() {
        jQuery.validator.addMethod("email", function(value, element) {
            var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
                if(filter.test(value))
                {
                    return true;
                }
                return false;
         },'');
        $('.user-create-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                name: {
                    maxlength:255,
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    maxlength: 255,
                    minlength: 8,
                    required: true
                },
                user_type: {
                    required: true
                }
            },

            messages: {
                name: {
                    required: "The name field is required",
                    maxlength: "Maximum characters is 255"
                },
                email: {
                    required: "The email field is required",
                    email: "Email should be valid",
                },
                password: {
                    required: "The password field is required",
                    maxlength: "Maximum characters is 255",
                    minlength: 'Minimum characters is 8'
                },
                user_type: {
                    required: "The user type field is required"
                }
            },

            invalidHandler: function(event, validator) { //display error alert on form submit
                $('.alert-danger', $('.user-create-form')).show();
            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function(error, element) {
                error.insertAfter(element.closest('.form-error'));
            },

            submitHandler: function(form) {
                form.submit(); // form validation success, call ajax form submit
            }
        });

        $('.user-create-form input').keypress(function(e) {
            if (e.which == 13) {
                if ($('.user-create-form').validate().form()) {
                    $('.user-create-form').submit(); //form validation success, call ajax form submit
                }
                return false;
            }
        });
    }

    var handleCategory = function () {
        $('.category-create-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                name: {
                    required: true,
                },
                slug: {
                    required: true,
                }
            },
            messages: {
                name: {
                    required: "The name field is required",
                },
                slug: {
                    required: "The slug field is required"
                }
            },

            invalidHandler: function(event, validator) { //display error alert on form submit
                $('.alert-danger', $('.category-create-form')).show();
            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function(error, element) {
                error.insertAfter(element.closest('.form-error'));
            },

            submitHandler: function(form) {
                form.submit(); // form validation success, call ajax form submit
            }
        });

        $('.category-create-form input').keypress(function(e) {
            if (e.which == 13) {
                if ($('.category-create-form').validate().form()) {
                    $('.category-create-form').submit(); //form validation success, call ajax form submit
                }
                return false;
            }
        });
    }

    var handleSubCategory = function () {
        $('.sub-category-create-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                name: {
                    required: true,
                },
                category: {
                    required: true,
                },
                slug: {
                    required: true,
                }
            },
            messages: {
                name: {
                    required: "The name field is required",
                },
                category: {
                    required: "The category field is required",
                },
                slug: {
                    required: "The slug field is required"
                }
            },

            invalidHandler: function(event, validator) { //display error alert on form submit
                $('.alert-danger', $('.sub-category-create-form')).show();
            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function(error, element) {
                error.insertAfter(element.closest('.form-error'));
            },

            submitHandler: function(form) {
                form.submit(); // form validation success, call ajax form submit
            }
        });

        $('.sub-category-create-form input').keypress(function(e) {
            if (e.which == 13) {
                if ($('.sub-category-create-form').validate().form()) {
                    $('.sub-category-create-form').submit(); //form validation success, call ajax form submit
                }
                return false;
            }
        });
    }

    var handleJobType = function () {
        $('.job-type-create-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                name: {
                    required: true,
                },
                slug: {
                    required: true,
                }
            },
            messages: {
                name: {
                    required: "The name field is required",
                },
                slug: {
                    required: "The slug field is required"
                }
            },

            invalidHandler: function(event, validator) { //display error alert on form submit
                $('.alert-danger', $('.job-type-create-form')).show();
            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function(error, element) {
                error.insertAfter(element.closest('.form-error'));
            },

            submitHandler: function(form) {
                form.submit(); // form validation success, call ajax form submit
            }
        });

        $('.job-type-create-form input').keypress(function(e) {
            if (e.which == 13) {
                if ($('.job-type-create-form').validate().form()) {
                    $('.job-type-create-form').submit(); //form validation success, call ajax form submit
                }
                return false;
            }
        });
    }

    var handleKeyword = function () {
        $('.keyword-create-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                name: {
                    required: true,
                },
                slug: {
                    required: true,
                }
            },
            messages: {
                name: {
                    required: "The name field is required",
                },
                slug: {
                    required: "The slug field is required"
                }
            },

            invalidHandler: function(event, validator) { //display error alert on form submit
                $('.alert-danger', $('.keyword-create-form')).show();
            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function(error, element) {
                error.insertAfter(element.closest('.form-error'));
            },

            submitHandler: function(form) {
                form.submit(); // form validation success, call ajax form submit
            }
        });

        $('.keyword-create-form input').keypress(function(e) {
            if (e.which == 13) {
                if ($('.keyword-create-form').validate().form()) {
                    $('.keyword-create-form').submit(); //form validation success, call ajax form submit
                }
                return false;
            }
        });
    }

    var handleTestimonial = function () {
        $('.testimonial-create-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                client_name: {
                    required: true,
                },
                client_note: {
                    required: true,
                }
            },
            messages: {
                name: {
                    required: "The client name field is required",
                },
                client_note: {
                    required: "The client note field is required"
                }
            },

            invalidHandler: function(event, validator) { //display error alert on form submit
                $('.alert-danger', $('.testimonial-create-form')).show();
            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function(error, element) {
                error.insertAfter(element.closest('.form-error'));
            },

            submitHandler: function(form) {
                form.submit(); // form validation success, call ajax form submit
            }
        });

        $('.jtestimonial-create-form input').keypress(function(e) {
            if (e.which == 13) {
                if ($('.testimonial-create-form').validate().form()) {
                    $('.testimonial-create-form').submit(); //form validation success, call ajax form submit
                }
                return false;
            }
        });
    };
    return {
        //main function to initiate the module
        init: function() {

            handleUser();
            handleCategory();
            handleSubCategory();
            handleJobType();
            handleKeyword();
            handleTestimonial();
        }
    };
}();

jQuery(document).ready(function() {
    FORM.init();
});