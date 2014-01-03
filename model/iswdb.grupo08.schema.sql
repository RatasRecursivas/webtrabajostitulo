--
-- PostgreSQL database dump
--

-- Dumped from database version 9.1.11
-- Dumped by pg_dump version 9.1.11
-- Started on 2014-01-03 15:48:14 CLST

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- TOC entry 15 (class 2615 OID 1271841)
-- Name: grupo08; Type: SCHEMA; Schema: -; Owner: grupo08
--

CREATE SCHEMA grupo08;


ALTER SCHEMA grupo08 OWNER TO grupo08;

SET search_path = grupo08, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 351 (class 1259 OID 1539655)
-- Dependencies: 15
-- Name: carrera; Type: TABLE; Schema: grupo08; Owner: grupo08; Tablespace: 
--

CREATE TABLE carrera (
    codigo integer NOT NULL,
    nombre_carrera character varying,
    id_facultad integer NOT NULL
);


ALTER TABLE grupo08.carrera OWNER TO grupo08;

--
-- TOC entry 2474 (class 0 OID 0)
-- Dependencies: 351
-- Name: COLUMN carrera.codigo; Type: COMMENT; Schema: grupo08; Owner: grupo08
--

COMMENT ON COLUMN carrera.codigo IS 'Es el codigo de la carrera (e.g: 21030, 21041)';


--
-- TOC entry 2475 (class 0 OID 0)
-- Dependencies: 351
-- Name: COLUMN carrera.nombre_carrera; Type: COMMENT; Schema: grupo08; Owner: grupo08
--

COMMENT ON COLUMN carrera.nombre_carrera IS 'Nombre de la carrera';


--
-- TOC entry 353 (class 1259 OID 1539665)
-- Dependencies: 15
-- Name: categoria; Type: TABLE; Schema: grupo08; Owner: grupo08; Tablespace: 
--

CREATE TABLE categoria (
    id integer NOT NULL,
    nombre_categoria character varying,
    id_facultad integer NOT NULL
);


ALTER TABLE grupo08.categoria OWNER TO grupo08;

--
-- TOC entry 2476 (class 0 OID 0)
-- Dependencies: 353
-- Name: COLUMN categoria.nombre_categoria; Type: COMMENT; Schema: grupo08; Owner: grupo08
--

COMMENT ON COLUMN categoria.nombre_categoria IS 'Nombre representativo para cada categoria segun el trabajo de titutlo';


--
-- TOC entry 2477 (class 0 OID 0)
-- Dependencies: 353
-- Name: COLUMN categoria.id_facultad; Type: COMMENT; Schema: grupo08; Owner: grupo08
--

COMMENT ON COLUMN categoria.id_facultad IS 'Identifica a que facultad pertenece cierta categoria, ya que no mostraremos todas las categorias para la u completa, si no por facultades';


--
-- TOC entry 352 (class 1259 OID 1539663)
-- Dependencies: 15 353
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
-- TOC entry 2478 (class 0 OID 0)
-- Dependencies: 352
-- Name: categoria_id_seq; Type: SEQUENCE OWNED BY; Schema: grupo08; Owner: grupo08
--

ALTER SEQUENCE categoria_id_seq OWNED BY categoria.id;


--
-- TOC entry 354 (class 1259 OID 1539682)
-- Dependencies: 15
-- Name: estudiante; Type: TABLE; Schema: grupo08; Owner: grupo08; Tablespace: 
--

CREATE TABLE estudiante (
    rut integer NOT NULL,
    anio_ingreso character varying NOT NULL,
    codigo_carrera integer NOT NULL,
    user_id integer NOT NULL
);


ALTER TABLE grupo08.estudiante OWNER TO grupo08;

--
-- TOC entry 2479 (class 0 OID 0)
-- Dependencies: 354
-- Name: COLUMN estudiante.anio_ingreso; Type: COMMENT; Schema: grupo08; Owner: grupo08
--

COMMENT ON COLUMN estudiante.anio_ingreso IS 'Año que ingreso el estudiante';


--
-- TOC entry 2480 (class 0 OID 0)
-- Dependencies: 354
-- Name: COLUMN estudiante.codigo_carrera; Type: COMMENT; Schema: grupo08; Owner: grupo08
--

COMMENT ON COLUMN estudiante.codigo_carrera IS 'Es el codigo de la carrera a la que pertenece el estudiante (e.g: 21030, 21041)';


