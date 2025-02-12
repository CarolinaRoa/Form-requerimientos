<?php

header('Content-Type: text/html; charset=utf-8');

// Incluir la biblioteca PHPMailer
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Obtener los valores del formulario de forma segura
$nombre_cliente = filter_input(INPUT_POST, 'nombre-cliente', FILTER_SANITIZE_STRING);
$nombre_campana = filter_input(INPUT_POST, 'nombre-campana', FILTER_SANITIZE_STRING);
$pais = filter_input(INPUT_POST, 'pais', FILTER_SANITIZE_STRING);
$marcas = filter_input(INPUT_POST, 'marcas', FILTER_SANITIZE_STRING);
$personas = filter_input(INPUT_POST, 'personas', FILTER_SANITIZE_STRING);
$tipo = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_STRING);

// Manejo de arrays desde el formulario
$tipo_ffvv = filter_input(INPUT_POST, 'tipo_ffvv', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY) ?? array();
$tipo_ffvv_texto = implode(", ", $tipo_ffvv); // Convertir el array en una cadena separada por comas

$canal_ffvv = filter_input(INPUT_POST, 'canal_ffvv', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY) ?? array();
$canal_ffvv_texto = implode(", ", $canal_ffvv);

$cliente_final = filter_input(INPUT_POST, 'cliente_final', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY) ?? array();
$cliente_final_texto = implode(", ", $cliente_final);

$objetivo_general = filter_input(INPUT_POST, 'objetivo_general', FILTER_SANITIZE_STRING);
$target_group = filter_input(INPUT_POST, 'target_group', FILTER_SANITIZE_STRING);
$sienta = filter_input(INPUT_POST, 'sienta', FILTER_SANITIZE_STRING);
$piense = filter_input(INPUT_POST, 'piense', FILTER_SANITIZE_STRING);
$haga = filter_input(INPUT_POST, 'haga', FILTER_SANITIZE_STRING);
$pautas = filter_input(INPUT_POST, 'pautas', FILTER_SANITIZE_STRING);
$tono = filter_input(INPUT_POST, 'tono', FILTER_SANITIZE_STRING);
$concepto = filter_input(INPUT_POST, 'concepto', FILTER_SANITIZE_STRING);
$otros_mockups = filter_input(INPUT_POST, 'necesidad-otros', FILTER_SANITIZE_STRING);

// Comprobación de campos condicionales
if ($concepto === "Si") {
    $concepto_tematica_cual = filter_input(INPUT_POST, 'concepto_tematica_cual', FILTER_SANITIZE_STRING);
} else {
    $concepto_tematica_cual = "No";
}

$preferencia = filter_input(INPUT_POST, 'preferencia', FILTER_SANITIZE_STRING);
if ($preferencia === "Si") {
    $preferencia_color_cual = filter_input(INPUT_POST, 'preferencia_color_cual', FILTER_SANITIZE_STRING);
} else {
    $preferencia_color_cual = "No";
}

$logo = filter_input(INPUT_POST, 'logo', FILTER_SANITIZE_STRING);
if ($logo === "Si") {
    $logo_cual = filter_input(INPUT_POST, 'logo_cual', FILTER_SANITIZE_STRING);
} else {
    $logo_cual = "No";
}

$temas_caracteristicas = filter_input(INPUT_POST, 'temas_caracteristicas', FILTER_SANITIZE_STRING);
$elementos_no = filter_input(INPUT_POST, 'elementos_no', FILTER_SANITIZE_STRING);
$inspiracion = filter_input(INPUT_POST, 'inspiracion', FILTER_SANITIZE_STRING);

// Manejo de arrays desde el formulario (checkboxes)
$necesidades_desktop = filter_input(INPUT_POST, 'necesidad-desktop', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY) ?? array();
$necesidades_desktop_texto = implode(", ", $necesidades_desktop);

$necesidades_app = filter_input(INPUT_POST, 'necesidad-app', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY) ?? array();
$necesidades_app_texto = implode(", ", $necesidades_app);

$necesidades_actividades = filter_input(INPUT_POST, 'necesidad-actividades', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY) ?? array();
$necesidades_actividades_texto = implode(", ", $necesidades_actividades);

$necesidades_otros_mockups = filter_input(INPUT_POST, 'necesidad-otros-mockups', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY) ?? array();
$necesidades_otros_mockups_texto = implode(", ", $necesidades_otros_mockups);

$punto = filter_input(INPUT_POST, 'valor_punto', FILTER_SANITIZE_STRING);
if ($punto === "Si") {
    $punto_cual = filter_input(INPUT_POST, 'valor_punto_cual', FILTER_SANITIZE_STRING);
} else {
    $punto_cual = "No";
}

