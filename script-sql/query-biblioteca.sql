
/** Ingreso de URL de modulo bibliotecas */

UPDATE `modulo` SET `url` = 'Bibliotecas' WHERE `modulo`.`id` = 3;

/** Campos nuevos para la tabla de biblio_archivo */

ALTER TABLE `biblio_archivo` CHANGE `fecha` `fecha` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE biblio_archivo ADD grupo_ids TEXT NULL AFTER zona_home;