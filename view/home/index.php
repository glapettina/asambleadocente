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

        <style>
            .contenedor{
                display: flex;                
            }

            .btn2{
                margin-left: 30px;
            }
        </style>
        
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
                                    <div class="card-header bg-transparent border-primary contenedor">
                                        <h5 class="my-0 text-primary"><a href="../favoritos/" class="btn btn-primary waves-effect waves-light">Ir Listado Favoritos</a></h5>
                                        <h5 class="my-0 text-primary btn2"><a href="../../assets/files/Modelo de Poder Asamblea 2024.pdf" target="_blank" class="btn btn-primary waves-effect waves-light">Decargar Poder (Editable)</a></h5>
                                        <h5 class="my-0 text-primary btn2"><a href="../../assets/files/Formulario DDJJ.doc" target="_blank" class="btn btn-primary waves-effect waves-light">Decargar Formulario DDJJ</a></h5>
                                        
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Generar Listado de Favoritos</h5>
                                        <p style="text-align: justify;line-height:2em;">Abrir el menú Vacantes Asamblea, luego seleccionar el área de interés. Para filtrar el listado, en la opción Buscar, se puede poner, por ej. “200”, qué sería el código correspondiente al cargo de Preceptor. Luego tocar en la estrella correspondiente a la vacante y se abrirá una ventana con el detalle de la vacante, por último tocar en Favorito y un mensaje nos informará que la vacante fue agregada en la sección de Favoritos.
                                            Al intentar enviar una vacante que ya se encuentra en Favoritos, el sistema mostrará un mensaje diciendo que la vacante ya se encuentra en la lista de favoritos.
                                            Para acceder a Favoritos, dirigirse al correspondiente menú y allí estarán todos las vacantes marcadas como Favoritos.
                                            Para eliminar una vacante del listado de favoritos, se deberá tocar en el icono del “cesto de basura”.
                                        </p>
                                    </div>
                                </div>
                        </div>

                            <div class="row">                            

                                 <div class="card col-lg-4">
                                    <img class="card-img-top img-fluid" src="../../assets/picture/cargos.jpg" alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">Cargos</h4>
                                        
                                        <a href="../cargos/" class="btn btn-primary waves-effect waves-light">Ir...</a>
                                    </div>
                                </div>

                                <div class="card col-lg-4">
                                    <img class="card-img-top img-fluid" src="../../assets/picture/comunicacion.jpg" alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">Comunicación y Expresión</h4>
                                        
                                        <a href="../comunicacion/" class="btn btn-primary waves-effect waves-light">Ir...</a>
                                    </div>
                                </div>
                                <div class="card col-lg-4">
                                    <img class="card-img-top img-fluid" src="../../assets/picture/sociales.jpg" alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">Ciencias Sociales</h4>
                                        
                                        <a href="../sociales/" class="btn btn-primary waves-effect waves-light">Ir...</a>
                                    </div>
                                </div>
                                <div class="card col-lg-4">
                                    <img class="card-img-top img-fluid" src="../../assets/picture/juridicas.jpg" alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">Jurídicas y Contables</h4>
                                        <a href="../contables/" class="btn btn-primary waves-effect waves-light">Ir...</a>
                                    </div>
                                </div>

                                <div class="card col-lg-4">
                                    <img class="card-img-top img-fluid" src="../../assets/picture/tecnicas.jpg" alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">Técnicas y Modalidades</h4>
                                        <a href="../tecnicas/" class="btn btn-primary waves-effect waves-light">Ir...</a>
                                    </div>
                                </div>
                                <div class="card col-lg-4">
                                    <img class="card-img-top img-fluid" src="../../assets/picture/exactas.jpg" alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">Exactas y Naturales</h4>
                                        <a href="../exactas/" class="btn btn-primary waves-effect waves-light">Ir...</a>
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
