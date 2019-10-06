DROP TABLE IF EXISTS `agfg_users`;
CREATE TABLE `agfg_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(50) DEFAULT NULL,
  `contrasinal` varchar(255) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `rol` varchar(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `agfg_equipas`;
CREATE TABLE `agfg_equipas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(3) NOT NULL,
  `nome` varchar(200) DEFAULT NULL,
  `logo` varchar(200) DEFAULT NULL,
  `categoria` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS `agfg_competicion`;
CREATE TABLE `agfg_competicion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) DEFAULT NULL,
  `tempada` varchar(200) DEFAULT NULL,
  `tipo` varchar(200) DEFAULT NULL,
  `categoria` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `agfg_competicion_equipas`;
CREATE TABLE `agfg_competicion_equipas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_equipo` int(11) NOT NULL,
  `id_competicion` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `agfg_fase`;
CREATE TABLE `agfg_fase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_competicion` int(11) NOT NULL,
  `nome` varchar(200) DEFAULT NULL,
  `tipo` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_competicion` (`id_competicion`),
  CONSTRAINT `agfg_fase_ibfk_1` FOREIGN KEY (`id_competicion`) REFERENCES `agfg_competicion` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `agfg_partido`;
CREATE TABLE `agfg_partido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_fase` int(11) NOT NULL,
  `id_equipo1` int(11) NOT NULL,
  `id_equipo2` int(11) NOT NULL,
  `goles_equipo1` int(11) DEFAULT NULL,
  `goles_equipo2` int(11) DEFAULT NULL,
  `tantos_equipo1` int(11) DEFAULT NULL,
  `tantos_equipo2` int(11) DEFAULT NULL,
  `data_partido` datetime DEFAULT NULL,
  `lugar` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_fase` (`id_fase`),
  KEY `id_equipo1` (`id_equipo1`),
  KEY `id_equipo2` (`id_equipo2`),
  CONSTRAINT `agfg_partido_ibfk_1` FOREIGN KEY (`id_fase`) REFERENCES `agfg_fase` (`id`),
  CONSTRAINT `agfg_partido_ibfk_2` FOREIGN KEY (`id_equipo1`) REFERENCES `agfg_equipas` (`id`),
  CONSTRAINT `agfg_partido_ibfk_3` FOREIGN KEY (`id_equipo2`) REFERENCES `agfg_equipas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
