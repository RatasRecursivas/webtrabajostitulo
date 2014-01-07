--
-- PostgreSQL database dump
--

-- Dumped from database version 9.1.11
-- Dumped by pg_dump version 9.1.11
-- Started on 2014-01-06 17:21:56 CLST

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- TOC entry 14 (class 2615 OID 1271841)
-- Name: grupo08; Type: SCHEMA; Schema: -; Owner: grupo08
--

CREATE SCHEMA grupo08;


ALTER SCHEMA grupo08 OWNER TO grupo08;

SET search_path = grupo08, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 316 (class 1259 OID 1539655)
-- Dependencies: 2363 14
-- Name: carrera; Type: TABLE; Schema: grupo08; Owner: grupo08; Tablespace: 
--

CREATE TABLE carrera (
    codigo integer NOT NULL,
    nombre_carrera character varying,
    id_facultad integer DEFAULT 1 NOT NULL
);


ALTER TABLE grupo08.carrera OWNER TO grupo08;

--
-- TOC entry 2513 (class 0 OID 0)
-- Dependencies: 316
-- Name: COLUMN carrera.codigo; Type: COMMENT; Schema: grupo08; Owner: grupo08
--

COMMENT ON COLUMN carrera.codigo IS 'Es el codigo de la carrera (e.g: 21030, 21041)';


--
-- TOC entry 2514 (class 0 OID 0)
-- Dependencies: 316
-- Name: COLUMN carrera.nombre_carrera; Type: COMMENT; Schema: grupo08; Owner: grupo08
--

COMMENT ON COLUMN carrera.nombre_carrera IS 'Nombre de la carrera';


--
-- TOC entry 318 (class 1259 OID 1539665)
-- Dependencies: 2365 14
-- Name: categoria; Type: TABLE; Schema: grupo08; Owner: grupo08; Tablespace: 
--

CREATE TABLE categoria (
    id integer NOT NULL,
    nombre_categoria character varying,
    id_facultad integer DEFAULT 1 NOT NULL
);


ALTER TABLE grupo08.categoria OWNER TO grupo08;

--
-- TOC entry 2515 (class 0 OID 0)
-- Dependencies: 318
-- Name: COLUMN categoria.nombre_categoria; Type: COMMENT; Schema: grupo08; Owner: grupo08
--

COMMENT ON COLUMN categoria.nombre_categoria IS 'Nombre representativo para cada categoria segun el trabajo de titutlo';


--
-- TOC entry 2516 (class 0 OID 0)
-- Dependencies: 318
-- Name: COLUMN categoria.id_facultad; Type: COMMENT; Schema: grupo08; Owner: grupo08
--

COMMENT ON COLUMN categoria.id_facultad IS 'Identifica a que facultad pertenece cierta categoria, ya que no mostraremos todas las categorias para la u completa, si no por facultades';


--
-- TOC entry 317 (class 1259 OID 1539663)
-- Dependencies: 14 318
-- Name: categoria_id_seq; Type: SEQUENCE; Schema: grupo08; Owner: grupo08
--

CREATE SEQUENCE categoria_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE grupo08.categoria_id_seq OWNER TO grupo08;

--
-- TOC entry 2517 (class 0 OID 0)
-- Dependencies: 317
-- Name: categoria_id_seq; Type: SEQUENCE OWNED BY; Schema: grupo08; Owner: grupo08
--

ALTER SEQUENCE categoria_id_seq OWNED BY categoria.id;


--
-- TOC entry 319 (class 1259 OID 1539682)
-- Dependencies: 2366 2367 14
-- Name: estudiante; Type: TABLE; Schema: grupo08; Owner: grupo08; Tablespace: 
--

CREATE TABLE estudiante (
    rut integer NOT NULL,
    anio_ingreso character varying NOT NULL,
    codigo_carrera integer DEFAULT 1 NOT NULL,
    user_id integer DEFAULT 1 NOT NULL
);


ALTER TABLE grupo08.estudiante OWNER TO grupo08;

--
-- TOC entry 2518 (class 0 OID 0)
-- Dependencies: 319
-- Name: COLUMN estudiante.anio_ingreso; Type: COMMENT; Schema: grupo08; Owner: grupo08
--

