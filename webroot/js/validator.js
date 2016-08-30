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
            },
            birthdate: {
                required: true
            },
            adress: {
                minlength: 5,
                required: true
            },
            contact: {
                minlength: 10,
                required: true
            },
            
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
            birthdate: "Заповніть дату народження!",
            adress: "Заповніть адресу!",
            contact: "Заповніть номер телефону!",
            email: {
               email: "Your email address must be in the format of name@domain.com"
            }
        }

    });


    $('#companycreate').validate({
        rules: {

            company: {
                minlength: 2,
                required: true
            },
            PIB: {
                minlength: 2,
                required: true
            },
            contact:{
                minlength: 2,
                required: true
            },
            telefon:{
                minlength: 10,
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
            company: "Заповніть назву компанії!",
            PIB: "Заповніть ПІБ!",
            contact: "Заповніть Контакти!",
            telefon: "Заповніть телефон!"
        }
    });



});
