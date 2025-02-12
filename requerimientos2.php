<?php

error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', '0'); // No muestra errores en pantalla
ini_set('log_errors', '1');     // Registra errores en el log
ini_set('error_log', '/path/to/error.log'); // Path al log de errores

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
$cantidad_piezas = $_POST['cantidad-piezas'];

$tipo_pieza = $_POST['tipo-pieza'];
$otro_cliente_campaña = isset($_POST['otro-cliente-campaña']) ? $_POST['otro-cliente-campaña'] : '';
$objetivo_pieza = $_POST['objetivo-pieza'];
$pieza_incluida = $_POST['pieza-incluida'];
$copy = $_POST['copy'];
$modificar_copy = $_POST['modficar-copy'];
$detalles = $_POST['detalles'];
$cargar_recursos = $_POST['cargar-recursos'] ?? '';


$tipo_pieza_2 = $_POST['tipo-pieza-2'] ??'';
$objetivo_pieza_2 = $_POST['objetivo-pieza-2'] ??'';
$pieza_incluida_2 = $_POST['pieza-incluida-2'] ??'';
$copy_2 = $_POST['copy-2'] ??'';
$modificar_copy_2 = $_POST['modficar-copy-2'] ??'';
$detalles_2 = $_POST['detalles-2'] ??'';
$cargar_recursos_2 = $_POST['cargar-recursos-2'] ?? '';

$tipo_pieza_3 = $_POST['tipo-pieza-3'] ??'';
$objetivo_pieza_3 = $_POST['objetivo-pieza-3'] ??'';
$pieza_incluida_3 = $_POST['pieza-incluida-3'] ??'';
$copy_3 = $_POST['copy-3'] ??'';
$modificar_copy_2 = $_POST['modficar-copy-3'] ??'';
$detalles_3 = $_POST['detalles-3'] ??'';
$cargar_recursos_3 = $_POST['cargar-recursos-3'] ?? '';

$tipo_pieza_4 = $_POST['tipo-pieza-4'] ??'';
$objetivo_pieza_4 = $_POST['objetivo-pieza-4'] ??'';
$pieza_incluida_4 = $_POST['pieza-incluida-4'] ??'';
$copy_4 = $_POST['copy-4'] ??'';
$modificar_copy_2 = $_POST['modficar-copy-4'] ??'';
$detalles_4 = $_POST['detalles-4'] ??'';
$cargar_recursos_4 = $_POST['cargar-recursos-4'] ?? '';

$tipo_pieza_5 = $_POST['tipo-pieza-5'] ??'';
$objetivo_pieza_5 = $_POST['objetivo-pieza-5'] ??'';
$pieza_incluida_5 = $_POST['pieza-incluida-5'] ??'';
$copy_5 = $_POST['copy-5'] ??'';
$modificar_copy_2 = $_POST['modficar-copy-5'] ??'';
$detalles_5 = $_POST['detalles-5'] ??'';
$cargar_recursos_5 = $_POST['cargar-recursos-5'] ?? '';

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
        $tipo_pieza_especifico_2 = $_POST['otra-pieza'];
        $otra_pieza = $_POST['otra-pieza'];
        break;
    default:
        $tipo_pieza_especifico = '';
        break;
}

// Obtener el tipo de pieza específico dependiendo de la categoría seleccionada 2
switch ($tipo_pieza_2) {
    case 'Banners':
        $tipo_pieza_especifico_2 = $_POST['tipo-pieza-c1-2'];
        break;
    case 'WhatsApp':
        $tipo_pieza_especifico_2 = $_POST['tipo-pieza-c2-2'];
        break;
    case 'Presentaciones editables':
        $tipo_pieza_especifico_2 = $_POST['tipo-pieza-c3-2'];
        break;
    case 'Mockups':
        $tipo_pieza_especifico_2 = $_POST['tipo-pieza-c4-2'];
        break;
    case 'Piezas animadas y audio':
        $tipo_pieza_especifico_2 = $_POST['tipo-pieza-c5-2'];
        break;
    case 'Impresos':
        $tipo_pieza_especifico_2 = $_POST['tipo-pieza-c6-2'];
        break;
    case 'Nuevos proyectos':
        $tipo_pieza_especifico_2 = $_POST['tipo-pieza-c7-2'];
        break;
    case 'Redes sociales':
        $tipo_pieza_especifico_2 = $_POST['tipo-pieza-c8-2'];
        break;
    case 'Administración plataforma':
        $tipo_pieza_especifico_2 = $_POST['tipo-pieza-c9-2'];
        break;
    case 'Otro':
        $tipo_pieza_especifico_2 = $_POST['otra-pieza-2'];
        break;
    default:
        $tipo_pieza_especifico_2 = '';
        break;
}