COMMENT ON COLUMN estudiante.anio_ingreso IS 'Año que ingreso el estudiante';


--
-- TOC entry 2519 (class 0 OID 0)
-- Dependencies: 319
-- Name: COLUMN estudiante.codigo_carrera; Type: COMMENT; Schema: grupo08; Owner: grupo08
--

COMMENT ON COLUMN estudiante.codigo_carrera IS 'Es el codigo de la carrera a la que pertenece el estudiante (e.g: 21030, 21041)';


--
-- TOC entry 321 (class 1259 OID 1539689)
-- Dependencies: 14
-- Name: facultad; Type: TABLE; Schema: grupo08; Owner: grupo08; Tablespace: 
--

CREATE TABLE facultad (
    id integer NOT NULL,
    nombre_facultad character varying
);


ALTER TABLE grupo08.facultad OWNER TO grupo08;

--
-- TOC entry 320 (class 1259 OID 1539687)
-- Dependencies: 14 321
-- Name: facultad_id_seq; Type: SEQUENCE; Schema: grupo08; Owner: grupo08
--

CREATE SEQUENCE facultad_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE grupo08.facultad_id_seq OWNER TO grupo08;

--
-- TOC entry 2520 (class 0 OID 0)
-- Dependencies: 320
-- Name: facultad_id_seq; Type: SEQUENCE OWNED BY; Schema: grupo08; Owner: grupo08
--

ALTER SEQUENCE facultad_id_seq OWNED BY facultad.id;


--
-- TOC entry 323 (class 1259 OID 1539700)
-- Dependencies: 14
-- Name: groups; Type: TABLE; Schema: grupo08; Owner: grupo08; Tablespace: 
--

CREATE TABLE groups (
    id integer NOT NULL,
    name character varying(20) NOT NULL,
    description character varying(100) NOT NULL
);


ALTER TABLE grupo08.groups OWNER TO grupo08;

--
-- TOC entry 322 (class 1259 OID 1539698)
-- Dependencies: 323 14
-- Name: groups_id_seq; Type: SEQUENCE; Schema: grupo08; Owner: grupo08
--

CREATE SEQUENCE groups_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE grupo08.groups_id_seq OWNER TO grupo08;

--
-- TOC entry 2521 (class 0 OID 0)
-- Dependencies: 322
-- Name: groups_id_seq; Type: SEQUENCE OWNED BY; Schema: grupo08; Owner: grupo08
--

ALTER SEQUENCE groups_id_seq OWNED BY groups.id;


--
-- TOC entry 325 (class 1259 OID 1539708)
-- Dependencies: 14
-- Name: login_attempts; Type: TABLE; Schema: grupo08; Owner: grupo08; Tablespace: 
--

CREATE TABLE login_attempts (
    id integer NOT NULL,
    ip_address inet NOT NULL,
    login character varying(100) NOT NULL,
    time_t integer
);


ALTER TABLE grupo08.login_attempts OWNER TO grupo08;

--
-- TOC entry 324 (class 1259 OID 1539706)
-- Dependencies: 14 325
-- Name: login_attempts_id_seq; Type: SEQUENCE; Schema: grupo08; Owner: grupo08
--

CREATE SEQUENCE login_attempts_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE grupo08.login_attempts_id_seq OWNER TO grupo08;

--
-- TOC entry 2522 (class 0 OID 0)
-- Dependencies: 324
-- Name: login_attempts_id_seq; Type: SEQUENCE OWNED BY; Schema: grupo08; Owner: grupo08
--

ALTER SEQUENCE login_attempts_id_seq OWNED BY login_attempts.id;


--
-- TOC entry 326 (class 1259 OID 1539717)
-- Dependencies: 2371 14
-- Name: profesor; Type: TABLE; Schema: grupo08; Owner: grupo08; Tablespace: 
--

CREATE TABLE profesor (
    rut integer NOT NULL,
    user_id integer DEFAULT 1 NOT NULL
);


ALTER TABLE grupo08.profesor OWNER TO grupo08;

--
-- TOC entry 2523 (class 0 OID 0)
-- Dependencies: 326
-- Name: COLUMN profesor.rut; Type: COMMENT; Schema: grupo08; Owner: grupo08
--

COMMENT ON COLUMN profesor.rut IS 'Rut del usuario, sirve como identificador para el login tambien';


