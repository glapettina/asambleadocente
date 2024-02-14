<?php

    /* TODO: Incluye el archivo de configuración a la base de datos y la clase Usuario */

    require_once("../config/conexion.php");
    require_once("../models/Usuario.php");
    require_once("../models/Email.php");

   /*  TODO: Crea una instancia de la clase Usuario */

    $usuario = new Usuario();
    $email = new Email();

    /* TODO: Utiliza una estructura switch para determinar la operación a realizar según el valor de $_GET["op"] */

    switch ($_GET["op"]) {

        case 'recuperar':

            /* TODO: Llama al método registrar_usuario de la instancia $usuario con los datos del formulario */

            $datos = $usuario->get_usuario_correo($_POST["usu_correo"], $_POST["rol_id"]);

            if (is_array($datos) == true and count($datos) == 0) {
                echo "0";
            }else{

                $email->recuperar($_POST["usu_correo"], $_POST["rol_id"]);
                echo "1";
            }
            

        break;

        
    }

?>