// Obtener el tipo de pieza específico dependiendo de la categoría seleccionada 3
switch ($tipo_pieza_3) {
    case 'Banners':
        $tipo_pieza_especifico_3 = $_POST['tipo-pieza-c1-3'];
        break;
    case 'WhatsApp':
        $tipo_pieza_especifico_3 = $_POST['tipo-pieza-c2-3'];
        break;
    case 'Presentaciones editables':
        $tipo_pieza_especifico_3 = $_POST['tipo-pieza-c3-3'];
        break;
    case 'Mockups':
        $tipo_pieza_especifico_3 = $_POST['tipo-pieza-c4-3'];
        break;
    case 'Piezas animadas y audio':
        $tipo_pieza_especifico_3 = $_POST['tipo-pieza-c5-3'];
        break;
    case 'Impresos':
        $tipo_pieza_especifico_3 = $_POST['tipo-pieza-c6-3'];
        break;
    case 'Nuevos proyectos':
        $tipo_pieza_especifico_3 = $_POST['tipo-pieza-c7-3'];
        break;
    case 'Redes sociales':
        $tipo_pieza_especifico_3 = $_POST['tipo-pieza-c8-3'];
        break;
    case 'Administración plataforma':
        $tipo_pieza_especifico_3 = $_POST['tipo-pieza-c9-3'];
        break;
    case 'Otro':
        $tipo_pieza_especifico_3 = $_POST['otra-pieza-3'];
        break;
    default:
        $tipo_pieza_especifico_3 = '';
        break;
}

// Obtener el tipo de pieza específico dependiendo de la categoría seleccionada 4
switch ($tipo_pieza_4) {
    case 'Banners':
        $tipo_pieza_especifico_4 = $_POST['tipo-pieza-c1-4'];
        break;
    case 'WhatsApp':
        $tipo_pieza_especifico_4 = $_POST['tipo-pieza-c2-4'];
        break;
    case 'Presentaciones editables':
        $tipo_pieza_especifico_4 = $_POST['tipo-pieza-c3-4'];
        break;
    case 'Mockups':
        $tipo_pieza_especifico_4 = $_POST['tipo-pieza-c4-4'];
        break;
    case 'Piezas animadas y audio':
        $tipo_pieza_especifico_4 = $_POST['tipo-pieza-c5-4'];
        break;
    case 'Impresos':
        $tipo_pieza_especifico_4 = $_POST['tipo-pieza-c6-4'];
        break;
    case 'Nuevos proyectos':
        $tipo_pieza_especifico_4 = $_POST['tipo-pieza-c7-4'];
        break;
    case 'Redes sociales':
        $tipo_pieza_especifico_4 = $_POST['tipo-pieza-c8-4'];
        break;
    case 'Administración plataforma':
        $tipo_pieza_especifico_4 = $_POST['tipo-pieza-c9-4'];
        break;
    case 'Otro':
        $tipo_pieza_especifico_4 = $_POST['otra-pieza-4'];
        break;
    default:
        $tipo_pieza_especifico_4 = '';
        break;
}

