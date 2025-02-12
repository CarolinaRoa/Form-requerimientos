document.addEventListener('DOMContentLoaded', function () {
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

            // Aquí puedes realizar más validaciones si lo necesitas
            // Por ejemplo, mostrar información de los archivos seleccionados
            console.log('Nombre: ' + file.name + ', Tipo: ' + file.type + ', Tamaño: ' + file.size + ' bytes');
        }

        return true;
    }

    const clienteCampaña = document.getElementById('cliente-campaña');
    const otroClienteCampaña = document.getElementById('otro-cliente-campaña');
    const tipoPieza = document.getElementById('tipo-pieza');
    const tipoPiezaC1 = document.getElementById('tipo-pieza-c1');
    const tipoPiezaC2 = document.getElementById('tipo-pieza-c2');
    const tipoPiezaC3 = document.getElementById('tipo-pieza-c3');
    const tipoPiezaC4 = document.getElementById('tipo-pieza-c4');
    const tipoPiezaC5 = document.getElementById('tipo-pieza-c5');
    const tipoPiezaC6 = document.getElementById('tipo-pieza-c6');
    const tipoPiezaC7 = document.getElementById('tipo-pieza-c7');
    const tipoPiezaC8 = document.getElementById('tipo-pieza-c8');
    const tipoPiezaC9 = document.getElementById('tipo-pieza-c9');
    const otraCategoria = document.getElementById('otra-categoria');
    const otroTipoPieza = document.getElementById('otro-tipo-pieza');

    function toggleOtroField(element, targetField) {
        if (element.value === 'Otro') {
            targetField.parentElement.style.display = 'block';
        } else {
            targetField.parentElement.style.display = 'none';
        }
    }

    clienteCampaña.addEventListener('change', function () {
        toggleOtroField(this, otroClienteCampaña);
    });

    tipoPieza.addEventListener('change', function () {
        // Ocultar todos los campos de tipo de pieza
        tipoPiezaC1.parentElement.style.display = 'none';
        tipoPiezaC2.parentElement.style.display = 'none';
        tipoPiezaC3.parentElement.style.display = 'none';
        tipoPiezaC4.parentElement.style.display = 'none';
        tipoPiezaC5.parentElement.style.display = 'none';
        tipoPiezaC6.parentElement.style.display = 'none';
        tipoPiezaC7.parentElement.style.display = 'none';
        tipoPiezaC8.parentElement.style.display = 'none';
        tipoPiezaC9.parentElement.style.display = 'none';
        otraCategoria.parentElement.style.display = 'none';

        // Mostrar el campo correspondiente al tipo de pieza seleccionado
        switch (this.value) {
            case 'Banners':
                tipoPiezaC1.parentElement.style.display = 'block';
                break;
            case 'WhatsApp':
                tipoPiezaC2.parentElement.style.display = 'block';
                break;
            case 'Presentaciones editables':
                tipoPiezaC3.parentElement.style.display = 'block';
                break;
            case 'Mockups':
                tipoPiezaC4.parentElement.style.display = 'block';
                break;
            case 'Piezas animadas y audio':
                tipoPiezaC5.parentElement.style.display = 'block';
                break;
            case 'Impresos':
                tipoPiezaC6.parentElement.style.display = 'block';
                break;
            case 'Nuevos proyectos':
                tipoPiezaC7.parentElement.style.display = 'block';
                break;
            case 'Redes sociales':
                tipoPiezaC8.parentElement.style.display = 'block';
                break;
            case 'Administración plataforma':
                tipoPiezaC9.parentElement.style.display = 'block';
                break;
            case 'Otro':
                otraCategoria.parentElement.style.display = 'block';
                break;
            default:
                // Cualquier otro caso, ocultar el campo de otro tipo de pieza
                otroTipoPieza.parentElement.style.display = 'block';
                break;
        }
    });
    

    // Función para mostrar u ocultar el div de archivo basado en la selección de radio buttons
    const cargarAqui = document.getElementById('cargar-aqui');
    const cargarWetransfer = document.getElementById('cargar-wetransfer');
    const recursosAqui = document.getElementById('recursos-aqui');
    const recursosWetransfer = document.getElementById('recursos-wetransfer');

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

    cargarAqui.addEventListener('change', toggleArchivoAqui);
    cargarWetransfer.addEventListener('change', toggleArchivoAqui);
    toggleArchivoAqui(); // Llamar la función al cargar la página para establecer el estado inicial


    // Función para mostrar u ocultar el div de archivo basado en la selección de radio buttons
    const piezaIncluidaSi = document.getElementById('pieza-incluida-si');
    const piezaIncluidaNo = document.getElementById('pieza-incluida-no');
    const archivoDiv = document.getElementById('archivo-div');

    function toggleArchivoDiv() {
        if (piezaIncluidaNo.checked) {
            archivoDiv.style.display = 'block';
        } else {
            archivoDiv.style.display = 'none';
        }
    }

    piezaIncluidaSi.addEventListener('change', toggleArchivoDiv);
    piezaIncluidaNo.addEventListener('change', toggleArchivoDiv);
    toggleArchivoDiv(); // Llamar la función al cargar la página para establecer el estado inicial

    // Llamar las funciones de inicialización al cargar la página
    toggleOtroField(clienteCampaña, otroClienteCampaña);
    tipoPieza.dispatchEvent(new Event('change')); // Forzar el evento change para inicializar el tipo de pieza adecuado
});