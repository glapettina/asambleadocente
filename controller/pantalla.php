<?php

require_once("../config/conexion.php");
require_once("../models/Pantalla.php");

   /*  TODO: Crea una instancia de la clase Trámite */

   $area = new Pantalla();

    /* TODO: Utiliza una estructura switch para determinar la operación a realizar según el valor de $_GET["op"] */

    switch ($_GET["op"]) {
        

        case 'listar':

            $datos = $area->get_pantalla($_POST["area_id"]);
            $data = Array();
            foreach ($datos as $row) {
                
                $sub_array = array();
                $sub_array[] = $row["esc_nom"];
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
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);

            echo json_encode($results);

        break;  
        
        case 'comboarea':
            $datos = $area->get_pantalla_area($_SESSION["area_id"]);
            $html="";
            $html.="<option value=''>Seleccionar</option>";
            if (is_array($datos) == true && count($datos) > 0) {
                
                foreach ($datos as $row) {
                    $html.="<option value='".$row['area_id']."'>".$row['area_nom']."</option>";
                }

                echo $html;
            }
        break;    

    }
?>