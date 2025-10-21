$(document).ready(function () {
    $("#loginForm").validate({
        rules: {
            contrasenialogin: {
                required: true,
                minlength: 8,
                maxlength: 30
            },
            emaillogin: {
                required: true,
                email: true,
            },
        },
        messages: {
            contrasenialogin: {
                required: "Ingrese un numero",
                minlength: "Ingrese Minimo 8 caracteres",
                maxlength: "Ingrese Maximo 30 caracteres",
            },
            emaillogin: {
                required: "Ingrese un email",
                email: "Ingrese un email valido"
            }
        },
        errorElement: 'div',
        errorClass: 'text-danger mt-1',
        highlight: function (element) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element) {
            $(element).removeClass('is-invalid');
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element); 
        }
    })
    $("#registroForm").validate({
        rules: {
            dniRegistro: {
                required: true,
                minlength: 7,
                maxlength: 9,
                min: 0
            },
            contraseniaRegistro: {
                required: true,
                minlength: 8,
                maxlength: 30
            },
            emailRegistro: {
                required: true,
                email: true,
            },

        },
        messages: {
            contraseniaRegistro: {
                required: "Ingrese una contraseña",
                minlength: "Ingrese Minimo 8 caracteres",
                maxlength: "Ingrese Maximo 30 caracteres",
            },
            emailRegistro: {
                required: "Ingrese un email",
                email: "Ingrese un email valido"
            },
            dniRegistro: {
                required: "Ingrese su numero de documento",
                minlength: "Ingrese Minimo 7 caracteres",
                maxlength: "Ingrese Maximo 9 caracteres",
                min: "debe ser un numero positivo"
            }
        },
        errorElement: 'div',
        errorClass: 'text-danger mt-1',
        highlight: function (element) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element) {
            $(element).removeClass('is-invalid');
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element); 
        }
    })
});