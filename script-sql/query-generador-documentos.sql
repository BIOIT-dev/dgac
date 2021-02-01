
/** Eliminación de módulos innecesarios */
DELETE FROM modulo WHERE panel_admin = 3 AND nombre LIKE '%Reporte%';

/** Nuevo módulo de generación de documentos */
INSERT INTO modulo (activo, icono, tipo, panel_admin, nombre, url) VALUES
(1, '', 2, 3, 'Generador de Documentos', 'GeneradorDocs/index'),
(1, '', 2, 3, 'Crear Documento', 'GeneradorDocs/crear_documento');

/** Nueva tabla para el listado de reportes */
CREATE TABLE IF NOT EXISTS `documentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activo` int(11) DEFAULT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `url` text,
  `orden` int(11) DEFAULT NULL,
  `d_create` datetime NULL,
  `d_update` timestamp NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
