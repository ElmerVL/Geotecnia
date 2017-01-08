-- -------------------------------------------------------------------------
-- PostgreSQL SQL create tables
-- exported at Sun Oct 02 22:02:01 CDT 2016 with easyDesigner
-- -------------------------------------------------------------------------

-- -------------------------------------------------------------------------
-- Table: usuario
-- -------------------------------------------------------------------------
CREATE TABLE public.usuario
(
    idusuario bigint NOT NULL DEFAULT nextval('usuario_idusuario_seq'::regclass),
    login character varying(255) COLLATE "default".pg_catalog NOT NULL,
    password character varying(255) COLLATE "default".pg_catalog NOT NULL,
    habilitado boolean NOT NULL,
    nombre character varying(255) COLLATE "default".pg_catalog NOT NULL,
    apellido character varying(255) COLLATE "default".pg_catalog NOT NULL,
    CONSTRAINT usuario_pkey PRIMARY KEY (idusuario)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.usuario
    OWNER to postgres;
-- -------------------------------------------------------------------------
-- Table: tecnico
-- -------------------------------------------------------------------------
CREATE TABLE public.solicitud_usuario
(
    solicitud_idsolicitud integer NOT NULL,
    usuario_idusuario integer NOT NULL,
    CONSTRAINT solicitud_usuario_pkey PRIMARY KEY (solicitud_idsolicitud, usuario_idusuario),
    CONSTRAINT solicitud_usuario_solicitud_idsolicitud_fkey FOREIGN KEY (solicitud_idsolicitud)
        REFERENCES public.solicitud (idsolicitud) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT solicitud_usuario_usuario_idusuario_fkey FOREIGN KEY (usuario_idusuario)
        REFERENCES public.usuario (idusuario) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.solicitud_usuario
    OWNER to postgres;
-- -------------------------------------------------------------------------
-- Table: auxiliar
-- -------------------------------------------------------------------------
CREATE TABLE public.auxiliar
(
    usuario_idusuario integer NOT NULL,
    CONSTRAINT auxiliar_pkey PRIMARY KEY (usuario_idusuario),
    CONSTRAINT auxiliar_usuario_idusuario_fkey FOREIGN KEY (usuario_idusuario)
        REFERENCES public.usuario (idusuario) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.auxiliar
    OWNER to postgres;
-- -------------------------------------------------------------------------
-- Table: director
-- -------------------------------------------------------------------------
CREATE TABLE public.director
(
    usuario_idusuario integer NOT NULL,
    encurso boolean NOT NULL,
    CONSTRAINT director_pkey PRIMARY KEY (usuario_idusuario),
    CONSTRAINT director_usuario_idusuario_fkey FOREIGN KEY (usuario_idusuario)
        REFERENCES public.usuario (idusuario) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.director
    OWNER to postgres;
-- -------------------------------------------------------------------------
-- Table: contador
-- -------------------------------------------------------------------------
CREATE TABLE public.contador
(
    usuario_idusuario integer NOT NULL,
    CONSTRAINT contador_pkey PRIMARY KEY (usuario_idusuario),
    CONSTRAINT contador_usuario_idusuario_fkey FOREIGN KEY (usuario_idusuario)
        REFERENCES public.usuario (idusuario) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.contador
    OWNER to postgres;
-- -------------------------------------------------------------------------
-- Table: ingeniero
-- -------------------------------------------------------------------------
CREATE TABLE public.ingeniero
(
    usuario_idusuario integer NOT NULL,
    cargo character varying(255) COLLATE "default".pg_catalog NOT NULL,
    CONSTRAINT ingeniero_pkey PRIMARY KEY (usuario_idusuario),
    CONSTRAINT ingeniero_usuario_idusuario_fkey FOREIGN KEY (usuario_idusuario)
        REFERENCES public.usuario (idusuario) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.ingeniero
    OWNER to postgres;
-- -------------------------------------------------------------------------
-- Table: usuario_rol
-- -------------------------------------------------------------------------
CREATE TABLE public.usuario_rol
(
    usuario_idusuario integer NOT NULL,
    rol_idrol integer NOT NULL,
    CONSTRAINT usuario_rol_pkey PRIMARY KEY (rol_idrol, usuario_idusuario),
    CONSTRAINT usuario_rol_rol_idrol_fkey FOREIGN KEY (rol_idrol)
        REFERENCES public.rol (idrol) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT usuario_rol_usuario_idusuario_fkey FOREIGN KEY (usuario_idusuario)
        REFERENCES public.usuario (idusuario) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.usuario_rol
    OWNER to postgres;
-- -------------------------------------------------------------------------
-- Table: rol
-- -------------------------------------------------------------------------
CREATE TABLE public.rol
(
    idrol bigint NOT NULL DEFAULT nextval('rol_idrol_seq'::regclass),
    descripcion character varying(255) COLLATE "default".pg_catalog NOT NULL,
    CONSTRAINT rol_pkey PRIMARY KEY (idrol)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.rol
    OWNER to postgres;
-- -------------------------------------------------------------------------
-- Table: solicitud_usuario
-- -------------------------------------------------------------------------
CREATE TABLE public.solicitud_usuario
(
    solicitud_idsolicitud integer NOT NULL,
    usuario_idusuario integer NOT NULL,
    CONSTRAINT solicitud_usuario_pkey PRIMARY KEY (solicitud_idsolicitud, usuario_idusuario),
    CONSTRAINT solicitud_usuario_solicitud_idsolicitud_fkey FOREIGN KEY (solicitud_idsolicitud)
        REFERENCES public.solicitud (idsolicitud) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT solicitud_usuario_usuario_idusuario_fkey FOREIGN KEY (usuario_idusuario)
        REFERENCES public.usuario (idusuario) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.solicitud_usuario
    OWNER to postgres;
-- -------------------------------------------------------------------------
-- Table: solicitud
-- -------------------------------------------------------------------------
CREATE TABLE public.solicitud
(
    idsolicitud bigint NOT NULL DEFAULT nextval('solicitud_idsolicitud_seq'::regclass),
    nombre character varying(255) COLLATE "default".pg_catalog NOT NULL,
    fecha date NOT NULL,
    ubicacion character varying(255) COLLATE "default".pg_catalog NOT NULL,
    tipo character varying(255) COLLATE "default".pg_catalog NOT NULL,
    codigo character varying(255) COLLATE "default".pg_catalog NOT NULL,
    codigo_proyecto character varying(255) COLLATE "default".pg_catalog NOT NULL,
    habilitado boolean NOT NULL,
    responsable character varying(255) COLLATE "default".pg_catalog NOT NULL,
    informe_entregado boolean NOT NULL,
    informe_aprobado boolean NOT NULL,
    registro_cliente boolean NOT NULL,
    registro_pago boolean NOT NULL,
    CONSTRAINT solicitud_pkey PRIMARY KEY (idsolicitud)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.solicitud
    OWNER to postgres;
-- -------------------------------------------------------------------------
-- Table: solicitud_pago
-- -------------------------------------------------------------------------
CREATE TABLE public.solicitud_pago
(
    pago_idpago integer NOT NULL,
    solicitud_idsolicitud integer NOT NULL,
    porcentaje_anticipo integer NOT NULL,
    anticipo_pagado boolean NOT NULL,
    porcentaje_saldo integer NOT NULL,
    saldo_pagado boolean NOT NULL,
    CONSTRAINT solicitud_pago_pkey PRIMARY KEY (pago_idpago, solicitud_idsolicitud),
    CONSTRAINT solicitud_pago_pago_idpago_fkey FOREIGN KEY (pago_idpago)
        REFERENCES public.pago (idpago) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT solicitud_pago_solicitud_idsolicitud_fkey FOREIGN KEY (solicitud_idsolicitud)
        REFERENCES public.solicitud (idsolicitud) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.solicitud_pago
    OWNER to postgres;
-- -------------------------------------------------------------------------
-- Table: pago
-- -------------------------------------------------------------------------
CREATE TABLE public.pago
(
    idpago bigint NOT NULL DEFAULT nextval('pago_idpago_seq'::regclass),
    numero_pago integer NOT NULL,
    numero_factura integer NOT NULL,
    porcentaje_pago integer NOT NULL,
    monto_pago integer NOT NULL,
    CONSTRAINT pago_pkey PRIMARY KEY (idpago)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.pago
    OWNER to postgres;
-- -------------------------------------------------------------------------
-- Table: resultado
-- -------------------------------------------------------------------------
CREATE TABLE public.resultado
(
    idresultado bigint NOT NULL DEFAULT nextval('resultado_idresultado_seq'::regclass),
    solicitud_idsolicitud integer NOT NULL,
    nombre_archivo character varying(255) COLLATE "default".pg_catalog NOT NULL,
    descripcion character varying(255) COLLATE "default".pg_catalog,
    informe_final boolean NOT NULL,
    resultado_proyecto boolean NOT NULL,
    CONSTRAINT resultado_pkey PRIMARY KEY (idresultado, solicitud_idsolicitud),
    CONSTRAINT resultado_solicitud_idsolicitud_fkey FOREIGN KEY (solicitud_idsolicitud)
        REFERENCES public.solicitud (idsolicitud) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.resultado
    OWNER to postgres;-- -------------------------------------------------------------------------
-- Table: trabajo_campo
-- -------------------------------------------------------------------------
CREATE TABLE public.trabajo_campo
(
    solicitud_idsolicitud integer NOT NULL,
    alcance_creado boolean NOT NULL,
    alcance_aprobado boolean NOT NULL,
    CONSTRAINT trabajo_campo_pkey PRIMARY KEY (solicitud_idsolicitud),
    CONSTRAINT trabajo_campo_solicitud_idsolicitud_fkey FOREIGN KEY (solicitud_idsolicitud)
        REFERENCES public.solicitud (idsolicitud) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.trabajo_campo
    OWNER to postgres;
-- -------------------------------------------------------------------------
-- Table: ensayo_laboratorio
-- -------------------------------------------------------------------------
CREATE TABLE public.ensayo_laboratorio
(
    solicitud_idsolicitud integer NOT NULL,
    muestra_registrada boolean NOT NULL,
    ensayo_registrado boolean NOT NULL,
    CONSTRAINT ensayo_laboratorio_pkey PRIMARY KEY (solicitud_idsolicitud),
    CONSTRAINT ensayo_laboratorio_solicitud_idsolicitud_fkey FOREIGN KEY (solicitud_idsolicitud)
        REFERENCES public.solicitud (idsolicitud) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.ensayo_laboratorio
    OWNER to postgres;
-- -------------------------------------------------------------------------
-- Table: alcance
-- -------------------------------------------------------------------------
CREATE TABLE public.alcance
(
    idalcance bigint NOT NULL DEFAULT nextval('alcance_idalcance_seq'::regclass),
    trabajo_campo_solicitud_idsolicitud integer NOT NULL,
    antecedente character varying(255) COLLATE "default".pg_catalog NOT NULL,
    objetivo character varying(255) COLLATE "default".pg_catalog NOT NULL,
    trabajo_campo character varying(255) COLLATE "default".pg_catalog NOT NULL,
    trabajo_gabinete character varying(255) COLLATE "default".pg_catalog NOT NULL,
    trabajo_laboratorio character varying(255) COLLATE "default".pg_catalog NOT NULL,
    duracion integer NOT NULL,
    precio numeric NOT NULL,
    forma_pago character varying(255) COLLATE "default".pg_catalog NOT NULL,
    requerimiento_adicional character varying(255) COLLATE "default".pg_catalog NOT NULL,
    observacion character varying(255) COLLATE "default".pg_catalog NOT NULL,
    conobservacion boolean NOT NULL,
    CONSTRAINT alcance_pkey PRIMARY KEY (idalcance, trabajo_campo_solicitud_idsolicitud),
    CONSTRAINT alcance_trabajo_campo_solicitud_idsolicitud_fkey FOREIGN KEY (trabajo_campo_solicitud_idsolicitud)
        REFERENCES public.trabajo_campo (solicitud_idsolicitud) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.alcance
    OWNER to postgres;
-- -------------------------------------------------------------------------
-- Table: formulario_tc
-- -------------------------------------------------------------------------
CREATE TABLE public.formulario_tc
(
    cliente_idcliente integer NOT NULL,
    trabajo_campo_solicitud_idsolicitud integer NOT NULL,
    formulario_registrado boolean NOT NULL,
    CONSTRAINT formulario_tc_pkey PRIMARY KEY (cliente_idcliente, trabajo_campo_solicitud_idsolicitud),
    CONSTRAINT formulario_tc_cliente_idcliente_fkey FOREIGN KEY (cliente_idcliente)
        REFERENCES public.cliente (idcliente) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT formulario_tc_trabajo_campo_solicitud_idsolicitud_fkey FOREIGN KEY (trabajo_campo_solicitud_idsolicitud)
        REFERENCES public.trabajo_campo (solicitud_idsolicitud) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.formulario_tc
    OWNER to postgres;
-- -------------------------------------------------------------------------
-- Table: cliente
-- -------------------------------------------------------------------------
CREATE TABLE public.cliente
(
    idcliente bigint NOT NULL DEFAULT nextval('cliente_idcliente_seq'::regclass),
    nombre_factura character varying(255) COLLATE "default".pg_catalog NOT NULL,
    nit_ci bigint NOT NULL,
    nombre_contacto character varying(255) COLLATE "default".pg_catalog NOT NULL,
    telefono_fijo integer NOT NULL,
    telefono_celular integer NOT NULL,
    direccion_fiscal character varying(255) COLLATE "default".pg_catalog NOT NULL,
    correo character varying(255) COLLATE "default".pg_catalog NOT NULL,
    tipo character varying(255) COLLATE "default".pg_catalog NOT NULL,
    ci_contacto character varying(255) COLLATE "default".pg_catalog NOT NULL,
    CONSTRAINT cliente_pkey PRIMARY KEY (idcliente)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.cliente
    OWNER to postgres;
-- -------------------------------------------------------------------------
-- Table: formulario_el
-- -------------------------------------------------------------------------
CREATE TABLE public.formulario_el
(
    cliente_idcliente integer NOT NULL,
    ensayo_laboratorio_solicitud_idsolicitud integer NOT NULL,
    formulario_registrado boolean NOT NULL,
    CONSTRAINT formulario_el_pkey PRIMARY KEY (cliente_idcliente, ensayo_laboratorio_solicitud_idsolicitud),
    CONSTRAINT formulario_el_cliente_idcliente_fkey FOREIGN KEY (cliente_idcliente)
        REFERENCES public.cliente (idcliente) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT formulario_el_ensayo_laboratorio_solicitud_idsolicitud_fkey FOREIGN KEY (ensayo_laboratorio_solicitud_idsolicitud)
        REFERENCES public.ensayo_laboratorio (solicitud_idsolicitud) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.formulario_el
    OWNER to postgres;
-- -------------------------------------------------------------------------
-- Table: detalle_ensayo
-- -------------------------------------------------------------------------
CREATE TABLE public.detalle_ensayo
(
    ensayo_idensayo integer NOT NULL,
    ensayo_laboratorio_solicitud_idsolicitud integer NOT NULL,
    cantidad_ensayo integer NOT NULL,
    precio_total numeric NOT NULL,
    precio_unitario numeric NOT NULL,
    tiempo_total integer NOT NULL,
    tiempo_unidad integer NOT NULL,
    CONSTRAINT detalle_ensayo_pkey PRIMARY KEY (ensayo_idensayo, ensayo_laboratorio_solicitud_idsolicitud),
    CONSTRAINT detalle_ensayo_ensayo_idensayo_fkey FOREIGN KEY (ensayo_idensayo)
        REFERENCES public.ensayo (idensayo) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT detalle_ensayo_ensayo_laboratorio_solicitud_idsolicitud_fkey FOREIGN KEY (ensayo_laboratorio_solicitud_idsolicitud)
        REFERENCES public.ensayo_laboratorio (solicitud_idsolicitud) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.detalle_ensayo
    OWNER to postgres;
-- -------------------------------------------------------------------------
-- Table: ensayo
-- -------------------------------------------------------------------------
CREATE TABLE public.ensayo
(
    idensayo bigint NOT NULL DEFAULT nextval('ensayo_idensayo_seq'::regclass),
    codigo character varying(255) COLLATE "default".pg_catalog NOT NULL,
    tipo character varying(255) COLLATE "default".pg_catalog NOT NULL,
    categoria character varying(255) COLLATE "default".pg_catalog NOT NULL,
    descripcion character varying(255) COLLATE "default".pg_catalog NOT NULL,
    unidad character varying(255) COLLATE "default".pg_catalog NOT NULL,
    precio_unitario numeric NOT NULL,
    precio_dies_muestra numeric NOT NULL,
    duracion integer,
    CONSTRAINT ensayo_pkey PRIMARY KEY (idensayo)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.ensayo
    OWNER to postgres;
-- -------------------------------------------------------------------------
-- Table: muestra
-- -------------------------------------------------------------------------
CREATE TABLE public.muestra
(
    idmuestra bigint NOT NULL DEFAULT nextval('muestra_idmuestra_seq'::regclass),
    ensayo_laboratorio_solicitud_idsolicitud integer NOT NULL,
    ubicacion_general character varying(255) COLLATE "default".pg_catalog NOT NULL,
    ubicacion_especifica character varying(255) COLLATE "default".pg_catalog NOT NULL,
    profundidad numeric NOT NULL,
    fecha_toma_muestra date NOT NULL,
    metodo_extraccion character varying(255) COLLATE "default".pg_catalog NOT NULL,
    punto character varying(255) COLLATE "default".pg_catalog NOT NULL,
    tipo character varying(255) COLLATE "default".pg_catalog NOT NULL,
    descripcion character varying(255) COLLATE "default".pg_catalog NOT NULL,
    codigo character varying(255) COLLATE "default".pg_catalog NOT NULL,
    CONSTRAINT muestra_pkey PRIMARY KEY (ensayo_laboratorio_solicitud_idsolicitud, idmuestra),
    CONSTRAINT muestra_ensayo_laboratorio_solicitud_idsolicitud_fkey FOREIGN KEY (ensayo_laboratorio_solicitud_idsolicitud)
        REFERENCES public.ensayo_laboratorio (solicitud_idsolicitud) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.muestra
    OWNER to postgres;
-- -------------------------------------------------------------------------
-- Table: calendario
-- -------------------------------------------------------------------------
CREATE TABLE public.calendario
(
    idcalendario bigint NOT NULL DEFAULT nextval('calendario_idcalendario_seq'::regclass),
    solicitud_idsolicitud integer NOT NULL,
    fecha_inicial date NOT NULL,
    fecha_final date NOT NULL,
    CONSTRAINT calendario_pkey PRIMARY KEY (idcalendario, solicitud_idsolicitud),
    CONSTRAINT calendario_solicitud_idsolicitud_fkey FOREIGN KEY (solicitud_idsolicitud)
        REFERENCES public.solicitud (idsolicitud) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.calendario
    OWNER to postgres;
-- -------------------------------------------------------------------------
-- Table: bitacora
-- -------------------------------------------------------------------------
CREATE TABLE public.bitacora
(
    idbitacora bigint NOT NULL DEFAULT nextval('bitacora_idbitacora_seq'::regclass),
    solicitud_idsolicitud integer NOT NULL,
    actividad character varying(255) COLLATE "default".pg_catalog NOT NULL,
    fecha_bitacora date NOT NULL,
    CONSTRAINT bitacora_pkey PRIMARY KEY (idbitacora, solicitud_idsolicitud),
    CONSTRAINT bitacora_solicitud_idsolicitud_fkey FOREIGN KEY (solicitud_idsolicitud)
        REFERENCES public.solicitud (idsolicitud) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.bitacora
    OWNER to postgres;