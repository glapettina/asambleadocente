<?php

require_once("../config/conexion.php");
require_once("../models/Favoritos.php");

   /*  TODO: Crea una instancia de la clase Trámite */

   $favorito = new Favoritos();

    /* TODO: Utiliza una estructura switch para determinar la operación a realizar según el valor de $_GET["op"] */

    switch ($_GET["op"]) {

        
        case 'listar':

            $datos = $favorito->get_favoritos($_SESSION["usu_id"]);
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

                $sub_array[] = '<button type="button" class="btn btn-soft-info waves-effect waves-light btn-sm" onClick="eliminar('.$row["vacante_id"].')"><i class="bx bxs-trash font-size-16 align-middle"></i></button>';

                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);

            echo json_encode($results);

        break;    

        case 'eliminar':
            $favorito->eliminar_vacante_docente($_POST["vacante_id"]);
        break;

    }
?>