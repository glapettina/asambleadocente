<?php

require_once("../config/conexion.php");
require_once("../models/Sociales.php");
require_once("../models/Vacantes.php");
require_once("../models/Cargos.php");

   /*  TODO: Crea una instancia de la clase Trámite */

   $sociales = new Sociales();
   $vacante = new Vacantes();
   $cargo = new Cargos();

    /* TODO: Utiliza una estructura switch para determinar la operación a realizar según el valor de $_GET["op"] */

    switch ($_GET["op"]) {


        case 'listarmini':

            $datos = $sociales->get_sociales_mini();
            $data = Array();
            foreach ($datos as $row) {
                
                $sub_array = array();
                $sub_array[] = $row["esc_nom"];
                $sub_array[] = $row["esc_loc"];
                $sub_array[] = $row["codigo"];
                $sub_array[] = $row["asignatura"];
                $sub_array[] = $row["id"];
                $sub_array[] = $row["horas"];
                $sub_array[] = $row["turno"];
                $sub_array[] = $row["origen"];
                
                if ($row["docente"] == "") {
                    
                    $sub_array[] = '<span class="label label-pill label-success">Vacante</span>';

                }else{

                    $sub_array[] = '<span class="label label-pill label-danger">'.$row["docente"].'</span>'; 

                }
                
                
                if ($_SESSION["rol_id"] == 3) {

                    $sub_array[] = '<button type="button" class="btn btn-soft-warning waves-effect waves-light btn-sm" onClick="editar('.$row["vacante_id"].')"><i class="bx bx-edit-alt font-size-16 align-middle"></i></button>';
                }

                if ($_SESSION["rol_id"] == 1) {

                    $sub_array[] = '<button type="button" class="btn btn-soft-info waves-effect waves-light btn-sm" onClick="favoritoMini('.$row["vacante_id"].')"><i class="bx bx bxs-star font-size-16 align-middle"></i></button>';              
                
                }
                
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);

            echo json_encode($results);

        break;    

        case 'editarmini':
    
            $cargo->update_cargo_mini($_POST["vacante_id"], $_POST["docente"]);
            echo "2";

        break;

        case "mostrar":
        
            $datos = $vacante->get_vacante_x_id($_POST["vacante_id"]);
            if (is_array($datos) == true and count($datos) > 0) {

                foreach ($datos as $row) {
                    
                    $output["vacante_id"] = $row["vacante_id"];
                    $output["area_id"] = $row["area_id"];
                    $output["esc_id"] = $row["esc_id"];
                    $output["codigo"] = $row["codigo"];
                    $output["asignatura"] = $row["asignatura"];
                    $output["id"] = $row["id"];
                    $output["horas"] = $row["horas"];
                    $output["turno"] = $row["turno"];
                    $output["origen"] = $row["origen"];
                }

                echo json_encode($output);
            }

        
        break;

        case "mostrar_docente_mini":
        
            $datos = $vacante->get_vacante_x_id($_POST["vacante_id"]);
            if (is_array($datos) == true and count($datos) > 0) {

                foreach ($datos as $row) {
                    
                    $output["vacante_id"] = $row["vacante_id"];
                    $output["docente"] = $row["docente"];
                }

                echo json_encode($output);
            }

        
        break;

        case 'marcar':
 
            $datos = $cargo->get_vacante_x_docente($_SESSION["usu_id"], $_POST["vacante_id"]);

            if (is_array($datos) == true and count($datos) == 0) {

            $cargo->insert_favorito($_SESSION["usu_id"], $_POST["vacante_id"]);
            echo "1";

            }else {

                echo "2";
            }

        break;
    }
?>