--
-- TOC entry 356 (class 1259 OID 1539689)
-- Dependencies: 15
-- Name: facultad; Type: TABLE; Schema: grupo08; Owner: grupo08; Tablespace: 
--

CREATE TABLE facultad (
    id integer NOT NULL,
    nombre_facultad character varying
);


ALTER TABLE grupo08.facultad OWNER TO grupo08;

--
-- TOC entry 355 (class 1259 OID 1539687)
-- Dependencies: 356 15
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
-- TOC entry 2481 (class 0 OID 0)
-- Dependencies: 355
-- Name: facultad_id_seq; Type: SEQUENCE OWNED BY; Schema: grupo08; Owner: grupo08
--

ALTER SEQUENCE facultad_id_seq OWNED BY facultad.id;


--
-- TOC entry 358 (class 1259 OID 1539700)
-- Dependencies: 15
-- Name: groups; Type: TABLE; Schema: grupo08; Owner: grupo08; Tablespace: 
--

CREATE TABLE groups (
    id integer NOT NULL,
    name character varying(20) NOT NULL,
    description character varying(100) NOT NULL
);


ALTER TABLE grupo08.groups OWNER TO grupo08;

--
-- TOC entry 357 (class 1259 OID 1539698)
-- Dependencies: 15 358
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
-- TOC entry 2482 (class 0 OID 0)
-- Dependencies: 357
-- Name: groups_id_seq; Type: SEQUENCE OWNED BY; Schema: grupo08; Owner: grupo08
--

ALTER SEQUENCE groups_id_seq OWNED BY groups.id;


--
-- TOC entry 360 (class 1259 OID 1539708)
-- Dependencies: 15
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
-- TOC entry 359 (class 1259 OID 1539706)
-- Dependencies: 15 360
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
-- TOC entry 2483 (class 0 OID 0)
-- Dependencies: 359
-- Name: login_attempts_id_seq; Type: SEQUENCE OWNED BY; Schema: grupo08; Owner: grupo08
--

ALTER SEQUENCE login_attempts_id_seq OWNED BY login_attempts.id;


--
-- TOC entry 361 (class 1259 OID 1539717)
-- Dependencies: 15
-- Name: profesor; Type: TABLE; Schema: grupo08; Owner: grupo08; Tablespace: 
--

CREATE TABLE profesor (
    rut integer NOT NULL,
    user_id integer NOT NULL
);


ALTER TABLE grupo08.profesor OWNER TO grupo08;

--
-- TOC entry 2484 (class 0 OID 0)
-- Dependencies: 361
-- Name: COLUMN profesor.rut; Type: COMMENT; Schema: grupo08; Owner: grupo08
--

COMMENT ON COLUMN profesor.rut IS 'Rut del usuario, sirve como identificador para el login tambien';


--
-- TOC entry 363 (class 1259 OID 1539732)
-- Dependencies: 15
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
    id_categoria integer NOT NULL,
    estudiante_rut integer NOT NULL,
    profesor_guia_rut integer NOT NULL
);


ALTER TABLE grupo08.tesis OWNER TO grupo08;

--
-- TOC entry 2485 (class 0 OID 0)
-- Dependencies: 363
-- Name: COLUMN tesis.titulo; Type: COMMENT; Schema: grupo08; Owner: grupo08
--

COMMENT ON COLUMN tesis.titulo IS 'Nombre del trabajo de titulo';


--
-- TOC entry 2486 (class 0 OID 0)
-- Dependencies: 363
-- Name: COLUMN tesis.abstract; Type: COMMENT; Schema: grupo08; Owner: grupo08
--

COMMENT ON COLUMN tesis.abstract IS 'Resumen del trabajo de titulo';


--
-- TOC entry 2487 (class 0 OID 0)
-- Dependencies: 363
-- Name: COLUMN tesis.fecha_evaluacion; Type: COMMENT; Schema: grupo08; Owner: grupo08
--

COMMENT ON COLUMN tesis.fecha_evaluacion IS 'Fecha/hora en que la comision evalua el trabajo de titulo';


--
-- TOC entry 2488 (class 0 OID 0)
-- Dependencies: 363
-- Name: COLUMN tesis.fecha_publicacion; Type: COMMENT; Schema: grupo08; Owner: grupo08
--

