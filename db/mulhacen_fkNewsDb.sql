-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 03-10-2018 a las 23:43:05
-- Versión del servidor: 5.5.61-cll
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mulhacen_fkNewsDb`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`mulhacen`@`localhost` PROCEDURE `activarFase` (IN `fase` INT(1) UNSIGNED)  BEGIN
-- Activamos las noticas de la Fase1
IF (fase = 1)  then
-- desactivamos todas las noticias
UPDATE news SET visible = 0;
-- activamos las de la fase 1
UPDATE news SET visible = 1 WHERE stage = 1;
 END IF;
 
 -- Activamos las noticas de la Fase2
IF (fase = 2)  then
-- desactivamos todas las noticias
UPDATE news SET visible = 0;
-- activamos las de la fase 1
UPDATE news SET visible = 1 WHERE stage = 2;
 END IF;
END$$

CREATE DEFINER=`mulhacen`@`localhost` PROCEDURE `estadisticasVotacionesFases` (IN `fase` INT(1) UNSIGNED)  BEGIN
-- Variables del alumno actual que se esta leyendo
  DECLARE v_alumno_ac INT;
  DECLARE v_voto_ac INT;
  DECLARE v_fase_ac INT DEFAULT 0;
  DECLARE v_new_ac INT;
  DECLARE v_noticia_ac INT;
-- Variables del alumno acumuladas
  DECLARE v_alumno INT;
  DECLARE v_voto INT;
  DECLARE v_noticia INT;
  DECLARE v_noticias_correctas INT;
  DECLARE v_noticias_incorrectas INT;

-- Variable para controlar el fin del bucle
   DECLARE n INT DEFAULT 0;
   DECLARE i INT DEFAULT 0;



-- El SELECT que vamos a ejecutar
  DECLARE votos_cursor CURSOR FOR SELECT votes.idUser, votes.idNew, votes.fake, news.fake ,news.stage FROM votes INNER JOIN news ON votes.idNew = news.id order by  votes.idUser;

  OPEN votos_cursor;
    set n =  (SELECT COUNT(*) FROM votes);
    SET i = 0;
 
   CREATE TEMPORARY TABLE tabla_resultado (
     id_alumno INT,
     noticias_correctas int,
     noticias_incorrectas int
   ) ENGINE=MEMORY;
   
 
  WHILE i<n DO 
     SET i = i + 1;
    FETCH votos_cursor INTO v_alumno_ac, v_new_ac, v_voto_ac, v_noticia_ac,v_fase_ac;
   -- SELECT v_alumno_ac, v_new_ac, v_voto_ac, v_noticia_ac; Verificamos que sea la fase correcta  
   if(v_fase_ac=fase) then
		-- Seguimos con el mismo alumno, acumulamos estadisticas
	   IF (`v_alumno` = `v_alumno_ac`)  then
		    IF (`v_voto_ac` = `v_noticia_ac`)  THEN
				set v_noticias_correctas = v_noticias_correctas + 1;
				ELSE
					set v_noticias_incorrectas = v_noticias_incorrectas+1;
		   	END IF;
			ELSE
				-- Mostramos los valores del alumno anterior ya que no hay mas votos SELECT v_alumno, v_noticias_correctas, v_noticias_incorrectas;
			 insert into tabla_resultado (id_alumno,noticias_correctas,noticias_incorrectas) values (v_alumno ,v_noticias_correctas,v_noticias_incorrectas);
				-- Asignamos el nuevo alumno a las variables
				set v_alumno = v_alumno_ac;
				-- iniciamos variables
				set v_noticias_correctas = 0;
				set v_noticias_incorrectas = 0;
				-- Asigamos el voto en incorrecto o correcto
				IF (`v_voto_ac` = `v_noticia_ac`)  THEN
						set v_noticias_correctas = v_noticias_correctas + 1;
					else
						set v_noticias_incorrectas = v_noticias_incorrectas + 1;
			END IF;
	   end IF;
	  end if;
 END WHILE;
  CLOSE votos_cursor;
 select users.Nombre,users.Apellido1,users.Apellido2, users.Curso,tabla_resultado.noticias_correctas as Correctas,tabla_resultado.noticias_incorrectas as incorrectas,(noticias_correctas+noticias_incorrectas) as TotalVotadas,(noticias_correctas/(noticias_correctas+noticias_incorrectas))*100 as aciertos,fase  from  tabla_resultado INNER JOIN users ON users.id = tabla_resultado.id_alumno ;
 DROP TEMPORARY TABLE tabla_resultado;
END$$

CREATE DEFINER=`mulhacen`@`localhost` PROCEDURE `generarPasswd` ()  BEGIN
-- Variables del alumno actual que se esta leyendo
  DECLARE login_user Varchar(100);

-- Variable para controlar el fin del bucle
   DECLARE n INT DEFAULT 0;
   DECLARE i INT DEFAULT 0;



-- El SELECT que vamos a ejecutar
  DECLARE usuarios_cursor CURSOR FOR SELECT login FROM users ;

  OPEN usuarios_cursor;
    set n =  (SELECT COUNT(*) FROM users);
    SET i = 0;
 

  WHILE i<n DO 
     SET i = i + 1;
    FETCH usuarios_cursor INTO login_user;
   
   UPDATE users SET passwd = MD5(login_user) WHERE login = login_user;

	END WHILE;
  CLOSE usuarios_cursor;

END$$

CREATE DEFINER=`mulhacen`@`localhost` PROCEDURE `getFase` (OUT `fase_actual` INT(1) UNSIGNED)  BEGIN
DECLARE noticias_visible_fase1 INT(4) default 0;
DECLARE noticias_visible_fase2 INT(4) default 0;

-- comprobamos el total de noticias fase 1 activadas
select count(*) into noticias_visible_fase1 from news where stage = 1 and visible = 1 ;

-- comprobamos el total de noticias fase 1 activadas
select count(*) into noticias_visible_fase2 from news where stage = 2 and visible = 1 ;

-- Si la snoticias de la fase2 visibles es 0 ESTAMOS en FASE1
if (noticias_visible_fase2 = 0 and noticias_visible_fase1 > 0 ) then
	set @fase_actual = 1;
End if;
-- Si la snoticias de la fase1 visibles es 0 ESTAMOS en FASE2
if (noticias_visible_fase1 = 0 and noticias_visible_fase2 > 0 ) then
	set @fase_actual = 2;
End if;
-- return fase_actual;

select @fase_actual as fase_actual;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `news`
--

CREATE TABLE `news` (
  `id` int(6) NOT NULL,
  `title` varchar(150) CHARACTER SET latin1 NOT NULL,
  `urlScreenshot` varchar(200) CHARACTER SET latin1 NOT NULL,
  `urlWebSource` varchar(250) CHARACTER SET latin1 NOT NULL,
  `fake` int(1) NOT NULL COMMENT '1->Falsa 0 ->Verdadera',
  `visible` int(1) NOT NULL COMMENT '1->Visible 0 ->No visible',
  `stage` int(11) NOT NULL COMMENT '1=Fase1 o 2=Fase2'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(3) NOT NULL,
  `login` varchar(100) NOT NULL,
  `passwd` varchar(32) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Apellido1` varchar(50) NOT NULL,
  `Apellido2` varchar(50) NOT NULL,
  `Curso` varchar(10) NOT NULL,
  `sexo` varchar(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_tmp`
--

CREATE TABLE `users_tmp` (
  `id` int(3) NOT NULL,
  `login` varchar(100) NOT NULL,
  `passwd` varchar(32) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Apellido1` varchar(50) NOT NULL,
  `Apellido2` varchar(50) NOT NULL,
  `Curso` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `votes`
--

CREATE TABLE `votes` (
  `idUser` int(3) NOT NULL,
  `idNew` int(6) NOT NULL,
  `fake` tinyint(1) NOT NULL COMMENT 'Es real o no la noticia',
  `diffusion` tinyint(1) NOT NULL COMMENT 'Difundida en otros medios',
  `author` tinyint(1) NOT NULL COMMENT 'Autor contrastado y de prestigio',
  `source` tinyint(1) NOT NULL COMMENT 'Medio de comunicacion fiabl',
  `hype` tinyint(1) NOT NULL COMMENT 'Es actual o con mucha cobertura en medios',
  `authorImg` tinyint(1) NOT NULL COMMENT 'Las imagenes tienen o no autor',
  `trueStory` tinyint(1) NOT NULL COMMENT 'Habla de lugares reales o concretos',
  `scamEur` tinyint(1) NOT NULL COMMENT 'Pide dinero',
  `malwareInstall` tinyint(1) NOT NULL COMMENT 'Instala Malware',
  `clickBait` tinyint(1) NOT NULL COMMENT 'Publicidad invasiva, productos milagrosos',
  `gainRank` tinyint(1) NOT NULL COMMENT 'Busca fama o difusion'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Indices de la tabla `users_tmp`
--
ALTER TABLE `users_tmp`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `news`
--
ALTER TABLE `news`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT de la tabla `users_tmp`
--
ALTER TABLE `users_tmp`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=252;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
