

/* Drop Indexes */

DROP INDEX IF EXISTS uc_users_groups;



/* Drop Tables */

DROP TABLE IF EXISTS tesis;
DROP TABLE IF EXISTS estudiante;
DROP TABLE IF EXISTS carrera;
DROP TABLE IF EXISTS categoria;
DROP TABLE IF EXISTS facultad;
DROP TABLE IF EXISTS groups;
DROP TABLE IF EXISTS login_attempts;
DROP TABLE IF EXISTS profesor;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS users_groups;



/* Drop Sequences */

DROP SEQUENCE IF EXISTS categoria_id_seq;
DROP SEQUENCE IF EXISTS facultad_id_seq;
DROP SEQUENCE IF EXISTS groups_id_seq;
DROP SEQUENCE IF EXISTS login_attempts_id_seq;
DROP SEQUENCE IF EXISTS tesis_id_seq;
DROP SEQUENCE IF EXISTS users_groups_id_seq;
DROP SEQUENCE IF EXISTS users_id_seq;




/* Create Tables */

CREATE TABLE carrera
(
	-- Es el codigo de la carrera (e.g: 21030, 21041)
	codigo int NOT NULL,
	-- Nombre de la carrera
	nombre_carrera varchar,
	id_facultad int DEFAULT 1 NOT NULL,
	CONSTRAINT carrera_pkey PRIMARY KEY (codigo)
) WITHOUT OIDS;


CREATE TABLE categoria
(
	id serial NOT NULL,
	-- Nombre representativo para cada categoria segun el trabajo de titutlo
	nombre_categoria varchar,
	-- Identifica a que facultad pertenece cierta categoria, ya que no mostraremos todas las categorias para la u completa, si no por facultades
	id_facultad int DEFAULT 1 NOT NULL,
	CONSTRAINT categoria_pkey PRIMARY KEY (id)
) WITHOUT OIDS;


CREATE TABLE estudiante
(
	rut int NOT NULL,
	-- Año que ingreso el estudiante
	anio_ingreso varchar NOT NULL,
	-- Es el codigo de la carrera a la que pertenece el estudiante (e.g: 21030, 21041)
	codigo_carrera int DEFAULT 1 NOT NULL,
	user_id int DEFAULT 1 NOT NULL,
	CONSTRAINT estudiante_pkey PRIMARY KEY (rut)
) WITHOUT OIDS;


CREATE TABLE facultad
(
	id serial NOT NULL,
	nombre_facultad varchar,
	CONSTRAINT facultad_pkey PRIMARY KEY (id)
) WITHOUT OIDS;


CREATE TABLE groups
(
	id serial NOT NULL,
	name varchar(20) NOT NULL,
	description varchar(100) NOT NULL,
	CONSTRAINT groups_pkey PRIMARY KEY (id)
) WITHOUT OIDS;


CREATE TABLE login_attempts
(
	id serial NOT NULL,
	ip_address inet NOT NULL,
	login varchar(100) NOT NULL,
	time_t int,
	CONSTRAINT login_attempts_pkey PRIMARY KEY (id)
) WITHOUT OIDS;


CREATE TABLE profesor
(
	-- Rut del usuario, sirve como identificador para el login tambien
	rut int NOT NULL,
	user_id int DEFAULT 1 NOT NULL,
	CONSTRAINT profesor_pkey PRIMARY KEY (rut)
) WITHOUT OIDS;


CREATE TABLE tesis
(
	id serial NOT NULL,
	-- Nombre del trabajo de titulo
	titulo varchar NOT NULL,
	-- Resumen del trabajo de titulo
	abstract varchar,
	-- Fecha/hora en que la comision evalua el trabajo de titulo
	fecha_evaluacion timestamp,
	-- Fecha en que el trabajo de titulo es entregado a la universidad, puede ser nula ya que el sistema permite agregar trabajos de titulos antes de su entrega (e.g: Al tomar TT1 o en el transcurso de este)
	fecha_publicacion date,
	-- Ubicacion del fichero descargable del trabajo de titulo
	ubicacion_fichero varchar,
	-- Fecha en que el TT puede ser mostrado públicamente
	feha_disponibilidad date,
	-- Identifica a que categoria pertenece el trabajo de titulo
	id_categoria int DEFAULT 1 NOT NULL,
	-- Identifica al estudiante que realiza el trabajo de titulo
	estudiante_rut int DEFAULT 12345678 NOT NULL,
	-- Identifica al profesor guia de este trabajod de titulo
	profesor_guia_rut int DEFAULT 12345678 NOT NULL,
	CONSTRAINT tesis_pkey PRIMARY KEY (id)
) WITHOUT OIDS;


CREATE TABLE users
(
	id serial NOT NULL,
	ip_address inet NOT NULL,
	username varchar(100) NOT NULL,
	password varchar(80) NOT NULL,
	salt varchar(40),
	email varchar(100) NOT NULL,
	activation_code varchar(40),
	forgotten_password_code varchar(40),
	forgotten_password_time int,
	remember_code varchar(40),
	created_on int NOT NULL,
	last_login int,
	active int,
	first_name varchar(50),
	last_name varchar(50),
	company varchar(100),
	phone varchar(20),
	CONSTRAINT users_pkey PRIMARY KEY (id)
) WITHOUT OIDS;


CREATE TABLE users_groups
(
	id serial NOT NULL,
	user_id int NOT NULL,
	group_id int NOT NULL,
	CONSTRAINT users_groups_pkey PRIMARY KEY (id)
) WITHOUT OIDS;



/* Create Foreign Keys */

