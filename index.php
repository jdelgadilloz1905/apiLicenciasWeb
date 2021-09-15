<?php

/*=============================
    CONTROLLER
===============================*/
require_once "controller/template.controller.php";
require_once "controller/products.controller.php";
require_once "controller/class.fileuploader.php";


/*=============================
    MODELS
===============================*/

require_once "models/products.model.php";
require_once "models/rutas.php";

/*=============================
    EXTENSIONS
===============================*/


require_once "extensions/PHPMailer/PHPMailerAutoload.php";
require_once "extensions/vendor/autoload.php";

require __DIR__ . '/vendor/autoload.php';

$plantilla = new ControllerTemplate();
$plantilla-> ctrTemplate();
