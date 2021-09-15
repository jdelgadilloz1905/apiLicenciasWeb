<?php
$json = file_get_contents('php://input');
$obj = json_decode($json,true);
//busco las consultas segun el metodo de l URL

//$answer = ModelsConfig::mdlConfig();
//echo $answer["API_KEY"];

$rutas = explode("/", $_GET["ruta"]);
$method = str_replace("-","",$rutas[1]);
//$_SERVER['REQUEST_METHOD'] == 'POST' validar el metodo de envio dependiendo del tipo de consulta

switch ($method){

    case "generadorkey":

        $respuesta = ControllerProducts::ctrInsertarLicencia($obj);
        echo $respuesta;

        break;

    case "activarlicencia":

        $respuesta = ControllerProducts::ctrVerificarLicencia($obj);

        echo $respuesta;

        break;

    case "visionimagetext":

        $respuesta = ControllerProducts::ctrPostImageTexto($obj);

        echo $respuesta;

        break;

    case "uploadimage":

        $respuesta = ControllerProducts::ctrCargaImagen($obj);

        echo $respuesta;

        break;



    default:
        echo json_encode(
            array(
                "error" => true,
                "statusCode"=>400,
                "metodo" =>$method,
                "variable" =>$obj
            ));
            break;
}

