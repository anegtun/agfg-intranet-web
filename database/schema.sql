DROP TABLE IF EXISTS agfg_users;
DROP TABLE IF EXISTS agfg_partido;
DROP TABLE IF EXISTS agfg_fase;
DROP TABLE IF EXISTS agfg_competicion_equipas;
DROP TABLE IF EXISTS agfg_competicion;
DROP TABLE IF EXISTS agfg_equipas;



CREATE TABLE agfg_users (
  id int unsigned NOT NULL AUTO_INCREMENT,
  nome_usuario varchar(50) DEFAULT NULL,
  contrasinal varchar(255) DEFAULT NULL,
  nome varchar(255) DEFAULT NULL,
  rol varchar(20) DEFAULT NULL,
  created datetime DEFAULT NULL,
  modified datetime DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


CREATE TABLE agfg_equipas (
  id int NOT NULL AUTO_INCREMENT,
  codigo varchar(3) NOT NULL,
  nome varchar(200) DEFAULT NULL,
  logo varchar(200) DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE agfg_competicion (
  id int NOT NULL AUTO_INCREMENT,
  nome varchar(200) DEFAULT NULL,
  ano varchar(200) DEFAULT NULL,
  tipo varchar(200) DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE agfg_competicion_equipas (
  id int NOT NULL AUTO_INCREMENT,
  id_equipo int NOT NULL,
  id_competicion int NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE agfg_fase (
  id int NOT NULL AUTO_INCREMENT,
  id_competicion int NOT NULL,
  nome varchar(200) DEFAULT NULL,
  tipo varchar(200) DEFAULT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (id_competicion) REFERENCES agfg_competicion(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE agfg_partido (
  id int NOT NULL AUTO_INCREMENT,
  id_fase int NOT NULL,
  id_equipo1 int NOT NULL,
  id_equipo2 int NOT NULL,
  goles_equipo1 int DEFAULT NULL,
  goles_equipo2 int DEFAULT NULL,
  tantos_equipo1 int DEFAULT NULL,
  tantos_equipo2 int DEFAULT NULL,
  data_partido datetime DEFAULT NULL,
  lugar varchar(200) DEFAULT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (id_fase) REFERENCES agfg_fase(id),
  FOREIGN KEY (id_equipo1) REFERENCES agfg_equipas(id),
  FOREIGN KEY (id_equipo2) REFERENCES agfg_equipas(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




INSERT INTO agfg_users VALUES (1,'agfg-admin','$2a$10$BRzX/K3Ds/8dV1X6MsU2QOc3eBvu7J8bxOa3KyIDSWzztU4ggKfdW','Administrador','admin','2016-09-21 19:38:38','2016-09-21 19:38:38');
