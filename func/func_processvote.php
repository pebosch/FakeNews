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
include_once 'func/func_utils.php';
if (checkAuthentication() == true) {
    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */
    $dbh = new Conexion();
    echo "EOOOOO";
    $output = "Guardando el voto";
    $fake = 0;
    $diffusion = 0;
    $author = 0;
    $source = 0;
    $hype = 0;
    $authorImg = 0;
    $trueStory = 0;
    $scamEur = 0;
    $malwareInstall = 0;
    $clickBait = 0;
    $gainRank = 0;
    $idUser = $_SESSION["id_usr"];
    $idNews = $_SESSION["news_act"];
    if ($_POST["ynquestion"] == 0) {//Es verdadera
        $fake = 0;
        if (isset($_POST["yarguments0"])) {
            $diffusion = 1;
        }
        if (isset($_POST["yarguments1"])) {
            $author = 1;
        }
        if (isset($_POST["yarguments2"])) {
            $source = 1;
        }
        if (isset($_POST["yarguments3"])) {
            $hype = 1;
        }
        if (isset($_POST["yarguments4"])) {
            $authorImg = 1;
        }
        if (isset($_POST["yarguments5"])) {
            $trueStory = 1;
        }
        if (isset($_POST["yarguments6"])) {
            $scamEur = 1;
        }
        if (isset($_POST["yarguments7"])) {
            $malwareInstall = 1;
        }
        if (isset($_POST["yarguments8"])) {
            $clickBait = 1;
        }
        if (isset($_POST["yarguments9"])) {
            $gainRank = 1;
        }
    } else {//Es falsa!
        $fake = 1;
        if (isset($_POST["narguments0"])) {
            $diffusion = 1;
        }
        if (isset($_POST["narguments1"])) {
            $author = 1;
        }
        if (isset($_POST["narguments2"])) {
            $source = 1;
        }
        if (isset($_POST["narguments3"])) {
            $hype = 1;
        }
        if (isset($_POST["narguments4"])) {
            $authorImg = 1;
        }
        if (isset($_POST["narguments5"])) {
            $trueStory = 1;
        }
        if (isset($_POST["narguments6"])) {
            $scamEur = 1;
        }
        if (isset($_POST["narguments7"])) {
            $malwareInstall = 1;
        }
        if (isset($_POST["narguments8"])) {
            $clickBait = 1;
        }
        if (isset($_POST["narguments9"])) {
            $gainRank = 1;
        }
    }

    $dbh->addVoteNewsUser($idNews, $idUser, $fake, $diffusion, $author, $source, $hype, $authorImg, $trueStory, $scamEur, $malwareInstall, $clickBait, $gainRank);


//redirigimos a la pagina de votaciones para una nueva noticia
    redirect("index.php?seccion=2");
} else {
    redirect("index.php?seccion=1");
}
//echo $output;
?>
