document.addEventListener('DOMContentLoaded', function () {
    // Función para inicializar el formulario
    function initializeForm(formulario) {
        const tipoPieza = formulario.querySelector('[name="tipo-pieza"]');
        const tipoPiezaC1 = formulario.querySelector('[name="tipo-pieza-c1"]');
        const tipoPiezaC2 = formulario.querySelector('[name="tipo-pieza-c2"]');
        const tipoPiezaC3 = formulario.querySelector('[name="tipo-pieza-c3"]');
        const tipoPiezaC4 = formulario.querySelector('[name="tipo-pieza-c4"]');
        const tipoPiezaC5 = formulario.querySelector('[name="tipo-pieza-c5"]');
        const tipoPiezaC6 = formulario.querySelector('[name="tipo-pieza-c6"]');
        const tipoPiezaC7 = formulario.querySelector('[name="tipo-pieza-c7"]');
        const tipoPiezaC8 = formulario.querySelector('[name="tipo-pieza-c8"]');
        const tipoPiezaC9 = formulario.querySelector('[name="tipo-pieza-c9"]');
        const otraCategoria = formulario.querySelector('[name="otra-categoria"]');
        const otroTipoPieza = formulario.querySelector('[name="otra-pieza"]');
        const cargarAqui = formulario.querySelector('[name="cargar-recursos"][value="Cargar en form"]');
        const cargarWetransfer = formulario.querySelector('[name="cargar-recursos"][value="Cargar en WeTransfer"]');
        const recursosAqui = formulario.querySelector('#recursos-aqui');
        const recursosWetransfer = formulario.querySelector('#recursos-wetransfer');
        const piezaIncluidaSi = formulario.querySelector('[name="pieza-incluida"][value="Si"]');
        const piezaIncluidaNo = formulario.querySelector('[name="pieza-incluida"][value="No"]');
        const archivoDiv = formulario.querySelector('#archivo-div');
        const cantidadPiezas = formulario.querySelector('[name="cantidad-piezas"]');

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

        function toggleArchivoDiv() {
            if (piezaIncluidaSi.checked)
                archivoDiv.style.display = 'none';
            else if (piezaIncluidaNo.checked)
                archivoDiv.style.display = 'block';
            else {
                archivoDiv.style.display = 'none';
            }
        }

        // Nueva función para mostrar las secciones basadas en la cantidad de piezas
        function toggleFormSections() {
            const forms = formulario.querySelectorAll('section.form2, section.form3, section.form4, section.form5');

            // Ocultar todas las secciones inicialmente
            forms.forEach((form, index) => {
                form.style.display = 'none';
            });

            // Mostrar las secciones correspondientes a la selección
            const cantidad = parseInt(cantidadPiezas.value);

            // Asegúrate de que el número seleccionado está dentro de los valores válidos
            if (cantidad >= 2 && cantidad <= 5) {
                for (let i = 1; i < cantidad; i++) { // Empezamos en 1 para que no se muestre nada si cantidad es 1
                    if (forms[i - 1]) { // Ajustamos el índice para que coincida con las secciones form2, form3, etc.
                        forms[i - 1].style.display = 'block';
                    }
                }
            }
        }

        // Event Listeners
        if (tipoPieza) tipoPieza.addEventListener('change', toggleTipoPiezaFields);
        if (piezaIncluidaSi) piezaIncluidaSi.addEventListener('change', toggleArchivoDiv);
        if (piezaIncluidaNo) piezaIncluidaNo.addEventListener('change', toggleArchivoDiv);
        if (cargarAqui) cargarAqui.addEventListener('change', toggleArchivoAqui);
        if (cargarWetransfer) cargarWetransfer.addEventListener('change', toggleArchivoAqui);
        if (cantidadPiezas) cantidadPiezas.addEventListener('change', toggleFormSections);

        // Para la función toggleOtroField
        const clienteCampaña = formulario.querySelector('[name="cliente-campaña"]');
        const otroClienteCampaña = formulario.querySelector('#otro-cliente-campaña');

        if (clienteCampaña) clienteCampaña.addEventListener('change', function () {
            toggleOtroField(clienteCampaña, otroClienteCampaña);
        });

        // Aquí agregamos los event listeners para cada uno de los campos de tipo pieza
        const tipoPiezaFields = [
            tipoPiezaC1, tipoPiezaC2, tipoPiezaC3, tipoPiezaC4, tipoPiezaC5,
            tipoPiezaC6, tipoPiezaC7, tipoPiezaC8, tipoPiezaC9
        ];

        tipoPiezaFields.forEach((field) => {
            if (field) {
                field.addEventListener('change', toggleOtroField);
            }
        });

        // Llamar las funciones de inicialización al cargar la página
        if (tipoPieza) tipoPieza.dispatchEvent(new Event('change')); // Forzar el evento change para inicializar el tipo de pieza adecuado
        toggleArchivoAqui(); // Inicializar visibilidad de archivos
        toggleArchivoDiv(); // Inicializar visibilidad del div
        toggleOtroField(); // Inicializar visibilidad del campo "Otro tipo de pieza"
    }

    // Inicializar el primer formulario
    initializeForm(document);
});
