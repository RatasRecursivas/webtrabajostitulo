
/* Drop Tables */

DROP TABLE IF EXISTS TESIS;
DROP TABLE IF EXISTS CATEGORIA;
DROP TABLE IF EXISTS ESTUDIANTE;
DROP TABLE IF EXISTS PROFESOR_COMISION;
DROP TABLE IF EXISTS COMISION;
DROP TABLE IF EXISTS GRADO;
DROP TABLE IF EXISTS PROFESOR;
DROP TABLE IF EXISTS CARRERA;
DROP TABLE IF EXISTS FACULTAD;
DROP TABLE IF EXISTS USUARIO;
DROP TABLE IF EXISTS TIPO_USUARIO;




/* Create Tables */

CREATE TABLE CATEGORIA
(
	Id_categoria int NOT NULL,
	-- Nombre representativo para cada categoria segun el trabajo de titutlo
	-- 
	Nombre_categoria varchar,
	Id_facultuad int NOT NULL,
	PRIMARY KEY (Id_categoria)
) WITHOUT OIDS;


CREATE TABLE ESTUDIANTE
(
	Rut int NOT NULL,
	-- Nombre del estudiante 
	Primer_nombre varchar NOT NULL,
	Primer_apellido varchar,
	Segundo_apellido varchar,
	-- Año que ingreso el alumno
	Anio_ingreso date NOT NULL,
	-- Número de contacto del estudiante
	Contacto_estudiante date,
	-- Mail del estudiante
	Mail_estudiante varchar,
	-- Todas las carreras tiene un codigo que son unicos 
	Codio int NOT NULL,
	Id_usuario int NOT NULL,
	PRIMARY KEY (Rut)
) WITHOUT OIDS;


CREATE TABLE COMISION
(
	Id_comision int NOT NULL,
	PRIMARY KEY (Id_comision)
) WITHOUT OIDS;


CREATE TABLE PROFESOR
(
	Id_profesor int NOT NULL,
	Primer_nombre varchar,
	Primer_apellido varchar,
	Segundo_apellido varchar,
	Contacto_profesor varchar,
	Mail_profesor varchar,
	Id_usuario int NOT NULL,
	PRIMARY KEY (Id_profesor)
) WITHOUT OIDS;


CREATE TABLE CARRERA
(
	-- Todas las carreras tiene un codigo que son unicos 
	Codio int NOT NULL,
	-- Nombre de la carrera
	Nombre_carrera varchar,
	Id_facultuad int NOT NULL,
	PRIMARY KEY (Codio)
) WITHOUT OIDS;


CREATE TABLE FACULTAD
(
	Id_facultuad int NOT NULL,
	Nombre_facultad varchar,
	PRIMARY KEY (Id_facultuad)
) WITHOUT OIDS;


CREATE TABLE GRADO
(
	Id_grado varchar NOT NULL,
	Nombre_grado varchar,
	Id_profesor int NOT NULL,
	PRIMARY KEY (Id_grado)
) WITHOUT OIDS;


CREATE TABLE TIPO_USUARIO
(
	Id_tipo_usuario int NOT NULL,
	-- Nombre del tipo de privilegio que se le dara al usuario
	tipo varchar,
	PRIMARY KEY (Id_tipo_usuario)
) WITHOUT OIDS;


CREATE TABLE USUARIO
(
	Id_usuario int NOT NULL,
	-- NOmbre de usuario que sera represetnado en el portal
	-- 
	Usuario varchar NOT NULL,
	-- Password que tendra en el portal
	Password varchar NOT NULL,
	Id_tipo_usuario int NOT NULL,
	PRIMARY KEY (Id_usuario)
) WITHOUT OIDS;


CREATE TABLE PROFESOR_COMISION
(
	Id_profesor int NOT NULL,
	Id_comision int NOT NULL
) WITHOUT OIDS;


CREATE TABLE TESIS
(
	Id_tesis int NOT NULL,
	-- Nombre del trabajo de titutlo
	Titulo varchar NOT NULL,
	-- Fecha que sera publicadad el trabajo de titulo en el portal
	Fecha_publicacion date,
	Feha_disponible date,
	Abstrac varchar NOT NULL,
	-- Ubicacion del archivo del trabajo de titulo
	Ubicacion_archivo varchar,
	Id_categoria int NOT NULL,
	Rut int NOT NULL,
	Id_profesor_guia int NOT NULL,
	Id_comision int NOT NULL,
	PRIMARY KEY (Id_tesis)
) WITHOUT OIDS;



/* Create Foreign Keys */

