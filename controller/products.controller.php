<?php

class ControllerProducts{

    static public function ctrInsertarLicencia($data){

        if(isset($data["rif"])){

            $key = "";
            $pattern = "1234567890abcdefghijklmnopqrstuvwxyz";

            $max = strlen($pattern)-1;

            for($i = 0; $i < 24; $i++){

                $key .= $pattern[mt_rand(0,$max)];

            }

            $fecha_actual = date("d-m-Y");
            //sumo 1 año
            $fecha_fin= date("d-m-Y",strtotime($fecha_actual."+ 1 year"));

            $datos = array(
                "email" => $data["email"],
                "nombre" => $data["nombre"],
                "direccion" => $data["direccion"],
                "rif" => $data["rif"],
                "telefono" => $data["telefono"],
                "fecha_ini" => date("Y-m-d"),
                "fecha_fin" => $fecha_fin,
                "serial" => $key,
                "estatus" => $data["estatus"]
            );

            $respuesta = ModelProducts::mdlInsertarLicencia($datos);

            if($respuesta == 'ok'){

                echo json_encode(array(
                    "statusCode" => 200,
                    "info"=> array(
                        "Fecha inicio" => date("Y-m-d"),
                        "Fecha vencimiento" => $fecha_fin,
                        "serial" => $key
                    ),
                    "error" => false,
                ));


            }else{
                echo json_encode(array(
                    "statusCode" => 400,
                    "info"=> "",
                    "error" => true,
                ));

            }



        }


    }

    static public function ctrVerificarLicencia($data){

        $respuesta = ModelProducts::mdlVerificarLicencia($data["keySerial"]);

        if($respuesta == 'ok'){

            echo json_encode(array(
                "statusCode" => 200,
                "info"=> $respuesta,
                "error" => false,
            ));


        }else{
            echo json_encode(array(
                "statusCode" => 400,
                "info"=> "No existe licencia, contacte con el administrador",
                "error" => true,
            ));

        }
    }

    static public function ctrPostImageTexto($data){

//        $json = '{
//                    "requests": [
//                        {
//                            "features": [
//                                { "type": "LABEL_DETECTION", "maxResults": 10 },
//                                { "type": "LANDMARK_DETECTION", "maxResults": 5 },
//                                { "type": "FACE_DETECTION", "maxResults": 5 },
//                                { "type": "LOGO_DETECTION", "maxResults": 5 },
//                                { "type": "TEXT_DETECTION", "maxResults": 5},
//                                { "type": "DOCUMENT_TEXT_DETECTION", "maxResults": 5 },
//                                { "type": "SAFE_SEARCH_DETECTION", "maxResults": 5 },
//                                { "type": "IMAGE_PROPERTIES", "maxResults": 5 },
//                                { "type": "CROP_HINTS", "maxResults": 5 },
//                                { "type": "WEB_DETECTION", "maxResults": 5 },
//                            ],
//                            "image":{
//                                "source":{
//                                    "imageUri": "https://www.visa.co.ve/dam/VCOM/regional/lac/SPA/Default/Pay%20With%20Visa/Tarjetas/visa-classic-400x225.jpg"
//                                }
//                            }
//                        }
//                    ]
//                }';
//
//        $data = json_decode($json,true);
//


        $ruta = Ruta::ctrVisionGoogleCloudAPI();

        //url contra la que atacamos

        $ch = curl_init($ruta);

        //a true, obtendremos una respuesta de la url, en otro caso,

        //true si es correcto, false si no lo es

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //establecemos el verbo http que queremos utilizar para la petición

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

        //enviamos el array data

        curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));

        //obtenemos la respuesta

        $response = curl_exec($ch);

        // Se cierra el recurso CURL y se liberan los recursos del sistema

        curl_close($ch);

        echo json_encode(array(

            "statusCode" => 200,

            "respuesta"=>json_decode($response),

            "tipo de datos" => gettype($response),

            "error" => true,

            "mensaje" =>"",

        ));
    }

}