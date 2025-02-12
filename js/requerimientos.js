document.addEventListener('DOMContentLoaded', function () {
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
        const otroTipoPieza = formulario.querySelector('[name="otro-tipo-pieza"]');
        const cargarAqui = formulario.querySelector('[name="cargar-recursos"][value="Cargar en form"]');
        const cargarWetransfer = formulario.querySelector('[name="cargar-recursos"][value="Cargar en WeTransfer"]');
        const recursosAqui = formulario.querySelector('#recursos-aqui');
        const recursosWetransfer = formulario.querySelector('#recursos-wetransfer');
        const piezaIncluidaSi = formulario.querySelector('[name="pieza-incluida"][value="Si"]');
        const piezaIncluidaNo = formulario.querySelector('[name="pieza-incluida"][value="No"]');
        const archivoDiv = formulario.querySelector('#archivo-div');

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
                tipoPiezaC6, tipoPiezaC7, tipoPiezaC8, tipoPiezaC9, otraCategoria
            ];

            tipoPiezaFields.forEach(field => {
                if (field && field.parentElement) {
                    field.parentElement.style.display = 'none';
                }
            });

            switch (tipoPieza.value) {
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
                    otroTipoPieza.parentElement.style.display = 'block';
                    break;
            }
        }

        function toggleOtroField(element, targetField) {
            if (element.value === 'Otro') {
                targetField.parentElement.style.display = 'block';
            } else {
                targetField.parentElement.style.display = 'none';
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

        // Event Listeners
        if (tipoPieza) tipoPieza.addEventListener('change', toggleTipoPiezaFields);
        if (piezaIncluidaSi) piezaIncluidaSi.addEventListener('change', toggleArchivoDiv);
        if (piezaIncluidaNo) piezaIncluidaNo.addEventListener('change', toggleArchivoDiv);
        if (cargarAqui) cargarAqui.addEventListener('change', toggleArchivoAqui);
        if (cargarWetransfer) cargarWetransfer.addEventListener('change', toggleArchivoAqui);

        // Para la función toggleOtroField
        const clienteCampaña = formulario.querySelector('[name="cliente-campaña"]');
        const otroClienteCampaña = formulario.querySelector('#otro-cliente-campaña');
        
        if (clienteCampaña) clienteCampaña.addEventListener('change', function() {
            toggleOtroField(clienteCampaña, otroClienteCampaña);
        });

        // Llamar las funciones de inicialización al cargar la página
        if (tipoPieza) tipoPieza.dispatchEvent(new Event('change')); // Forzar el evento change para inicializar el tipo de pieza adecuado
        toggleArchivoAqui(); // Inicializar visibilidad de archivos
        toggleArchivoDiv(); // Inicializar visibilidad del div
        toggleOtroField(clienteCampaña, otroClienteCampaña); // Inicializar visibilidad del campo "Otro"
    }

    // Inicializar el primer formulario
    initializeForm(document);

    // Lógica para agregar nuevos formularios hasta un máximo de 5
    let formularioCount = 1;
    const maxFormularios = 5;

    document.getElementById('agregar-formulario').addEventListener('click', function (event) {
        event.preventDefault(); // Prevenir el comportamiento predeterminado del botón
        if (formularioCount < maxFormularios) {
            formularioCount++;
            agregarFormulario();

            // Comprobar si se ha alcanzado el máximo de formularios
            if (formularioCount === maxFormularios) {
                // Ocultar el botón
                document.getElementById('agregar-formulario').style.display = 'none';
            }
        }
        
    });
    
    /*function agregarFormulario() {
        const formulariosContainer = document.getElementById('formularios-container');
        const nuevoFormulario = document.createElement('div');
        nuevoFormulario.classList.add('formulario-dinamico');
        // Aseguramos que cada formulario tenga un id único para poder eliminarlo
        nuevoFormulario.id = `formulario-${formularioCount}`;
        
        
        nuevoFormulario.innerHTML = `
            <!-- Aquí puedes copiar el contenido HTML de tu formulario -->
            <!-- Reemplaza esto con el contenido de tu formulario -->
            <div class="row mt-3">
                <div class="col-md-11">
                    <h3>Pieza ${formularioCount}</h3>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger eliminar-formulario">Eliminar</button>
                </div>
                <div class="col-md-6">
                    <label for="tipo-pieza">Categoría</label>
                    <select name="tipo-pieza" id="tipo-pieza" class="form-control" required>
                        <option value="" disabled selected>Selecciona la categoría</option>
                        <option value="Banners">Banners</option>
                        <option value="WhatsApp">WhatsApp</option>
                        <option value="Presentaciones editables">Presentaciones editables</option>
                        <option value="Mockups">Mockups</option>
                        <option value="Piezas animadas y audio">Piezas animadas y audio</option>
                        <option value="Impresos">Impresos</option>
                        <option value="Nuevos proyectos">Nuevos proyectos</option>
                        <option value="Redes sociales">Redes sociales</option>
                        <option value="Administración plataforma">Administración plataforma</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="tipo-pieza-c1">Banners</label>
                    <select name="tipo-pieza-c1" id="tipo-pieza-c1" class="form-control">
                        <option value="" disabled selected>Selecciona el tipo de banner</option>
                        <option value="Banners plataforma">Banners plataforma</option>
                        <option value="Banners WhatsApp">Banners WhatsApp</option>
                        <option value="Banners mailling">Banners mailling</option>
                        <option value="Banners calendario comercial">Banners calendario comercial</option>
                        <option value="Banners comunicación interna">Banners comunicación interna</option>
                        <option value="Banners infografías">Banners infografías</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="tipo-pieza-c2">WhatsApp</label>
                    <select name="tipo-pieza-c2" id="tipo-pieza-c2" class="form-control">
                        <option value="" disabled selected>Selecciona el tipo de pieza</option>
                        <option value="Paso a paso general">Paso a paso general</option>
                        <option value="Stickers WhatsApp">Stickers WhatsApp</option>
                        <option value="Personaje WhatsApp">Personaje WhatsApp</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="tipo-pieza-c3">Presentaciones editables</label>
                    <select name="tipo-pieza-c3" id="tipo-pieza-c3" class="form-control">
                        <option value="" disabled selected>Selecciona el tipo de ppt</option>
                        <option value="PPT templates retos">PPT templates retos</option>
                        <option value="PPT catálogo editable">PPT catálogo editable</option>
                        <option value="PPT presentación editable">PPT presentación editable</option>
                        <option value="PPT Plantillas bonos Kupaa">PPT Plantillas bonos Kupaa</option>
                        <option value="PPT comercial">PPT comercial</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="tipo-pieza-c4">Mockups</label>
                    <select name="tipo-pieza-c4" id="tipo-pieza-c4" class="form-control">
                        <option value="" disabled selected>Selecciona el tipo de mockup</option>
                        <option value="Actualización contenido App">Mockups bonos Kupaa</option>
                        <option value="Mockups productos catálogo">Mockups productos catálogo</option>
                        <option value="Mockups actividades campañas">Mockups actividades campañas</option>
                        <option value="Mockups dotaciones FNB">Mockups dotaciones FNB</option>
                        <option value="Mockups merchandising">Mockups merchandising</option>
                        <option value="Mockups POP">Mockups POP</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="tipo-pieza-c5">Piezas animadas y audio</label>
                    <select name="tipo-pieza-c5" id="tipo-pieza-c5" class="form-control">
                        <option value="" disabled selected>Selecciona el tipo de pieza</option>
                        <option value="Capsula animada">Capsula animada</option>
                        <option value="Capsula paso a paso">Capsula paso a paso</option>
                        <option value="Capsula general plataforma">Capsula general plataforma</option>
                        <option value="Gif animado">Gif animado</option>
                        <option value="Cuñas perifoneo">Cuñas perifoneo</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="tipo-pieza-c6">Impresos</label>
                    <select name="tipo-pieza-c6" id="tipo-pieza-c6" class="form-control">
                        <option value="" disabled selected>Selecciona el tipo de impreso</option>
                        <option value="Diseño material impreso / POP">Diseño material impreso / POP</option>
                        <option value="Diseño caja (plano mecánico)">Diseño caja (plano mecánico)</option>
                        <option value="Impresión carnets">Impresión carnets</option>
                        <option value="Manual producto">Manual producto</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="tipo-pieza-c7">Nuevos proyectos</label>
                    <select name="tipo-pieza-c7" id="tipo-pieza-c7" class="form-control">
                        <option value="" disabled selected>Selecciona el tipo de pieza</option>
                        <option value="Mockups Plataforma">Mockups Plataforma</option>
                        <option value="Mockups App">Mockups App</option>
                        <option value="Propuesta logotipo">Propuesta logotipo</option>
                        <option value="Propuesta Kv">Propuesta Kv</option>
                        <option value="PPT propuesta licitación">PPT propuesta licitación</option>
                        <option value="Piezas digitales bingo">Piezas digitales bingo</option>
                        <option value="Diseño landing page">Diseño landing page</option>
                        <option value="Desarrollo de prototipos">Desarrollo de prototipos</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="tipo-pieza-c8">Redes sociales</label>
                    <select name="tipo-pieza-c8" id="tipo-pieza-c8" class="form-control">
                        <option value="" disabled selected>Selecciona el tipo de pieza</option>
                        <option value="Publicaciones redes sociales">Publicaciones redes sociales</option>
                        <option value="Video TikTok">Video TikTok</option>
                        <option value="Historia">Historia</option>
                        <option value="Reel">Reel</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="tipo-pieza-c9">Administración plataforma</label>
                    <select name="tipo-pieza-c9" id="tipo-pieza-c9" class="form-control">
                        <option value="" disabled selected>Selecciona el tipo de pieza</option>
                        <option value="Crear nueva campaña">Crear nueva campaña</option>
                        <option value="Publicar banners">Publicar banners</option>
                        <option value="Publicar T&C">Publicar T&C</option>
                        <option value="Mockups Plataforma">Mockups Plataforma</option>
                        <option value="Mockups App">Mockups App</option>
                        <option value="Vestir plataforma">Vestir plataforma</option>
                        <option value="Vestir App">Vestir App</option>
                        <option value="Actualización contenido App">Actualización contenido App</option>
                        <option value="Seguimientos plataforma">Seguimientos plataforma</option>
                        <option value="Plantillas mail plataforma">Plantillas mail plataforma</option>
                        <option value="Punto plataforma">Punto plataforma</option>
                        <option value="Imágenes galeria carrusel">Imágenes galeria carrusel</option>
                        <option value="Responsive plataforma">Responsive plataforma</option>
                        <option value="Crear módulo">Crear módulo</option>
                        <option value="Ajustes plataforma">Ajustes plataforma</option>
                        <option value="Cronometro vencimiento puntos">Cronometro vencimiento puntos</option>
                        <option value="Configurar módulo conocimiento">Configurar módulo conocimiento</option>
                        <option value="Cargar curso módulo conocimiento">Cargar curso módulo conocimiento</option>
                        <option value="Ajustes módulo de conocimiento">Ajustes módulo de conocimiento</option>
                        <option value="Publicar calendario comercial">Publicar calendario comercial</option>
                        <option value="Crear módulos para perfiles">Crear módulos para perfiles</option>
                        <option value="Ajustes perfiles">Ajustes perfiles</option>
                        <option value="Códigos Google Analytics">Códigos Google Analytics</option>
                        <option value="Configuración visual de bolsas">Configuración visual de bolsas</option>
                        <option value="Html mails / firmas">Html mails / firmas</option>
                        <option value="Enrrutar plataforma">Enrrutar plataforma</option>
                        <option value="Recursos dashboard">Recursos dashboard</option>
                        <option value="Formulario de captura">Formulario de captura</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="">¿Cual?</label>
                    <input type="text" class="form-control" id="otra-categoria" name="otra-categoria">
                </div>        
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <label for="">Objetivo de la pieza</label>
                    <textarea name="objetivo-pieza" id="objetivo-pieza" rows="3" class="form-control" placeholder="Describe detalladamente el objetivo de la pieza. Escribe mínimo 20 caracteres." required minlength="20"></textarea>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-4">
                    <label for="pieza-incluida-${formularioCount}">¿La pieza está incluida en la campaña?</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="pieza-incluida-${formularioCount}" id="pieza-incluida-si" value="Si" required>
                        <label class="form-check-label" for="pieza-incluida-si">Sí</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="pieza-incluida-${formularioCount}" id="pieza-incluida-no" value="No">
                        <label class="form-check-label" for="pieza-incluida-no">No</label>
                    </div>
                </div>
                <div class="col-md-8">
                    <div id="archivo-div" style="display:none;">
                        <label for="archivo" style="font-size: medium;">Aquí debes cargar la imagen de aprobación de cotización por parte del cliente.<br></label>
                        <input type="file" id="archivo" name="archivo[]" class="form-control-file" multiple
                        accept=".jpg, .jpeg, .png, .gif, .pdf, .doc, .docx, .xls, .xlsx, .ppt, .pptx"/>
                        <small class="form-text text-muted">Puedes seleccionar múltiples archivos. Peso máximo 5MB*.</small>
                    </div>
                </div>
            </div>                        

            <div class="row mt-3">
                <div class="col-md-12">
                    <label for="">Copy</label>
                    <textarea name="copy" id="copy" rows="2" class="form-control"
                        placeholder="Por favor déjanos el texto sugerido para la pieza. Ten en cuenta datos obligatorios como: Fechas, sitios, nombres, productos, información específica. Escribe mínimo 20 caracteres." required minlength="20"></textarea>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <label for="">¿Se puede modificar el copy?</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="modficar-copy-${formularioCount}" id="modficar-copy-si" value="Si" required>
                        <label class="form-check-label" for="modificar-si">Sí</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="modficar-copy-${formularioCount}" id="modficar-copy-no" value="No">
                        <label class="form-check-label" for="modficar-copy-no">No</label>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <label for="">Detalles que debemos tener en cuenta</label>
                    <textarea name="detalles" id="detalles" rows="5" class="form-control"
                        placeholder="Si hay detalles específicos, por favor déjalos aquí ( Colores, imágenes, formato, recursos etc). Escribe mínimo 20 caracteres." required minlength="20"></textarea>
                </div>
            </div>

            <div class="row mt-3">
                <label for="">Aquí puedes cargar imagenes o archivos de apoyo para el requerimiento.</label> <br>
                <div class="col-md-4 subir-recursos">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="cargar-recursos-${formularioCount}" id="cargar-aqui-${formularioCount}" value="Cargar en form">
                        <label class="form-check-label" for="cargar-aqui">Cargar aquí</label>
                    </div>        
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="cargar-recursos-${formularioCount}" id="cargar-wetransfer-${formularioCount}" value="Cargar en WeTransfer">
                        <label class="form-check-label" for="cargar-wetransfer">Cargar por WeTransfer</label>
                    </div>
                </div>

                <div class="col-md-7">
                    <div id="recursos-aqui" style="display:none;">
                        <input type="file" id="archivo-apoyo" name="archivo-apoyo[]" class="form-control-file" multiple
                        accept=".jpg, .jpeg, .png, .gif, .pdf, .doc, .docx, .xls, .xlsx, .ppt, .pptx"/>
                        <small class="form-text text-muted">Puedes seleccionar múltiples archivos. Peso máximo 5MB*.</small>
                    </div>

                    <div id="recursos-wetransfer" style="display:none;">
                        <label for="" style="font-size: medium;">Haz clic sobre el link y envía el archivo <a href="https://grupomerpes.wetransfer.com" target="_blank">https://grupomerpes.wetransfer.com</a></label>
                    </div>

                </div>

                </div>

            </div>
        `;
        // Añadir el event listener al botón de eliminar
        const botonEliminar = nuevoFormulario.querySelector('.eliminar-formulario');
        botonEliminar.addEventListener('click', () => {
            nuevoFormulario.remove();
        });
        formulariosContainer.appendChild(nuevoFormulario);
        initializeForm(nuevoFormulario);
    }*/
    
});
