<?php

    class Pantalla extends Conectar{

        public function get_pantalla($area_id){

            /* TODO: Obtener la conexión a la base de datos utiliz&&o el método de la clase padre */

            $conectar = parent::conexion();

            /* TODO: Establecer el juego de caracteres a UTF-8 utiliz&&o el método de la clase padre */

            parent::set_names();

           /*  TODO: Consulta SQL para insertar un nuevo usuario en la tabla tm_usuario */

            $sql="SELECT 
            tm_vacante.vacante_id,
            tm_vacante.area_id,
            tm_vacante.esc_id,
            tm_vacante.codigo,
            tm_vacante.asignatura,
            tm_vacante.id,
            tm_vacante.horas,
            tm_vacante.turno,
            tm_vacante.origen,
            tm_vacante.docente,
            tm_area.area_nom,
            tm_escuela.esc_nom,
            tm_escuela.esc_loc
            FROM tm_vacante
            INNER JOIN tm_area ON tm_vacante.area_id = tm_area.area_id
            INNER JOIN tm_escuela ON tm_vacante.esc_id = tm_escuela.esc_id
            WHERE tm_vacante.area_id = ? AND tm_vacante.estado = 1";

            /* TODO: Prepara la consulta SQL */

            $sql = $conectar->prepare($sql);

            $sql->bindValue(1, $area_id);

            /* TODO: Ejecutar la consulta SQL */

            $sql->execute();

            return $sql->fetchAll();

        }
        
        public function get_pantalla_area(){

            /* TODO: Obtener la conexión a la base de datos utiliz&&o el método de la clase padre */

            $conectar = parent::conexion();

            /* TODO: Establecer el juego de caracteres a UTF-8 utiliz&&o el método de la clase padre */

            parent::set_names();

           /*  TODO: Consulta SQL para insertar un nuevo usuario en la tabla tm_usuario */

            $sql="SELECT * FROM tm_area WHERE tm_area.est = 1";

            /* TODO: Prepara la consulta SQL */

            $sql = $conectar->prepare($sql);

            /* TODO: Ejecutar la consulta SQL */

            $sql->execute();

            return $sql->fetchAll();

        }
    }

?>