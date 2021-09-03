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

}