// Obtener el tipo de pieza específico dependiendo de la categoría seleccionada 5
switch ($tipo_pieza_5) {
    case 'Banners':
        $tipo_pieza_especifico_5 = $_POST['tipo-pieza-c1-5'];
        break;
    case 'WhatsApp':
        $tipo_pieza_especifico_5 = $_POST['tipo-pieza-c2-5'];
        break;
    case 'Presentaciones editables':
        $tipo_pieza_especifico_5 = $_POST['tipo-pieza-c3-5'];
        break;
    case 'Mockups':
        $tipo_pieza_especifico_5 = $_POST['tipo-pieza-c4-5'];
        break;
    case 'Piezas animadas y audio':
        $tipo_pieza_especifico_5 = $_POST['tipo-pieza-c5-5'];
        break;
    case 'Impresos':
        $tipo_pieza_especifico_5 = $_POST['tipo-pieza-c6-5'];
        break;
    case 'Nuevos proyectos':
        $tipo_pieza_especifico_5 = $_POST['tipo-pieza-c7-5'];
        break;
    case 'Redes sociales':
        $tipo_pieza_especifico_5 = $_POST['tipo-pieza-c8-5'];
        break;
    case 'Administración plataforma':
        $tipo_pieza_especifico_5 = $_POST['tipo-pieza-c9-5'];
        break;
    case 'Otro':
        $tipo_pieza_especifico_5 = $_POST['otra-pieza-5'];
        break;
    default:
        $tipo_pieza_especifico_5 = '';
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

// Archivos adjuntos 2
$archivos_2 = array();
if (!empty($_FILES['archivo-2']['name'][0])) {
    foreach ($_FILES['archivo-2']['tmp_name'] as $key => $tmp_name) {
        $archivo_nombre_2 = $_FILES['archivo-2']['name'][$key];
        $archivos_2[] = array(
            'tmp_name' => $tmp_name,
            'nombre' => $archivo_nombre_2
        );
    }
}

// Archivos adjuntos 3
$archivos_3 = array();
if (!empty($_FILES['archivo-3']['name'][0])) {
    foreach ($_FILES['archivo-3']['tmp_name'] as $key => $tmp_name) {
        $archivo_nombre_3 = $_FILES['archivo-3']['name'][$key];
        $archivos_3[] = array(
            'tmp_name' => $tmp_name,
            'nombre' => $archivo_nombre_3
        );
    }
}

// Archivos adjuntos 4
$archivos_4 = array();
if (!empty($_FILES['archivo-4']['name'][0])) {
    foreach ($_FILES['archivo-4']['tmp_name'] as $key => $tmp_name) {
        $archivo_nombre_4 = $_FILES['archivo-4']['name'][$key];
        $archivos_4[] = array(
            'tmp_name' => $tmp_name,
            'nombre' => $archivo_nombre_4
        );
    }
}

// Archivos adjuntos 5
$archivos_5 = array();
if (!empty($_FILES['archivo-5']['name'][0])) {
    foreach ($_FILES['archivo-5']['tmp_name'] as $key => $tmp_name) {
        $archivo_nombre_5 = $_FILES['archivo-5']['name'][$key];
        $archivos_5[] = array(
            'tmp_name' => $tmp_name,
            'nombre' => $archivo_nombre_5
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

// Archivos de apoyo 2
$archivos_apoyo_2 = array();
if (!empty($_FILES['archivo-apoyo-2']['name'][0])) {
    foreach ($_FILES['archivo-apoyo-2']['tmp_name'] as $key => $tmp_name) {
        $archivo_apoyo_nombre_2 = $_FILES['archivo-apoyo-2']['name'][$key];
        $archivos_apoyo_2[] = array(
            'tmp_name' => $tmp_name,
            'nombre' => $archivo_apoyo_nombre_2
        );
    }
}

// Archivos de apoyo 3
$archivos_apoyo_3 = array();
if (!empty($_FILES['archivo-apoyo-3']['name'][0])) {
    foreach ($_FILES['archivo-apoyo-3']['tmp_name'] as $key => $tmp_name) {
        $archivo_apoyo_nombre_3 = $_FILES['archivo-apoyo-3']['name'][$key];
        $archivos_apoyo_3[] = array(
            'tmp_name' => $tmp_name,
            'nombre' => $archivo_apoyo_nombre_3
        );
    }
}

// Archivos de apoyo 4
$archivos_apoyo_4 = array();
if (!empty($_FILES['archivo-apoyo-4']['name'][0])) {
    foreach ($_FILES['archivo-apoyo-4']['tmp_name'] as $key => $tmp_name) {
        $archivo_apoyo_nombre_4 = $_FILES['archivo-apoyo-4']['name'][$key];
        $archivos_apoyo_4[] = array(
            'tmp_name' => $tmp_name,
            'nombre' => $archivo_apoyo_nombre_4
        );
    }
}

// Archivos de apoyo 5
$archivos_apoyo_5 = array();
if (!empty($_FILES['archivo-apoyo-5']['name'][0])) {
    foreach ($_FILES['archivo-apoyo-5']['tmp_name'] as $key => $tmp_name) {
        $archivo_apoyo_nombre_5 = $_FILES['archivo-apoyo-5']['name'][$key];
        $archivos_apoyo_5[] = array(
            'tmp_name' => $tmp_name,
            'nombre' => $archivo_apoyo_nombre_5
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
    //$mail->addAddress('disenoweb@grupomerpes.com', 'Destinatario 1');
    $mail->addAddress('jefediseno@grupomerpes.com', 'Destinatario 2');
    $mail->addAddress('grupomerpesredes@gmail.com', 'Destinatario 3');

    // Agregar el correo del solicitante como destinatario
    $mail->addAddress($correo_solicitante, $nombre);

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

    // Función para agregar contenido si no está vacío
    function agregarContenido($label, $valor) {
        return !empty($valor) ? "<p><strong>$label:</strong><br>" . nl2br(htmlspecialchars($valor)) . '</p>' : '';
    }

    // Función para generar el HTML de la Pieza 1
    function generarHtmlPieza1(
        $cliente_campaña,
        $otro_cliente_campaña,
        $fecha_solicitud,
        $tipo_pieza,
        $tipo_pieza_especifico,
        $otra_pieza,
        $objetivo_pieza,
        $pieza_incluida,
        $copy,
        $modificar_copy,
        $detalles,
        $archivos,
        $archivos_apoyo,
        $cargar_recursos
    ) {
        $html = '
        <div class="section">
            <h2>Pieza 1</h2>
            <p><strong>Cliente y/o campaña:</strong> ' . htmlspecialchars($cliente_campaña) . '</p>';

        // Agregar campo adicional si el cliente/campaña es "Otro"
        $html .= ($cliente_campaña == 'Otro') ? '<p><strong>Otro cliente y/o campaña:</strong> ' . htmlspecialchars($otro_cliente_campaña) . '</p>' : '';

        $html .= agregarContenido('Fecha de la solicitud', $fecha_solicitud);
        
        // Categoría de pieza
        $html .= '<p><strong>Categoría de pieza:</strong> ' . htmlspecialchars($tipo_pieza) . '</p>';

        // Tipo de pieza específico o "Otro" tipo de pieza
        if ($tipo_pieza == 'Otro') {
            $html .= '<p><strong>Tipo de pieza específico:</strong> ' . htmlspecialchars($tipo_pieza_especifico) . '</p>';
            $html .= '<p><strong>Otro tipo de pieza:</strong> ' . htmlspecialchars($otra_pieza) . '</p>';
        } else {
            $html .= '<p><strong>Tipo de pieza específico:</strong> ' . htmlspecialchars($tipo_pieza_especifico) . '</p>';
        }

        // Detalles adicionales de la pieza
        $html .= agregarContenido('Objetivo de la pieza', $objetivo_pieza);
        $html .= agregarContenido('¿La pieza está incluida en la campaña?', $pieza_incluida);
        $html .= agregarContenido('Copy', $copy);
        $html .= agregarContenido('¿Se puede modificar el copy?', $modificar_copy);
        $html .= agregarContenido('Detalles que debemos tener en cuenta', $detalles);
        $html .= agregarContenido('Archivos de apoyo', $cargar_recursos);

        // Archivos de la cotización para Pieza 1
        if (!empty($archivos)) {
            $html .= '
                <div class="section">
                    <h4>Archivo de aprobación de la cotización:</h4>
                    <ul class="archivo-list">';
            foreach ($archivos as $archivo) {
                $html .= '<li>' . htmlspecialchars($archivo['nombre']) . '</li>';
            }
            $html .= '
                    </ul>
                </div>';
        }

        // Archivos de apoyo para Pieza 1
        if (!empty($archivos_apoyo)) {
            $html .= '
                <div class="section">
                    <h4>Archivos adjuntos de apoyo:</h4>
                    <ul class="archivo-list">';
            foreach ($archivos_apoyo as $archivo_apoyo) {
                $html .= '<li>' . htmlspecialchars($archivo_apoyo['nombre']) . '</li>';
            }
            $html .= '
                    </ul>
                </div>';
        }

        $html .= '</div>';

        return $html;
    }

    // Función para generar el HTML de la Pieza 2
    function generarHtmlPieza2(
        $tipo_pieza_2,
        $tipo_pieza_especifico_2,
        $objetivo_pieza_2,
        $pieza_incluida_2,
        $copy_2,
        $modificar_copy_2,
        $detalles_2,
        $archivos_2,
        $archivos_apoyo_2,
        $cargar_recursos_2
    ) {
        $html = '
        <div class="section">
            <h2>Pieza 2</h2>';

        // Categoría de pieza
        $html .= '<p><strong>Categoría de pieza:</strong> ' . htmlspecialchars($tipo_pieza_2) . '</p>';

        // Tipo de pieza específico o "Otro" tipo de pieza
        if ($tipo_pieza_2 == 'Otro') {
            $html .= '<p><strong>Otro tipo de pieza:</strong> ' . htmlspecialchars($tipo_pieza_especifico_2) . '</p>';
        } else {
            $html .= '<p><strong>Tipo de pieza específico:</strong> ' . htmlspecialchars($tipo_pieza_especifico_2) . '</p>';
        }

        // Detalles adicionales de la pieza
        $html .= agregarContenido('Objetivo de la pieza', $objetivo_pieza_2);
        $html .= agregarContenido('¿La pieza está incluida en la campaña?', $pieza_incluida_2);
        $html .= agregarContenido('Copy', $copy_2);
        $html .= agregarContenido('¿Se puede modificar el copy?', $modificar_copy_2);
        $html .= agregarContenido('Detalles que debemos tener en cuenta', $detalles_2);
        $html .= agregarContenido('Archivos de apoyo', $cargar_recursos_2);

        // Archivos de la cotización para Pieza 2
        if (!empty($archivos_2)) {
            $html .= '
                <div class="section">
                    <h4>Archivo de aprobación de la cotización para Pieza 2:</h4>
                    <ul class="archivo-list">';
            foreach ($archivos_2 as $archivo_2) {
                $html .= '<li>' . htmlspecialchars($archivo_2['nombre']) . '</li>';
            }
            $html .= '
                    </ul>
                </div>';
        }

        // Archivos de apoyo para Pieza 2
        if (!empty($archivos_apoyo_2)) {
            $html .= '
                <div class="section">
                    <h4>Archivos adjuntos de apoyo para Pieza 2:</h4>
                    <ul class="archivo-list">';
            foreach ($archivos_apoyo_2 as $archivo_apoyo_2) {
                $html .= '<li>' . htmlspecialchars($archivo_apoyo_2['nombre']) . '</li>';
            }
            $html .= '
                    </ul>
                </div>';
        }

        $html .= '</div>';

        return $html;
    }

    // Función para generar el HTML de la Pieza 3
    function generarHtmlPieza3(
        $tipo_pieza_3,
        $tipo_pieza_especifico_3,
        $objetivo_pieza_3,
        $pieza_incluida_3,
        $copy_3,
        $modificar_copy_3,
        $detalles_3,
        $archivos_3,
        $archivos_apoyo_3,
        $cargar_recursos_3
    ) {
        $html = '
        <div class="section">
            <h2>Pieza 3</h2>';
        
        // Categoría de pieza
        $html .= '<p><strong>Categoría de pieza:</strong> ' . htmlspecialchars($tipo_pieza_3) . '</p>';

        // Tipo de pieza específico o "Otro" tipo de pieza
        if ($tipo_pieza_3 == 'Otro') {
            $html .= '<p><strong>Otro tipo de pieza:</strong> ' . htmlspecialchars($tipo_pieza_especifico_3) . '</p>';
        } else {
            $html .= '<p><strong>Tipo de pieza específico:</strong> ' . htmlspecialchars($tipo_pieza_especifico_3) . '</p>';
        }

        // Detalles adicionales de la pieza
        $html .= agregarContenido('Objetivo de la pieza', $objetivo_pieza_3);
        $html .= agregarContenido('¿La pieza está incluida en la campaña?', $pieza_incluida_3);
        $html .= agregarContenido('Copy', $copy_3);
        $html .= agregarContenido('¿Se puede modificar el copy?', $modificar_copy_3);
        $html .= agregarContenido('Detalles que debemos tener en cuenta', $detalles_3);
        $html .= agregarContenido('Archivos de apoyo', $cargar_recursos_3);

        // Archivos de la cotización para Pieza 3
        if (!empty($archivos_3)) {
            $html .= '
                <div class="section">
                    <h4>Archivo de aprobación de la cotización para Pieza 3:</h4>
                    <ul class="archivo-list">';
            foreach ($archivos_3 as $archivo_3) {
                $html .= '<li>' . htmlspecialchars($archivo_3['nombre']) . '</li>';
            }
            $html .= '
                    </ul>
                </div>';
        }

        // Archivos de apoyo para Pieza 3
        if (!empty($archivos_apoyo_3)) {
            $html .= '
                <div class="section">
                    <h4>Archivos adjuntos de apoyo para Pieza 3:</h4>
                    <ul class="archivo-list">';
            foreach ($archivos_apoyo_3 as $archivo_apoyo_3) {
                $html .= '<li>' . htmlspecialchars($archivo_apoyo_3['nombre']) . '</li>';
            }
            $html .= '
                    </ul>
                </div>';
        }

        $html .= '</div>';

        return $html;
    }
    function generarHtmlPieza4(
        $tipo_pieza_4,
        $tipo_pieza_especifico_4,
        $objetivo_pieza_4,
        $pieza_incluida_4,
        $copy_4,
        $modificar_copy_4,
        $detalles_4,
        $archivos_4,
        $archivos_apoyo_4,
        $cargar_recursos_4
    ) {
        $html = '
        <div class="section">
            <h2>Pieza 4</h2>';
        
        // Categoría de pieza
        $html .= '<p><strong>Categoría de pieza:</strong> ' . htmlspecialchars($tipo_pieza_4) . '</p>';

        // Tipo de pieza específico o "Otro" tipo de pieza
        if ($tipo_pieza_4 == 'Otro') {
            $html .= '<p><strong>Otro tipo de pieza:</strong> ' . htmlspecialchars($tipo_pieza_especifico_4) . '</p>';
        } else {
            $html .= '<p><strong>Tipo de pieza específico:</strong> ' . htmlspecialchars($tipo_pieza_especifico_4) . '</p>';
        }

        // Detalles adicionales de la pieza
        $html .= agregarContenido('Objetivo de la pieza', $objetivo_pieza_4);
        $html .= agregarContenido('¿La pieza está incluida en la campaña?', $pieza_incluida_4);
        $html .= agregarContenido('Copy', $copy_4);
        $html .= agregarContenido('¿Se puede modificar el copy?', $modificar_copy_4);
        $html .= agregarContenido('Detalles que debemos tener en cuenta', $detalles_4);
        $html .= agregarContenido('Archivos de apoyo', $cargar_recursos_4);

        // Archivos de la cotización para Pieza 4
        if (!empty($archivos_4)) {
            $html .= '
                <div class="section">
                    <h4>Archivo de aprobación de la cotización para Pieza 4:</h4>
                    <ul class="archivo-list">';
            foreach ($archivos_4 as $archivo_4) {
                $html .= '<li>' . htmlspecialchars($archivo_4['nombre']) . '</li>';
            }
            $html .= '
                    </ul>
                </div>';
        }

        // Archivos de apoyo para Pieza 4
        if (!empty($archivos_apoyo_4)) {
            $html .= '
                <div class="section">
                    <h4>Archivos adjuntos de apoyo para Pieza 4:</h4>
                    <ul class="archivo-list">';
            foreach ($archivos_apoyo_4 as $archivo_apoyo_4) {
                $html .= '<li>' . htmlspecialchars($archivo_apoyo_4['nombre']) . '</li>';
            }
            $html .= '
                    </ul>
                </div>';
        }

        $html .= '</div>';

        return $html;
    }

    function generarHtmlPieza5(
        $tipo_pieza_5,
        $tipo_pieza_especifico_5,
        $objetivo_pieza_5,
        $pieza_incluida_5,
        $copy_5,
        $modificar_copy_5,
        $detalles_5,
        $archivos_5,
        $archivos_apoyo_5,
        $cargar_recursos_5
    ) {
        $html = '
        <div class="section">
            <h2>Pieza 5</h2>';
        
        // Categoría de pieza
        $html .= '<p><strong>Categoría de pieza:</strong> ' . htmlspecialchars($tipo_pieza_5) . '</p>';

        // Tipo de pieza específico o "Otro" tipo de pieza
        if ($tipo_pieza_5 == 'Otro') {
            $html .= '<p><strong>Otro tipo de pieza:</strong> ' . htmlspecialchars($tipo_pieza_especifico_5) . '</p>';
        } else {
            $html .= '<p><strong>Tipo de pieza específico:</strong> ' . htmlspecialchars($tipo_pieza_especifico_5) . '</p>';
        }

        // Detalles adicionales de la pieza
        $html .= agregarContenido('Objetivo de la pieza', $objetivo_pieza_5);
        $html .= agregarContenido('¿La pieza está incluida en la campaña?', $pieza_incluida_5);
        $html .= agregarContenido('Copy', $copy_5);
        $html .= agregarContenido('¿Se puede modificar el copy?', $modificar_copy_5);
        $html .= agregarContenido('Detalles que debemos tener en cuenta', $detalles_5);
        $html .= agregarContenido('Archivos de apoyo', $cargar_recursos_5);

        // Archivos de la cotización para Pieza 5
        if (!empty($archivos_5)) {
            $html .= '
                <div class="section">
                    <h5>Archivo de aprobación de la cotización para Pieza 5:</h5>
                    <ul class="archivo-list">';
            foreach ($archivos_5 as $archivo_5) {
                $html .= '<li>' . htmlspecialchars($archivo_5['nombre']) . '</li>';
            }
            $html .= '
                    </ul>
                </div>';
        }

        // Archivos de apoyo para Pieza 5
        if (!empty($archivos_apoyo_5)) {
            $html .= '
                <div class="section">
                    <h5>Archivos adjuntos de apoyo para Pieza 5:</h5>
                    <ul class="archivo-list">';
            foreach ($archivos_apoyo_5 as $archivo_apoyo_5) {
                $html .= '<li>' . htmlspecialchars($archivo_apoyo_5['nombre']) . '</li>';
            }
            $html .= '
                    </ul>
                </div>';
        }

        $html .= '</div>';

        return $html;
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
            <h2>Formulario de Requerimientos de Diseño</h2>';

    $cuerpoCorreo .= generarHtmlPieza1(
        $cliente_campaña,
        $otro_cliente_campaña,
        $fecha_solicitud,
        $tipo_pieza,
        $tipo_pieza_especifico,
        $otra_pieza,
        $objetivo_pieza,
        $pieza_incluida,
        $copy,
        $modificar_copy,
        $detalles,
        $archivos,
        $archivos_apoyo,
        $cargar_recursos
    );

    switch ($cantidad_piezas) {
        case '2':
            $cuerpoCorreo .= generarHtmlPieza2(
                $tipo_pieza_2,
                $tipo_pieza_especifico_2,
                $objetivo_pieza_2,
                $pieza_incluida_2,
                $copy_2,
                $modificar_copy_2,
                $detalles_2,
                $archivos_2,
                $archivos_apoyo_2,
                $cargar_recursos_2
            );
            break;
        case '3':
            $cuerpoCorreo .= generarHtmlPieza2(
                $tipo_pieza_2,
                $tipo_pieza_especifico_2,
                $objetivo_pieza_2,
                $pieza_incluida_2,
                $copy_2,
                $modificar_copy_2,
                $detalles_2,
                $archivos_2,
                $archivos_apoyo_2,
                $cargar_recursos_2
            );

            $cuerpoCorreo .= generarHtmlPieza3(
                $tipo_pieza_3,
                $tipo_pieza_especifico_3,
                $objetivo_pieza_3,
                $pieza_incluida_3,
                $copy_3,
                $modificar_copy_3,
                $detalles_3,
                $archivos_3,
                $archivos_apoyo_3,
                $cargar_recursos_3
            );
            break;
        case '4':
            $cuerpoCorreo .= generarHtmlPieza2(
                $tipo_pieza_2,
                $tipo_pieza_especifico_2,
                $objetivo_pieza_2,
                $pieza_incluida_2,
                $copy_2,
                $modificar_copy_2,
                $detalles_2,
                $archivos_2,
                $archivos_apoyo_2,
                $cargar_recursos_2
            );

            $cuerpoCorreo .= generarHtmlPieza3(
                $tipo_pieza_3,
                $tipo_pieza_especifico_3,
                $objetivo_pieza_3,
                $pieza_incluida_3,
                $copy_3,
                $modificar_copy_3,
                $detalles_3,
                $archivos_3,
                $archivos_apoyo_3,
                $cargar_recursos_3
            );

            $cuerpoCorreo .= generarHtmlPieza4(
                $tipo_pieza_4,
                $tipo_pieza_especifico_4,
                $objetivo_pieza_4,
                $pieza_incluida_4,
                $copy_4,
                $modificar_copy_4,
                $detalles_4,
                $archivos_4,
                $archivos_apoyo_4,
                $cargar_recursos_4
            );
            break;
        case '5':
            $cuerpoCorreo .= generarHtmlPieza2(
                $tipo_pieza_2,
                $tipo_pieza_especifico_2,
                $objetivo_pieza_2,
                $pieza_incluida_2,
                $copy_2,
                $modificar_copy_2,
                $detalles_2,
                $archivos_2,
                $archivos_apoyo_2,
                $cargar_recursos_2
            );

            $cuerpoCorreo .= generarHtmlPieza3(
                $tipo_pieza_3,
                $tipo_pieza_especifico_3,
                $objetivo_pieza_3,
                $pieza_incluida_3,
                $copy_3,
                $modificar_copy_3,
                $detalles_3,
                $archivos_3,
                $archivos_apoyo_3,
                $cargar_recursos_3
            );

            $cuerpoCorreo .= generarHtmlPieza4(
                $tipo_pieza_4,
                $tipo_pieza_especifico_4,
                $objetivo_pieza_4,
                $pieza_incluida_4,
                $copy_4,
                $modificar_copy_4,
                $detalles_4,
                $archivos_4,
                $archivos_apoyo_4,
                $cargar_recursos_4
            );

            $cuerpoCorreo .= generarHtmlPieza5(
                $tipo_pieza_5,
                $tipo_pieza_especifico_5,
                $objetivo_pieza_5,
                $pieza_incluida_5,
                $copy_5,
                $modificar_copy_5,
                $detalles_5,
                $archivos_5,
                $archivos_apoyo_5,
                $cargar_recursos_5
            );
            break;
        }

    // Agregar los detalles finales del correo
    $cuerpoCorreo .= agregarContenido('Fecha estimada de entrega', $fecha_entrega);
    $cuerpoCorreo .= agregarContenido('Nombre completo de quien solicita', $nombre);
    $cuerpoCorreo .= agregarContenido('Correo electrónico', $correo_solicitante);
    $cuerpoCorreo .= agregarContenido('Correo copiado a', $correos_copia_final);

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

    // Adjuntar archivos adicionales para Pieza 2
    foreach ($archivos_2 as $archivo_2) {
        $mail->addAttachment($archivo_2['tmp_name'], $archivo_2['nombre']);
    }

    // Adjuntar archivos de apoyo adicionales para Pieza 2
    foreach ($archivos_apoyo_2 as $archivo_apoyo_2) {
        $mail->addAttachment($archivo_apoyo_2['tmp_name'], $archivo_apoyo_2['nombre']);
    }

    // Adjuntar archivos adicionales para Pieza 3
    foreach ($archivos_3 as $archivo_3) {
        $mail->addAttachment($archivo_3['tmp_name'], $archivo_3['nombre']);
    }

    // Adjuntar archivos de apoyo adicionales para Pieza 3
    foreach ($archivos_apoyo_3 as $archivo_apoyo_3) {
        $mail->addAttachment($archivo_apoyo_3['tmp_name'], $archivo_apoyo_3['nombre']);
    }

    // Adjuntar archivos adicionales para Pieza 4
    foreach ($archivos_4 as $archivo_4) {
        $mail->addAttachment($archivo_4['tmp_name'], $archivo_4['nombre']);
    }

    // Adjuntar archivos de apoyo adicionales para Pieza 4
    foreach ($archivos_apoyo_4 as $archivo_apoyo_4) {
        $mail->addAttachment($archivo_apoyo_4['tmp_name'], $archivo_apoyo_4['nombre']);
    }

     // Adjuntar archivos adicionales para Pieza 5
     foreach ($archivos_5 as $archivo_5) {
        $mail->addAttachment($archivo_5['tmp_name'], $archivo_5['nombre']);
    }

    // Adjuntar archivos de apoyo adicionales para Pieza 5
    foreach ($archivos_apoyo_5 as $archivo_apoyo_5) {
        $mail->addAttachment($archivo_apoyo_5['tmp_name'], $archivo_apoyo_5['nombre']);
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
