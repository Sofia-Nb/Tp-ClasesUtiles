document.addEventListener('DOMContentLoaded', function() {
    
    const radioAlumno = document.getElementById('radioAlumno');
    const radioProfesor = document.getElementById('radioProfesor');
    
    const camposAlumno = document.getElementById('camposAlumno');
    const camposProfesor = document.getElementById('camposProfesor');

    const inputLegajo = document.getElementById('inputLegajo');
    const inputMateria = document.getElementById('inputMateria');

    function actualizarFormulario() {
        
        if (radioAlumno.checked) {
            camposAlumno.style.display = 'block';
            camposProfesor.style.display = 'none';

            inputLegajo.required = true;
            inputMateria.required = false;

        } else if (radioProfesor.checked) {

            camposAlumno.style.display = 'none';
            camposProfesor.style.display = 'block';

            inputLegajo.required = false;
            inputMateria.required = true;
        }
    }

    // Cada vez que el usuario cambie de radio se ejecuta la funcion
    radioAlumno.addEventListener('change', actualizarFormulario);
    radioProfesor.addEventListener('change', actualizarFormulario);
});