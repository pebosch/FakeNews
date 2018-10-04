<!--/******************************************************************************************************************/
/********************************************** REDALONE STYLE v.3.0 **********************************************/
/* Desarrollo por Pedro Fernández Bosch y David Rojas Quesada */
/* Adaptación para Reddelsur Control Panel v.2.0 */
/* 31/05/2010 */
/* https://github.com/pebosch/fakenews */
/* Esta obra está bajo una licencia GNU LGPLv3 */
/******************************************************************************************************************/-->

<?php
include_once 'func/func_authentication.php';
include_once 'func/func_utils.php';
include_once 'func/func_conexion.php';

if (checkAuthentication() == true) {
    $dbh = new Conexion();
    $idusuario = $_SESSION["id_usr"];
    $noticias_pendientes = $dbh->getTotalPendingNewsUser($idusuario);
    $output = "";
    $output .= "<div class='login-box-large'>";
    $output .= "<p>Hola <b>" . $_SESSION["login_usr"] . "</b>!  tienes  <b>" . $noticias_pendientes . "</b> noticias por votar </p> <br>";
    //* Sacamos una noticia de las que aun no ha votado el usuario*//

    $consulta = "select * from news where visible=1 and id not in(select idNew from votes where idUser IN (SELECT id FROM `users`where login= '" . $_SESSION["login_usr"] . "'))limit 1;";
    $result = $dbh->consulta($consulta) or die('No se ha podido acceder a la base de datos, consulte con su administrador:' . mysql_error());


    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $_SESSION["news_act"] = $row['id'];
            $output .= "<h1>" . $row['title'] . "</h1>";
            $output .= "<p><img src='http://" . $_SERVER['HTTP_HOST'] . "/images/" . $row['urlScreenshot'] . "' alt='' style='width:100%; '  ></p>";


            $output .= "<p><a target='_blank' href='" . $row['urlWebSource'] . "'>Ver Noticia</a></p></br></br>";
        }
        $output .= "<p><b>¿Realidad o Ficcion?</b></p>";
        $output .= "<form id='form1' action='../index.php?seccion=3' method='post' onsubmit='return valida(this)' >
                        <input type='checkbox' name='newsread' value='1'>He terminado de leer la noticia<br>
						<div id='eLeerNoticia_error' style='display:none' class='texto_rojo'><strong>Marca la casilla si has leido completamente la noticia</strong></div>	
						<input type='checkbox' name='websearch' value='1'>He usado un buscador para comprobar que la noticia aparece en diversos medios
						<div id='eContrastarNoticia_error' style='display:none' class='texto_rojo'><strong>Marca esta casilla si has comprobado la noticia en otros medios</strong></div>	
						<br><br>				
						<div id='eVotarNoticia_error' style='display:none' class='texto_rojo'><strong>Debes indicar si la noticia es verdadera o falsa</strong></div>							
						
						<input type='radio' name='ynquestion' value='0' onclick='show1();' /> Si,es verdadera<br>
                        <div id='eArgumentosVotoVerdad_error' style='display:none' class='texto_rojo'><strong>Debes seleccionar los argumentos de porque es verdadera o falsa</strong></div>							
						<div id='div1' class='hide'>						
                            <input type='checkbox' name='yarguments0' value='0'>Difundida en otros medios<br>
                            <input type='checkbox' name='yarguments1' value='1'>Autor contrastado y de prestigio<br>
                            <input type='checkbox' name='yarguments2' value='2'>Medio de comunicacion fiable<br>
                            <input type='checkbox' name='yarguments3' value='3'>Es actual o con mucha cobertura en medios<br>
							<input type='checkbox' name='yarguments4' value='4'>Las imagenes que contiene la noticia tienen autor<br>
							<input type='checkbox' name='yarguments5' value='5'>Hablan de lugares reales y concretos en la noticia<br>
							<input type='checkbox' name='yarguments6' value='6'>No se pide dinero o recursos en la noticia<br>
							<input type='checkbox' name='yarguments7' value='7'>No intenta instalarnos ningun programa externo<br>
							<input type='checkbox' name='yarguments8' value='8'>No hay publicidad de productos milagrosos o aparentemente falsos<br>
							<input type='checkbox' name='yarguments9' value='9'>El protagonista/s de la noticia NO busca ganar fama con su difusion<br>
                        </div>
                        <input type='radio' name='ynquestion' value='1' onclick='show2();' /> No,es falsa<br>
						<div id='eArgumentosVoto_error' style='display:none' class='texto_rojo'><strong>Debes seleccionar los argumentos de porque es verdadera o falsa</strong></div>							
                        <div id='div2' class='hide'>
                            <input type='checkbox' name='narguments0' value='0'>No difundida en otros medios<br>
                            <input type='checkbox' name='narguments1' value='1'>Autor desconocido o poca trayectoria<br>
                            <input type='checkbox' name='narguments2' value='2'>Medio de comunicacion desconocido o poco fiable<br>
                            <input type='checkbox' name='narguments3' value='3'>No actual,evento pasado o irrelevante<br>
							<input type='checkbox' name='narguments4' value='4'>Aparecen imagenes sin autor definido<br>
							<input type='checkbox' name='narguments5' value='5'>No indican el lugar concreto de la noticia<br>
							<input type='checkbox' name='narguments6' value='6'>Se pide dinero o recursos en la noticia<br>
							<input type='checkbox' name='narguments7' value='7'>Intenta o sugiere que instalemos un programa externo sin relacion con la noticia<br>
							<input type='checkbox' name='narguments8' value='8'>Hay publicidad de productos milagrosos o aparentemente falsos<br>
							<input type='checkbox' name='narguments9' value='9'>El protagonista/s de la noticia SOLO busca ganar fama con su difusion<br>
                        </div>
						<br>
                        <button type='submit' value='Submit'>Votar</button>
                    </form>
                ";
        $output .= "</form>";
    } else {//No hay resultados
        $output .= "<h1>!Enhorabuena! terminaste ;)<h1>";
    }
    $output .= "</div>";
} else {
    redirect("index.php?seccion=1");
}
echo $output;
?>