--
-- TOC entry 328 (class 1259 OID 1539732)
-- Dependencies: 2373 2374 2375 2376 14
-- Name: tesis; Type: TABLE; Schema: grupo08; Owner: grupo08; Tablespace: 
--

CREATE TABLE tesis (
    id integer NOT NULL,
    titulo character varying NOT NULL,
    abstract character varying,
    fecha_evaluacion timestamp without time zone,
    fecha_publicacion date,
    ubicacion_fichero character varying,
    feha_disponibilidad date,
    id_categoria integer DEFAULT 1 NOT NULL,
    estudiante_rut integer DEFAULT 12345678 NOT NULL,
    profesor_guia_rut integer DEFAULT 12345678 NOT NULL,
    CONSTRAINT fechas_publicacion_disponibilidad CHECK ((fecha_publicacion <= feha_disponibilidad))
);


ALTER TABLE grupo08.tesis OWNER TO grupo08;

--
-- TOC entry 2524 (class 0 OID 0)
-- Dependencies: 328
-- Name: COLUMN tesis.titulo; Type: COMMENT; Schema: grupo08; Owner: grupo08
--

COMMENT ON COLUMN tesis.titulo IS 'Nombre del trabajo de titulo';


--
-- TOC entry 2525 (class 0 OID 0)
-- Dependencies: 328
-- Name: COLUMN tesis.abstract; Type: COMMENT; Schema: grupo08; Owner: grupo08
--

COMMENT ON COLUMN tesis.abstract IS 'Resumen del trabajo de titulo';


--
-- TOC entry 2526 (class 0 OID 0)
-- Dependencies: 328
-- Name: COLUMN tesis.fecha_evaluacion; Type: COMMENT; Schema: grupo08; Owner: grupo08
--

COMMENT ON COLUMN tesis.fecha_evaluacion IS 'Fecha/hora en que la comision evalua el trabajo de titulo';


--
-- TOC entry 2527 (class 0 OID 0)
-- Dependencies: 328
-- Name: COLUMN tesis.fecha_publicacion; Type: COMMENT; Schema: grupo08; Owner: grupo08
--

COMMENT ON COLUMN tesis.fecha_publicacion IS 'Fecha en que el trabajo de titulo es entregado a la universidad, puede ser nula ya que el sistema permite agregar trabajos de titulos antes de su entrega (e.g: Al tomar TT1 o en el transcurso de este)';


--
-- TOC entry 2528 (class 0 OID 0)
-- Dependencies: 328
-- Name: COLUMN tesis.ubicacion_fichero; Type: COMMENT; Schema: grupo08; Owner: grupo08
--

COMMENT ON COLUMN tesis.ubicacion_fichero IS 'Ubicacion del fichero descargable del trabajo de titulo';


--
-- TOC entry 2529 (class 0 OID 0)
-- Dependencies: 328
-- Name: COLUMN tesis.feha_disponibilidad; Type: COMMENT; Schema: grupo08; Owner: grupo08
--

COMMENT ON COLUMN tesis.feha_disponibilidad IS 'Fecha en que el TT puede ser mostrado públicamente';


--
-- TOC entry 2530 (class 0 OID 0)
-- Dependencies: 328
-- Name: COLUMN tesis.id_categoria; Type: COMMENT; Schema: grupo08; Owner: grupo08
--

COMMENT ON COLUMN tesis.id_categoria IS 'Identifica a que categoria pertenece el trabajo de titulo';


--
-- TOC entry 2531 (class 0 OID 0)
-- Dependencies: 328
-- Name: COLUMN tesis.estudiante_rut; Type: COMMENT; Schema: grupo08; Owner: grupo08
--

COMMENT ON COLUMN tesis.estudiante_rut IS 'Identifica al estudiante que realiza el trabajo de titulo';


--
-- TOC entry 2532 (class 0 OID 0)
-- Dependencies: 328
-- Name: COLUMN tesis.profesor_guia_rut; Type: COMMENT; Schema: grupo08; Owner: grupo08
--

COMMENT ON COLUMN tesis.profesor_guia_rut IS 'Identifica al profesor guia de este trabajod de titulo';


