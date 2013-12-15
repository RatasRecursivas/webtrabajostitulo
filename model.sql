
/* Drop Tables */

DROP TABLE IF EXISTS tesis;




/* Create Tables */

CREATE TABLE tesis
(
	-- Llave primaria tabla tesis
	id serial NOT NULL,
	titulo varchar NOT NULL,
	fecha_publicacion date,
	fecha_disponibilidad date,
	-- Resumen del trabajo de titulo
	abstract varchar,
	ubicacion_fichero varchar,
	PRIMARY KEY (id)
) WITHOUT OIDS;



/* Comments */

COMMENT ON COLUMN tesis.id IS 'Llave primaria tabla tesis';
COMMENT ON COLUMN tesis.abstract IS 'Resumen del trabajo de titulo';



