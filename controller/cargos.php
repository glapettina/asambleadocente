<?php

require_once("../config/conexion.php");
require_once("../models/Cargos.php");

   /*  TODO: Crea una instancia de la clase Trámite */

   $cargo = new cargos();

    /* TODO: Utiliza una estructura switch para determinar la operación a realizar según el valor de $_GET["op"] */

    switch ($_GET["op"]) {

        /* case 'combo':
            $datos = $tramite->get_tramite();
            $html="";
            $html.="<option value=''>Seleccionar</option>";
            if (is_array($datos) == true && count($datos) > 0) {
                
                foreach ($datos as $row) {
                    $html.="<option value='".$row['tra_id']."'>".$row['tra_nom']."</option>";
                }

                echo $html;
            }
        break;     */

        case 'listar':

            $datos = $cargo->get_cargos();
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
                $sub_array[] = $row["docente"];
                $sub_array[] = '<button type="button" class="btn btn-soft-warning waves-effect waves-light btn-sm" onClick="editar('.$row["vacante_id"].')"><i class="bx bx-edit-alt font-size-16 align-middle"></i></button>';
                $sub_array[] = '<button type="button" class="btn btn-soft-danger waves-effect waves-light btn-sm" onClick="eliminar('.$row["vacante_id"].')"><i class="bx bx-trash-alt font-size-16 align-middle"></i></button>';
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

            $datos = $cargo->get_vacante_id($_POST["id"]);

            if (is_array($datos) == true and count($datos) == 0) {
                if (empty($_POST["vacante_id"])) {
                
                    $cargo->insert_cargo($_POST["esc_id"], 
                    $_POST["codigo"], $_POST["asignatura"],
                    $_POST["id"], $_POST["horas"],
                    $_POST["turno"], $_POST["origen"],
                    $_POST["docente"]);
                    echo "1";
    
                }else{
    
                    $tramite->update_tramite($_POST["tra_id"], $_POST["tra_nom"], $_POST["tra_descrip"]);
                    echo "2";
                }         
            }else {
                echo "0";
            }

               

        break;

        case "mostrar":
        
            $datos = $tramite->get_tramite_x_id($_POST["tra_id"]);
            if (is_array($datos) == true and count($datos) > 0) {

                foreach ($datos as $row) {
                    
                    $output["tra_id"] = $row["tra_id"];
                    $output["tra_nom"] = $row["tra_nom"];
                    $output["tra_descrip"] = $row["tra_descrip"];
                }

                echo json_encode($output);
            }

        
        break;

        case 'eliminar':
            $datos = $tramite->eliminar_tramite($_POST["tra_id"]);
            echo "1";
        break;
    }
?>