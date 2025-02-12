<?php

// Incluir la biblioteca PHPMailer
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Obtener los valores del formulario
$cliente_campaña = $_POST['cliente-campaña'];
$fecha_solicitud = $_POST['fecha-solicitud'];

$tipo_pieza = $_POST['tipo-pieza'];
$otro_cliente_campaña = isset($_POST['otro-cliente-campaña']) ? $_POST['otro-cliente-campaña'] : '';
$objetivo_pieza = $_POST['objetivo-pieza'];
$pieza_incluida = $_POST['pieza-incluida'];
$copy = $_POST['copy'];
$modificar_copy = $_POST['modficar-copy'];
$detalles = $_POST['detalles'];
$cargar_recursos = $_POST['cargar-recursos'] ?? '';

$fecha_entrega = $_POST['fecha-entrega'];
$nombre = $_POST['nombre'];
$correo_solicitante = $_POST['correo-solicitante'];
$correo_copia = $_POST['email-copia'];


// Obtener el tipo de pieza específico dependiendo de la categoría seleccionada
switch ($tipo_pieza) {
    case 'Banners':
        $tipo_pieza_especifico = $_POST['tipo-pieza-c1'];
        break;
    case 'WhatsApp':
        $tipo_pieza_especifico = $_POST['tipo-pieza-c2'];
        break;
    case 'Presentaciones editables':
        $tipo_pieza_especifico = $_POST['tipo-pieza-c3'];
        break;
    case 'Mockups':
        $tipo_pieza_especifico = $_POST['tipo-pieza-c4'];
        break;
    case 'Piezas animadas y audio':
        $tipo_pieza_especifico = $_POST['tipo-pieza-c5'];
        break;
    case 'Impresos':
        $tipo_pieza_especifico = $_POST['tipo-pieza-c6'];
        break;
    case 'Nuevos proyectos':
        $tipo_pieza_especifico = $_POST['tipo-pieza-c7'];
        break;
    case 'Redes sociales':
        $tipo_pieza_especifico = $_POST['tipo-pieza-c8'];
        break;
    case 'Administración plataforma':
        $tipo_pieza_especifico = $_POST['tipo-pieza-c9'];
        break;
    case 'Otro':
        $tipo_pieza_especifico = $_POST['otro-tipo-pieza'];
        break;
    default:
        $tipo_pieza_especifico = '';
        break;
}

// Archivos adjuntos
$archivos = array();
if (!empty($_FILES['archivo']['name'][0])) {
    foreach ($_FILES['archivo']['tmp_name'] as $key => $tmp_name) {
        $archivo_nombre = $_FILES['archivo']['name'][$key];
        $archivos[] = array(
            'tmp_name' => $tmp_name,
            'nombre' => $archivo_nombre
        );
    }
}

// Archivos de apoyo
$archivos_apoyo = array();
if (!empty($_FILES['archivo-apoyo']['name'][0])) {
    foreach ($_FILES['archivo-apoyo']['tmp_name'] as $key => $tmp_name) {
        $archivo_apoyo_nombre = $_FILES['archivo-apoyo']['name'][$key];
        $archivos_apoyo[] = array(
            'tmp_name' => $tmp_name,
            'nombre' => $archivo_apoyo_nombre
        );
    }
}

// Crear una instancia de PHPMailer
$mail = new PHPMailer(true);

