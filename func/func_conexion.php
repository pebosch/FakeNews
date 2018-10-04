<!--/******************************************************************************************************************/
/********************************************** REDALONE STYLE v.3.0 **********************************************/
/* Desarrollo por Pedro Fernández Bosch y David Rojas Quesada */
/* Adaptación para Reddelsur Control Panel v.2.0 */
/* 31/05/2010 */
/* https://github.com/pebosch/fakenews */
/* Esta obra está bajo una licencia GNU LGPLv3 */
/******************************************************************************************************************/-->

<?php
/* Clase MySQL para funcionar con PHP5 */

class Conexion {

    private $conexion;
    private $total_consultas;

    public function Conexion() {
        if (!isset($this->conexion)) {
//      $this->conexion = (mysql_connect("localhost","mulhacen_usr","FKN2018$"))
//        or die(mysql_error());
//      mysql_select_db("mulhacen_fakenewsbd",$this->conexion) or die(mysql_error());
            $this->conexion = new mysqli("localhost", "xxxxxxxxxxxx", "xxxxxxxxxxxx", "xxxxxxxxxxxx");
// Check connection
            if ($this->conexion->connect_error) {
                die("Connection failed: " . $conexion->connect_error);
            }
        }
        return $this;
    }

    public function consulta($consulta) {
        $resultado = $this->conexion->query($consulta);
        if (!$resultado) {
            echo 'MySQL Error: ' . mysql_error();
            exit;
        }
        return $resultado;
    }

    public function addVoteNewsUser($idNews, $idUser, $fake, $diffusion, $author, $source, $hype, $authorImg, $trueStory, $scamEur, $malwareInstall, $clickBait, $gainRank) {
        $consulta = "INSERT INTO `votes` (`idUser`, `idNew`, `fake`, `diffusion`, `author`, `source`, `hype`, `authorImg`,`trueStory`,`scamEur`,`malwareInstall`,`clickBait`,`gainRank`) VALUES ('$idUser', '$idNews', '$fake', '$diffusion', '$author', '$source', '$hype', '$authorImg','$trueStory','$scamEur','$malwareInstall','$clickBait','$gainRank');";
        $resultado = $this->conexion->query($consulta);
        if (!$resultado) {
            echo 'MySQL Error: ' . mysql_error();
            exit;
        }
        return $resultado;
    }

    public function changeFase($fase) {
        $consulta = "CALL activarFase('$fase');";
        $resultado = $this->conexion->query($consulta);
        if (!$resultado) {
            echo 'MySQL Error: ' . mysql_error();
            exit;
        }
        return $fase;
    }

    public function getFase() {
        $fase = 0;
        $consulta = "select count(*) as fase_actual from news where stage = 1 and visible = 1 ";
        $result = $this->conexion->query($consulta);
        if ($result->num_rows > 0) {
            // output data of each row      
            while ($row = $result->fetch_assoc()) {
                $fase = $row["fase_actual"];
            }
        }

        if ($fase == 0) {
            $fase = 2;
        } else {
            $fase = 1;
        }
        return $fase;
    }

    public function getTotalPendingNewsUser($idUser) {
        $totalNewsPendingUser = -10;
        $consulta = "select count(id) as total from news where visible=1 and id not in(select idNew from votes where idUser IN (SELECT id FROM `users`where id= '" . $idUser . "'))";
        $result = $this->conexion->query($consulta);
        if ($result->num_rows > 0) {
            // output data of each row      
            while ($row = $result->fetch_assoc()) {
                $totalNewsPendingUser = $row["total"];
            }
        }
        return $totalNewsPendingUser;
    }

    public function fetch_array($consulta) {
        return mysql_fetch_array($consulta);
    }

    public function num_rows($consulta) {
        return mysql_num_rows($consulta);
    }

    public function getTotalConsultas() {
        return $this->total_consultas;
    }

    public function Cerrar() {
        mysql_close($this->conexion);
    }

}
?>