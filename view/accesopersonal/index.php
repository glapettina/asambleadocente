<?php

    require_once("../../config/conexion.php");
    if(isset($_POST["enviar"]) && $_POST["enviar"] == "si"){

        require_once("../../models/Usuario.php");
        $usuario = new Usuario();
        $usuario -> login_colaborador();
    }

?>

<!doctype html>
<html lang="es">

    <head>

        <meta charset="utf-8">
        <title>Administrador | La Usina - Asamblea Docente</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
        <meta content="Themesbrand" name="author">

        <!-- Sweet Alert-->
        <link href="../../assets/css/sweetalert2.min.css" rel="stylesheet" type="text/css">

        <!-- preloader css -->
        <link rel="stylesheet" href="../../assets/css/preloader.min-1.css" type="text/css">

        <!-- Bootstrap Css -->
        <link href="../../assets/css/bootstrap.min-1.css" id="bootstrap-style" rel="stylesheet" type="text/css">
        <!-- Icons Css -->
        <link href="../../assets/css/icons.min-1.css" rel="stylesheet" type="text/css">
        <!-- App Css-->
        <link href="../../assets/css/app.min-1.css" id="app-style" rel="stylesheet" type="text/css">

    </head>

    <body>

    <!-- <body data-layout="horizontal"> -->
        <div class="auth-page">
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <div class="col-xxl-3 col-lg-4 col-md-5">
                        <div class="auth-full-page-content d-flex p-sm-5 p-4">
                            <div class="w-100">
                                <div class="d-flex flex-column h-100">
                                    <div class="mb-4 mb-md-5 text-center">
                                        <a href="index-1.html" class="d-block auth-logo">
                                            <img src="../../assets/picture/logo-sm-1.svg" alt="" height="28"> <span class="logo-txt">La Usina</span>
                                        </a>
                                    </div>
                                    <div class="auth-content my-auto">
                                        <div class="text-center">
                                            <h5 class="mb-0">Asamblea Docente 2024 (Administrador)</h5>
                                            <p class="text-muted mt-2">Ingrese sus Credenciales de Colaborador.</p>
                                        </div>
                                        <form class="custom-form mt-4 pt-2" action="" method="post">

                                        <?php
                                        
                                            if(isset($_GET["m"])){

                                                switch($_GET["m"]){
                                                    case "1";
                                                      ?>
                                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                            <i class="mdi mdi-block-helper me-2"></i>
                                                               Correo Electrónico no encontrado
                                                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                        </div>
                                                      <?php
                                                    break;

                                                    case "2";
                                                    ?>
                                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                            <i class="mdi mdi-block-helper me-2"></i>
                                                               Campos Vacíos
                                                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                        </div>
                                                    <?php

                                                    break;

                                                    case "3";
                                                    ?>
                                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                            <i class="mdi mdi-block-helper me-2"></i>
                                                               Contraseña Incorrecta
                                                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                        </div>
                                                    <?php
                                                    break;
                                                }
                                            }

                                        ?>                                        

                                            <div class="mb-3">
                                                <label class="form-label">Correo Electrónico</label>
                                                <input type="email" class="form-control" id="usu_correo" name="usu_correo" placeholder="Ingrese Correo Electrónico" required>
                                            </div>
                                            <div class="mb-3">
                                                <div class="d-flex align-items-start">
                                                    <div class="flex-grow-1">
                                                        <label class="form-label">Contraseña</label>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="">
                                                            <a href="../../view/recuperarcolaborador/index.php" class="text-muted">Olvidaste tu Contraseña?</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="input-group auth-pass-inputgroup">
                                                    <input type="password" class="form-control" id="usu_pass" name="usu_pass" placeholder="Ingrese Contraseña" aria-label="Password" aria-describedby="password-addon" required>
                                                    <button class="btn btn-light shadow-none ms-0" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="remember-check">
                                                        <label class="form-check-label" for="remember-check">
                                                            Recuérdame
                                                        </label>
                                                    </div>  
                                                </div>
                                                
                                            </div>
                                            <div class="mb-3">
                                                <input type="hidden" name="enviar" value="si">
                                                <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Acceder</button>
                                            </div>
                                        </form>

                                        <div class="mt-4 pt-2 text-center">
                                            <div class="signin-other-title">
                                                <h5 class="font-size-14 mb-3 text-muted fw-medium">- Acceder con -</h5>
                                            </div>

                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <div id="g_id_onload" data-client_id="81131178575-fcnvuu1vt3sfb26e51hojonupnh0oig0.apps.googleusercontent.com" 
                                                    data-context="signin" 
                                                    data-ux_mode="popup" 
                                                    data-callback="handleCredentialResponse" 
                                                    data-auto_prompt="false">                                                        
                                                    </div>
                                                    <div class="g_id_signin"
                                                         data-type="standard"
                                                         data-shape="rectangular"
                                                         data-theme="outline"
                                                         data-text="signin_with"
                                                         data-size="large"
                                                         data-logo_alignment="left">
                                                    </div>
                                                </li>                                                
                                            </ul>
                                        </div>

                                    </div>
                                    <div class="mt-4 mt-md-5 text-center">
                                        <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> La Usina <i class="mdi mdi-heart text-danger"></i> by Guillermo Lapettina</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end auth full page content -->
                    </div>
                    <!-- end col -->
                    <div class="col-xxl-9 col-lg-8 col-md-7">
                        <div class="auth-bg pt-md-5 p-4 d-flex">
                            <div class="bg-overlay bg-primary"></div>
                            <ul class="bg-bubbles">
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                            <!-- end bubble effect -->
                            <div class="row justify-content-center align-items-center">
                                <div class="col-xl-7">
                                    <div class="p-0 p-sm-4 px-xl-0">
                                        <div id="reviewcarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-indicators carousel-indicators-rounded justify-content-start ms-0 mb-0">
                                                <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                                <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                            </div>
                                            <!-- end carouselIndicators -->
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <div class="testi-contain text-white">
                                                        <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                                        <h4 class="mt-4 fw-medium lh-base text-white">“Estamos encantados de tenerlos en nuestra casa, 
                                                            en nombre de toda la ESRN 153 les damos nuestra más cálida bienvenida y los mejores deseos.”
                                                        </h4>
                                                        <div class="mt-4 pt-3 pb-5">
                                                            <div class="d-flex align-items-start">
                                                                <div class="flex-shrink-0">
                                                                    <img src="../../assets/picture/avatar-1-1.jpg" class="avatar-md img-fluid rounded-circle" alt="...">
                                                                </div>
                                                                <div class="flex-grow-1 ms-3 mb-4">
                                                                    <h5 class="font-size-18 text-white">Natalia Toletti Del Pino
                                                                    </h5>
                                                                    <p class="mb-0 text-white-50">Directora</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="carousel-item">
                                                    <div class="testi-contain text-white">
                                                        <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                                        <h4 class="mt-4 fw-medium lh-base text-white">“El éxito llega a quienes están dispuestos a alcanzarlo. Es la suma de la buena actitud y el trabajo.
                                                            Éxito a todxs compañerxs.
                                                            .”</h4>
                                                        <div class="mt-4 pt-3 pb-5">
                                                            <div class="d-flex align-items-start">
                                                                <div class="flex-shrink-0">
                                                                    <img src="../../assets/picture/avatar-2-1.jpg" class="avatar-md img-fluid rounded-circle" alt="...">
                                                                </div>
                                                                <div class="flex-grow-1 ms-3 mb-4">
                                                                    <h5 class="font-size-18 text-white">Soledad López
                                                                    </h5>
                                                                    <p class="mb-0 text-white-50">Vicedirectora</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- end carousel-inner -->
                                        </div>
                                        <!-- end review carousel -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container fluid -->
        </div>


        <!-- JAVASCRIPT -->
        <script src="../../assets/js/jquery.min-1.js"></script>
        <script src="../../assets/js/bootstrap.bundle.min-1.js"></script>
        <script src="../../assets/js/metisMenu.min-1.js"></script>
        <script src="../../assets/js/simplebar.min-1.js"></script>
        <script src="../../assets/js/waves.min-1.js"></script>
        <script src="../../assets/js/feather.min-1.js"></script>
        <!-- pace js -->
        <script src="../../assets/js/pace.min-1.js"></script>
        <!-- password addon init -->
        <script src="../../assets/js/pass-addon.init-1.js"></script>

        <!-- Script para cargar la API de Google Sign-In de manera asíncronal -->                                           
         <script src="https://accounts.google.com/gsi/client" async></script>

         <script src="../../assets/js/sweetalert2.min.js"></script>

         <script type="text/javascript" src="accesopersonal.js"></script>

    </body>

</html>