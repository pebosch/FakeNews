<!--/******************************************************************************************************************/
/********************************************** REDALONE STYLE v.3.0 **********************************************/
/* Desarrollo por Pedro Fernández Bosch y David Rojas Quesada */
/* Adaptación para Reddelsur Control Panel v.2.0 */
/* 31/05/2010 */
/* https://github.com/pebosch/fakenews */
/* Esta obra está bajo una licencia GNU LGPLv3 */
/******************************************************************************************************************/-->

<?php
session_start();
include_once 'func/func_authentication.php';
startAuthentication();

include_once 'func/func_conexion.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <head>
        <title>FakeNews, ¿Realidad o Ficción?</title>
        <meta charset="UTF-8" />
        <meta name="language" content="es" />
        <link rel="shortcut icon" href="favicon.ico" />
        <link rel="stylesheet" type="text/css" href="css/style_panel.css" /> 
        <!-- Google Fonts -->
        <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700|Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>
            <link rel="stylesheet" href="css/animate.css">
                <!-- Custom Stylesheet -->
                <link rel="stylesheet" href="css/style.css">
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
                    <head>
                        <!-- Custom Stylesheet -->
                        <link rel="shortcut icon" href="favicon.ico" />
                        <link rel="stylesheet" type="text/css" href="css/style_panel.css" /> 
                        <meta name="language" content="es" />

                        <!-- Librerias de valicdacion javascript (AJAX) -->
                        <script src="js/validacion.js" type="text/javascript"></script>
                        <script src="js/validacion_nuevo_servicio.js" type="text/javascript"></script>
                        <script src="js/validacion_nueva_reparacion.js" type="text/javascript"></script>

                        <!-- Librerias para cargar ANADIR IMAGEN-->
                        <script src="js/anadir_imagen.js" type="text/javascript"></script>
                    </head>
                    <body>
                        <div class="align_cen">
                            <?php
                            switch ($_GET['seccion']) {
                                case 1: include("form/form_authentication.php");
                                    break;
                                case 2: include("form/form_vote_news.php");
                                    break;
                                case 3: include("func/func_processvote.php");
                                    break;
                                case 4: include("form/form_admin_panel.php");
                                    break;
                                case 5: include("func/func_changefase.php");
                                    break;
                                case 6: include("form/form_exito.php");
                                    break;
                                case 7: include("form/form_nueva_reparacion.php");
                                    break;
                                case 8: include("form/form_borrar_reparacion.php");
                                    break;
                                case 9: include("form/form_modificar_reparacion.php");
                                    break;
                                case 10: include("form/form_modificar_ficha_reparacion.php");
                                    break;
                                default: include("form/form_vote_news.php");
                                    break;
                            }
                            ?>
                            <br />
                            <span class="gris_peque">FakeNews - ¿Realidad o Ficción? V1.0 - Granada - ESPA&Ntilde;A - E-MAIL: <a href="mailto:info@reddelsur.es" target="_self" class="gris_peque_link">INFO@REDDELSUR.ES</a><br />DESARROLLO: <a href="http://www.reddelsur.es" target="_blank" class="gris_peque_link">REDDELSUR</a> &copy; 2012 - <a href="http://validator.w3.org/check?uri=referer" target="_blank" class="gris_peque_link">XHTML</a> - <a href="http://jigsaw.w3.org/css-validator/check/referer" target="_blank" class="gris_peque_link">CSS</a> - TODOS LOS DERECHOS RESERVADOS</span>
                        </div>
                    </body>
                    </html>