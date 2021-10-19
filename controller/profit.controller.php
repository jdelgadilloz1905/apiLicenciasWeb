<?php

class ControllerProfit{

    static public function ctrEnviarPedidoNuevo($data){

        if(count($data) >0){

            date_default_timezone_set("America/Bogota");

            $mail = new PHPMailer;

            $mail->CharSet = 'UTF-8';

            $mail->isMail();

            $mail->setFrom('jorge.delgadillo@bluepoint.com', 'PEDIDOS APP');

            //$mail->addReplyTo('hola@prujula.com', 'PRUJULA');

            $mail->Subject = "Nuevo Pedido ". $data["doc_num"];

            $mail->addAddress("jdelgadilloz1905@gmail.com");

            $mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">

								<center>

									<img style="padding:20px; width:10%" src="">

								</center>

								<div style="position:relative; margin:auto; width:600px; background:white; padding:20px">

									<center>

									<img style="padding:20px; width:15%" src="https://www.estudio57.net/apilicenciasweb/views/img/satvicos/logo_satvico.jpg">

									<h3 style="font-weight:100; color:#999">NUEVO PEDIDO CREADO '.$data["doc_num"].'</h3>

									<hr style="border:1px solid #ccc; width:80%">

									<div style="line-height:30px; width:80%">Se ha creado el pedido '.$data["doc_num"].', por un monto de  '.$data["total_neto"].'</div>
									
									<div style="line-height:30px; width:80%">Nombre del cliente: '.$data["client"]["cli_des"].' </div>
									
									<div style="line-height:30px; width:80%">Telefonos: '.$data["client"]["telefonos"].' </div>
									
									<div style="line-height:30px; width:80%">RIF: '.$data["client"]["rif"].' </div>
									
									<div style="line-height:30px; width:80%">Dirección: '.$data["client"]["direc1"].' </div>

									</a>

									<br>

									<hr style="border:1px solid #ccc; width:80%">

									<h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará.</h5>

									</center>

								</div>

							</div>');

            $mail->Send();

            echo json_encode(array(
                "statusCode" => 200,
                "error" => false,
                "mensaje" =>"Genial correo enviado"
            ));
        }else{
            echo json_encode(array(
                "statusCode" => 00,
                "error" => true,
                "mensaje" =>"No hay datos para enviar "
            ));
        }
    }



}