<?php

    class Escuela extends Conectar{

        public function get_escuela(){

            /* TODO: Obtener la conexión a la base de datos utiliz&&o el método de la clase padre */

            $conectar = parent::conexion();

            /* TODO: Establecer el juego de caracteres a UTF-8 utiliz&&o el método de la clase padre */

            parent::set_names();

           /*  TODO: Consulta SQL para insertar un nuevo usuario en la tabla tm_usuario */

            $sql="SELECT * FROM tm_escuela WHERE est = 1";

            /* TODO: Prepara la consulta SQL */

            $sql = $conectar->prepare($sql);

            /* TODO: Ejecutar la consulta SQL */

            $sql->execute();

            return $sql->fetchAll();

        }

        

        public function insert_escuela($esc_nom, $esc_loc){

             /* TODO: Obtener la conexión a la base de datos utilizo el método de la clase padre */

             $conectar = parent::conexion();

               /* TODO: Establecer el juego de caracteres a UTF-8 utiliz&&o el método de la clase padre */

              parent::set_names();

             /*  TODO: Consulta SQL para insertar un nuevo usuario en la tabla tm_usuario */

             $sql="INSERT INTO tm_escuela (esc_nom, esc_loc) VALUES (?, ?)";

             /* TODO: Prepara la consulta SQL */

             $sql = $conectar->prepare($sql);

             $sql->bindValue(1, $esc_nom);
             $sql->bindValue(2, $esc_loc);

                /* TODO: Ejecutar la consulta SQL */

              $sql->execute();


        }

        public function update_escuela($esc_id, $esc_nom, $esc_loc){

            /* TODO: Obtener la conexión a la base de datos utilizo el método de la clase padre */

            $conectar = parent::conexion();

            /* TODO: Establecer el juego de caracteres a UTF-8 utiliz&&o el método de la clase padre */

            parent::set_names();

           /*  TODO: Consulta SQL para insertar un nuevo usuario en la tabla tm_usuario */

            $sql="UPDATE tm_escuela SET esc_nom = ?, esc_loc = ?, fech_modi = NOW() WHERE esc_id = ?";

            /* TODO: Prepara la consulta SQL */

            $sql = $conectar->prepare($sql);

            $sql->bindValue(1, $esc_nom);
            $sql->bindValue(2, $esc_loc);
            $sql->bindValue(3, $esc_id);

            /* TODO: Ejecutar la consulta SQL */

            $sql->execute();


        }


   public function eliminar_escuela($esc_id){

            /* TODO: Obtener la conexión a la base de datos utiliz&&o el método de la clase padre */

            $conectar = parent::conexion();

            /* TODO: Establecer el juego de caracteres a UTF-8 utiliz&&o el método de la clase padre */

            parent::set_names();

            /*  TODO: Consulta SQL para insertar un nuevo usuario en la tabla tm_usuario */

            $sql="UPDATE tm_escuela SET est = 0, fech_elim = NOW() WHERE esc_id = ?";

            /* TODO: Prepara la consulta SQL */

            $sql = $conectar->prepare($sql);

            /* TODO: Vincular los valores a los parámetros de la consulta */

            $sql->bindValue(1, $esc_id);

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


   public function get_escuela_x_id($esc_id){

        /* TODO: Obtener la conexión a la base de datos utiliz&&o el método de la clase padre */

        $conectar = parent::conexion();

        /* TODO: Establecer el juego de caracteres a UTF-8 utiliz&&o el método de la clase padre */

        parent::set_names();

    /*  TODO: Consulta SQL para insertar un nuevo usuario en la tabla tm_usuario */

        $sql="SELECT * FROM tm_escuela WHERE esc_id = ?";

        /* TODO: Prepara la consulta SQL */

        $sql = $conectar->prepare($sql);

        /* TODO: Vincular los valores a los parámetros de la consulta */

        $sql->bindValue(1, $esc_id);

        /* TODO: Ejecutar la consulta SQL */

        $sql->execute();

        return $sql->fetchAll();
      
}


}

?>