--
-- TOC entry 327 (class 1259 OID 1539730)
-- Dependencies: 14 328
-- Name: tesis_id_seq; Type: SEQUENCE; Schema: grupo08; Owner: grupo08
--

CREATE SEQUENCE tesis_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE grupo08.tesis_id_seq OWNER TO grupo08;

--
-- TOC entry 2533 (class 0 OID 0)
-- Dependencies: 327
-- Name: tesis_id_seq; Type: SEQUENCE OWNED BY; Schema: grupo08; Owner: grupo08
--

ALTER SEQUENCE tesis_id_seq OWNED BY tesis.id;


--
-- TOC entry 330 (class 1259 OID 1539743)
-- Dependencies: 14
-- Name: users; Type: TABLE; Schema: grupo08; Owner: grupo08; Tablespace: 
--

CREATE TABLE users (
    id integer NOT NULL,
    ip_address inet NOT NULL,
    username character varying(100) NOT NULL,
    password character varying(80) NOT NULL,
    salt character varying(40),
    email character varying(100) NOT NULL,
    activation_code character varying(40),
    forgotten_password_code character varying(40),
    forgotten_password_time integer,
    remember_code character varying(40),
    created_on integer NOT NULL,
    last_login integer,
    active integer,
    first_name character varying(50),
    last_name character varying(50),
    company character varying(100),
    phone character varying(20)
);


ALTER TABLE grupo08.users OWNER TO grupo08;

--
-- TOC entry 332 (class 1259 OID 1539754)
-- Dependencies: 14
-- Name: users_groups; Type: TABLE; Schema: grupo08; Owner: grupo08; Tablespace: 
--

CREATE TABLE users_groups (
    id integer NOT NULL,
    user_id integer NOT NULL,
    group_id integer NOT NULL
);


ALTER TABLE grupo08.users_groups OWNER TO grupo08;

--
-- TOC entry 331 (class 1259 OID 1539752)
-- Dependencies: 14 332
-- Name: users_groups_id_seq; Type: SEQUENCE; Schema: grupo08; Owner: grupo08
--

CREATE SEQUENCE users_groups_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE grupo08.users_groups_id_seq OWNER TO grupo08;

--
-- TOC entry 2534 (class 0 OID 0)
-- Dependencies: 331
-- Name: users_groups_id_seq; Type: SEQUENCE OWNED BY; Schema: grupo08; Owner: grupo08
--

ALTER SEQUENCE users_groups_id_seq OWNED BY users_groups.id;


--
-- TOC entry 329 (class 1259 OID 1539741)
-- Dependencies: 330 14
-- Name: users_id_seq; Type: SEQUENCE; Schema: grupo08; Owner: grupo08
--

CREATE SEQUENCE users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE grupo08.users_id_seq OWNER TO grupo08;

--
-- TOC entry 2535 (class 0 OID 0)
-- Dependencies: 329
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: grupo08; Owner: grupo08
--

ALTER SEQUENCE users_id_seq OWNED BY users.id;


--
-- TOC entry 2364 (class 2604 OID 1539668)
-- Dependencies: 318 317 318
-- Name: id; Type: DEFAULT; Schema: grupo08; Owner: grupo08
--

ALTER TABLE ONLY categoria ALTER COLUMN id SET DEFAULT nextval('categoria_id_seq'::regclass);


--
-- TOC entry 2368 (class 2604 OID 1539692)
-- Dependencies: 321 320 321
-- Name: id; Type: DEFAULT; Schema: grupo08; Owner: grupo08
--

ALTER TABLE ONLY facultad ALTER COLUMN id SET DEFAULT nextval('facultad_id_seq'::regclass);


--
-- TOC entry 2369 (class 2604 OID 1539703)
-- Dependencies: 322 323 323
-- Name: id; Type: DEFAULT; Schema: grupo08; Owner: grupo08
--

ALTER TABLE ONLY groups ALTER COLUMN id SET DEFAULT nextval('groups_id_seq'::regclass);


--
-- TOC entry 2370 (class 2604 OID 1539711)
-- Dependencies: 325 324 325
-- Name: id; Type: DEFAULT; Schema: grupo08; Owner: grupo08
--

ALTER TABLE ONLY login_attempts ALTER COLUMN id SET DEFAULT nextval('login_attempts_id_seq'::regclass);


