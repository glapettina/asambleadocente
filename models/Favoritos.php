<?php

    class Favoritos extends Conectar{

        public function get_favoritos($usu_id){

            /* TODO: Obtener la conexión a la base de datos utiliz&&o el método de la clase padre */

            $conectar = parent::conexion();

            /* TODO: Establecer el juego de caracteres a UTF-8 utiliz&&o el método de la clase padre */

            parent::set_names();

           /*  TODO: Consulta SQL para insertar un nuevo usuario en la tabla tm_usuario */

            $sql="SELECT 	
            td_vacante_docente.vacanted_id,
            td_vacante_docente.usu_id,
            td_vacante_docente.vacante_id,
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
            FROM td_vacante_docente
            INNER JOIN tm_vacante ON td_vacante_docente.vacante_id = tm_vacante.vacante_id
            INNER JOIN tm_area ON tm_vacante.area_id = tm_area.area_id
            INNER JOIN tm_escuela ON tm_vacante.esc_id = tm_escuela.esc_id
            WHERE tm_vacante.estado = 1 AND td_vacante_docente.usu_id = ?";

            /* TODO: Prepara la consulta SQL */

            $sql = $conectar->prepare($sql);

            $sql->bindValue(1, $usu_id);

            /* TODO: Ejecutar la consulta SQL */

            $sql->execute();

            return $sql->fetchAll();

        }


        public function eliminar_vacante_docente($vacante_id){

            $usuario = $_SESSION["usu_id"];

            /* TODO: Obtener la conexión a la base de datos utiliz&&o el método de la clase padre */

            $conectar = parent::conexion();

            /* TODO: Establecer el juego de caracteres a UTF-8 utiliz&&o el método de la clase padre */

            parent::set_names();

            /*  TODO: Consulta SQL para insertar un nuevo usuario en la tabla tm_usuario */

            $sql="DELETE FROM td_vacante_docente WHERE usu_id = '$usuario' and vacante_id = ?";

            /* TODO: Prepara la consulta SQL */

            $sql = $conectar->prepare($sql);

            /* TODO: Vincular los valores a los parámetros de la consulta */

            $sql->bindValue(1, $vacante_id);

            /* TODO: Ejecutar la consulta SQL */

            $sql->execute();

    }

    public function get_escuela_nombre($esc_nom){

            /* TODO: Obtener la conexión a la base de datos utiliz&&o el método de la clase padre */

            $conectar = parent::conexion();

            /* TODO: Establecer el juego de caracteres a UTF-8 utiliz&&o el método de la clase padre */

            parent::set_names();

        /*  TODO: Consulta SQL para insertar un nuevo usuario en la tabla tm_usuario */

            $sql="SELECT * FROM tm_escuela WHERE esc_nom = ?";

            /* TODO: Prepara la consulta SQL */

            $sql = $conectar->prepare($sql);

            /* TODO: Vincular los valores a los parámetros de la consulta */

            $sql->bindValue(1, $esc_nom);

            /* TODO: Ejecutar la consulta SQL */

            $sql->execute();

            return $sql->fetchAll();
   }

       

        

       

       public function get_tramite_x_id($tra_id){

        /* TODO: Obtener la conexión a la base de datos utiliz&&o el método de la clase padre */

        $conectar = parent::conexion();

        /* TODO: Establecer el juego de caracteres a UTF-8 utiliz&&o el método de la clase padre */

        parent::set_names();

       /*  TODO: Consulta SQL para insertar un nuevo usuario en la tabla tm_usuario */

        $sql="SELECT * FROM tm_tramite WHERE tra_id = ?";

        /* TODO: Prepara la consulta SQL */

        $sql = $conectar->prepare($sql);

        /* TODO: Vincular los valores a los parámetros de la consulta */

        $sql->bindValue(1, $tra_id);

        /* TODO: Ejecutar la consulta SQL */

        $sql->execute();

        return $sql->fetchAll();
          }

   public function eliminar_tramite($tra_id){

    /* TODO: Obtener la conexión a la base de datos utiliz&&o el método de la clase padre */

    $conectar = parent::conexion();

    /* TODO: Establecer el juego de caracteres a UTF-8 utiliz&&o el método de la clase padre */

    parent::set_names();

   /*  TODO: Consulta SQL para insertar un nuevo usuario en la tabla tm_usuario */

    $sql="UPDATE tm_tramite SET est = 0, fech_elim = NOW() WHERE tra_id = ?";

    /* TODO: Prepara la consulta SQL */

    $sql = $conectar->prepare($sql);

    /* TODO: Vincular los valores a los parámetros de la consulta */

    $sql->bindValue(1, $tra_id);

    /* TODO: Ejecutar la consulta SQL */

    $sql->execute();

    }

    public function insert_favorito($usu_id, $vacante_id){

        /* TODO: Obtener la conexión a la base de datos utilizo el método de la clase padre */

        $conectar = parent::conexion();

        /* TODO: Establecer el juego de caracteres a UTF-8 utiliz&&o el método de la clase padre */

        parent::set_names();

       /*  TODO: Consulta SQL para insertar un nuevo usuario en la tabla tm_usuario */

        $sql="INSERT INTO td_vacante_docente (usu_id, vacante_id) VALUES (?, ?)";

        /* TODO: Prepara la consulta SQL */

        $sql = $conectar->prepare($sql);

        $sql->bindValue(1, $usu_id);
        $sql->bindValue(2, $vacante_id);

        /* TODO: Ejecutar la consulta SQL */

        $sql->execute();


    }

    public function get_vacante_x_docente($usu_id, $vacante_id){

        /* TODO: Obtener la conexión a la base de datos utiliz&&o el método de la clase padre */

        $conectar = parent::conexion();

        /* TODO: Establecer el juego de caracteres a UTF-8 utiliz&&o el método de la clase padre */

        parent::set_names();

    /*  TODO: Consulta SQL para insertar un nuevo usuario en la tabla tm_usuario */

        $sql="SELECT * FROM td_vacante_docente WHERE usu_id = ? AND vacante_id =?";

        /* TODO: Prepara la consulta SQL */

        $sql = $conectar->prepare($sql);

        /* TODO: Vincular los valores a los parámetros de la consulta */

        $sql->bindValue(1, $usu_id);
        $sql->bindValue(2, $vacante_id);

        /* TODO: Ejecutar la consulta SQL */

        $sql->execute();

        return $sql->fetchAll();
}

    }

?>