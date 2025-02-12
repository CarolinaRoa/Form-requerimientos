// Obtener la lista de países de la API REST Countries
fetch('https://restcountries.com/v3.1/all')
    .then(response => response.json())
    .then(data => {
        // Ordenar los países alfabéticamente
        data.sort((a, b) => {
            if (a.translations.spa.common < b.translations.spa.common) return -1;
            if (a.translations.spa.common > b.translations.spa.common) return 1;
            return 0;
        });

        const selectElement = document.getElementById('pais');
        data.forEach(country => {
            const option = document.createElement('option');
            option.value = country.translations.spa.common;
            option.textContent = country.translations.spa.common;
            selectElement.appendChild(option);
        });
    })
    .catch(error => console.log(error));

// Funciones para mostrar y ocultar campos
function mostrarCampoCuál(id) {
    document.getElementById(id).style.display = "block";
}

function ocultarCampoCuál(id) {
    document.getElementById(id).style.display = "none";
}

// Función para mostrar u ocultar contenido basado en la selección de radio button
function mostrarOcultarContenido(selectedId, targetId) {
    var selectedValue = document.getElementById(selectedId).value;
    var contenido = document.getElementById(targetId);
    if (selectedValue === 'Si') {
        contenido.style.display = "block";
    } else {
        contenido.style.display = "none";
    }
}

// Función para manejar el checkbox "Tradicional" y sus subopciones
function seleccionarTradicional() {
    const checkboxes = document.getElementsByName('canal_ffvv[]');
    let algunCheckboxSeleccionado = false;

    for (const checkbox of checkboxes) {
        if (checkbox.checked && checkbox.value !== 'Tradicional') {
            algunCheckboxSeleccionado = true;
            break;
        }
    }

    for (const checkbox of checkboxes) {
        if (checkbox.value === 'Tradicional') {
            checkbox.checked = algunCheckboxSeleccionado;
            break;
        }
    }
}

// Función para manejar la selección de recursos para cargar
function toggleArchivoAqui() {
    const cargarAqui = document.getElementById('cargar-aqui-licitacion');
    const cargarWetransfer = document.getElementById('cargar-wetransfer-licitacion');
    const recursosAqui = document.getElementById('recursos-aqui-licitacion');
    const recursosWetransfer = document.getElementById('recursos-wetransfer-licitacion');

    if (cargarAqui.checked) {
        recursosAqui.style.display = 'block';
        recursosWetransfer.style.display = 'none';
    } else if (cargarWetransfer.checked) {
        recursosAqui.style.display = 'none';
        recursosWetransfer.style.display = 'block';
    } else {
        recursosAqui.style.display = 'none';
        recursosWetransfer.style.display = 'none';
    }
}

// Agregar listeners para los radio buttons de carga de recursos
document.getElementById('cargar-aqui-licitacion').addEventListener('change', toggleArchivoAqui);
document.getElementById('cargar-wetransfer-licitacion').addEventListener('change', toggleArchivoAqui);

// Función para validar el atributo minlength
function validarMinlength(event) {
    event.preventDefault(); // Prevenir el envío del formulario

    const inputs = document.querySelectorAll("input[minlength]");
    let isValid = true;

    inputs.forEach(input => {
        const minLength = input.getAttribute("minlength");
        if (input.value.length < minLength) {
            isValid = false;
            // Mostrar alerta personalizada
            alert(`El campo "${input.previousElementSibling.textContent}" debe tener al menos ${minLength} caracteres.`);
            // Resaltar el campo
            input.classList.add("is-invalid");
        } else {
            input.classList.remove("is-invalid");
        }
    });

    if (isValid) {
        alert("Formulario enviado con éxito.");
        document.getElementById("formLicitaciones").submit(); // Enviar el formulario si es válido
    }
}

// Agregar evento al formulario
document.getElementById("myForm").addEventListener("submit", validarMinlength);
