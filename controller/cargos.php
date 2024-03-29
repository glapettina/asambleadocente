<?php

require_once("../config/conexion.php");
require_once("../models/Cargos.php");
require_once("../models/Vacantes.php");

   /*  TODO: Crea una instancia de la clase Trámite */

   $cargo = new Cargos();
   $vacante = new Vacantes();

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
                
                if ($row["docente"] == "") {
                    
                    $sub_array[] = '<span class="label label-pill label-success">Vacante</span>';

                }else{

                    $sub_array[] = '<span class="label label-pill label-danger">'.$row["docente"].'</span>'; 

                }
                
                
                if ($_SESSION["rol_id"] == 3) {

                    $sub_array[] = '<button type="button" class="btn btn-soft-warning waves-effect waves-light btn-sm" onClick="editar('.$row["vacante_id"].')"><i class="bx bx-edit-alt font-size-16 align-middle"></i></button>';
                }

                if ($_SESSION["rol_id"] == 1) {

                    $sub_array[] = '<button type="button" class="btn btn-soft-info waves-effect waves-light btn-sm" onClick="favorito('.$row["vacante_id"].')"><i class="bx bx bxs-star font-size-16 align-middle"></i></button>';              
                
                }

                
                //$sub_array[] = '<button type="button" class="btn btn-soft-danger waves-effect waves-light btn-sm" onClick="eliminar('.$row["vacante_id"].')"><i class="bx bx-trash-alt font-size-16 align-middle"></i></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);

            echo json_encode($results);

        break;    

        case 'listarmini':

            $datos = $cargo->get_cargos_mini();
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

                
                //$sub_array[] = '<button type="button" class="btn btn-soft-danger waves-effect waves-light btn-sm" onClick="eliminar('.$row["vacante_id"].')"><i class="bx bx-trash-alt font-size-16 align-middle"></i></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);

            echo json_encode($results);

        break;

        case 'editar':

            //$datos = $vacante->get_vacante_id($_POST["id"]);

            /* if (is_array($datos) == true and count($datos) == 0) {
                if (empty($_POST["vacante_id"])) {
                
                    $cargo->insert_cargo($_POST["esc_id"], 
                    $_POST["codigo"], $_POST["asignatura"],
                    $_POST["id"], $_POST["horas"],
                    $_POST["turno"], $_POST["origen"],
                    $_POST["docente"]);
                    echo "1";
    
                }else if(is_array($datos) == true and count($datos) == 0){ */
    
                    $cargo->update_cargo($_POST["vacante_id"], $_POST["docente"]);
                    echo "2";
                /* }         
            }else {
                echo "0";
            } */

               

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

        case "mostrar_mini":
        
            $datos = $vacante->get_vacante_x_id_mini($_POST["vacante_id"]);
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

        case "mostrar_docente":
        
            $datos = $vacante->get_vacante_x_id($_POST["vacante_id"]);
            if (is_array($datos) == true and count($datos) > 0) {

                foreach ($datos as $row) {
                    
                    $output["vacante_id"] = $row["vacante_id"];
                    $output["docente"] = $row["docente"];
                }

                echo json_encode($output);
            }

        
        break;

        case "mostrar_docente_mini":
        
            $datos = $vacante->get_vacante_x_id_mini($_POST["vacante_id"]);
            if (is_array($datos) == true and count($datos) > 0) {

                foreach ($datos as $row) {
                    
                    $output["vacante_id"] = $row["vacante_id"];
                    $output["docente"] = $row["docente"];
                }

                echo json_encode($output);
            }

        
        break;

        /* case 'eliminar':
            $datos = $tramite->eliminar_tramite($_POST["tra_id"]);
            echo "1";
        break; */

        case 'marcar':
 
            $datos = $cargo->get_vacante_x_docente($_SESSION["usu_id"], $_POST["vacante_id"]);

            if (is_array($datos) == true and count($datos) == 0) {

            $cargo->insert_favorito($_SESSION["usu_id"], $_POST["vacante_id"]);
            echo "1";

            }else {

                echo "2";
            }

        break;

        case 'marcarmini':
 
            $datos = $cargo->get_vacante_x_docente_mini($_SESSION["usu_id"], $_POST["vacante_id"]);

            if (is_array($datos) == true and count($datos) == 0) {

            $cargo->insert_favorito_mini($_SESSION["usu_id"], $_POST["vacante_id"]);
            echo "1";

            }else {

                echo "2";
            }

        break;
    }
?>