try {
    // Configurar el servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.office365.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'contactanos@grupomerpes.com';
    $mail->Password = 'Cor53794';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Configurar el remitente y destinatarios
    $mail->setFrom('contactanos@grupomerpes.com', 'Equipo de diseño');

    // Destinatarios principales fijos
    $mail->addAddress('disenoweb@grupomerpes.com', 'Destinatario 1');
    $mail->addAddress('jefediseno@grupomerpes.com', 'Destinatario 2');
    $mail->addAddress('grupomerpesredes@gmail.com', 'Destinatario 3');

    // Agregar el correo del solicitante como destinatario
    $mail->addAddress($correo_solicitante, 'Solicitante');

    // Agregar el correo copia como destinatario, si se proporcionó
    if (!empty($correo_copia)) {
        // Separar los correos electrónicos por comas y espacios
        $correos_copia_array = explode(', ', $correo_copia);

        // Inicializar la variable para almacenar todos los correos
        $correos_validos = [];

        // Agregar cada correo como destinatario y validar
        foreach ($correos_copia_array as $correo) {
            $correo = trim($correo); // Eliminar espacios en blanco adicionales
            if (!empty($correo) && filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $correos_validos[] = $correo;
                // Aquí puedes agregar el correo a los destinatarios
                $mail->addAddress($correo);
            } else {
                echo "Correo inválido: $correo<br>";
            }
        }

        // Unir los correos válidos de nuevo en una cadena separada por comas y espacios
        $correos_copia_final = implode(', ', $correos_validos);
    }

    // Configurar el contenido del correo electrónico
    $mail->isHTML(true); // Configurar PHPMailer para enviar correo HTML
    $mail->CharSet = 'UTF-8';
    $mail->Subject = $cliente_campaña . ' ' . $tipo_pieza_especifico . ' ' . $correo_solicitante;

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
            <h2>Formulario de Requerimientos de Diseño</h2>
            <div class="section">
                <p><strong>Cliente y/o campaña:</strong> ' . htmlspecialchars($cliente_campaña) . '</p>';

    // Agregar condicional para incluir otro cliente/campaña si es necesario
    if ($cliente_campaña == 'Otro') {
        $cuerpoCorreo .= '<p><strong>Otro cliente y/o campaña:</strong> ' . htmlspecialchars($otro_cliente_campaña) . '</p>';
    }

    // Continuar con el resto del contenido del formulario
    $cuerpoCorreo .= '
            <p><strong>Categoría de pieza:</strong> ' . htmlspecialchars($tipo_pieza) . '</p>';
    if ($tipo_pieza == 'Otro') {
        $cuerpoCorreo .= ' (' . htmlspecialchars($tipo_pieza_especifico) . ')';
    } else {
        //$cuerpoCorreo .= ' (' . htmlspecialchars($tipo_pieza) . ')';
        $cuerpoCorreo .= '<p><strong>Tipo de pieza:</strong> ' . htmlspecialchars($tipo_pieza_especifico) . '</p>';
    }
    $cuerpoCorreo .= '</p>
                <p><strong>Objetivo de la pieza:</strong><br>' . nl2br(htmlspecialchars($objetivo_pieza)) . '</p>
                <p><strong>¿La pieza está incluida en la campaña?:</strong> ' . htmlspecialchars($pieza_incluida) . '</p>
                <p><strong>Copy:</strong><br>' . nl2br(htmlspecialchars($copy)) . '</p>
                <p><strong>¿Se puede modificar el copy?:</strong> ' . htmlspecialchars($modificar_copy) . '</p>
                <p><strong>Detalles que debemos tener en cuenta:</strong><br>' . nl2br(htmlspecialchars($detalles)) . '</p>
                <p><strong>Archivos de apoyo:</strong> ' . htmlspecialchars($cargar_recursos) . '</p>
                <p><strong>Fecha estimada de entrega:</strong> ' . htmlspecialchars($fecha_entrega) . '</p>
                <p><strong>Nombre completo de quien solicita:</strong> ' . htmlspecialchars($nombre) . '</p>
                <p><strong>Correo electrónico:</strong> ' . htmlspecialchars($correo_solicitante) . '</p>
                <p><strong>Correo copiado a:</strong> ' . htmlspecialchars($correos_copia_final) . '</p>
            </div>';

    // Agregar sección de archivos adjuntos desde el formulario
    if (!empty($archivos)) {
        $cuerpoCorreo .= '
            <div class="section">
                <h4>Archivo de aprobación de la cotización:</h4>
                <ul class="archivo-list">';
        foreach ($archivos as $archivo) {
            $cuerpoCorreo .= '<li>' . htmlspecialchars($archivo['nombre']) . '</li>';
        }
        $cuerpoCorreo .= '
                </ul>
            </div>';
    }

    // Agregar sección de archivos adjuntos de apoyo
    if (!empty($archivos_apoyo)) {
        $cuerpoCorreo .= '
            <div class="section">
                <h4>Archivos adjuntos de apoyo:</h4>
                <ul class="archivo-list">';
        foreach ($archivos_apoyo as $archivo_apoyo) {
            $cuerpoCorreo .= '<li>' . htmlspecialchars($archivo_apoyo['nombre']) . '</li>';
        }
        $cuerpoCorreo .= '
                </ul>
            </div>';
    }

    // Agregar imagen de agradecimiento solo para los correos en copia y solicitante
    $cuerpoCorreo .= '
        <div class="section">
            <img src="https://grupomerpes.com/forms/requerimientosdiseno/img/enviado.jpg" alt="Imagen de Agradecimiento" style="width: 100%;">
        </div>
    </div>
    </body>
    </html>';

    // Configurar PHPMailer para enviar correo HTML
    $mail->isHTML(true); // Configurar PHPMailer para enviar correo HTML
    $mail->CharSet = 'UTF-8';
    $mail->Subject = $cliente_campaña . ' ' . $tipo_pieza_especifico . ' ' . $correo_solicitante;
    $mail->Body = $cuerpoCorreo;

    // Adjuntar archivos al correo, si hay archivos adjuntos
    foreach ($archivos as $archivo) {
        $mail->addAttachment($archivo['tmp_name'], $archivo['nombre']);
    }

    // Adjuntar archivos de apoyo al correo, si hay archivos de apoyo adjuntos
    foreach ($archivos_apoyo as $archivo_apoyo) {
        $mail->addAttachment($archivo_apoyo['tmp_name'], $archivo_apoyo['nombre']);
    }

    // Enviar el correo electrónico
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
    // Mostrar mensaje de error en caso de fallo
    echo "Error al enviar el correo: {$mail->ErrorInfo}";
}

?>