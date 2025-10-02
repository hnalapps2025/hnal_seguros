<?php 
include_once('controllerResysFua.php');
$resultado = false;
$mensaje = '';
$datos = null;

$IdCuentaAtencion = $_GET["IdCuentaAtencion"];
$url_resysLocal = "http://resys.hloayza.local";
$usuario = 'mlimache';
$clave = '123456';

$ObtenerFua = ObtenerFua($url_resysLocal, $usuario, $clave, $IdCuentaAtencion);

if ($ObtenerFua["resultado"]) {
    $datos = $ObtenerFua["fua"];
    $resultado = true;
} else {
    $mensaje = $ObtenerFua["mensaje"];
}

if ($resultado) {

    //  Validaciones de lo que llega
    if (empty($datos)) {
        echo " El WS devolvió vacío para la cuenta $IdCuentaAtencion";
        exit;
    }

    if (stripos($datos, "<html") !== false) {
        echo " El WS devolvió HTML (error) en lugar de Excel para la cuenta $IdCuentaAtencion:<br><pre>$datos</pre>";
        exit;
    }

    //  Guardar en carpeta temporal
    $fileLocation = sys_get_temp_dir() . DIRECTORY_SEPARATOR . $IdCuentaAtencion . ".xlsx";

    if (file_put_contents($fileLocation, $datos) === false) {
        echo " Error al escribir el archivo Excel en disco en: $fileLocation";
        exit;
    }

    //  Descargar Excel
    header('Content-Description: File Transfer');
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header("Content-Disposition: attachment; filename=\"" . basename($fileLocation) . "\"");
    header("Content-Transfer-Encoding: binary");
    header("Expires: 0");
    header("Pragma: public");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    readfile($fileLocation);

    //  Eliminar archivo temporal después de enviarlo
    unlink($fileLocation);
    exit;
} else {
    echo json_encode([
        "resultado" => $resultado,
        "mensaje"   => $mensaje,
        "datos"     => $datos
    ]);
}
?>
