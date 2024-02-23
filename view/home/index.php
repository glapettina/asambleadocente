<?php

    require_once("../../config/conexion.php");
    require_once("../../models/Rol.php");
    $rol = new Rol();
    $datos = $rol->validar_menu_x_rol($_SESSION["rol_id"], "home");
    if (isset($_SESSION["usu_id"]) AND count($datos) > 0) {
        

   

?>

<!doctype html>
<html lang="es">

    <head>
        
        
        <title>La Usina Software | Inicio Asamblea Docente</title>
        
        <?php require_once("../html/head.php") ?>

    </head>

    <body>

    <!-- <body data-layout="horizontal"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            
        <?php require_once("../html/header.php") ?>

        <?php require_once("../html/menu.php") ?>

            

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Inicio</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                            <li class="breadcrumb-item active">Inicio</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>

                            <div class="card border border-primary">
                                    <div class="card-header bg-transparent border-primary">
                                        <h5 class="my-0 text-primary"><i class="mdi mdi-bullseye-arrow me-3"></i>Favoritos</h5>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Abrir el menú Vacantes Asamblea, luego seleccionar el área de interés. Para filtrar el listado, en la opción Buscar, se puede poner, por ej. “200”, qué sería el código correspondiente al cargo de Preceptor. Luego tocar en la estrella correspondiente a la vacante y se abrirá una ventana con el detalle de la vacante, por último tocar en Favorito y un mensaje nos informará que la vacante fue agregada en la sección de Favoritos.
                                            Al intentar enviar una vacante que ya se encuentra en Favoritos, el sistema mostrará un mensaje diciendo que la vacante ya se encuentra en la lista de favoritos.
                                            Para acceder a Favoritos, dirigirse al correspondiente menú y allí estarán todos las vacantes marcadas como Favoritos.
                                            Para eliminar una vacante del listado de favoritos, se deberá tocar en el icono del “cesto de basura”.
                                        </p>
                                    </div>
                                </div>
                        </div>
                        <!-- end page title -->
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                
                <?php require_once("../html/footer.php") ?>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        
        <?php require_once("../html/sidebar.php") ?>

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <?php require_once("../html/js.php") ?>

        

    </body>
</html>

<?php

    }else{

        header("Location:".Conectar::ruta()."index.php");
    }

?>