--
-- TOC entry 2372 (class 2604 OID 1539735)
-- Dependencies: 328 327 328
-- Name: id; Type: DEFAULT; Schema: grupo08; Owner: grupo08
--

ALTER TABLE ONLY tesis ALTER COLUMN id SET DEFAULT nextval('tesis_id_seq'::regclass);


--
-- TOC entry 2377 (class 2604 OID 1539746)
-- Dependencies: 330 329 330
-- Name: id; Type: DEFAULT; Schema: grupo08; Owner: grupo08
--

ALTER TABLE ONLY users ALTER COLUMN id SET DEFAULT nextval('users_id_seq'::regclass);


--
-- TOC entry 2378 (class 2604 OID 1539757)
-- Dependencies: 331 332 332
-- Name: id; Type: DEFAULT; Schema: grupo08; Owner: grupo08
--

ALTER TABLE ONLY users_groups ALTER COLUMN id SET DEFAULT nextval('users_groups_id_seq'::regclass);


--
-- TOC entry 2380 (class 2606 OID 1539662)
-- Dependencies: 316 316 2510
-- Name: carrera_pkey; Type: CONSTRAINT; Schema: grupo08; Owner: grupo08; Tablespace: 
--

ALTER TABLE ONLY carrera
    ADD CONSTRAINT carrera_pkey PRIMARY KEY (codigo);


--
-- TOC entry 2382 (class 2606 OID 1539673)
-- Dependencies: 318 318 2510
-- Name: categoria_pkey; Type: CONSTRAINT; Schema: grupo08; Owner: grupo08; Tablespace: 
--

ALTER TABLE ONLY categoria
    ADD CONSTRAINT categoria_pkey PRIMARY KEY (id);


--
-- TOC entry 2384 (class 2606 OID 1539686)
-- Dependencies: 319 319 2510
-- Name: estudiante_pkey; Type: CONSTRAINT; Schema: grupo08; Owner: grupo08; Tablespace: 
--

ALTER TABLE ONLY estudiante
    ADD CONSTRAINT estudiante_pkey PRIMARY KEY (rut);


--
-- TOC entry 2386 (class 2606 OID 1539697)
-- Dependencies: 321 321 2510
-- Name: facultad_pkey; Type: CONSTRAINT; Schema: grupo08; Owner: grupo08; Tablespace: 
--

ALTER TABLE ONLY facultad
    ADD CONSTRAINT facultad_pkey PRIMARY KEY (id);


--
-- TOC entry 2388 (class 2606 OID 1539705)
-- Dependencies: 323 323 2510
-- Name: groups_pkey; Type: CONSTRAINT; Schema: grupo08; Owner: grupo08; Tablespace: 
--

ALTER TABLE ONLY groups
    ADD CONSTRAINT groups_pkey PRIMARY KEY (id);


--
-- TOC entry 2390 (class 2606 OID 1539716)
-- Dependencies: 325 325 2510
-- Name: login_attempts_pkey; Type: CONSTRAINT; Schema: grupo08; Owner: grupo08; Tablespace: 
--

ALTER TABLE ONLY login_attempts
    ADD CONSTRAINT login_attempts_pkey PRIMARY KEY (id);


--
-- TOC entry 2392 (class 2606 OID 1539721)
-- Dependencies: 326 326 2510
-- Name: profesor_pkey; Type: CONSTRAINT; Schema: grupo08; Owner: grupo08; Tablespace: 
--

ALTER TABLE ONLY profesor
    ADD CONSTRAINT profesor_pkey PRIMARY KEY (rut);


--
-- TOC entry 2394 (class 2606 OID 1539740)
-- Dependencies: 328 328 2510
-- Name: tesis_pkey; Type: CONSTRAINT; Schema: grupo08; Owner: grupo08; Tablespace: 
--

ALTER TABLE ONLY tesis
    ADD CONSTRAINT tesis_pkey PRIMARY KEY (id);


--
-- TOC entry 2399 (class 2606 OID 1539759)
-- Dependencies: 332 332 2510
-- Name: users_groups_pkey; Type: CONSTRAINT; Schema: grupo08; Owner: grupo08; Tablespace: 
--

ALTER TABLE ONLY users_groups
    ADD CONSTRAINT users_groups_pkey PRIMARY KEY (id);