ALTER TABLE TESIS
	ADD FOREIGN KEY (Id_categoria)
	REFERENCES CATEGORIA (Id_categoria)
	ON UPDATE RESTRICT
	ON DELETE RESTRICT
;


ALTER TABLE TESIS
	ADD FOREIGN KEY (Rut)
	REFERENCES ESTUDIANTE (Rut)
	ON UPDATE RESTRICT
	ON DELETE RESTRICT
;


ALTER TABLE PROFESOR_COMISION
	ADD FOREIGN KEY (Id_comision)
	REFERENCES COMISION (Id_comision)
	ON UPDATE RESTRICT
	ON DELETE RESTRICT
;


ALTER TABLE TESIS
	ADD FOREIGN KEY (Id_comision)
	REFERENCES COMISION (Id_comision)
	ON UPDATE RESTRICT
	ON DELETE RESTRICT
;


ALTER TABLE GRADO
	ADD FOREIGN KEY (Id_profesor)
	REFERENCES PROFESOR (Id_profesor)
	ON UPDATE RESTRICT
	ON DELETE RESTRICT
;


ALTER TABLE TESIS
	ADD FOREIGN KEY (Id_profesor_guia)
	REFERENCES PROFESOR (Id_profesor)
	ON UPDATE RESTRICT
	ON DELETE RESTRICT
;


ALTER TABLE PROFESOR_COMISION
	ADD FOREIGN KEY (Id_profesor)
	REFERENCES PROFESOR (Id_profesor)
	ON UPDATE RESTRICT
	ON DELETE RESTRICT
;


ALTER TABLE ESTUDIANTE
	ADD FOREIGN KEY (Codio)
	REFERENCES CARRERA (Codio)
	ON UPDATE RESTRICT
	ON DELETE RESTRICT
;


ALTER TABLE CATEGORIA
	ADD FOREIGN KEY (Id_facultuad)
	REFERENCES FACULTAD (Id_facultuad)
	ON UPDATE RESTRICT
	ON DELETE RESTRICT
;


ALTER TABLE CARRERA
	ADD FOREIGN KEY (Id_facultuad)
	REFERENCES FACULTAD (Id_facultuad)
	ON UPDATE RESTRICT
	ON DELETE RESTRICT
;


ALTER TABLE USUARIO
	ADD FOREIGN KEY (Id_tipo_usuario)
	REFERENCES TIPO_USUARIO (Id_tipo_usuario)
	ON UPDATE RESTRICT
	ON DELETE RESTRICT
;


ALTER TABLE ESTUDIANTE
	ADD FOREIGN KEY (Id_usuario)
	REFERENCES USUARIO (Id_usuario)
	ON UPDATE RESTRICT
	ON DELETE RESTRICT
;


ALTER TABLE PROFESOR
	ADD FOREIGN KEY (Id_usuario)
	REFERENCES USUARIO (Id_usuario)
	ON UPDATE RESTRICT
	ON DELETE RESTRICT
;



/* Comments */

COMMENT ON COLUMN CATEGORIA.Nombre_categoria IS 'Nombre representativo para cada categoria segun el trabajo de titutlo
';
COMMENT ON COLUMN ESTUDIANTE.Primer_nombre IS 'Nombre del estudiante ';
COMMENT ON COLUMN ESTUDIANTE.Anio_ingreso IS 'Año que ingreso el alumno';
COMMENT ON COLUMN ESTUDIANTE.Contacto_estudiante IS 'Número de contacto del estudiante';
COMMENT ON COLUMN ESTUDIANTE.Mail_estudiante IS 'Mail del estudiante';
COMMENT ON COLUMN ESTUDIANTE.Codio IS 'Todas las carreras tiene un codigo que son unicos ';
COMMENT ON COLUMN CARRERA.Codio IS 'Todas las carreras tiene un codigo que son unicos ';
COMMENT ON COLUMN CARRERA.Nombre_carrera IS 'Nombre de la carrera';
COMMENT ON COLUMN TIPO_USUARIO.tipo IS 'Nombre del tipo de privilegio que se le dara al usuario';
COMMENT ON COLUMN USUARIO.Usuario IS 'NOmbre de usuario que sera represetnado en el portal
';
COMMENT ON COLUMN USUARIO.Password IS 'Password que tendra en el portal';
COMMENT ON COLUMN TESIS.Titulo IS 'Nombre del trabajo de titutlo';
COMMENT ON COLUMN TESIS.Fecha_publicacion IS 'Fecha que sera publicadad el trabajo de titulo en el portal';
COMMENT ON COLUMN TESIS.Ubicacion_archivo IS 'Ubicacion del archivo del trabajo de titulo';



