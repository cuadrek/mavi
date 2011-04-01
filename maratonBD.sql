/*
SQLyog Community- MySQL GUI v8.22 
MySQL - 5.0.51b-community-nt-log : Database - bdmavi
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bdmavi` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `bdmavi`;

/*Table structure for table `cat_area` */

DROP TABLE IF EXISTS `cat_area`;

CREATE TABLE `cat_area` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `area` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `cat_area` */

/*Table structure for table `cat_privilegios` */

DROP TABLE IF EXISTS `cat_privilegios`;

CREATE TABLE `cat_privilegios` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `privilegio` varchar(45) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `cat_privilegios` */

insert  into `cat_privilegios`(`id`,`privilegio`) values (1,'Administrador'),(2,'Coordinador'),(3,'Jurado'),(4,'Competidor');

/*Table structure for table `cat_regiones` */

DROP TABLE IF EXISTS `cat_regiones`;

CREATE TABLE `cat_regiones` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `region` varchar(45) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `cat_regiones` */

insert  into `cat_regiones`(`id`,`region`) values (1,'Zona I'),(2,'Zona II'),(3,'Zona III'),(4,'Zona IV'),(5,'Zona V'),(6,'Zona VI');

/*Table structure for table `cat_temas` */

DROP TABLE IF EXISTS `cat_temas`;

CREATE TABLE `cat_temas` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `tema` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `cat_temas` */

/*Table structure for table `cat_universidad` */

DROP TABLE IF EXISTS `cat_universidad`;

CREATE TABLE `cat_universidad` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `nombre` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `cat_universidad` */

insert  into `cat_universidad`(`id`,`nombre`) values (1,'Universidad Veracruzana');

/*Table structure for table `competencia` */

DROP TABLE IF EXISTS `competencia`;