--
-- TOC entry 2396 (class 2606 OID 1539751)
-- Dependencies: 330 330 2510
-- Name: users_pkey; Type: CONSTRAINT; Schema: grupo08; Owner: grupo08; Tablespace: 
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- TOC entry 2397 (class 1259 OID 1539815)
-- Dependencies: 332 332 2510
-- Name: uc_users_groups; Type: INDEX; Schema: grupo08; Owner: grupo08; Tablespace: 
--

CREATE UNIQUE INDEX uc_users_groups ON users_groups USING btree (user_id, group_id);


--
-- TOC entry 2402 (class 2606 OID 1588757)
-- Dependencies: 319 2379 316 2510
-- Name: carrera_estudiante_fk; Type: FK CONSTRAINT; Schema: grupo08; Owner: grupo08
--

ALTER TABLE ONLY estudiante
    ADD CONSTRAINT carrera_estudiante_fk FOREIGN KEY (codigo_carrera) REFERENCES carrera(codigo) ON DELETE SET DEFAULT;


--
-- TOC entry 2405 (class 2606 OID 1588775)
-- Dependencies: 2381 328 318 2510
-- Name: categoria_tesis_fk; Type: FK CONSTRAINT; Schema: grupo08; Owner: grupo08
--

ALTER TABLE ONLY tesis
    ADD CONSTRAINT categoria_tesis_fk FOREIGN KEY (id_categoria) REFERENCES categoria(id) ON DELETE SET DEFAULT;


--
-- TOC entry 2406 (class 2606 OID 1588780)
-- Dependencies: 328 319 2383 2510
-- Name: estudiante_tesis_fk; Type: FK CONSTRAINT; Schema: grupo08; Owner: grupo08
--

ALTER TABLE ONLY tesis
    ADD CONSTRAINT estudiante_tesis_fk FOREIGN KEY (estudiante_rut) REFERENCES estudiante(rut) ON DELETE SET DEFAULT;


--
-- TOC entry 2403 (class 2606 OID 1588763)
-- Dependencies: 2395 330 319 2510
-- Name: estudiante_user_id_fkey; Type: FK CONSTRAINT; Schema: grupo08; Owner: grupo08
--

ALTER TABLE ONLY estudiante
    ADD CONSTRAINT estudiante_user_id_fkey FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET DEFAULT;


--
-- TOC entry 2400 (class 2606 OID 1588743)
-- Dependencies: 321 2385 316 2510
-- Name: facultad_carrera_fk; Type: FK CONSTRAINT; Schema: grupo08; Owner: grupo08
--

ALTER TABLE ONLY carrera
    ADD CONSTRAINT facultad_carrera_fk FOREIGN KEY (id_facultad) REFERENCES facultad(id) ON DELETE SET DEFAULT;


--
-- TOC entry 2401 (class 2606 OID 1588769)
-- Dependencies: 321 318 2385 2510
-- Name: facultad_categoria_fk; Type: FK CONSTRAINT; Schema: grupo08; Owner: grupo08
--

ALTER TABLE ONLY categoria
    ADD CONSTRAINT facultad_categoria_fk FOREIGN KEY (id_facultad) REFERENCES facultad(id) ON DELETE SET DEFAULT;


--
-- TOC entry 2407 (class 2606 OID 1588785)
-- Dependencies: 326 2391 328 2510
-- Name: profesor_tesis_fk; Type: FK CONSTRAINT; Schema: grupo08; Owner: grupo08
--

ALTER TABLE ONLY tesis
    ADD CONSTRAINT profesor_tesis_fk FOREIGN KEY (profesor_guia_rut) REFERENCES profesor(rut) ON DELETE SET DEFAULT;


--
-- TOC entry 2404 (class 2606 OID 1588794)
-- Dependencies: 2395 326 330 2510
-- Name: profesor_user_id_fkey; Type: FK CONSTRAINT; Schema: grupo08; Owner: grupo08
--

ALTER TABLE ONLY profesor
    ADD CONSTRAINT profesor_user_id_fkey FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET DEFAULT;

-- Datos iniciales
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


-- Completed on 2014-01-06 17:21:58 CLST

--
-- PostgreSQL database dump complete
--