COMMENT ON COLUMN tesis.fecha_publicacion IS 'Fecha en que el trabajo de titulo es entregado a la universidad, puede ser nula ya que el sistema permite agregar trabajos de titulos antes de su entrega (e.g: Al tomar TT1 o en el transcurso de este)';


--
-- TOC entry 2489 (class 0 OID 0)
-- Dependencies: 363
-- Name: COLUMN tesis.ubicacion_fichero; Type: COMMENT; Schema: grupo08; Owner: grupo08
--

COMMENT ON COLUMN tesis.ubicacion_fichero IS 'Ubicacion del fichero descargable del trabajo de titulo';


--
-- TOC entry 2490 (class 0 OID 0)
-- Dependencies: 363
-- Name: COLUMN tesis.feha_disponibilidad; Type: COMMENT; Schema: grupo08; Owner: grupo08
--

COMMENT ON COLUMN tesis.feha_disponibilidad IS 'Fecha en que el TT puede ser mostrado públicamente';


--
-- TOC entry 2491 (class 0 OID 0)
-- Dependencies: 363
-- Name: COLUMN tesis.id_categoria; Type: COMMENT; Schema: grupo08; Owner: grupo08
--

COMMENT ON COLUMN tesis.id_categoria IS 'Identifica a que categoria pertenece el trabajo de titulo';


--
-- TOC entry 2492 (class 0 OID 0)
-- Dependencies: 363
-- Name: COLUMN tesis.estudiante_rut; Type: COMMENT; Schema: grupo08; Owner: grupo08
--

COMMENT ON COLUMN tesis.estudiante_rut IS 'Identifica al estudiante que realiza el trabajo de titulo';


--
-- TOC entry 2493 (class 0 OID 0)
-- Dependencies: 363
-- Name: COLUMN tesis.profesor_guia_rut; Type: COMMENT; Schema: grupo08; Owner: grupo08
--

COMMENT ON COLUMN tesis.profesor_guia_rut IS 'Identifica al profesor guia de este trabajod de titulo';


--
-- TOC entry 362 (class 1259 OID 1539730)
-- Dependencies: 363 15
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
-- TOC entry 2494 (class 0 OID 0)
-- Dependencies: 362
-- Name: tesis_id_seq; Type: SEQUENCE OWNED BY; Schema: grupo08; Owner: grupo08
--

ALTER SEQUENCE tesis_id_seq OWNED BY tesis.id;


--
-- TOC entry 365 (class 1259 OID 1539743)
-- Dependencies: 15
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
-- TOC entry 367 (class 1259 OID 1539754)
-- Dependencies: 15
-- Name: users_groups; Type: TABLE; Schema: grupo08; Owner: grupo08; Tablespace: 
--

CREATE TABLE users_groups (
    id integer NOT NULL,
    user_id integer NOT NULL,
    group_id integer NOT NULL
);


ALTER TABLE grupo08.users_groups OWNER TO grupo08;

--
-- TOC entry 366 (class 1259 OID 1539752)
-- Dependencies: 15 367
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
-- TOC entry 2495 (class 0 OID 0)
-- Dependencies: 366
-- Name: users_groups_id_seq; Type: SEQUENCE OWNED BY; Schema: grupo08; Owner: grupo08
--

ALTER SEQUENCE users_groups_id_seq OWNED BY users_groups.id;


--
-- TOC entry 364 (class 1259 OID 1539741)
-- Dependencies: 15 365
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
-- TOC entry 2496 (class 0 OID 0)
-- Dependencies: 364
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: grupo08; Owner: grupo08
--

ALTER SEQUENCE users_id_seq OWNED BY users.id;


--
-- TOC entry 2333 (class 2604 OID 1539668)
-- Dependencies: 352 353 353
-- Name: id; Type: DEFAULT; Schema: grupo08; Owner: grupo08
--

ALTER TABLE ONLY categoria ALTER COLUMN id SET DEFAULT nextval('categoria_id_seq'::regclass);


--
-- TOC entry 2334 (class 2604 OID 1539692)
-- Dependencies: 355 356 356
-- Name: id; Type: DEFAULT; Schema: grupo08; Owner: grupo08
--

ALTER TABLE ONLY facultad ALTER COLUMN id SET DEFAULT nextval('facultad_id_seq'::regclass);


