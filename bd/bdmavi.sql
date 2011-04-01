/*
SQLyog - Free MySQL GUI v4.1
Host - 4.1.12a-nt : Database - bdmavi
*********************************************************************
Server version : 4.1.12a-nt
*/


create database if not exists `bdmavi`;

USE `bdmavi`;

/*Table structure for table `cat_area` */

drop table if exists `cat_area`;

CREATE TABLE `cat_area` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `area` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `cat_area` */

insert into `cat_area` values (1,'Fiscal'),(2,'Contadur');

/*Table structure for table `cat_privilegios` */

drop table if exists `cat_privilegios`;

CREATE TABLE `cat_privilegios` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `privilegio` varchar(45) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `cat_privilegios` */

insert into `cat_privilegios` values (1,'Administrador'),(2,'Coordinador'),(3,'Jurado'),(4,'Competidor');

/*Table structure for table `cat_regiones` */

drop table if exists `cat_regiones`;

CREATE TABLE `cat_regiones` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `region` varchar(45) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `cat_regiones` */

insert into `cat_regiones` values (1,'Zona I'),(2,'Zona II'),(3,'Zona III'),(4,'Zona IV'),(5,'Zona V'),(6,'Zona VI');

/*Table structure for table `cat_temas` */

drop table if exists `cat_temas`;

CREATE TABLE `cat_temas` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `tema` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `cat_temas` */

insert into `cat_temas` values (1,'Fiscal'),(2,'Administraci?n del personal');

/*Table structure for table `cat_universidad` */

drop table if exists `cat_universidad`;

CREATE TABLE `cat_universidad` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `nombre` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `cat_universidad` */

insert into `cat_universidad` values (1,'Universidad Veracruzana');

/*Table structure for table `competencia` */

drop table if exists `competencia`;

CREATE TABLE `competencia` (
  `id` int(15) NOT NULL auto_increment,
  `usuario_id` int(10) NOT NULL default '0',
  `cuestionario_pregunta_id` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `competencia` */

/*Table structure for table `correcciones` */

drop table if exists `correcciones`;

CREATE TABLE `correcciones` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `cuestionario_pregunta_id` int(10) unsigned NOT NULL default '0',
  `tipo` varchar(45) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `correcciones` */

/*Table structure for table `cuestionario_pregunta` */

drop table if exists `cuestionario_pregunta`;

CREATE TABLE `cuestionario_pregunta` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `etapa_id` int(10) unsigned NOT NULL default '0',
  `maraton_id` int(10) unsigned NOT NULL default '0',
  `preguntas_id` int(10) unsigned NOT NULL default '0',
  `secuencia` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `cuestionario_pregunta` */

/*Table structure for table `docente` */

drop table if exists `docente`;

CREATE TABLE `docente` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `nombre` varchar(45) default NULL,
  `apellido_paterno` varchar(45) default NULL,
  `apellido_materno` varchar(45) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `docente` */

insert into `docente` values (1,'Nancy Araceli','Olivarez','Ruiz'),(2,'Patricia','Arieta','Melgarejo');

/*Table structure for table `etapa` */

drop table if exists `etapa`;

CREATE TABLE `etapa` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `nombre` varchar(45) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `etapa` */

insert into `etapa` values (1,'Primera Fase'),(2,'Segunda Fase'),(5,'Tercera Fase');

/*Table structure for table `maraton` */

drop table if exists `maraton`;

CREATE TABLE `maraton` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `cat_universidad_id` int(10) unsigned NOT NULL default '0',
  `cat_regiones_id` int(10) unsigned NOT NULL default '0',
  `nombre_tema` varchar(255) default NULL,
  `fecha_creacion` date default NULL,
  `fecha_aplicacion` date default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `maraton` */

/*Table structure for table `maraton_activo` */

drop table if exists `maraton_activo`;

CREATE TABLE `maraton_activo` (
  `id` int(10) NOT NULL auto_increment,
  `cuestionario_pregunta_id` int(10) default NULL,
  `activo` tinyint(1) default NULL,
  `usuario_id` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`,`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `maraton_activo` */

/*Table structure for table `preferencias` */

drop table if exists `preferencias`;

CREATE TABLE `preferencias` (
  `usuario_id` int(5) default NULL,
  `color_default` varchar(7) default '#FFFFFF',
  `id` int(5) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `preferencias` */

/*Table structure for table `preguntas` */

drop table if exists `preguntas`;

CREATE TABLE `preguntas` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `cat_temas_id` int(10) unsigned NOT NULL default '0',
  `cat_area_id` int(10) unsigned NOT NULL default '0',
  `nombre_docente` varchar(200) default NULL,
  `pregunta` text,
  `opcion1` text,
  `opcion2` text,
  `opcion3` text,
  `opcion4` text,
  `respuesta` char(1) default NULL,
  `grado_dificultad` int(11) default NULL,
  `tipo` varchar(20) default NULL,
  `justificacion` text,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `preguntas` */

/*Table structure for table `respuesta` */

drop table if exists `respuesta`;

CREATE TABLE `respuesta` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `cuestionario_pregunta_id` int(10) unsigned NOT NULL default '0',
  `usuario_id` int(10) unsigned NOT NULL default '0',
  `respuesta` int(11) NOT NULL default '0',
  `tiempo` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`,`cuestionario_pregunta_id`,`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `respuesta` */

/*Table structure for table `usuario` */

drop table if exists `usuario`;

CREATE TABLE `usuario` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `cat_privilegios_id` int(10) unsigned NOT NULL default '0',
  `nombre` varchar(18) default NULL,
  `contrasenia` varchar(18) default NULL,
  `online` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `usuario` */

insert into `usuario` values (1,1,'Admin','admin',0),(3,2,'Coordinador','coordinador',0),(16,4,'equipo1','equipo1',0),(17,4,'equipo2','equipo2',0),(18,4,'equipo3','equipo3',0),(19,4,'equipo4','equipo4',0),(20,4,'equipo5','equipo5',0),(21,4,'equipo6','equipo6',0),(22,4,'equipo7','equipo7',0),(23,4,'equipo8','equipo8',0),(24,4,'equipo9','equipo9',0),(25,4,'equipo10','equipo10',0);
