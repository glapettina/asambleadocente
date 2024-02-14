<?php

require_once("../config/conexion.php");
require_once("../models/Escuela.php");

   /*  TODO: Crea una instancia de la clase Area */

   $escuela = new Escuela();

    /* TODO: Utiliza una estructura switch para determinar la operación a realizar según el valor de $_GET["op"] */

    switch ($_GET["op"]) {

        case 'combo':
            $datos = $escuela->get_escuela();
            $html="";
            $html.="<option value=''>Seleccionar</option>";
            if (is_array($datos) == true && count($datos) > 0) {
                
                foreach ($datos as $row) {
                    $html.="<option value='".$row['esc_id']."'>".$row['esc_nom']."</option>";
                }

                echo $html;
            }
        break;

        case 'listar':

            $datos = $escuela->get_escuela();
            $data = Array();
            foreach ($datos as $row) {
                
                $sub_array = array();
                $sub_array[] = $row["esc_nom"];
                $sub_array[] = $row["esc_loc"];
                $sub_array[] = '<button type="button" class="btn btn-soft-warning waves-effect waves-light btn-sm" onClick="editar('.$row["esc_id"].')"><i class="bx bx-edit-alt font-size-16 align-middle"></i></button>';
                $sub_array[] = '<button type="button" class="btn btn-soft-danger waves-effect waves-light btn-sm" onClick="eliminar('.$row["esc_id"].')"><i class="bx bx-trash-alt font-size-16 align-middle"></i></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);

            echo json_encode($results);

        break;    

        case 'guardaryeditar':

            $datos = $escuela->get_escuela_nombre($_POST["esc_nom"]);

            if (is_array($datos) == true and count($datos) == 0) {
                if (empty($_POST["esc_id"])) {
                
                    $escuela->insert_escuela($_POST["esc_nom"], $_POST["esc_loc"]);
                    echo "1";
    
                }else{
    
                    $escuela->update_escuela($_POST["esc_id"], $_POST["esc_nom"], $_POST["esc_loc"]);
                    echo "2";
                }         
            }else {
                echo "0";
            }

               

        break;

        case "mostrar":
        
            $datos = $escuela->get_escuela_x_id($_POST["esc_id"]);
            if (is_array($datos) == true and count($datos) > 0) {

                foreach ($datos as $row) {
                    
                    $output["esc_id"] = $row["esc_id"];
                    $output["esc_nom"] = $row["esc_nom"];
                    $output["esc_loc"] = $row["esc_loc"];
                }

                echo json_encode($output);
            }

        
        break;

        case 'eliminar':
            $datos = $escuela->eliminar_escuela($_POST["esc_id"]);
            echo "1";
        break;


    }
?>