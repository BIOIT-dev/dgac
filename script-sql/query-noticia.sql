
-- Ingreso de nuevo campo orden para la tabla de modulo

ALTER TABLE `modulo` ADD `orden` INT(11) NULL AFTER `url`;

-- Ingresar registro de Inicio

INSERT INTO `modulo` (`id`, `activo`, `icono`, `tipo`, `panel_admin`, `nombre`, `url`, `orden`) VALUES (62, 1, 'mdi-home', 1, 0, 'Inicio', 'Home', 1);

UPDATE `modulo` SET `orden` = '2' WHERE `modulo`.`id` = 1;
UPDATE `modulo` SET `orden` = '3' WHERE `modulo`.`id` = 2;
UPDATE `modulo` SET `orden` = '4' WHERE `modulo`.`id` = 3;
UPDATE `modulo` SET `orden` = '5' WHERE `modulo`.`id` = 4;
UPDATE `modulo` SET `orden` = '6' WHERE `modulo`.`id` = 5;
UPDATE `modulo` SET `orden` = '7' WHERE `modulo`.`id` = 6;
UPDATE `modulo` SET `orden` = '8' WHERE `modulo`.`id` = 7;
UPDATE `modulo` SET `orden` = '9' WHERE `modulo`.`id` = 8;
UPDATE `modulo` SET `orden` = '1' WHERE `modulo`.`id` = 62;


-- Ingreso para el permiso de la seccion de Inicio

INSERT INTO `role_permisos` (`id`, `role_id`, `modulo_id`, `acceso`) VALUES (68, 6, 62, '1,2,3');

-- Nuevo campo para la tabla de Noticia

ALTER TABLE noticia ADD grupo_ids TEXT NOT NULL AFTER global;




