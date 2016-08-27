/**
 * Created by a.mazepa on 27.08.16.
 */
$(document).ready(function () {

    $('#jobseekercreate').validate({

        rules: {

            surname: {
                minlength: 2,
                required: true
            },
            jobseekername: {
                minlength: 2,
                required: true
            },
            father: {
                minlength: 2,
                required: true
            }
            
        },
        highlight: function (element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function (element) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        },
        messages: {
            surname: "Заповніть Прізвище!",
            jobseekername: "Заповніть Ім'я!",
            father: "Заповніть По-батькові!",
            email: {
               email: "Your email address must be in the format of name@domain.com"
            }
        }

    });



});