--
-- TOC entry 2335 (class 2604 OID 1539703)
-- Dependencies: 358 357 358
-- Name: id; Type: DEFAULT; Schema: grupo08; Owner: grupo08
--

ALTER TABLE ONLY groups ALTER COLUMN id SET DEFAULT nextval('groups_id_seq'::regclass);


--
-- TOC entry 2336 (class 2604 OID 1539711)
-- Dependencies: 360 359 360
-- Name: id; Type: DEFAULT; Schema: grupo08; Owner: grupo08
--

ALTER TABLE ONLY login_attempts ALTER COLUMN id SET DEFAULT nextval('login_attempts_id_seq'::regclass);


--
-- TOC entry 2337 (class 2604 OID 1539735)
-- Dependencies: 362 363 363
-- Name: id; Type: DEFAULT; Schema: grupo08; Owner: grupo08
--

ALTER TABLE ONLY tesis ALTER COLUMN id SET DEFAULT nextval('tesis_id_seq'::regclass);


--
-- TOC entry 2338 (class 2604 OID 1539746)
-- Dependencies: 365 364 365
-- Name: id; Type: DEFAULT; Schema: grupo08; Owner: grupo08
--

ALTER TABLE ONLY users ALTER COLUMN id SET DEFAULT nextval('users_id_seq'::regclass);


--
-- TOC entry 2339 (class 2604 OID 1539757)
-- Dependencies: 367 366 367
-- Name: id; Type: DEFAULT; Schema: grupo08; Owner: grupo08
--

ALTER TABLE ONLY users_groups ALTER COLUMN id SET DEFAULT nextval('users_groups_id_seq'::regclass);


--
-- TOC entry 2341 (class 2606 OID 1539662)
-- Dependencies: 351 351 2471
-- Name: carrera_pkey; Type: CONSTRAINT; Schema: grupo08; Owner: grupo08; Tablespace: 
--

ALTER TABLE ONLY carrera
    ADD CONSTRAINT carrera_pkey PRIMARY KEY (codigo);


--
-- TOC entry 2343 (class 2606 OID 1539673)
-- Dependencies: 353 353 2471
-- Name: categoria_pkey; Type: CONSTRAINT; Schema: grupo08; Owner: grupo08; Tablespace: 
--

ALTER TABLE ONLY categoria
    ADD CONSTRAINT categoria_pkey PRIMARY KEY (id);


--
-- TOC entry 2345 (class 2606 OID 1539686)
-- Dependencies: 354 354 2471
-- Name: estudiante_pkey; Type: CONSTRAINT; Schema: grupo08; Owner: grupo08; Tablespace: 
--

ALTER TABLE ONLY estudiante
    ADD CONSTRAINT estudiante_pkey PRIMARY KEY (rut);


--
-- TOC entry 2347 (class 2606 OID 1539697)
-- Dependencies: 356 356 2471
-- Name: facultad_pkey; Type: CONSTRAINT; Schema: grupo08; Owner: grupo08; Tablespace: 
--

ALTER TABLE ONLY facultad
    ADD CONSTRAINT facultad_pkey PRIMARY KEY (id);


--
-- TOC entry 2349 (class 2606 OID 1539705)
-- Dependencies: 358 358 2471
-- Name: groups_pkey; Type: CONSTRAINT; Schema: grupo08; Owner: grupo08; Tablespace: 
--

ALTER TABLE ONLY groups
    ADD CONSTRAINT groups_pkey PRIMARY KEY (id);


--
-- TOC entry 2351 (class 2606 OID 1539716)
-- Dependencies: 360 360 2471
-- Name: login_attempts_pkey; Type: CONSTRAINT; Schema: grupo08; Owner: grupo08; Tablespace: 
--

ALTER TABLE ONLY login_attempts
    ADD CONSTRAINT login_attempts_pkey PRIMARY KEY (id);


--
-- TOC entry 2353 (class 2606 OID 1539721)
-- Dependencies: 361 361 2471
-- Name: profesor_pkey; Type: CONSTRAINT; Schema: grupo08; Owner: grupo08; Tablespace: 
--

ALTER TABLE ONLY profesor
    ADD CONSTRAINT profesor_pkey PRIMARY KEY (rut);


--
-- TOC entry 2355 (class 2606 OID 1539740)
-- Dependencies: 363 363 2471
-- Name: tesis_pkey; Type: CONSTRAINT; Schema: grupo08; Owner: grupo08; Tablespace: 
--

