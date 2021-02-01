

/** Script sql para el modulo de roles */

ALTER TABLE roles ADD clave varchar(3) AFTER id;

UPDATE roles SET clave = "ALU" WHERE name = "Alumnos";

UPDATE roles SET clave = "TUT" WHERE name = "Gestor Administrativo";

UPDATE roles SET clave = "PRO" WHERE name = "Profesores";

UPDATE roles SET clave = "PUB" WHERE name = "Coordinadores";

UPDATE roles SET clave = "VIS" WHERE name = "Curricular";

UPDATE roles SET clave = "ADM" WHERE name = "Administradores";

UPDATE roles SET clave = "POS" WHERE name = "Administrador de Admision";
