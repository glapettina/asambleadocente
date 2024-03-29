<?php

    class Area extends Conectar{

        public function get_area(){

            /* TODO: Obtener la conexión a la base de datos utiliz&&o el método de la clase padre */

            $conectar = parent::conexion();

            /* TODO: Establecer el juego de caracteres a UTF-8 utiliz&&o el método de la clase padre */

            parent::set_names();

           /*  TODO: Consulta SQL para insertar un nuevo usuario en la tabla tm_usuario */

            $sql="SELECT * FROM tm_area WHERE est = 1";

            /* TODO: Prepara la consulta SQL */

            $sql = $conectar->prepare($sql);

            /* TODO: Ejecutar la consulta SQL */

            $sql->execute();

            return $sql->fetchAll();

        }

        public function insert_area($area_nom){

            /* TODO: Obtener la conexión a la base de datos utilizo el método de la clase padre */

            $conectar = parent::conexion();

            /* TODO: Establecer el juego de caracteres a UTF-8 utiliz&&o el método de la clase padre */

            parent::set_names();

           /*  TODO: Consulta SQL para insertar un nuevo usuario en la tabla tm_usuario */

            $sql="INSERT INTO tm_area (area_nom) VALUES (?)";

            /* TODO: Prepara la consulta SQL */

            $sql = $conectar->prepare($sql);

            $sql->bindValue(1, $area_nom);

            /* TODO: Ejecutar la consulta SQL */

            $sql->execute();


        }

        public function update_area($area_id, $area_nom){

            /* TODO: Obtener la conexión a la base de datos utilizo el método de la clase padre */

            $conectar = parent::conexion();

            /* TODO: Establecer el juego de caracteres a UTF-8 utiliz&&o el método de la clase padre */

            parent::set_names();

           /*  TODO: Consulta SQL para insertar un nuevo usuario en la tabla tm_usuario */

            $sql="UPDATE tm_area SET area_nom = ?, fech_modi = NOW() WHERE area_id = ?";

            /* TODO: Prepara la consulta SQL */

            $sql = $conectar->prepare($sql);

            $sql->bindValue(1, $area_nom);
            $sql->bindValue(2, $area_id);

            /* TODO: Ejecutar la consulta SQL */

            $sql->execute();


        }

        public function get_area_nombre($area_nom){

            /* TODO: Obtener la conexión a la base de datos utiliz&&o el método de la clase padre */

            $conectar = parent::conexion();

            /* TODO: Establecer el juego de caracteres a UTF-8 utiliz&&o el método de la clase padre */

            parent::set_names();

           /*  TODO: Consulta SQL para insertar un nuevo usuario en la tabla tm_usuario */

            $sql="SELECT * FROM tm_area WHERE area_nom = ?";

            /* TODO: Prepara la consulta SQL */

            $sql = $conectar->prepare($sql);

            /* TODO: Vincular los valores a los parámetros de la consulta */

            $sql->bindValue(1, $area_nom);

            /* TODO: Ejecutar la consulta SQL */

            $sql->execute();

            return $sql->fetchAll();
       }

       public function get_area_x_id($area_id){

        /* TODO: Obtener la conexión a la base de datos utiliz&&o el método de la clase padre */

        $conectar = parent::conexion();

        /* TODO: Establecer el juego de caracteres a UTF-8 utiliz&&o el método de la clase padre */

        parent::set_names();

       /*  TODO: Consulta SQL para insertar un nuevo usuario en la tabla tm_usuario */

        $sql="SELECT * FROM tm_area WHERE area_id = ?";

        /* TODO: Prepara la consulta SQL */

        $sql = $conectar->prepare($sql);

        /* TODO: Vincular los valores a los parámetros de la consulta */

        $sql->bindValue(1, $area_id);

        /* TODO: Ejecutar la consulta SQL */

        $sql->execute();

        return $sql->fetchAll();
          }

   public function eliminar_area($area_id){

            /* TODO: Obtener la conexión a la base de datos utiliz&&o el método de la clase padre */

            $conectar = parent::conexion();

            /* TODO: Establecer el juego de caracteres a UTF-8 utiliz&&o el método de la clase padre */

            parent::set_names();

            /*  TODO: Consulta SQL para insertar un nuevo usuario en la tabla tm_usuario */

                $sql="UPDATE tm_area SET est = 0, fech_elim = NOW() WHERE area_id = ?";

                /* TODO: Prepara la consulta SQL */

                $sql = $conectar->prepare($sql);

                /* TODO: Vincular los valores a los parámetros de la consulta */

                $sql->bindValue(1, $area_id);

                /* TODO: Ejecutar la consulta SQL */

                $sql->execute();
         }

         public function get_area_usuario_permisos($usu_id){

            /* TODO: Obtener la conexión a la base de datos utiliz&&o el método de la clase padre */

            $conectar = parent::conexion();

            /* TODO: Establecer el juego de caracteres a UTF-8 utiliz&&o el método de la clase padre */

            parent::set_names();

           /*  TODO: Consulta SQL para insertar un nuevo usuario en la tabla tm_usuario */

            $sql="CALL sp_i_area_01 (?);";

            /* TODO: Prepara la consulta SQL */

            $sql = $conectar->prepare($sql);

            /* TODO: Vincular los valores a los parámetros de la consulta */

            $sql->bindValue(1, $usu_id);

            /* TODO: Ejecutar la consulta SQL */

            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
      }

      public function habilitar_area_usuario($aread_id){

        /* TODO: Obtener la conexión a la base de datos utiliz&&o el método de la clase padre */

        $conectar = parent::conexion();

        /* TODO: Establecer el juego de caracteres a UTF-8 utiliz&&o el método de la clase padre */

        parent::set_names();

        /*  TODO: Consulta SQL para insertar un nuevo usuario en la tabla tm_usuario */

            $sql="UPDATE td_area_detalle SET aread_permi = 'Si', fech_modi = NOW() WHERE aread_id = ?";

            /* TODO: Prepara la consulta SQL */

            $sql = $conectar->prepare($sql);

            /* TODO: Vincular los valores a los parámetros de la consulta */

            $sql->bindValue(1, $aread_id);

            /* TODO: Ejecutar la consulta SQL */

            $sql->execute();
     }

     public function deshabilitar_area_usuario($aread_id){

        /* TODO: Obtener la conexión a la base de datos utiliz&&o el método de la clase padre */

        $conectar = parent::conexion();

        /* TODO: Establecer el juego de caracteres a UTF-8 utiliz&&o el método de la clase padre */

        parent::set_names();

        /*  TODO: Consulta SQL para insertar un nuevo usuario en la tabla tm_usuario */

            $sql="UPDATE td_area_detalle SET aread_permi = 'No', fech_modi = NOW() WHERE aread_id = ?";

            /* TODO: Prepara la consulta SQL */

            $sql = $conectar->prepare($sql);

            /* TODO: Vincular los valores a los parámetros de la consulta */

            $sql->bindValue(1, $aread_id);

            /* TODO: Ejecutar la consulta SQL */

            $sql->execute();
     }

    }

?>