$fecha_entrega = filter_input(INPUT_POST, 'fecha-entrega-licitacion', FILTER_SANITIZE_STRING);
$nombre = filter_input(INPUT_POST, 'nombre-licitacion', FILTER_SANITIZE_STRING);
$correo_solicitante = filter_input(INPUT_POST, 'correo-solicitante-licitacion', FILTER_SANITIZE_EMAIL);
$correo_copia = filter_input(INPUT_POST, 'email-copia-licitacion', FILTER_SANITIZE_STRING);

// Archivos de apoyo
$archivos_apoyo_licitacion = [];
if (!empty($_FILES['archivo-apoyo-licitacion']['name'][0])) {
    foreach ($_FILES['archivo-apoyo-licitacion']['tmp_name'] as $key => $tmp_name) {
        $archivo_apoyo_nombre_licitacion = $_FILES['archivo-apoyo-licitacion']['name'][$key];
        $archivos_apoyo_licitacion[] = [
            'tmp_name' => $tmp_name,
            'nombre' => $archivo_apoyo_nombre_licitacion,
        ];
    }
}

// Construir el cuerpo del correo en HTML
$cuerpoCorreo = '
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Correo de Requerimiento de Diseño</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                line-height: 1.6;
                background-color: #f9f9f9;
                padding: 20px;
            }
            .container {
                max-width: 600px;
                margin: 0 auto;
                background-color: #fff;
                padding: 20px;
                border: 1px solid #ddd;
                border-radius: 5px;
            }
            h2 {
                color: #333;
                border-bottom: 1px solid #ddd;
                padding-bottom: 10px;
            }
            p {
                margin-bottom: 10px;
            }
            .section {
                margin-bottom: 20px;
            }
            .archivo-list {
                margin-left: 20px;
                color: #666;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>Formulario de Requerimientos de Licitación ' . htmlspecialchars($nombre_cliente) . '</h2>
            <div class="section">
                <h3>Información genereal</h3>
                <p><strong>Nombre cliente:</strong> ' . htmlspecialchars($nombre_cliente) . '</p>
                <p><strong>Nombre campaña:</strong> ' . htmlspecialchars($nombre_campana) . '</p>
                <p><strong>País:</strong> ' . htmlspecialchars($pais) . '</p>
                <p><strong>Marcas a impactar:</strong> ' . htmlspecialchars($marcas) . '</p>
                <p><strong>Personas a impactar:</strong> ' . htmlspecialchars($personas) . '</p>
                <p><strong>Tipo de campaña:</strong> ' . htmlspecialchars($tipo) . '</p>
                <p><strong>Fuerza de ventas:</strong> ' . htmlspecialchars($tipo_ffvv_texto) . '</p>
                <p><strong>Canal de ventas:</strong> ' . htmlspecialchars($canal_ffvv_texto) . '</p>
                <p><strong>Cliente final:</strong> ' . htmlspecialchars($cliente_final_texto) . '</p>
                <h3>Características del proyecto</h3>
                <p><strong>Racional:</strong> ' . htmlspecialchars($objetivo_general) . '</p>
                <p><strong>Target group:</strong> ' . htmlspecialchars($target_group) . '</p>
                <p><strong>Sienta:</strong> ' . htmlspecialchars($sienta) . '</p>
                <p><strong>Piensa:</strong> ' . htmlspecialchars($piense) . '</p>
                <p><strong>Haga:</strong> ' . htmlspecialchars($haga) . '</p>
                <h3>Detalles del concepto</h3>
                <p><strong>Pautas que debemos tener en cuenta para el desarrollo de la ppt:</strong> ' . htmlspecialchars($pautas) . '</p>
                <p><strong>Tono:</strong> ' . htmlspecialchars($tono) . '</p>
                <p><strong>¿Tienes algún concepto o temática en mente?:</strong> ' . htmlspecialchars($concepto) . '</p>
                <p><strong>¿Cuál?</strong> ' . htmlspecialchars($concepto_tematica_cual) . '</p>
                <p><strong>Preferencia de color:</strong> ' . htmlspecialchars($preferencia) . '</p>
                <p><strong>¿Cuál?</strong> ' . htmlspecialchars($preferencia_color_cual) . '</p>
                <p><strong>¿Hay algún elemento que quisieras incluir en el logo?</strong> ' . htmlspecialchars($logo) . '</p>
                <p><strong>¿Cuál?</strong> ' . htmlspecialchars($logo_cual) . '</p>
                <p><strong>Temas y características:</strong> ' . htmlspecialchars($temas_caracteristicas) . '</p>
                <p><strong>Elementos que no debe tener la ppt:</strong> ' . htmlspecialchars($elementos_no) . '</p>
                <p><strong>Inspiración:</strong> ' . htmlspecialchars($inspiracion) . '</p>
                <h2>Detalles de la ppt</h2>
                <h3>Mockups que necesitas</h3>
                <p><strong>Desktop:</strong> ' . htmlspecialchars($necesidades_desktop_texto) . '</p>
                <p><strong>App:</strong> ' . htmlspecialchars($necesidades_app_texto) . '</p>
                <p><strong>Actividades:</strong> ' . htmlspecialchars($necesidades_actividades_texto) . '</p>
                <p><strong>Otros mockups:</strong> ' . htmlspecialchars($necesidades_otros_mockups_texto) . '</p>
                <p><strong>Otros ¿Cuáles?:</strong> ' . htmlspecialchars($otros_mockups) . '</p>
                <h3>Puntos</h3>
                <p><strong>¿Tienes algún punto en mente?</strong> ' . htmlspecialchars($punto) . '</p>
                <p><strong>¿Cuál?</strong> ' . htmlspecialchars($punto_cual) . '</p>
                <p><strong>Fecha estimada de entrega:</strong> ' . htmlspecialchars($fecha_entrega) . '</p>
                <p><strong>Nombre del solicitante:</strong> ' . htmlspecialchars($nombre) . '</p>
                <p><strong>Correo del solicitante:</strong> ' . htmlspecialchars($correo_solicitante) . '</p>
                <p><strong>Correos en copia:</strong> ' . htmlspecialchars($correo_copia) . '</p>
            </div>
            <h3>Archivos de Apoyo</h3>
            <div class="section">
                <ul class="archivo-list">
';

// Listar los archivos de apoyo en el correo
foreach ($archivos_apoyo_licitacion as $archivo) {
    $cuerpoCorreo .= '<li>' . htmlspecialchars($archivo['nombre']) . '</li>';
}

    // Agregar imagen de agradecimiento solo para los correos en copia y solicitante
    $cuerpoCorreo .= '
        <div class="section">
            <img src="https://grupomerpes.com/forms/requerimientosdiseno/img/enviado.jpg" alt="Imagen de Agradecimiento" style="width: 100%;">
        </div>
    </div>
    </body>
    </html>';

// Crear una instancia de PHPMailer
$mail = new PHPMailer(true);

try {
    // Configuración del servidor
    $mail->isSMTP();
    $mail->Host = 'smtp.office365.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'contactanos@grupomerpes.com';
    $mail->Password = 'Cor53794';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Destinatarios
    $mail->setFrom('contactanos@grupomerpes.com', 'Equipo de diseño');
    $mail->addAddress('disenoweb@grupomerpes.com'); // Dirección de correo del destinatario
    $mail->addAddress('jefediseno@grupomerpes.com'); // Otra dirección de correo del destinatario
    $mail->addAddress('a.pacheco@grupomerpes.com'); // Otra dirección de correo del destinatario
    $mail->addAddress('grupomerpesredes@gmail.com'); // Otra dirección de correo del destinatario

    // Validar y añadir correos en copia
    if (!empty($correo_copia)) {
        // Dividir la cadena de correos por coma y espacio
        $correos_copia = explode(', ', $correo_copia);
        // Añadir cada correo a la lista de CC
        foreach ($correos_copia as $correo) {
            if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $mail->addCC($correo);
            } else {
                echo "Correo inválido en copia: {$correo}";
            }
        }
    }

    // Archivos adjuntos
    foreach ($archivos_apoyo_licitacion as $archivo) {
        $mail->addAttachment($archivo['tmp_name'], $archivo['nombre']);
    }

    // Contenido del correo
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Subject = 'Requerimiento de licitación ' . $nombre_cliente;
    $mail->Body = $cuerpoCorreo;

    // Enviar correo
    $mail->send();

    // Mostrar una imagen o mensaje de agradecimiento al usuario
    echo '<img src="https://grupomerpes.com/forms/requerimientosdiseno/img/enviado.jpg" alt="Imagen" id="mi-imagen" style="width:100%">';

    // Script JavaScript para ocultar la imagen después de 5 segundos
    echo '<script>
    setTimeout(function() {
    document.getElementById("mi-imagen").style.display = "none";
    window.location.href = "https://grupomerpes.com/forms/requerimientosdiseno/";
    }, 15000); // 15000 milisegundos = 15 segundos
    </script>';

} catch (Exception $e) {
    echo "Hubo un error al enviar el correo: {$mail->ErrorInfo}";
}

?>
