<?php

    class Vacantes extends Conectar{

        public function get_vacantes(){

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
            WHERE tm_vacante.estado = 1";

            /* TODO: Prepara la consulta SQL */

            $sql = $conectar->prepare($sql);

            /* TODO: Ejecutar la consulta SQL */

            $sql->execute();

            return $sql->fetchAll();

        }

        public function insert_vacante($area_id, $esc_id, $codigo, $asignatura, $id, $horas, $turno, $origen){

            /* TODO: Obtener la conexión a la base de datos utilizo el método de la clase padre */

            $conectar = parent::conexion();

            /* TODO: Establecer el juego de caracteres a UTF-8 utiliz&&o el método de la clase padre */

            parent::set_names();

           /*  TODO: Consulta SQL para insertar un nuevo usuario en la tabla tm_usuario */

            $sql="INSERT INTO tm_vacante (area_id, esc_id, codigo, asignatura, id, horas, turno, 
            origen) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            /* TODO: Prepara la consulta SQL */

            $sql = $conectar->prepare($sql);

            $sql->bindValue(1, $area_id);
            $sql->bindValue(2, $esc_id);
            $sql->bindValue(3, $codigo);
            $sql->bindValue(4, $asignatura);
            $sql->bindValue(5, $id);
            $sql->bindValue(6, $horas);
            $sql->bindValue(7, $turno);
            $sql->bindValue(8, $origen);

            /* TODO: Ejecutar la consulta SQL */

            $sql->execute();


        }

        public function update_vacante($vacante_id, $esc_id, $codigo, $asignatura, $id, $horas, $turno, $origen){

            /* TODO: Obtener la conexión a la base de datos utilizo el método de la clase padre */

            $conectar = parent::conexion();

            /* TODO: Establecer el juego de caracteres a UTF-8 utiliz&&o el método de la clase padre */

            parent::set_names();

           /*  TODO: Consulta SQL para insertar un nuevo usuario en la tabla tm_usuario */

            $sql="UPDATE tm_vacante SET esc_id = ?, codigo = ?, asignatura = ?, id = ?, horas = ?, turno =?, origen = ? fech_modi = NOW() WHERE vacante_id = ?";

            /* TODO: Prepara la consulta SQL */

            $sql = $conectar->prepare($sql);

            $sql->bindValue(1, $esc_id);
            $sql->bindValue(2, $codigo);
            $sql->bindValue(3, $asignatura);
            $sql->bindValue(4, $id);
            $sql->bindValue(5, $horas);
            $sql->bindValue(6, $turno);
            $sql->bindValue(7, $origen);
            $sql->bindValue(8, $vacante_id);

            /* TODO: Ejecutar la consulta SQL */

            $sql->execute();


        }

        public function get_vacante_id($id){

            /* TODO: Obtener la conexión a la base de datos utiliz&&o el método de la clase padre */

            $conectar = parent::conexion();

            /* TODO: Establecer el juego de caracteres a UTF-8 utiliz&&o el método de la clase padre */

            parent::set_names();

           /*  TODO: Consulta SQL para insertar un nuevo usuario en la tabla tm_usuario */

            $sql="SELECT * FROM tm_vacante WHERE id = ?";

            /* TODO: Prepara la consulta SQL */

            $sql = $conectar->prepare($sql);

            /* TODO: Vincular los valores a los parámetros de la consulta */

            $sql->bindValue(1, $id);

            /* TODO: Ejecutar la consulta SQL */

            $sql->execute();

            return $sql->fetchAll();
       }

       public function get_vacante_x_id($vacante_id){

        /* TODO: Obtener la conexión a la base de datos utiliz&&o el método de la clase padre */

        $conectar = parent::conexion();

        /* TODO: Establecer el juego de caracteres a UTF-8 utiliz&&o el método de la clase padre */

        parent::set_names();

       /*  TODO: Consulta SQL para insertar un nuevo usuario en la tabla tm_usuario */

        $sql="SELECT * FROM tm_vacante WHERE vacante_id = ?";

        /* TODO: Prepara la consulta SQL */

        $sql = $conectar->prepare($sql);

        /* TODO: Vincular los valores a los parámetros de la consulta */

        $sql->bindValue(1, $vacante_id);

        /* TODO: Ejecutar la consulta SQL */

        $sql->execute();

        return $sql->fetchAll();
          }

   public function eliminar_vacante($vacante_id){

    /* TODO: Obtener la conexión a la base de datos utiliz&&o el método de la clase padre */

    $conectar = parent::conexion();

    /* TODO: Establecer el juego de caracteres a UTF-8 utiliz&&o el método de la clase padre */

    parent::set_names();

   /*  TODO: Consulta SQL para insertar un nuevo usuario en la tabla tm_usuario */

    $sql="UPDATE tm_vacante SET estado = 0, fech_elim = NOW() WHERE vacante_id = ?";

    /* TODO: Prepara la consulta SQL */

    $sql = $conectar->prepare($sql);

    /* TODO: Vincular los valores a los parámetros de la consulta */

    $sql->bindValue(1, $vacante_id);

    /* TODO: Ejecutar la consulta SQL */

    $sql->execute();

    }

    }

?>