ALTER TABLE estudiante
	ADD CONSTRAINT carrera_estudiante_fk FOREIGN KEY (codigo_carrera)
	REFERENCES carrera (codigo)
	ON UPDATE NO ACTION
	ON DELETE SET DEFAULT
;


ALTER TABLE tesis
	ADD CONSTRAINT categoria_tesis_fk FOREIGN KEY (id_categoria)
	REFERENCES categoria (id)
	ON UPDATE NO ACTION
	ON DELETE SET DEFAULT
;


ALTER TABLE tesis
	ADD CONSTRAINT estudiante_tesis_fk FOREIGN KEY (estudiante_rut)
	REFERENCES estudiante (rut)
	ON UPDATE NO ACTION
	ON DELETE SET DEFAULT
;


ALTER TABLE carrera
	ADD CONSTRAINT facultad_carrera_fk FOREIGN KEY (id_facultad)
	REFERENCES facultad (id)
	ON UPDATE NO ACTION
	ON DELETE SET DEFAULT
;


ALTER TABLE categoria
	ADD CONSTRAINT facultad_categoria_fk FOREIGN KEY (id_facultad)
	REFERENCES facultad (id)
	ON UPDATE NO ACTION
	ON DELETE SET DEFAULT
;


ALTER TABLE tesis
	ADD CONSTRAINT profesor_tesis_fk FOREIGN KEY (profesor_guia_rut)
	REFERENCES profesor (rut)
	ON UPDATE NO ACTION
	ON DELETE SET DEFAULT
;


ALTER TABLE estudiante
	ADD CONSTRAINT estudiante_user_id_fkey FOREIGN KEY (user_id)
	REFERENCES users (id)
	ON UPDATE NO ACTION
	ON DELETE SET DEFAULT
;


ALTER TABLE profesor
	ADD CONSTRAINT profesor_user_id_fkey FOREIGN KEY (user_id)
	REFERENCES users (id)
	ON UPDATE NO ACTION
	ON DELETE SET DEFAULT
;



/* Create Indexes */

CREATE UNIQUE INDEX uc_users_groups ON users_groups USING BTREE (user_id, group_id);



/* Comments */

COMMENT ON COLUMN carrera.codigo IS 'Es el codigo de la carrera (e.g: 21030, 21041)';
COMMENT ON COLUMN carrera.nombre_carrera IS 'Nombre de la carrera';
COMMENT ON COLUMN categoria.nombre_categoria IS 'Nombre representativo para cada categoria segun el trabajo de titutlo';
COMMENT ON COLUMN categoria.id_facultad IS 'Identifica a que facultad pertenece cierta categoria, ya que no mostraremos todas las categorias para la u completa, si no por facultades';
COMMENT ON COLUMN estudiante.anio_ingreso IS 'Año que ingreso el estudiante';
COMMENT ON COLUMN estudiante.codigo_carrera IS 'Es el codigo de la carrera a la que pertenece el estudiante (e.g: 21030, 21041)';
COMMENT ON COLUMN profesor.rut IS 'Rut del usuario, sirve como identificador para el login tambien';
COMMENT ON COLUMN tesis.titulo IS 'Nombre del trabajo de titulo';
COMMENT ON COLUMN tesis.abstract IS 'Resumen del trabajo de titulo';
COMMENT ON COLUMN tesis.fecha_evaluacion IS 'Fecha/hora en que la comision evalua el trabajo de titulo';
COMMENT ON COLUMN tesis.fecha_publicacion IS 'Fecha en que el trabajo de titulo es entregado a la universidad, puede ser nula ya que el sistema permite agregar trabajos de titulos antes de su entrega (e.g: Al tomar TT1 o en el transcurso de este)';
COMMENT ON COLUMN tesis.ubicacion_fichero IS 'Ubicacion del fichero descargable del trabajo de titulo';
COMMENT ON COLUMN tesis.feha_disponibilidad IS 'Fecha en que el TT puede ser mostrado públicamente';
COMMENT ON COLUMN tesis.id_categoria IS 'Identifica a que categoria pertenece el trabajo de titulo';
COMMENT ON COLUMN tesis.estudiante_rut IS 'Identifica al estudiante que realiza el trabajo de titulo';
COMMENT ON COLUMN tesis.profesor_guia_rut IS 'Identifica al profesor guia de este trabajod de titulo';



INSERT INTO facultad (id, nombre_facultad) VALUES (1, 'Sin Facultad');
INSERT INTO carrera (codigo, nombre_carrera, id_facultad) VALUES (1, 'Sin Carrera', 1);
INSERT INTO categoria (id, nombre_categoria, id_facultad) VALUES (1, 'Sin Categoria', 1);
INSERT INTO groups (id, name, description) VALUES (1, 'admin', 'Administradores');
INSERT INTO users (id, ip_address, username, password, salt, email, activation_code, forgotten_password_code, created_on, last_login, active, first_name, last_name, company, phone) VALUES
    (1, '127.0.0.1','default','','','','',NULL,'1268889823','1268889823','0','Sin','Persona','UTEM','0');
INSERT INTO users (id, ip_address, username, password, salt, email, activation_code, forgotten_password_code, created_on, last_login, active, first_name, last_name, company, phone) VALUES
    (2, '127.0.0.1','ptorrealba','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36','9462e8eee0','ptorrealba@utem.cl','',NULL,'1268889823','1268889823','1','Pamela','Torrealba','UTEM','0');
INSERT INTO users_groups (user_id, group_id) VALUES (2, 1);
INSERT INTO estudiante (rut, anio_ingreso, codigo_carrera, user_id) VALUES (12345678, 1970, 1, 1);
INSERT INTO profesor (rut, user_id) VALUES (12345678, 1);

