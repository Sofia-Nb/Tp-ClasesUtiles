// Espera a que todo el HTML esté cargado
document.addEventListener('DOMContentLoaded', function() {
    
    // 1. Selecciona los elementos que vamos a manipular
    const radioAlumno = document.getElementById('radioAlumno');
    const radioProfesor = document.getElementById('radioProfesor');
    
    const camposAlumno = document.getElementById('camposAlumno');
    const camposProfesor = document.getElementById('camposProfesor');

    const inputLegajo = document.getElementById('inputLegajo');
    const inputMateria = document.getElementById('inputMateria');

    // 2. Creamos una función para actualizar el formulario
    function actualizarFormulario() {
        
        if (radioAlumno.checked) {
            // Si es Alumno:
            // Mostramos los campos de alumno y ocultamos los de profe
            camposAlumno.style.display = 'block';
            camposProfesor.style.display = 'none';

            // Hacemos que 'legajo' sea OBLIGATORIO
            inputLegajo.required = true;
            // Y que 'materia' NO sea obligatorio
            inputMateria.required = false;

        } else if (radioProfesor.checked) {
            // Si es Profesor:
            // Ocultamos los campos de alumno y mostramos los de profe
            camposAlumno.style.display = 'none';
            camposProfesor.style.display = 'block';

            // Hacemos que 'legajo' NO sea obligatorio
            inputLegajo.required = false;
            // Y que 'materia' SÍ sea obligatorio
            inputMateria.required = true;
        }
    }

    // 3. Añadimos "escuchadores" a los radio buttons
    // Cada vez que el usuario haga 'change' (clic) en uno, se ejecutará la función.
    radioAlumno.addEventListener('change', actualizarFormulario);
    radioProfesor.addEventListener('change', actualizarFormulario);
});