ALTER TABLE ONLY tesis
    ADD CONSTRAINT tesis_pkey PRIMARY KEY (id);


--
-- TOC entry 2360 (class 2606 OID 1539759)
-- Dependencies: 367 367 2471
-- Name: users_groups_pkey; Type: CONSTRAINT; Schema: grupo08; Owner: grupo08; Tablespace: 
--

ALTER TABLE ONLY users_groups
    ADD CONSTRAINT users_groups_pkey PRIMARY KEY (id);


--
-- TOC entry 2357 (class 2606 OID 1539751)
-- Dependencies: 365 365 2471
-- Name: users_pkey; Type: CONSTRAINT; Schema: grupo08; Owner: grupo08; Tablespace: 
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- TOC entry 2358 (class 1259 OID 1539815)
-- Dependencies: 367 367 2471
-- Name: uc_users_groups; Type: INDEX; Schema: grupo08; Owner: grupo08; Tablespace: 
--

CREATE UNIQUE INDEX uc_users_groups ON users_groups USING btree (user_id, group_id);


--
-- TOC entry 2363 (class 2606 OID 1539760)
-- Dependencies: 354 2340 351 2471
-- Name: carrera_estudiante_fk; Type: FK CONSTRAINT; Schema: grupo08; Owner: grupo08
--

ALTER TABLE ONLY estudiante
    ADD CONSTRAINT carrera_estudiante_fk FOREIGN KEY (codigo_carrera) REFERENCES carrera(codigo);


--
-- TOC entry 2366 (class 2606 OID 1539765)
-- Dependencies: 363 2342 353 2471
-- Name: categoria_tesis_fk; Type: FK CONSTRAINT; Schema: grupo08; Owner: grupo08
--

ALTER TABLE ONLY tesis
    ADD CONSTRAINT categoria_tesis_fk FOREIGN KEY (id_categoria) REFERENCES categoria(id);


--
-- TOC entry 2367 (class 2606 OID 1539775)
-- Dependencies: 2344 363 354 2471
-- Name: estudiante_tesis_fk; Type: FK CONSTRAINT; Schema: grupo08; Owner: grupo08
--

ALTER TABLE ONLY tesis
    ADD CONSTRAINT estudiante_tesis_fk FOREIGN KEY (estudiante_rut) REFERENCES estudiante(rut);


--
-- TOC entry 2364 (class 2606 OID 1539805)
-- Dependencies: 2356 354 365 2471
-- Name: estudiante_user_id_fkey; Type: FK CONSTRAINT; Schema: grupo08; Owner: grupo08
--

ALTER TABLE ONLY estudiante
    ADD CONSTRAINT estudiante_user_id_fkey FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2361 (class 2606 OID 1539780)
-- Dependencies: 351 2346 356 2471
-- Name: facultad_carrera_fk; Type: FK CONSTRAINT; Schema: grupo08; Owner: grupo08
--

ALTER TABLE ONLY carrera
    ADD CONSTRAINT facultad_carrera_fk FOREIGN KEY (id_facultad) REFERENCES facultad(id);


--
-- TOC entry 2362 (class 2606 OID 1539785)
-- Dependencies: 353 356 2346 2471
-- Name: facultad_categoria_fk; Type: FK CONSTRAINT; Schema: grupo08; Owner: grupo08
--

ALTER TABLE ONLY categoria
    ADD CONSTRAINT facultad_categoria_fk FOREIGN KEY (id_facultad) REFERENCES facultad(id);


--
-- TOC entry 2368 (class 2606 OID 1539795)
-- Dependencies: 2352 361 363 2471
-- Name: profesor_tesis_fk; Type: FK CONSTRAINT; Schema: grupo08; Owner: grupo08
--

ALTER TABLE ONLY tesis
    ADD CONSTRAINT profesor_tesis_fk FOREIGN KEY (profesor_guia_rut) REFERENCES profesor(rut);


--
-- TOC entry 2365 (class 2606 OID 1539810)
-- Dependencies: 361 2356 365 2471
-- Name: profesor_user_id_fkey; Type: FK CONSTRAINT; Schema: grupo08; Owner: grupo08
--

ALTER TABLE ONLY profesor
    ADD CONSTRAINT profesor_user_id_fkey FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


-- Completed on 2014-01-03 15:48:16 CLST

--
-- PostgreSQL database dump complete
--

