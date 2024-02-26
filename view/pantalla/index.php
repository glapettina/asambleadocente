<?php

    require_once("../../config/conexion.php");
    require_once("../../models/Rol.php");
    $rol = new Rol();
    $datos = $rol->validar_menu_x_rol($_SESSION["rol_id"], "pantalla");
    if (isset($_SESSION["usu_id"]) AND count($datos) > 0) {
        

   

?>

<!doctype html>
<html lang="es">

    <head>
        
        <link rel="stylesheet" href="../../assets/css/style.css">

        <title>La Usina Software | Pantalla</title>

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
                                    <h4 class="mb-sm-0 font-size-18">Vacantes</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="../homecolaborador/">Home</a></li>
                                            <li class="breadcrumb-item active">Pantalla</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">                                        
                                        <br>
                                        <div class="col-lg-2" style="margin-left: 25px;">                                            
                                                <label for="area_id" class="form-label">Seleccione Área</label>
                                                    <select class="form-select" data-trigger="" name="area_id" id="area_id" placeholder="Seleccionar" required>
                                                        <option value="">Seleccionar</option>
                                                    </select>
                                                    <input type="hidden" id="area_id" name="area_id">                                            
                                        </div>
                                        <div class="card-body">                                     
                                        
                                            <table id="listado_table" class="table table-striped table-bordered dt-responsive nowrap w-100">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th>Escuela</th>
                                                        <th>Código</th>
                                                        <th>Cargo</th>
                                                        <th>ID</th>
                                                        <th>Horas</th>
                                                        <th>Turno</th>
                                                        <th>Origen</th>
                                                        <th>Docente</th>
                                                    </tr>
                                                </thead>
            
                                                <tbody>

                                                </tbody>
                                            </table>
                                            </div>

                                            
                                    </div>
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

        <script type="text/javascript" src="pantalla.js"></script>

        

    </body>
</html>


<?php

    }else{

        header("Location:".Conectar::ruta()."index.php");
    }

?>