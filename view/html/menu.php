<?php

    require_once("../../models/Rol.php");
    $rol = new Rol();

    $datos = $rol->get_menu_x_rol($_SESSION["rol_id"]);

?>

<div class="vertical-menu">

<div data-simplebar="" class="h-100">

    <div id="sidebar-menu">
        <ul class="metismenu list-unstyled" id="side-menu">
            <li class="menu-title" data-key="t-menu">Menú</li>

            <?php
            
                foreach ($datos as $row) {
                    ?>
                        <li>
                            <a href="<?php echo $row["men_ruta"] ?>">
                                <i data-feather="<?php echo $row["men_icon"] ?>"></i>
                                <span data-key="t-dashboard"><?php echo $row["men_nom_vista"] ?></span>
                            </a>
                        </li>
                    <?php

                }
            
            ?>

            <ul class="metismenu list-unstyled mm-show" id="side-menu">
                <li>
                    <a href="javascript: void(0);" class="has-arrow" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                        <span data-key="t-apps">Vacantes Asamblea</span>
                    </a>
                    <ul class="sub-menu mm-collapse" aria-expanded="false">
                        <li>
                            <a href="../cargos/">
                                <span data-key="t-calendar">Cargos</span>
                            </a>
                        </li>
                        <li>
                            <a href="../comunicacion/">
                                <span data-key="t-calendar">Comunicación y Expresión</span>
                            </a>
                        </li>
                        <li>
                            <a href="../sociales/">
                                <span data-key="t-calendar">Ciencias Sociales</span>
                            </a>
                        </li>
                        <li>
                            <a href="../contables/">
                                <span data-key="t-calendar">Jurídicas y Contables</span>
                            </a>
                        </li>
                        <li>
                            <a href="../tecnicas/">
                                <span data-key="t-calendar">Técnicas y Modalidades</span>
                            </a>
                        </li>
                        <li>
                            <a href="../exactas/">
                                <span data-key="t-calendar">Exactas y Naturales</span>
                            </a>
                        </li>
                </li>
            </ul>

            <ul class="metismenu list-unstyled mm-show" id="side-menu">
                <li>
                    <a href="javascript: void(0);" class="has-arrow" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                        <span data-key="t-apps">Mini Asamblea</span>
                    </a>
                    <ul class="sub-menu mm-collapse" aria-expanded="false">
                        <li>
                            <a href="../cargos-mini/">
                                <span data-key="t-calendar">Cargos</span>
                            </a>
                        </li>
                        <li>
                            <a href="../comunicacion-mini/">
                                <span data-key="t-calendar">Comunicación y Expresión</span>
                            </a>
                        </li>
                        <li>
                            <a href="../sociales-mini/">
                                <span data-key="t-calendar">Ciencias Sociales</span>
                            </a>
                        </li>
                        <li>
                            <a href="../contables-mini/">
                                <span data-key="t-calendar">Jurídicas y Contables</span>
                            </a>
                        </li>
                        <li>
                            <a href="../tecnicas-mini/">
                                <span data-key="t-calendar">Técnicas y Modalidades</span>
                            </a>
                        </li>
                        <li>
                            <a href="../exactas-mini/">
                                <span data-key="t-calendar">Exactas y Naturales</span>
                            </a>
                        </li>
                </li>
            </ul>

        <?php        

            if ($_SESSION["rol_id"] == 1) {
                
                echo '<li>
                        <a href="../favoritos/">
                            <i data-feather="star"></i>
                            <span data-key="t-dashboard">Favoritos Asamblea</span>
                        </a>
                    </li>
                    <li>
                        <a href="../favoritos-mini/">
                            <i data-feather="star"></i>
                            <span data-key="t-dashboard">Favoritos Mini Asamblea</span>
                        </a>
                    </li>';
            }            

        ?>

        </ul>

    </div>
</div>
</div>
