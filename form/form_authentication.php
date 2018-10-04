<!--/******************************************************************************************************************/
/********************************************** REDALONE STYLE v.3.0 **********************************************/
/* Desarrollo por Pedro Fernández Bosch y David Rojas Quesada */
/* Adaptación para Reddelsur Control Panel v.2.0 */
/* 31/05/2010 */
/* https://github.com/pebosch/fakenews */
/* Esta obra está bajo una licencia GNU LGPLv3 */
/******************************************************************************************************************/-->

<?php
include_once 'func/func_conexion.php';
?>

<div class="container">
    <div class="top">
        <h1 id="title" class="hidden"><span id="logo">Fake<span>News</span></span></h1>
    </div>
    <div class="login-box animated fadeInUp">
        <div class="box-header">
            <h2>Log In</h2>
        </div>
        <form action="../func/func_connectUser.php" method="post">
            <label for="username_txt">Usuario</label>
            <br/>
            <input name="username" type="text" >
            <br/>
            <label for="password_txt">Contraseña</label>
            <br/>
            <input name="password" type="password" >
            <br/>
            <button type="submit">Acceder</button>
            <br/>
        </form>
        <a href="#"><p class="small">Olvidaste tu contraseña?</p></a>

    </div>
</div>

<script>
    $(document).ready(function () {
        $('#logo').addClass('animated fadeInDown');
        $("input:text:visible:first").focus();
    });
    $('#username').focus(function () {
        $('label[for="username"]').addClass('selected');
    });
    $('#username').blur(function () {
        $('label[for="username"]').removeClass('selected');
    });
    $('#password').focus(function () {
        $('label[for="password"]').addClass('selected');
    });
    $('#password').blur(function () {
        $('label[for="password"]').removeClass('selected');
    });
</script>