CREATE TABLE `competencia` (
  `id` int(15) NOT NULL auto_increment,
  `usuario_id` int(10) NOT NULL default '0',
  `cuestionario_pregunta_id` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `competencia` */

/*Table structure for table `correcciones` */

DROP TABLE IF EXISTS `correcciones`;

CREATE TABLE `correcciones` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `cuestionario_pregunta_id` int(10) unsigned NOT NULL default '0',
  `tipo` varchar(45) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `correcciones` */

/*Table structure for table `cuestionario_pregunta` */

DROP TABLE IF EXISTS `cuestionario_pregunta`;

CREATE TABLE `cuestionario_pregunta` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `etapa_id` int(10) unsigned NOT NULL default '0',
  `maraton_id` int(10) unsigned NOT NULL default '0',
  `preguntas_id` int(10) unsigned NOT NULL default '0',
  `secuencia` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=latin1;

/*Data for the table `cuestionario_pregunta` */

insert  into `cuestionario_pregunta`(`id`,`etapa_id`,`maraton_id`,`preguntas_id`,`secuencia`) values (1,1,1,7,1),(2,1,1,2,2),(3,1,1,11,3),(4,1,1,9,4),(5,1,1,21,5),(6,1,1,8,6),(7,1,1,5,7),(8,1,1,31,8),(9,1,1,3,9),(10,1,1,1,10),(11,1,1,13,11),(12,1,1,4,12),(13,1,1,17,13),(14,1,1,10,14),(15,1,1,16,15),(16,1,1,6,16),(17,1,1,27,17),(18,1,1,19,18),(19,1,1,37,19),(20,1,1,18,20),(21,1,1,38,21),(22,1,1,24,22),(23,1,1,22,23),(24,1,1,14,24),(25,1,1,23,25),(26,1,1,29,26),(27,1,1,40,27),(28,1,1,28,28),(29,1,1,30,29),(30,1,1,12,30),(31,1,1,25,31),(32,1,1,15,32),(33,1,1,34,33),(34,1,1,20,34),(35,1,1,33,35),(36,1,1,36,36),(37,1,1,32,37),(38,1,1,35,38),(39,1,1,39,39),(40,1,1,44,40),(41,1,1,42,41),(42,1,1,45,42),(43,1,1,59,43),(44,1,1,26,44),(45,1,1,47,45),(46,1,1,56,46),(47,1,1,41,47),(48,1,1,63,48),(49,1,1,58,49),(50,1,1,43,50),(51,1,1,46,51),(52,1,1,50,52),(53,1,1,49,53),(54,1,1,48,54),(55,1,1,51,55),(56,1,1,52,56),(57,1,1,62,57),(58,1,1,54,58),(59,1,1,64,59),(60,1,1,55,60),(61,1,1,57,61),(62,1,1,65,62),(63,1,1,53,63),(64,1,1,60,64),(65,1,1,61,65),(66,2,1,71,1),(67,2,1,69,2),(68,2,1,70,3),(69,2,1,77,4),(70,2,1,66,5),(71,2,1,79,6),(72,2,1,80,7),(73,2,1,72,8),(74,2,1,68,9),(75,2,1,76,10),(76,2,1,86,11),(77,2,1,74,12),(78,2,1,67,13),(79,2,1,75,14),(80,2,1,73,15),(81,2,1,81,16),(82,2,1,78,17),(83,2,1,87,18),(84,2,1,82,19),(85,2,1,84,20),(86,2,1,83,21),(87,2,1,89,22),(88,2,1,85,23),(89,2,1,90,24),(90,2,1,88,25),(91,3,1,94,1),(92,3,1,95,2),(93,3,1,92,3),(94,3,1,97,4),(95,3,1,98,5),(96,3,1,96,6),(97,3,1,93,7),(98,3,1,91,8);

/*Table structure for table `docente` */

DROP TABLE IF EXISTS `docente`;

CREATE TABLE `docente` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `nombre` varchar(45) default NULL,
  `apellido_paterno` varchar(45) default NULL,
  `apellido_materno` varchar(45) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `docente` */

/*Table structure for table `etapa` */

DROP TABLE IF EXISTS `etapa`;

CREATE TABLE `etapa` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `nombre` varchar(45) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `etapa` */

insert  into `etapa`(`id`,`nombre`) values (1,'Primera Fase'),(2,'Segunda Fase'),(3,'Tercera Fase');

/*Table structure for table `maraton` */

DROP TABLE IF EXISTS `maraton`;

CREATE TABLE `maraton` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `cat_universidad_id` int(10) unsigned NOT NULL default '0',
  `cat_regiones_id` int(10) unsigned NOT NULL default '0',
  `nombre_tema` varchar(255) default NULL,
  `fecha_creacion` date default NULL,
  `fecha_aplicacion` date default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `maraton` */

insert  into `maraton`(`id`,`cat_universidad_id`,`cat_regiones_id`,`nombre_tema`,`fecha_creacion`,`fecha_aplicacion`) values (1,1,1,'Maraton de Finanzas','0000-00-00','0000-00-00');

/*Table structure for table `maraton_activo` */

DROP TABLE IF EXISTS `maraton_activo`;

CREATE TABLE `maraton_activo` (
  `id` int(10) NOT NULL auto_increment,
  `cuestionario_pregunta_id` int(10) default NULL,
  `activo` tinyint(1) default NULL,
  `usuario_id` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`,`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `maraton_activo` */

insert  into `maraton_activo`(`id`,`cuestionario_pregunta_id`,`activo`,`usuario_id`) values (1,66,0,1);

/*Table structure for table `preferencias` */

DROP TABLE IF EXISTS `preferencias`;

CREATE TABLE `preferencias` (
  `usuario_id` int(5) default NULL,
  `color_default` varchar(7) default '#FFFFFF',
  `id` int(5) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `preferencias` */

/*Table structure for table `preguntas` */

DROP TABLE IF EXISTS `preguntas`;

CREATE TABLE `preguntas` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `cat_temas_id` int(10) unsigned NOT NULL default '0',
  `cat_area_id` int(10) unsigned NOT NULL default '0',
  `nombre_docente` varchar(200) character set latin1 default NULL,
  `pregunta` text character set latin1,
  `opcion1` text character set latin1,
  `opcion2` text character set latin1,
  `opcion3` text character set latin1,
  `opcion4` text character set latin1,
  `respuesta` char(1) character set latin1 default NULL,
  `grado_dificultad` int(11) default NULL,
  `tipo` varchar(20) character set latin1 default NULL,
  `justificacion` text character set latin1,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `preguntas` */

insert  into `preguntas`(`id`,`cat_temas_id`,`cat_area_id`,`nombre_docente`,`pregunta`,`opcion1`,`opcion2`,`opcion3`,`opcion4`,`respuesta`,`grado_dificultad`,`tipo`,`justificacion`) values (1,1,1,'.',' En términos financieros, a la incorporación de recursos nuevos que no provengan de los propios accionistas de la empresa (pasivos) se  le conoce como…','Apalancamiento','Financiamiento','Pasivos ','Palanca Financiera','4',3,'1','.'),(2,1,1,'.',' Es aquel método del análisis financiero que analiza dos estados financieros de dos periodos diferentes.','   Método vertical','Método horizontal','Método histórico','Método dinámico','2',3,'1','.'),(3,1,1,'.',' Son agrupaciones que se dedican a dar liquidez inmediata a las cuentas por cobrar de una empresa, pudiendo o no absorber la responsabilidad del cobro, mediante el pago de un diferencial.','Arrendadoras financieras',' Uniones de crédito','Casas de cambio',' Empresas de factoraje.','4',3,'1','.'),(4,1,1,'.','Contrato mediante el cual una tercera persona se compromete a cumplir con una obligación ante un acreedor en caso de que el deudor no lo hiciera mediante el cobro de una prima.','Fianza','Seguro','Aval ','Depositario','1',3,'1','.'),(5,1,1,'.','Corporación Mexicana, S.A. de C.V. presenta ventas = $ 2´458,000; una inversión total (AT) = $ 5´900,000 y una utilidad neta de $ 442,440 ¿Cuál es su utilidad de la inversión total (UIT \"Return on Investiment\")?','0.0705','0.0805','0.075','0.065','3',3,'2','.'),(6,1,1,'.','Cuál de los siguientes disminuirá el capital neto de trabajo','el uso de efectivo para pagar cuentas por pagar','el uso de efectivo para recomprar acciones comunes','comprar inventarios a crédito','vender el inventario con una ganancia y utilizarla para comprar valores negociables','2',3,'1','.'),(7,1,1,'.','Cuál es el costo variable unitario de un producto para que la empresa alcance el punto de equilibrio, si se vende a $5, se tiene costo fijo de $40000 y se venden 200000 unidades','4','4.6','4.8','5','3',3,'2','.'),(8,1,1,'.','Cuáles son los principales valores del mercado de capitales?','Bonos y Acciones ','Papel comercial y aceptaciones bancarias','Valores Bursátiles','Certificados de depósitos','1',3,'1','.'),(9,1,1,'.','¿Cómo se llama al periodo de tiempo que transcurre desde que se compra inventario, se vende y hasta que se cobra el efectivo por la ventas de crédito realizadas? ','Ciclo de efectivo.','Ciclo de cobranza.','Ciclo operativo.','Ciclo financiero.','3',3,'1','.'),(10,1,1,'.','¿Cuál es el valor presente de $16000 que vence dentro de dos años, si la tasa de interés es de 38% y los intereses se capitalizan cada bimestre?','7657.5','6757.5','5677.5','7567.5','1',3,'2','.'),(11,1,1,'.','¿Cuáles son las estrategias de la administración eficiente de efectivo?','Optimizar inventario. \nAdelantar cobros.\nRetardar pagos. \n','Retardar inventario. \nAdelantar pagos.\nOptimizar cobros.\n','Optimizar inventario. \nRetardar cobros.\nAdelantar pagos.\n','Retardar inventario. \nOptimizar pagos.\nAdelantar cobros.\n','1',3,'1','.'),(12,1,1,'.','¿Cuánto pagará un comerciante de abarrotes por un crédito de la compañía cigarrera por $2,300 a 2 meses de la compra si le cargan interés del 15% anual?','2357.5','2243.9','2990','2328.75','1',3,'2','.'),(13,1,1,'.','¿El financiamiento con  acciones preferentes es asimilable a un pasivo a largo plazo debido a?','En ambas el costo de financiamiento se obtiene en base a la utilidad de la empresa.','Ambas son pasivos','Ambas tienen asegurado el pago de su rendimiento','Ambas en caso de quiebra de la empresa se les da prioridad de pago antes de proveedores','3',3,'1','.'),(14,1,1,'.','¿En cuánto tiempo se acumularían $5,000 si se depositaran hoy $3,000 en un fondo que paga 4% simple mensual?','41.67 meses','0.1667 meses','16.67 meses','1.67 meses','3',3,'2','.'),(15,1,1,'.','¿Es una operación por contrato que establece el uso o goce temporal de un bien, con la característica de que  existe la opción de compra al término del contrato?','Acciones Preferentes','Arrendamiento Financiero','Préstamo bancario','Arrendamiento Puro','2',3,'1','.'),(16,1,1,'.','¿Es una técnica de la administración de inventarios que divide el inventario en tres grupos, en orden descendente de importancia y nivel de supervisión, con base en la inversión monetaria de cada uno?','Sistema ABC','Sistema Just in Time','Sistema de dos depósitos','Sistema CBA','1',3,'1','.'),(17,1,1,'.','¿Nivel de ventas necesarias para cubrir todos los costos operativos?.','Margen de contribución','Ventas netas','Punto de equilibrio operativo','Apalancamiento operativo','3',3,'1','.'),(18,1,1,'.','¿Qué es el Capital de Trabajo Neto?','Diferencia entre Activo Circulante y Pasivo Circulante','Diferencia entre Pasivo fijo y Activo fijo','Parte del activo fijo financiado por el Pasivo circulante','Diferencia entre activos totales y Capital Contable','1',3,'1','.'),(19,1,1,'.','¿Qué es la estructura de capital óptima?','Estructura de capital en la que el costo del capital promedio ponderado se minimiza, maximizando así el valor de la empresa','Estructura de capital en la que el costo del capital promedio ponderado se maximiza, maximizando así el valor de la empresa','Estructura de capital en la que el costo de la deuda  se minimiza, maximizando así el valor de la empresa','Estructura de capital en la que el costo de la deuda  se maximiza, maximizando así el valor de la empresa','1',3,'1','.'),(20,1,1,'.','A la capitalizacion de intereses se le conoce como:','Interes devegado','Interes compuesto','Interes simple','Costo financiero','2',3,'1','.'),(21,1,1,'.','Además de las acciones preferentes y las acciones ordinarias, las fuentes básicas de fondos a largo plazo para una empresa comercial son:','Capital de trabajo,  y utilidades retenidas. ','Capital de trabajo,  y deuda a largo plazo. ','Deuda a largo plazo y utilidades retenidas.','Utilidades retenidas y capital contable.','3',3,'1','.'),(22,1,1,'.','Al determinar sus ____________con el uso del modelo CEP, la empresa puede colocar órdenes y permitir su entrega a tiempo sin que sus inventarios alcancen un nivel crítico','costos de mantenimiento','inventario de seguridad','costos de almacenamiento','puntos de reorden','4',3,'1','.'),(23,1,1,'.','Asegurar precios futuros en mercados con precios altamente variables es una de las funciones de:','Pronosticos financieros','Proyectos de inversión','Productos derivados','Valuación del crédito','3',3,'1','.'),(24,1,1,'.','Determine el grado de apalancamiento operativo de una empresa que tiene ventas de 1000 unidades a un precio de venta de $10 la unidad, costos operativos variables de $4.5 y costos operativos fijos de $3,000. ','3.2','1.2','5.5','2.2','4',3,'2','.'),(25,1,1,'.','Determine la cantidad económica de pedido para una empresa que tiene una demanda anual de 900 artículos cuyo costo unitario es de $1,000. Sus  costos de pedido son de $25 y los costos de mantenimiento ascienden a $200 por unidad.','15','120','45','127','1',3,'2','.'),(26,1,1,'.','el ____________ es el periodo de tiempo entre la venta del inventario y el cobro de las cuentas por cobrar','ciclo de efectivo','periodo de inventario','periodo de cobranza','ciclo operativo','3',3,'1','.'),(27,1,1,'.','El costo específico de cada fuente de financiamiento se calcula…','…después de impuestos a valor presente.','…después de impuestos a valor histórico','…antes de impuestos a valor presente.','…antes de impuestos a valor histórico.','1',3,'1','.'),(28,1,1,'.','En el ámbito financiero y comercial muchas operaciones en las que una serie de pagos periódicos se relaciona con su valor al comienzo o al término del plazo . Tales operaciones son conocidos como…','Créditos comerciales','Préstamos en parcialidades','Anualidades','Perpetuidades','3',3,'1','.'),(29,1,1,'.','En estos tipos de créditos, el préstamo esta garantizado por un bien mueble registrable. Por lo general se da en garantía el mismo bien que se adquiere.La prenda queda en poder del deudor para su uso pero el poder sobre ella esta restringido.','Arrendamiento Financiero','Préstamos Prendarios','Préstamo refaccionario','Préstamo Hipotecario.','2',3,'1','.'),(30,1,1,'.','En qué mercado se negocian los valores a largo plazo, tales como bonos y acciones?','Mercado Financiero','Mercado de capitales ','Mercado de dinero','En ninguno de los anteriores ','2',3,'1','.'),(31,1,1,'.','Es el método que determina la rentabilidad de un proyecto con base en el valor presente neto, los flujos de efectivo son calculados a diversas tasas de rentabilidad','Metodo del valor presente (VPN)','Metodo de la tasa interna de rendimiento (TIR)','Metodo del periodo de recuperacion (PAYBACK)','Metodo de la tasa de rendimiento contable (TRC)','2',3,'1','.'),(32,1,1,'.','Es el organismo de inspección y vigilancia del gobierno dependiente de la S.H.C.P., que norma, regula y promueve las actividades globales de las Instituciones de Crédito, Organizaciones Auxiliares así como del mercado de valores en los términos de la L.M.V. y sus disposicones reglamentarias','Secretaría de Hacienda y Crédito Público','Instituciones para el Deposito de Valores','Comisión Nacional Bancaria y de Valores','Banco de México','3',3,'1','.'),(33,1,1,'.','Es el tiempo que transcurre desde el inicio  del proceso de producción hasta el cobro del dinero por la venta de su producto terminado.','Ciclo de caja','Ciclo de conversión del efectivo o ciclo financiero','Ciclo operativo','Ciclo Financiero','3',3,'1','.'),(34,1,1,'.','Es el uso Potencial de costos financieros fijos para magnificar los efectos de los cambios en las utilidades antes de intereses e impuestos sobre las utilidades por acción de la empresa.','Apalancamiento operativo','Apalancamiento total','Apalancamiento financiero','Punto de equilibrio','3',3,'1','.'),(35,1,1,'.','Es la entidad financiera que realiza de forma centralizada las funciones del comprador de derivados para el vendedor, y de vendedor del contrato de derivados para el comprador, es la parte que garantiza el cumplimiento del contrato para cada uno de los participantes.','Condusef','SHCP','Cámara de compensación','Bolsa mexicana de Valores (BMV)','3',3,'1','.'),(36,1,1,'.','Es la separacion del contenido de los estados financieros correspondientes a una misma fecha o a un mismo periodo, en sus elementos o partes integrantes, con el fin de poder determinar la proporcion que guarda cada uno de ellos en relacion con el todo','Método de aumentos y disminuciones','Método de tendencias','Método de razones estándar','Método de reducción a porcientos integrales','4',3,'1','.'),(37,1,1,'.','Es la tasa de interés más alta que un inversionista podría pagar sin perder dinero, si todos los fondos para el financiamiento de la inversión se tomaran prestados y éste se pagara con las entradas en efectivo de la inversión a medida que se fuesen produciendo ','TREMA o TMAR','TIIE','TIR','LIBOR','3',3,'1','.'),(38,1,1,'.','Es la tasa de rendimiento que una empresa debe ganar en los proyectos en los que invierte para mantener su valor de mercado y atraer fondos.','Tasa de utilidad','Costo de capital','Utilidad por acción','Costo de financiamiento.','2',3,'1','.'),(39,1,1,'.','Es la tasa que se refiere al interés ganado por una inversión durante un periodo específico: un mes, un bimestre, un trimestre, un semestre o incluso un año.','Tasa de interes efectiva','Tasa de interes anualizada','Tasas equivalentes','Tasa de interés e inflación','1',3,'1','.'),(40,1,1,'.','Es un metodo utilizado para registrar los valores del inventario','PEPS y costo promedio','Costo promedio y EVA','UEPS y Costo historico','Costo estándar','1',3,'1','.'),(41,1,1,'.','Es una de las principales caracteristicas del accionista común.','El rendimiento de su inversión depende de la generación de utilidades.','El rendimiento de su inversión depende de un dividendo fijo en base a sus  utilidades.','Ser responsables de su empresa  hasta el monto de sus utilidades',' En caso de disolución de la sociedad, recuperarán su inversión después de los acreedores y antes  de los accionistas preferentes..','1',3,'1','.'),(42,1,1,'.','Esta cláusula permite al emisor redimir un bono en circulación cuando las tasa de interés caen. ','Cláusulas de cancelación','Cláusulas de cotización.','Cláusulas de conversión','Cláusula de compensación','1',3,'1','.'),(43,1,1,'.','Estas razones miden la capacidad de pago de deudas a corto plazo','Razones de Productividad','Razones de Solvencia','Razones de Liquidez','Razones de Rentabilidad','3',3,'1','.'),(44,1,1,'.','Este informe se utiliza para calcular sus requerimientos de efectivo a corto plazo','Flujo de efectivo','Flujo operativos','Presupuesto de capital','Presupuesto de efectivo','4',3,'1','.'),(45,1,1,'.','Este Método de financiamiento  que supone baja rentabilidad y riesgo, e implica alta liquidez y capital neto de trabajo.','Definición Común de financiamiento.','Método Conservador de Financiamiento. \n\n','Método Mixto de financiamiento.','Método Dinámico de financiamiento.','2',3,'1','.'),(46,1,1,'.','Fábrica de Ruedas en movimiento presenta un saldo en Ventas por $ 267 000 y en Clientes $ 24 800, por lo cual se puede decir que el promedio de cobranza es de:','20 días','10 días','33 días','15 días','3',3,'2','.'),(47,1,1,'.','Fase del desarrollo de un proyecto que tiene como misión materializarlo en las mejores condiciones posibles y cuyos objetivos son lograr la mejor calidad técnica, enmarcarse en el presupuesto definido y ejecutar las obras dentro del plazo previsto ','Formulación y evaluación','Fase operacional','Puesta en marcha','Administración y dirección','4',3,'1','.'),(48,1,1,'.','Instrumento de deuda a largo plazo emitida por empresas o gobiernos para obtener grandes cantidades de dinero, de varios grupos de prestamistas','Acciones preferentes','Bonos','Certificados de depósitos','Aceptaciones Bancarias','2',3,'1','.'),(49,1,1,'.','La empresa Problems, S.A. tiene un plazo promedio de cuentas por pagar de 60 días, una rotación\nde inventarios de 4 veces y una rotación de cuentas por cobrar de 9 veces. Cual es su ciclo de caja','70 Días','19 Veces','10 Días','11 Veces','1',3,'2','.'),(50,1,1,'.','Mecanismo de control que comprende un programa financiero, estimado para las operaciones de un período futuro, establece un plan definido para obtener la coordinación de las diferentes áreas e influye poderosamente en la optimización de las utilidades','Método de estados financieros pro forma','Método de administración financiera','Método de control del presupuesto','Método de tendencias','3',3,'1','.'),(51,1,1,'.','Obtener la tendencia de las ventas netas de la empresa \"Z\", por los años de 2007 al 2009, sabiendo que en el 2007  se vendieron= $400,000, en el 2008 = $460,000 y en el 2009 = $540,000','100%, 151% y 153% respectivamente','100%, 115% y 135% respectivamente','100%, 113% y 138% respectivamente','100%, 131% y 135% respectivamente','2',3,'2','.'),(52,1,1,'.','Proyecto \"A\" presenta una TIR = 16.39%, un VAN = $ 360 y la tasa de descuento = 15%. Proyecto \"B\" presenta una TIR = 20.27%, un VAN = $ 756 y la tasa de descuento = 15%. ¿De acuerdo a los criterios de evaluación, aceptaría alguno de los proyectos?','Proyecto \"A\"','Ambos','Ninguno','Proyecto B','4',3,'2','.'),(53,1,1,'.','Se tiene deuda de $450,000 a una tasa del 18% anual  e impuestos del 28%; 5,000 acciones preferentes pagando $2.50 de dividendo y 10,000 acciones comunes;utilidad antes de intereses e impuestos $265,000.Determine el grado de apalancamiento financiero. ','1.775','1.28','1.59','2.0','3',3,'2','.'),(54,1,1,'.','Si el volumen de ventas es mayor que el volumen de produccion en que sistema de costeo se presentan mayores utilidades?','Ponderado','Directo','Variable','Absorbente','3',3,'1','.'),(55,1,1,'.','Son las operaciones mediante la cual la entidad financiera coloca por vez primera sus títulos, con objeto de obtener capital','Mercado primario','Mercado secundario','Mercado de dinero','Mercados financieros','1',3,'1','.'),(56,1,1,'.','Son los costos que varian en su totalidad, pero permanecen constantes en su unidad, depende de la producción','Costos variables','Costos fijos','Costos semivariables','Costos semifijos','1',3,'1','.'),(57,1,1,'.','Son modificaciones que se derivan con el interés de analizar cómo afectan posibles cambios en ciertas variables de un proyecto de inversión','Valor presente neto','Análisis de sensibilidad','Costo de capital','Razones financieras','2',3,'1','.'),(58,1,1,'.','Son razones que indican la relación cuantitativa que existe entre partidas del estado de resultados de operación','Estáticas','Dinámicas','Básicas','Estático-Dinámicas','2',3,'1','.'),(59,1,1,'.','Tienen por objeto la guarda, control y comercialización de bienes o mercancías bajo su custodia o que se encuentran en transito amparados por certificados de depósito o bonos de prenda.','Almacenes generales de depósito','Uniones de crédito','Empresas de factoraje financiero','Arrendadoras','1',3,'1','.'),(60,1,1,'.','Una empresa desea otorgar un descuento por pronto pago a sus clientes del 2% y considera que el 80% de ellos aceptará dicho descuento. Se considera  que sus ventas ascenderán a 1,150 unidades al aplicar el descuento; el precio de venta de cada producto es de $3,000 y su costo variable de $2300, determine el costo del descuento por pronto pago.','55200','13800','42320','10580','1',3,'2','.'),(61,1,1,'.','Una empresa dispone de un excedente por $250,000.00 pesos, y no hará uso de él durante un plazo de 28 días, por lo que decide invertir esta cantidad en un Pagaré Bancario, la tasa de interés es del 5%. Determine el rendimiento que genera el pagaré','958.90','12,500','972.22','1,041.66','3',3,'2','.'),(62,1,1,'.','Una persona compra un DVD que cuesta $1,500. Paga un enganche de $800 y acuerda pagar otros $800 tres meses después. ¿Qué tasa de interés simple pagó?','29.17% mensual','38.10% mensual','4.76% mensual','4.17% mensual','3',3,'2','.'),(63,1,1,'.','Valor nominal de los BONDES','$ 10','$ 100','$ 1000','Variable','2',3,'1','.'),(64,1,1,'.','Valores de los cuales depende la liquidez de una empresa','Activo circulante y Activo fijo','Pasivo Fijo y Activo Circulante','Activo Circulante y Pasivo Circulante','Capital de trabajo y Activos no circulantes','3',3,'1','.'),(65,1,1,'.','Son las acciones, obligaciones y demás títulos de crédito emitidos en serie o en masa, así como otros documentos sobre los cuales se realice una oferta pública o intermediación en el Mercado de Valores.',' Emisoras','Instrumentos Financieros','Títulos de Crédito','Concepto de Valor','4',3,'1','.'),(66,1,1,'.','¿Es el valor monetario que resulta de restar la suma de los flujos descontados a la inversión inicial?','Ganancia neta','Valor presente neto','Valor de salvamento','Valor presente','2',3,'1','.'),(67,1,1,'.','¿Es la tasa de rendimiento que una empresa debe de ganar en los proyectos en los que invierte para mantener su valor de mercado y atraer fondos?','TIR','Costo de capital','TREMA','Costo de oportunidad','2',3,'1','.'),(68,1,1,'.','¿A mayor punto de equilibrio financiero significa que…?','La empresa tiene una mayor utilidad neta.','La empresa tiene mayor carga financiera, mayor apalancamiento financiero y mayor riesgo.','La empresa tiene mayor carga financiera, menor apalancamiento financiero y menor riesgo.','La empresa tiene una mayor utilidad neta.','2',3,'1','.'),(69,1,1,'.','¿Es la tasa que iguala la suma de los flujos descontados a la inversión inicial?','Tasa de interés','Tasa interna de rendimiento','Tasa Mínima Aceptable de Rendimiento.','Tasa de inflación.','2',3,'1','.'),(70,1,1,'.','¿Es una sucesión de pagos, por lo general iguales, que se realizan a intervalos iguales de tiempo?','Interés compuesto','Anualidades','Interés Simple','Parcialidades','2',3,'1','.'),(71,1,1,'.','¿Qué efecto tiene los incrementos de apalancamiento en el rendimiento y el riesgo?','El rendimiento disminuye y el riesgo aumenta.','El rendimiento y el riesgo aumentan. ','No tiene ningun efecto','El rendimiento y el riesgo disminuyen','2',3,'1','.'),(72,1,1,'.','¿Qué es el punto de equilibrio financiero?','El el punto en que los costos operativos igualan a sus ingresos totales','El el punto en que la utilidad antes de intereses e impuestos , cubre todos los costos.','Es el punto en que las ventas cubren todos los costos financieros  fijos.','Es la utilidad antes de intereses e impuestos  que debe de tener una empresa para que el socio no gane ni pierda. ','3',3,'1','.'),(73,1,1,'.','¿Qué se hace con la depreciación para determinar el flujo de efectivo?','Se le resta a la utilidad bruta','Se le suma a la utilidad bruta','Se le suma a la utilidad neta','Se le resta a la utilidad neta','3',3,'1','.'),(74,1,1,'.','¿Uso Potencial de costos operativos fijos para magnificar los efectos de los cambios en las ventas sobre las utilidades antes de intereses e impuestos de la empresa?','Grado de apalandamiento operativo','Punto de equilibrio operativo','Apalancamiento ','Apalancamiento operativo','4',3,'1','.'),(75,1,1,'.','A  la diferencia entre el saldo de efectivo disponible de una empresa y el saldo de efectivo en libros, se le conoce como:','Un saldo compensador','flotación','meta del nivel de efectivo','saldo promedio de efectivo','2',3,'1','.'),(76,1,1,'.','A diferencia del CAMP, el APT requiere:','Que el mercado se encuentre en equilibrio','Usa los premios por riesgo basados en variables economicas','Especifica el numero e identifica factores epecificos que deterinan el rendimiento esperado','No requieren de los supuestos restrictivos del portafolio de mercado','3',3,'1','.'),(77,1,1,'.','Cuando el primer pago no se realiza en el primer periodo, sino en un periodo posterior a ésta.','Anualidad Diferida','Anualidad vencida','Anualidad  anticipada','Anulidad Simple','1',3,'1','.'),(78,1,1,'.','Determine a cuanto equivale el ciclo de conversión del efectivo: Rotación de las cuentas por cobrar 8, antiguedad promedio de cuentas por cobrar 30, y período promedio de pago 60','15 días','22 días','30 días','38 días','1',3,'2','.'),(79,1,1,'.','Determine el punto de reorden considerando que una empresa tiene una demanda anual de 3,500 artículos y le toma 3 días  hacer y recibir un pedido. La empresa labora 350 días en el año y por política maneja un inventario de seguridad de 5 artículos. ','45','35','34','53','2',3,'2','.'),(80,1,1,'.','El activo A tiene un retorno esperado de 11.98 por ciento y una beta de 1.05.  La tasa libre de riesgo es 4 porciento.  Cuál es la prima de riesgo de mercado?','1.7 por ciento','5.7 por ciento','7.6 por ciento','10.2 por ciento','3',3,'2','.'),(81,1,1,'.','El riesgo de un activo no diversificable se mide por:','rendimiento total','rendimiento esperado','vanrianza de rendimientos','coeficiente beta','4',3,'1','.'),(82,1,1,'.','Es el método para la segmentacion de costos semivariables que su formula base es: Y= a+b(x)','Directo','Maximos y minimos','Estadistico','Absorbente','3',3,'1','.'),(83,1,1,'.','Es el principal indicador financiero del mercado bursáil mexicano','I.N.P.C.','I.P.C.','N.A.S.D.A.Q.','T.I.I.E.','2',3,'1','.'),(84,1,1,'.','Es un contrato en el cual el acreditado queda obligado a invertir el importe del crédito,  en la adquisición de materias primas y materiales en el pago de los jornales, salarios y gastos directos de explotación indispensablemente para los fines de su empresa.','Préstamos personales','Préstamos directos','Préstamo refaccionario','Préstamos de habilitación y avio','4',3,'1','.'),(85,1,1,'.','Es un contrato que se negocia entre el propietario de los bienes y la empresa  a la cual se le permite el uso de esos bienes durante un período determinado y mediante el pago de una renta específica, sus estipulaciones pueden variar según la situación y las necesidades de cada una de las partes.','Arrendamiento puro','Factoraje Financiero','Arrendamiento Financiero','Emisión de obligaciones','3',3,'1','.'),(86,1,1,'.','Establece que una empresa deberá financiar su requerimiento estacional o de temporada (activos circulantes) con fondos a corto plazo. La parte considerada “activos circulantes permanentes” más todos sus activos NO circulantes deben ser financiados con fondos de largo plazo','Método Dinámico de financiamiento.','Definición común de Capital  Neto de Trabajo\n','Método Mixto de financiamiento.','Método Conservador de financiamiento.','1',3,'1','.'),(87,1,1,'.','Este mercado pone en contacto como intermediario a las personas o instituciones que necesitan dinero (demandantes) con las personas u organizaciones oferentes','Mercado de valores','Mercado financiero','Mercado de divisas','Mercado de capitales','2',3,'1','.'),(88,1,1,'.','Para llevar a cabo un proyecto se requiere un capital de $ 1´500,000; los inversionistas aportarán el 50%, otros socios el 25% y un banco de desarrollo el resto, la TMAR o TREMA de cada uno son: 16.5%, 18.5% y 14.5% respectivamente. ¿Cuál es el costo de capital ponderado o TEMAR ponderada?','0.165','0.185','0.145','0.155','1',3,'2','.'),(89,1,1,'.','Se refiere al número de veces por año en las que los intereses se capitalizan','Plazo','Frecuencia de conversión','Periodo de capitalización','Tiempo de inversión','2',3,'1','.'),(90,1,1,'.','Un banco paga una tasa de 24% anual capitalizable trimestral y se invierten $1000 durante 3 trimestres bajo el supuesto. que los intereses se reinvierten. ¿Cuánto se logra acumular al final del tercer trimestre?','1340','1240','1191.6','1321','3',3,'2','.'),(91,1,1,'.','Concepto de progresión aritmética','Es una sucesión de numeros llamados términos, mismos que están separados por una razón común.','Es una sucesión de números llamados términos, mismos que están separados por una diferencia común.','Sucesión de números llamados términos, mismos que guardan una razón común. ','Sucesión de números llamados términos, mismos que guardan una razón diferente.','2',3,'2','.'),(92,1,1,'.','Considerando los siguientes datos, determina el ROE de la compañía Prufrock:  Utilidad Neta 363, Ventas  2, 311 , Activos totales 3, 588, Capital Total 2, 591 (Cifras en Millones de dólares)','0.1','0.14','0.16','0.12','2',3,'2','.'),(93,1,1,'.','¿Cuál es el capital que estuvo impuesto en un banco durante 4 años a la tasa de interés del 7% anual compuesto mensualmente y logró alcanzar un monto de $ 3’500,430? ','2647721.14','2302752.78','136050.48','4627757.06','1',3,'2','.'),(94,1,1,'.',' Se contrata un préstamo bancario por $150,000 pesos.  La tasa de interés es de 20% anual convertible bimestralmente ¿Cuál es el monto a pagar dentro de 6 meses?','165505.56','152613.96','157625.69','165000','1',3,'1','.'),(95,1,1,'.','¿Cuál es la tasa efectiva que se paga por un préstamo bancario de $250,000 que se pactó a 16% de interés anual convertible trimestralmente? ','0.16985856','0.2136','0.1512','0.011698','1',3,'2','.'),(96,1,1,'.','¿Cuánto tendría que depositar trimestralmente una persona que desea ahorrar durante un año y medio para pagarse unas vacaciones de $500, y la cuenta en el banco produce una tasa de interés  de 24% anual capitalizable trimestralmente (6% efectiva trimestral).','A)$89.65','B)$130.41','C)$71.68','D)153','3',3,'1','.'),(97,1,1,'.','Cual es la utilidad bruta de una empresa que vende $987, tiene un inventario inicial de $950, compra mercancia por $421, tienen un inventario final de $608','250','224','-150','645','2',3,'1','.'),(98,1,1,'.','Es el tiempo que hay entre dos fechas sucesivas en las que los intereses son agregados al capital. ','Plazo','Periodo de capitalización','Tiempo de inversión','Renta fija','2',3,'2','.');

/*Table structure for table `respuesta` */

DROP TABLE IF EXISTS `respuesta`;

CREATE TABLE `respuesta` (
  `id` int(10) unsigned NOT NULL,
  `cuestionario_pregunta_id` int(10) unsigned NOT NULL default '0',
  `usuario_id` int(10) unsigned NOT NULL default '0',
  `respuesta` int(11) NOT NULL default '0',
  `tiempo` int(1) NOT NULL default '0',
  PRIMARY KEY  (`cuestionario_pregunta_id`,`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `respuesta` */

insert  into `respuesta`(`id`,`cuestionario_pregunta_id`,`usuario_id`,`respuesta`,`tiempo`) values (8,1,4,3,1),(4,1,5,3,1),(1,1,6,3,1),(7,1,7,4,1),(5,1,8,3,1),(2,1,9,1,1),(3,1,10,3,1),(6,1,11,4,1),(15,2,4,2,1),(16,2,5,2,1),(12,2,6,2,1),(14,2,7,2,1),(11,2,8,2,1),(9,2,9,2,1),(13,2,10,2,1),(10,2,11,2,1),(23,3,4,1,1),(20,3,5,1,1),(17,3,6,1,1),(22,3,7,1,1),(18,3,8,1,1),(21,3,9,1,1),(19,3,10,1,1),(24,3,11,1,1),(31,4,4,1,1),(25,4,5,3,1),(29,4,6,3,1),(27,4,7,3,1),(28,4,8,3,1),(26,4,9,1,1),(30,4,10,1,1),(32,4,11,3,1),(38,5,4,3,1),(40,5,5,3,1),(33,5,6,3,1),(39,5,7,3,1),(34,5,8,3,1),(36,5,9,4,1),(35,5,10,3,1),(37,5,11,2,1),(47,6,4,1,1),(44,6,5,1,1),(45,6,6,1,1),(46,6,7,1,1),(43,6,8,2,1),(48,6,9,1,1),(42,6,10,3,1),(41,6,11,1,1),(55,7,4,3,1),(51,7,5,3,1),(50,7,6,3,1),(54,7,7,3,1),(53,7,8,3,1),(52,7,9,3,1),(49,7,10,3,1),(56,7,11,3,1),(62,8,4,2,1),(59,8,5,2,1),(63,8,6,1,1),(58,8,7,2,1),(64,8,8,1,1),(57,8,9,2,1),(61,8,10,2,1),(60,8,11,2,1),(71,9,4,4,1),(65,9,5,4,1),(69,9,6,4,1),(68,9,7,2,1),(66,9,8,4,1),(70,9,9,1,1),(67,9,10,4,1),(72,9,11,4,1),(77,10,4,2,1),(76,10,5,1,1),(80,10,6,1,1),(74,10,7,1,1),(79,10,8,1,1),(75,10,9,2,1),(78,10,10,1,1),(73,10,11,2,1),(84,11,4,3,1),(83,11,5,2,1),(88,11,6,2,1),(81,11,7,3,1),(85,11,8,3,1),(82,11,9,3,1),(86,11,10,1,1),(87,11,11,4,1),(95,12,4,1,1),(96,12,5,1,1),(93,12,6,1,1),(94,12,7,1,1),(91,12,8,1,1),(89,12,9,3,1),(92,12,10,1,1),(90,12,11,3,1),(103,13,4,3,1),(97,13,5,3,1),(104,13,6,3,1),(99,13,7,4,1),(98,13,8,3,1),(101,13,9,1,1),(100,13,10,3,1),(102,13,11,3,1),(110,14,4,1,1),(108,14,5,1,1),(107,14,6,1,1),(111,14,7,4,1),(106,14,8,1,1),(109,14,9,1,1),(105,14,10,1,1),(112,14,11,2,1),(117,15,4,1,1),(114,15,5,1,1),(116,15,6,1,1),(115,15,7,1,1),(113,15,8,1,1),(119,15,9,1,1),(118,15,10,1,1),(120,15,11,4,1),(123,16,4,3,1),(128,16,5,1,1),(127,16,6,1,1),(124,16,7,2,1),(126,16,8,1,1),(121,16,9,4,1),(122,16,10,2,1),(125,16,11,1,1),(134,17,4,1,1),(132,17,5,1,1),(136,17,6,3,1),(129,17,7,3,1),(135,17,8,4,1),(130,17,9,1,1),(133,17,10,3,1),(131,17,11,3,1),(141,18,4,1,1),(144,18,5,1,1),(137,18,6,1,1),(138,18,7,3,1),(143,18,8,1,1),(139,18,9,1,1),(140,18,10,1,1),(142,18,11,3,1),(149,19,4,3,1),(146,19,5,1,1),(151,19,6,3,1),(148,19,7,1,1),(152,19,8,2,1),(147,19,9,2,1),(145,19,10,1,1),(150,19,11,1,1),(160,20,4,1,1),(153,20,5,1,1),(157,20,6,1,1),(156,20,7,1,1),(154,20,8,1,1),(158,20,9,1,1),(155,20,10,1,1),(159,20,11,1,1),(163,21,4,2,1),(168,21,5,3,1),(162,21,6,2,1),(164,21,7,4,1),(166,21,8,2,1),(161,21,9,4,1),(165,21,10,1,1),(167,21,11,3,1),(172,22,4,4,1),(176,22,5,4,1),(175,22,6,4,1),(171,22,7,4,1),(174,22,8,2,1),(173,22,9,2,1),(169,22,10,4,1),(170,22,11,4,1),(181,23,4,4,1),(184,23,5,4,1),(183,23,6,4,1),(179,23,7,4,1),(177,23,8,4,1),(182,23,9,3,1),(180,23,10,4,1),(178,23,11,4,1),(191,24,4,3,1),(187,24,5,1,1),(192,24,6,1,1),(190,24,7,1,1),(189,24,8,3,1),(185,24,9,3,1),(188,24,10,3,1),(186,24,11,3,1),(200,25,4,3,1),(197,25,5,3,1),(194,25,6,3,1),(198,25,7,1,1),(193,25,8,3,1),(199,25,9,2,1),(195,25,10,3,1),(196,25,11,3,1),(205,26,4,2,1),(203,26,5,2,1),(208,26,6,3,1),(204,26,7,4,1),(202,26,8,3,1),(206,26,9,4,1),(201,26,10,2,1),(207,26,11,3,1),(214,27,4,1,1),(215,27,5,1,1),(211,27,6,1,1),(210,27,7,1,1),(212,27,8,1,1),(213,27,9,2,1),(209,27,10,1,1),(216,27,11,1,1),(222,28,4,3,1),(220,28,5,3,1),(224,28,6,3,1),(221,28,7,3,1),(223,28,8,1,1),(219,28,9,3,1),(217,28,10,3,1),(218,28,11,3,1),(230,29,4,2,1),(225,29,5,2,1),(227,29,6,2,1),(228,29,7,2,1),(232,29,8,3,1),(231,29,9,4,1),(226,29,10,2,1),(229,29,11,2,1),(238,30,4,1,1),(240,30,5,1,1),(237,30,6,1,1),(234,30,7,1,1),(236,30,8,1,1),(235,30,9,1,1),(233,30,10,1,1),(239,30,11,1,1),(245,31,4,1,1),(244,31,5,1,1),(242,31,6,1,1),(243,31,7,1,1),(241,31,8,1,1),(246,31,9,1,1),(247,31,10,4,1),(248,31,11,3,1),(256,32,4,2,1),(253,32,5,2,1),(251,32,6,2,1),(250,32,7,2,1),(249,32,8,2,1),(254,32,9,2,1),(252,32,10,2,1),(255,32,11,2,1),(260,33,4,3,1),(263,33,5,1,1),(258,33,6,3,1),(257,33,7,3,1),(264,33,8,3,1),(259,33,9,2,1),(261,33,10,3,1),(262,33,11,1,1),(272,34,4,2,1),(268,34,5,2,1),(269,34,6,2,1),(265,34,7,2,1),(267,34,8,2,1),(271,34,9,2,1),(266,34,10,2,1),(270,34,11,2,1),(279,35,4,3,1),(273,35,5,3,1),(277,35,6,3,1),(274,35,7,2,1),(276,35,8,3,1),(275,35,9,3,1),(278,35,10,2,1),(280,35,11,3,1),(287,36,4,4,1),(285,36,5,4,1),(282,36,6,4,1),(288,36,7,3,1),(283,36,8,4,1),(286,36,9,2,1),(281,36,10,4,1),(284,36,11,4,1),(296,37,4,3,1),(290,37,5,3,1),(295,37,6,3,1),(294,37,7,3,1),(293,37,8,3,1),(291,37,9,3,1),(289,37,10,3,1),(292,37,11,3,1),(302,38,4,3,1),(299,38,5,3,1),(297,38,6,3,1),(300,38,7,4,1),(298,38,8,3,1),(301,38,9,4,1),(304,38,10,4,1),(303,38,11,4,1),(311,39,4,1,1),(312,39,5,1,1),(306,39,6,1,1),(308,39,7,1,1),(310,39,8,1,1),(309,39,9,1,1),(305,39,10,1,1),(307,39,11,1,1),(319,40,4,4,1),(317,40,5,4,1),(316,40,6,4,1),(313,40,7,4,1),(318,40,8,4,1),(315,40,9,4,1),(314,40,10,4,1),(320,40,11,1,1),(324,41,4,4,1),(326,41,5,1,1),(323,41,6,3,1),(321,41,7,4,1),(328,41,8,4,1),(325,41,9,3,1),(322,41,10,4,1),(327,41,11,3,1),(334,42,4,2,1),(336,42,5,2,1),(331,42,6,2,1),(332,42,7,2,1),(330,42,8,2,1),(333,42,9,2,1),(329,42,10,2,1),(335,42,11,4,1),(343,43,4,1,1),(340,43,5,1,1),(339,43,6,1,1),(341,43,7,1,1),(338,43,8,1,1),(342,43,9,4,1),(337,43,10,1,1),(344,43,11,1,1),(349,44,4,3,1),(350,44,5,3,1),(346,44,6,1,1),(347,44,7,3,1),(352,44,8,3,1),(345,44,9,3,1),(348,44,10,3,1),(351,44,11,2,1),(358,45,4,3,1),(359,45,5,3,1),(360,45,6,3,1),(356,45,7,3,1),(355,45,8,2,1),(353,45,9,3,1),(354,45,10,3,1),(357,45,11,3,1),(363,46,4,1,1),(366,46,5,1,1),(361,46,6,1,1),(367,46,7,3,1),(368,46,8,3,1),(362,46,9,1,1),(365,46,10,1,1),(364,46,11,4,1),(376,47,4,1,1),(374,47,5,1,1),(371,47,6,1,1),(372,47,7,1,1),(369,47,8,1,1),(375,47,9,1,1),(370,47,10,2,1),(373,47,11,1,1),(384,48,4,2,1),(379,48,5,2,1),(378,48,6,2,1),(381,48,7,2,1),(383,48,8,2,1),(380,48,9,2,1),(377,48,10,2,1),(382,48,11,2,1),(390,49,4,1,1),(387,49,5,2,1),(386,49,6,1,1),(389,49,7,2,1),(391,49,8,1,1),(385,49,9,4,1),(392,49,10,1,1),(388,49,11,1,1),(399,50,4,3,1),(393,50,5,3,1),(397,50,6,3,1),(396,50,7,2,1),(398,50,8,3,1),(395,50,9,3,1),(394,50,10,3,1),(400,50,11,3,1),(407,51,4,3,1),(402,51,5,3,1),(406,51,6,3,1),(404,51,7,3,1),(405,51,8,2,1),(403,51,9,2,1),(401,51,10,3,1),(408,51,11,3,1),(412,52,4,3,1),(411,52,5,3,1),(409,52,6,3,1),(414,52,7,3,1),(416,52,8,1,1),(415,52,9,3,1),(410,52,10,1,1),(413,52,11,3,1),(422,53,4,1,1),(418,53,5,1,1),(419,53,6,1,1),(420,53,7,2,1),(424,53,8,1,1),(421,53,9,4,1),(417,53,10,1,1),(423,53,11,4,1),(429,54,4,2,1),(432,54,5,2,1),(425,54,6,2,1),(426,54,7,2,1),(431,54,8,2,1),(427,54,9,3,1),(430,54,10,2,1),(428,54,11,2,1),(440,55,4,2,1),(438,55,5,2,1),(435,55,6,2,1),(434,55,7,2,1),(433,55,8,2,1),(436,55,9,2,1),(439,55,10,2,1),(437,55,11,2,1),(443,56,4,4,1),(441,56,5,4,1),(442,56,6,4,1),(446,56,7,4,1),(447,56,8,4,1),(444,56,9,4,1),(445,56,10,4,1),(448,56,11,4,1),(455,57,4,1,1),(456,57,5,1,1),(454,57,6,4,1),(453,57,7,1,1),(451,57,8,3,1),(450,57,9,3,1),(452,57,10,3,1),(449,57,11,1,1),(460,58,4,4,1),(464,58,5,2,1),(463,58,6,2,1),(461,58,7,4,1),(462,58,8,1,1),(458,58,9,4,1),(459,58,10,4,1),(457,58,11,4,1),(472,59,4,3,1),(465,59,5,3,1),(470,59,6,3,1),(468,59,7,3,1),(466,59,8,3,1),(471,59,9,3,1),(467,59,10,3,1),(469,59,11,3,1),(479,60,4,1,1),(477,60,5,1,1),(474,60,6,1,1),(478,60,7,1,1),(473,60,8,1,1),(476,60,9,1,1),(475,60,10,1,1),(480,60,11,2,1),(487,61,4,2,1),(481,61,5,2,1),(484,61,6,2,1),(483,61,7,2,1),(488,61,8,2,1),(485,61,9,2,1),(482,61,10,2,1),(486,61,11,2,1),(495,62,4,2,1),(489,62,5,2,1),(494,62,6,2,1),(493,62,7,2,1),(490,62,8,2,1),(496,62,9,2,1),(492,62,10,2,1),(491,62,11,2,1),(503,63,4,2,1),(500,63,5,3,1),(502,63,6,4,1),(497,63,7,4,1),(501,63,8,1,1),(504,63,9,1,1),(498,63,10,2,1),(499,63,11,2,1),(510,64,4,1,1),(505,64,5,1,1),(509,64,6,1,1),(507,64,7,1,1),(506,64,8,1,1),(508,64,9,1,1),(511,64,10,1,1),(512,64,11,2,1),(520,65,4,3,1),(514,65,5,3,1),(519,65,6,3,1),(516,65,7,3,1),(515,65,8,4,1),(513,65,9,2,1),(518,65,10,3,1),(517,65,11,2,1),(523,66,4,2,1),(528,66,5,2,1),(524,66,6,2,1),(527,66,7,1,1),(522,66,8,2,1),(521,66,9,2,1),(525,66,10,2,1),(526,66,11,1,1),(536,67,4,2,1),(529,67,5,2,1),(533,67,6,2,1),(532,67,7,2,1),(534,67,8,2,1),(535,67,9,2,1),(530,67,10,2,1),(531,67,11,2,1),(543,68,4,2,1),(537,68,5,2,1),(544,68,6,2,1),(538,68,7,2,1),(542,68,8,2,1),(541,68,9,4,1),(540,68,10,2,1),(539,68,11,4,1),(550,69,4,1,1),(552,69,5,2,1),(548,69,6,1,1),(551,69,7,4,1),(547,69,8,2,1),(549,69,9,1,1),(546,69,10,1,1),(545,69,11,2,1),(559,70,4,2,1),(555,70,5,2,1),(554,70,6,2,1),(557,70,7,2,1),(558,70,8,2,1),(556,70,9,2,1),(553,70,10,2,1),(560,70,11,2,1),(563,71,4,2,1),(568,71,5,2,1),(561,71,6,2,1),(562,71,7,2,1),(565,71,8,2,1),(566,71,9,2,1),(564,71,10,1,1),(567,71,11,4,1),(574,72,4,4,1),(569,72,5,3,1),(570,72,6,3,1),(572,72,7,3,1),(576,72,8,4,1),(573,72,9,1,1),(571,72,10,3,1),(575,72,11,2,1),(579,73,4,1,1),(581,73,5,2,1),(584,73,6,1,1),(582,73,7,2,1),(580,73,8,3,1),(578,73,9,4,1),(577,73,10,3,1),(583,73,11,1,1),(586,74,4,2,1),(588,74,5,2,1),(592,74,6,1,1),(585,74,7,2,1),(587,74,8,2,1),(590,74,9,2,1),(591,74,10,2,1),(589,74,11,3,1),(593,75,4,2,1),(599,75,5,3,1),(597,75,6,1,1),(598,75,7,1,1),(594,75,8,3,1),(595,75,9,2,1),(600,75,10,1,1),(596,75,11,1,1),(604,76,4,3,1),(603,76,5,4,1),(607,76,6,1,1),(601,76,7,4,1),(602,76,8,4,1),(605,76,9,4,1),(606,76,10,4,1),(608,76,11,4,1),(613,77,4,1,1),(609,77,5,1,1),(611,77,6,4,1),(614,77,7,4,1),(616,77,8,4,1),(612,77,9,2,1),(610,77,10,1,1),(615,77,11,1,1),(621,78,4,2,1),(622,78,5,1,1),(624,78,6,2,1),(618,78,7,1,1),(620,78,8,3,1),(619,78,9,3,1),(617,78,10,3,1),(623,78,11,1,1),(629,79,4,2,1),(627,79,5,2,1),(626,79,6,1,1),(632,79,7,1,1),(631,79,8,2,1),(628,79,9,1,1),(625,79,10,2,1),(630,79,11,4,1),(637,80,4,3,1),(634,80,5,3,1),(636,80,6,3,1),(635,80,7,3,1),(640,80,8,2,1),(639,80,9,3,1),(633,80,10,3,1),(638,80,11,1,1),(642,81,4,4,1),(644,81,5,4,1),(641,81,6,4,1),(647,81,7,2,1),(648,81,8,2,1),(643,81,9,3,1),(646,81,10,4,1),(645,81,11,3,1),(653,82,4,1,1),(649,82,5,1,1),(654,82,6,3,1),(651,82,7,1,1),(652,82,8,4,1),(656,82,9,4,1),(650,82,10,1,1),(655,82,11,2,1),(663,83,4,1,1),(657,83,5,1,1),(662,83,6,2,1),(664,83,7,2,1),(659,83,8,2,1),(658,83,9,2,1),(660,83,10,1,1),(661,83,11,2,1),(666,84,4,2,1),(672,84,5,3,1),(669,84,6,2,1),(668,84,7,4,1),(671,84,8,2,1),(667,84,9,1,1),(665,84,10,2,1),(670,84,11,2,1),(678,85,4,4,1),(673,85,5,4,1),(674,85,6,4,1),(680,85,7,2,1),(675,85,8,4,1),(677,85,9,4,1),(676,85,10,4,1),(679,85,11,4,1),(688,86,4,2,1),(682,86,5,2,1),(685,86,6,2,1),(686,86,7,2,1),(683,86,8,2,1),(687,86,9,3,1),(681,86,10,2,1),(684,86,11,2,1),(694,87,4,2,1),(691,87,5,3,1),(693,87,6,2,1),(696,87,7,3,1),(692,87,8,3,1),(690,87,9,3,1),(689,87,10,3,1),(695,87,11,3,1),(699,88,4,3,1),(704,88,5,3,1),(703,88,6,3,1),(702,88,7,3,1),(698,88,8,3,1),(701,88,9,3,1),(697,88,10,3,1),(700,88,11,3,1),(710,89,4,3,1),(705,89,5,3,1),(706,89,6,3,1),(712,89,7,1,1),(709,89,8,3,1),(711,89,9,3,1),(708,89,10,3,1),(707,89,11,3,1),(719,90,4,1,1),(720,90,5,1,1),(716,90,6,1,1),(714,90,7,1,1),(715,90,8,1,1),(717,90,9,1,1),(713,90,10,1,1),(718,90,11,1,1);

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `cat_privilegios_id` int(10) unsigned NOT NULL default '0',
  `nombre` varchar(18) default NULL,
  `contrasenia` varchar(18) default NULL,
  `online` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `usuario` */

insert  into `usuario`(`id`,`cat_privilegios_id`,`nombre`,`contrasenia`,`online`) values (1,1,'admin','admin',0),(3,2,'coordinador','coordinador',0),(4,4,'equipo1','equipo1',0),(5,4,'equipo2','equipo2',0),(6,4,'equipo3','equipo3',0),(7,4,'equipo4','equipo4',0),(8,4,'equipo5','equipo5',0),(9,4,'equipo6','equipo6',0),(10,4,'equipo7','equipo7',0),(11,4,'equipo8','equipo8',0),(12,4,'equipo9','equipo9',0),(13,4,'equipo10','equipo10',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
