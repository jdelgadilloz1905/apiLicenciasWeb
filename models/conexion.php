<?php

class Conexion{

    static public function conectarLicencia(){

        $link = new PDO("mysql:host=localhost;dbname=estudio5_licencias",
            "estudio5_licen",
            "oZ7w5K#ht]s+",
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
        );


        return $link;
    }



}