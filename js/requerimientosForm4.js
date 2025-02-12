document.addEventListener('DOMContentLoaded', function () {
    // Función para inicializar el formulario
    function initializeForm(formulario) {
        const tipoPieza = formulario.querySelector('[name="tipo-pieza-4"]');
        const tipoPiezaC1 = formulario.querySelector('[name="tipo-pieza-c1-4"]');
        const tipoPiezaC2 = formulario.querySelector('[name="tipo-pieza-c2-4"]');
        const tipoPiezaC3 = formulario.querySelector('[name="tipo-pieza-c3-4"]');
        const tipoPiezaC4 = formulario.querySelector('[name="tipo-pieza-c4-4"]');
        const tipoPiezaC5 = formulario.querySelector('[name="tipo-pieza-c5-4"]');
        const tipoPiezaC6 = formulario.querySelector('[name="tipo-pieza-c6-4"]');
        const tipoPiezaC7 = formulario.querySelector('[name="tipo-pieza-c7-4"]');
        const tipoPiezaC8 = formulario.querySelector('[name="tipo-pieza-c8-4"]');
        const tipoPiezaC9 = formulario.querySelector('[name="tipo-pieza-c9-4"]');
        const otraCategoria = formulario.querySelector('[name="otra-categoria-4"]');
        const otroTipoPieza = formulario.querySelector('[name="otra-pieza-4"]');
        const cargarAqui = formulario.querySelector('[name="cargar-recursos-4"][value="Cargar en form"]');
        const cargarWetransfer = formulario.querySelector('[name="cargar-recursos-4"][value="Cargar en WeTransfer"]');
        const recursosAqui = formulario.querySelector('#recursos-aqui-4');
        const recursosWetransfer = formulario.querySelector('#recursos-wetransfer-4');
        const piezaIncluidaSi = formulario.querySelector('[name="pieza-incluida-4"][value="Si"]');
        const piezaIncluidaNo = formulario.querySelector('[name="pieza-incluida-4"][value="No"]');
        const archivoDiv = formulario.querySelector('#archivo-div-4');

        // Función para validar archivos
        function validarArchivos(input, allowedTypes, maxSize) {
            const files = input.files;

            for (let i = 0; i < files.length; i++) {
                const file = files[i];

                // Verificar tipo de archivo
                if (!allowedTypes.includes(file.type)) {
                    alert('Error: Solo se permiten archivos JPG, PNG, GIF, PDF, Word, Excel o PowerPoint.');
                    input.value = ''; // Limpiar el input de archivos seleccionados
                    return false;
                }

                // Verificar tamaño del archivo
                if (file.size > maxSize) {
                    alert('Error: El archivo ' + file.name + ' es demasiado grande, máximo 5MB permitido.');
                    input.value = ''; // Limpiar el input de archivos seleccionados
                    return false;
                }

                console.log('Nombre: ' + file.name + ', Tipo: ' + file.type + ', Tamaño: ' + file.size + ' bytes');
            }

            return true;
        }

        // Funciones de Toggle
        function toggleTipoPiezaFields() {
            const tipoPiezaFields = [
                tipoPiezaC1, tipoPiezaC2, tipoPiezaC3, tipoPiezaC4, tipoPiezaC5,
                tipoPiezaC6, tipoPiezaC7, tipoPiezaC8, tipoPiezaC9, otraCategoria, otroTipoPieza
            ];

            // Resetea todos los campos: oculta y elimina el atributo required
            tipoPiezaFields.forEach(field => {
                if (field && field.parentElement) {
                    field.parentElement.style.display = 'none';
                    field.required = false;
                }
            });

            // Muestra el campo correspondiente y lo hace obligatorio
            switch (tipoPieza.value) {
                case 'Banners':
                    tipoPiezaC1.parentElement.style.display = 'block';
                    tipoPiezaC1.required = true;
                    break;
                case 'WhatsApp':
                    tipoPiezaC2.parentElement.style.display = 'block';
                    tipoPiezaC2.required = true;
                    break;
                case 'Presentaciones editables':
                    tipoPiezaC3.parentElement.style.display = 'block';
                    tipoPiezaC3.required = true;
                    break;
                case 'Mockups':
                    tipoPiezaC4.parentElement.style.display = 'block';
                    tipoPiezaC4.required = true;
                    break;
                case 'Piezas animadas y audio':
                    tipoPiezaC5.parentElement.style.display = 'block';
                    tipoPiezaC5.required = true;
                    break;
                case 'Impresos':
                    tipoPiezaC6.parentElement.style.display = 'block';
                    tipoPiezaC6.required = true;
                    break;
                case 'Nuevos proyectos':
                    tipoPiezaC7.parentElement.style.display = 'block';
                    tipoPiezaC7.required = true;
                    break;
                case 'Redes sociales':
                    tipoPiezaC8.parentElement.style.display = 'block';
                    tipoPiezaC8.required = true;
                    break;
                case 'Administración plataforma':
                    tipoPiezaC9.parentElement.style.display = 'block';
                    tipoPiezaC9.required = true;
                    break;
                case 'Otro':
                    otraCategoria.parentElement.style.display = 'block';
                    otraCategoria.required = true;
                    break;
                default:
                    otroTipoPieza.parentElement.style.display = 'block';
                    otroTipoPieza.required = true;
                    break;
            }

            toggleOtroField(); // Asegura que el campo "Otro tipo de pieza" se actualice con el cambio de tipo de pieza
        }
        
        // Función para mostrar u ocultar el campo "Otro tipo de pieza"
        function toggleOtroField() {
            const tipoPiezaFields = [
                tipoPiezaC1, tipoPiezaC2, tipoPiezaC3, tipoPiezaC4, tipoPiezaC5,
                tipoPiezaC6, tipoPiezaC7, tipoPiezaC8, tipoPiezaC9
            ];

            let showOtroField = false; // Bandera para determinar si mostrar el campo "Otro tipo de pieza"

            // Verificar cada campo de selección si tiene el valor "Otro"
            tipoPiezaFields.forEach((field) => {
                if (field && field.value === 'Otro') {
                    showOtroField = true;
                }
            });

            // Mostrar u ocultar el campo "Otro tipo de pieza" basado en la bandera
            if (showOtroField) {
                otroTipoPieza.parentElement.style.display = 'block';
                otroTipoPieza.required = true;  // Hacer obligatorio el campo "Otro tipo de pieza"
            } else {
                otroTipoPieza.parentElement.style.display = 'none';
                otroTipoPieza.required = false; // Eliminar el requisito de obligatorio si no se muestra
            }
        }

        // Función para mostrar/ocultar secciones de archivos
        function toggleArchivoAqui() {
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

        // Función para mostrar/ocultar el div de archivos
        function toggleArchivoDiv() {
            if (piezaIncluidaSi.checked) {
                archivoDiv.style.display = 'none';
            } else if (piezaIncluidaNo.checked) {
                archivoDiv.style.display = 'block';
            } else {
                archivoDiv.style.display = 'none';
            }
        }

        // Función para activar/desactivar campos requeridos solo si son visibles
        function setRequiredFields(section, isRequired) {
            const inputs = section.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                const parentStyle = window.getComputedStyle(input.parentElement).display;
                
                // Verifica si el campo es visible
                if (parentStyle !== 'none') {
                    if (isRequired) {
                        input.setAttribute('required', 'required');
                    } else {
                        input.removeAttribute('required');
                    }
                } else {
                    input.removeAttribute('required'); // Asegura que los campos no visibles no sean requeridos
                }
            });
        }

        // Observador para cambios en los estilos de la sección form2
        const observer = new MutationObserver((mutationsList, observer) => {
            for (const mutation of mutationsList) {
                if (mutation.attributeName === 'style') {
                    const target = mutation.target;
                    const display = window.getComputedStyle(target).display;

                    // Si el display cambia a block, activar los campos requeridos solo si están visibles
                    if (display === 'block') {
                        setRequiredFields(target, true);
                    } else {
                        setRequiredFields(target, false);
                    }
                }
            }
        });

        // Configurar el observador
        const form2 = formulario.querySelector('.form2');
        if (form2) {
            observer.observe(form2, { attributes: true, attributeFilter: ['style'] });
        }

        // Event Listeners
        if (tipoPieza) tipoPieza.addEventListener('change', toggleTipoPiezaFields);

        if (piezaIncluidaSi) piezaIncluidaSi.addEventListener('change', toggleArchivoDiv);
        if (piezaIncluidaNo) piezaIncluidaNo.addEventListener('change', toggleArchivoDiv);
        if (cargarAqui) cargarAqui.addEventListener('change', toggleArchivoAqui);
        if (cargarWetransfer) cargarWetransfer.addEventListener('change', toggleArchivoAqui);

        // No es necesario agregar el listener a cada campo de tipo de pieza
        // Ya que esto se controla en el `tipoPieza.addEventListener`

        // Llamar las funciones de inicialización al cargar la página
        if (tipoPieza) tipoPieza.dispatchEvent(new Event('change')); // Forzar el evento change para inicializar el tipo de pieza adecuado
        toggleArchivoAqui(); // Inicializar visibilidad de archivos
        toggleArchivoDiv(); // Inicializar visibilidad del div
        toggleOtroField(); // Inicializar visibilidad del campo "Otro tipo de pieza"
    }

    // Inicializar el primer formulario
    initializeForm(document);
});