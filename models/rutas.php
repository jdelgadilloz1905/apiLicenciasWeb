<?php

class Ruta{

	/*=============================================
	RUTA PARA ACCEDER AL TEMPLATE SIN HTTPS
	=============================================*/
	static public function ctrRutaEnvioEmail(){

		//return "https://www.prujula.pr/";
		return "http://estudio57.net/apirestprujula/";

	}

	static public function ctrVisionGoogleCloudAPI(){

        return "https://vision.googleapis.com/v1/images:annotate?key=AIzaSyCoiwg_wwglI8bOEiXlePkCRq3GL7S2uTk";
    }
}