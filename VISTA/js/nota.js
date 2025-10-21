$(document).ready(function () {
    $("#nota").validate({
        rules: {
            dniAlumno: {
                required: true,
                digits: true,
                minlength: 7,
                maxlength: 8
            },
            dniProfesor: {
                required: true,
                digits: true,
                minlength: 7,
                maxlength: 8
            },
            valorNota: {
                required: true,
                number: true,
                min: 1,
                max: 10
            },
            fechaNota: {
                required: true,
                date: true
            }
        },
        messages: {
            dniAlumno: {
                required: "Ingrese el DNI del alumno",
                digits: "Solo números",
                minlength: "El DNI es demasiado corto",
                maxlength: "El DNI es demasiado largo"
            },
            dniProfesor: {
                required: "Ingrese su DNI",
                digits: "Solo números",
                minlength: "El DNI es demasiado corto",
                maxlength: "El DNI es demasiado largo"
            },
            valorNota: {
                required: "Ingrese el valor de la nota",
                number: "Debe ser un número",
                min: "Mínimo 1",
                max: "Máximo 10"
            },
            fechaNota: {
                required: "Seleccione la fecha",
                date: "Ingrese una fecha válida"
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
    });
});
