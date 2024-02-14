<?php

    require_once("../../config/conexion.php");
    require_once("../../models/Rol.php");
    $rol = new Rol();
    $datos = $rol->validar_menu_x_rol($_SESSION["rol_id"], "nuevotramite");
    if (isset($_SESSION["usu_id"]) AND count($datos) > 0) {
        

?>

<!doctype html>
<html lang="es">

    <head>
        
        
        <title>La Usina Software | Nuevo Trámite</title>
        
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
                                    <h4 class="mb-sm-0 font-size-18">Nuevo Trámite</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                                            <li class="breadcrumb-item active">Starter Page</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>

                           
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Ingrese toda la información requerida</h4>
                                        <p class="card-title-desc">(*) Datos obligatorios </p>
                                    </div>

                                    <div class="card-body">
                                    <form method="post" id="documento_form">
                                        <div class="row">
                                            
                                                 <div class="col-lg-3">
                                                     <div class="mb-3">
                                                       <label for="area_id" class="form-label">Area (*)</label>
                                                         <select class="form-select" data-trigger="" name="area_id" id="area_id" placeholder="Seleccionar" required>
                                                               <option value="">Seleccionar</option>
                                                          </select>
                                                    </div>
                                                </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="example-text-input" class="form-label">Trámite (*)</label>
                                                            <select class="form-select" data-trigger="" name="tra_id" id="tra_id" placeholder="Seleccionar" required>
                                                                <option value="">Seleccionar</option>
                                                            </select>
                                                        </div>
                                                    </div> 
                                                    <div class="col-lg-3">
                                                        <div class="mb-3">
                                                            <label for="area_id" class="form-label">Nº Externo</label>
                                                            <input class="form-control" type="text" value="" id="doc_externo" name="doc_externo">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="mb-3">
                                                            <label for="tip_id" class="form-label">Tipo (*)</label>
                                                            <select class="form-select" data-trigger="" name="tip_id" id="tip_id" placeholder="Seleccionar" required>
                                                                <option value="">Seleccionar</option>
                                                            </select>
                                                        </div>
                                                    </div>  

                                                    <div class="col-lg-3">
                                                        <div class="mb-3">
                                                            <label for="doc_dni" class="form-label">DNI / CUIT (*)</label>
                                                            <input class="form-control" type="text" value="" id="doc_dni" name="doc_dni" required>
                                                        </div>
                                                    </div> 
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="doc_nom" class="form-label">Nombre / Razón Social (*)</label>
                                                            <input class="form-control" type="text" value="" id="doc_nom" name="doc_nom" required>
                                                        </div>
                                                    </div> 
                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <label for="doc_descrip" class="form-label">Descripción (*)</label>
                                                            <textarea class="form-control" type="text" rows="3" value="" id="doc_descrip" name="doc_descrip" required></textarea>
                                                        </div>
                                                    </div> 

                                                    <div class="col-lg-12">
                                                        <div class="dropzone">
                                                            <div class="dz-default dz-message">
                                                                <button class="dz-button" type="button">
                                                                    <img src="../../assets/image/upload.png" alt="" />
                                                                </button>
                                                                <div class="dz-message" data-dz-message><span>Arrastra y suelta archivos aquí o haz click para seleccionar archivos *.PDF <br> Máximo 5 archivos y solo de 2MB.</span></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                <div class="d-flex flex-wrap gap-2 mt-4">
                                                    <button type="button" id="btnlimpiar" class="btn btn-secondary waves-effect waves-light">Limpiar</button>
                                                    <button type="submit" id="btnguardar" class="btn btn-primary waves-effect waves-light">Guardar</button>
                                                </div>

                                       
                                        </div>

                                        </form>
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

        <script type="text/javascript" src="nuevotramite.js"></script>

        

    </body>
</html>

<?php

    }else{

        header("Location:".Conectar::ruta()."index.php");
    }

?>
