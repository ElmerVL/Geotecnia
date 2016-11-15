-- -------------------------------------------------------------------------
-- PostgreSQL SQL create tables
-- exported at Sun Oct 02 22:02:01 CDT 2016 with easyDesigner
-- -------------------------------------------------------------------------

-- -------------------------------------------------------------------------
-- Table: usuario
-- -------------------------------------------------------------------------
CREATE TABLE "usuario" (
  "idusuario" bigserial NOT NULL,
  "login" VARCHAR(255) NOT NULL,
  "password" VARCHAR(255) NOT NULL,
  "habilitado" BOOLEAN NOT NULL,
  "nombre" VARCHAR(255) NOT NULL,
  "apellido" VARCHAR(255) NOT NULL,
  PRIMARY KEY ("idusuario")
);

-- -------------------------------------------------------------------------
-- Table: tecnico
-- -------------------------------------------------------------------------
CREATE TABLE "tecnico" (
  "usuario_idusuario" INTEGER NOT NULL,
  PRIMARY KEY ("usuario_idusuario")
);

-- -------------------------------------------------------------------------
-- Table: auxiliar
-- -------------------------------------------------------------------------
CREATE TABLE "auxiliar" (
  "usuario_idusuario" INTEGER NOT NULL,
  PRIMARY KEY ("usuario_idusuario")
);

-- -------------------------------------------------------------------------
-- Table: director
-- -------------------------------------------------------------------------
CREATE TABLE "director" (
  "usuario_idusuario" INTEGER NOT NULL,
  "encurso" BOOLEAN NOT NULL,
  PRIMARY KEY ("usuario_idusuario")
);

-- -------------------------------------------------------------------------
-- Table: contador
-- -------------------------------------------------------------------------
CREATE TABLE "contador" (
  "usuario_idusuario" INTEGER NOT NULL,
  PRIMARY KEY ("usuario_idusuario")
);

-- -------------------------------------------------------------------------
-- Table: ingeniero
-- -------------------------------------------------------------------------
CREATE TABLE "ingeniero" (
  "usuario_idusuario" INTEGER NOT NULL,
  "cargo" VARCHAR(255) NOT NULL,
  PRIMARY KEY ("usuario_idusuario")
);

-- -------------------------------------------------------------------------
-- Table: usuario_rol
-- -------------------------------------------------------------------------
CREATE TABLE "usuario_rol" (
  "usuario_idusuario" INTEGER NOT NULL,
  "rol_idrol" INTEGER NOT NULL,
  PRIMARY KEY ("usuario_idusuario", "rol_idrol")
);

-- -------------------------------------------------------------------------
-- Table: rol
-- -------------------------------------------------------------------------
CREATE TABLE "rol" (
  "idrol" bigserial NOT NULL,
  "descripcion" VARCHAR(255) NOT NULL,
  PRIMARY KEY ("idrol")
);

-- -------------------------------------------------------------------------
-- Table: solicitud_usuario
-- -------------------------------------------------------------------------
CREATE TABLE "solicitud_usuario" (
  "solicitud_idsolicitud" INTEGER NOT NULL,
  "usuario_idusuario" INTEGER NOT NULL,
  PRIMARY KEY ("solicitud_idsolicitud", "usuario_idusuario")
);

-- -------------------------------------------------------------------------
-- Table: solicitud
-- -------------------------------------------------------------------------
CREATE TABLE "solicitud" (
  "idsolicitud" bigserial NOT NULL,
  "nombre" VARCHAR(255) NOT NULL,
  "fecha" DATE NOT NULL,
  "ubicacion" VARCHAR(255) NOT NULL,
  "tipo" VARCHAR(255) NOT NULL,
  "codigo" VARCHAR(255) NOT NULL,
  "codigo_proyecto" VARCHAR(255) NOT NULL,	
  "habilitado" BOOLEAN NOT NULL,
  "responsable" VARCHAR(255) NOT NULL,
  "informe_entregado" BOOLEAN NOT NULL,
  "informe_aprobado" BOOLEAN  NOT NULL,
  "registro_cliente" BOOLEAN NOT NULL,
  "registro_pago" BOOLEAN  NOT NULL,
  PRIMARY KEY ("idsolicitud")
);

-- -------------------------------------------------------------------------
-- Table: solicitud_pago
-- -------------------------------------------------------------------------
CREATE TABLE "solicitud_pago" (
  "pago_idpago" INTEGER NOT NULL,
  "solicitud_idsolicitud" INTEGER NOT NULL,
  "porcentaje_anticipo" INTEGER NOT NULL,
  "anticipo_pagado" BOOLEAN NOT NULL,
  "porcentaje_saldo" INTEGER NOT NULL,
  "saldo_pagado" BOOLEAN NOT NULL,
  PRIMARY KEY ("pago_idpago", "solicitud_idsolicitud")
);

-- -------------------------------------------------------------------------
-- Table: pago
-- -------------------------------------------------------------------------
CREATE TABLE "pago" (
  "idpago" bigserial NOT NULL,
  "numero_pago" INTEGER NOT NULL,
  "numero_factura" INTEGER NOT NULL,
  "porcentaje_pago" INTEGER NOT NULL,
  "monto_pago" INTEGER NOT NULL,
  PRIMARY KEY ("idpago")
);

-- -------------------------------------------------------------------------
-- Table: resultado
-- -------------------------------------------------------------------------
CREATE TABLE "resultado" (
  "idresultado" bigserial NOT NULL,
  "solicitud_idsolicitud" INTEGER NOT NULL,
  "nombre_archivo" VARCHAR(255) NOT NULL,
  "descripcion" VARCHAR(255) NULL,
  "informe_final" BOOLEAN NOT NULL,
  "resultado_proyecto" BOOLEAN NOT NULL,
  PRIMARY KEY ("idresultado", "solicitud_idsolicitud")
);
-- -------------------------------------------------------------------------
-- Table: trabajo_campo
-- -------------------------------------------------------------------------
CREATE TABLE "trabajo_campo" (
  "solicitud_idsolicitud" INTEGER NOT NULL,
  "alcance_creado" BOOLEAN NOT NULL,
  "alcance_aprobado" BOOLEAN NOT NULL,
  PRIMARY KEY ("solicitud_idsolicitud")
);

-- -------------------------------------------------------------------------
-- Table: ensayo_laboratorio
-- -------------------------------------------------------------------------
CREATE TABLE "ensayo_laboratorio" (
  "solicitud_idsolicitud" INTEGER NOT NULL,
  "muestra_registrada" BOOLEAN NOT NULL,
  "ensayo_registrado" BOOLEAN NOT NULL,
  PRIMARY KEY ("solicitud_idsolicitud")
);

-- -------------------------------------------------------------------------
-- Table: alcance
-- -------------------------------------------------------------------------
CREATE TABLE "alcance" (
  "idalcance" bigserial NOT NULL,
  "trabajo_campo_solicitud_idsolicitud" INTEGER NOT NULL,
  "antecedente" VARCHAR(255) NOT NULL,
  "objetivo" VARCHAR(255) NOT NULL,
  "trabajo_campo" VARCHAR(255) NOT NULL,
  "trabajo_gabinete" VARCHAR(255) NOT NULL,
  "trabajo_laboratorio" VARCHAR(255) NOT NULL,
  "duracion" INTEGER NOT NULL,
  "precio" DECIMAL NOT NULL,
  "forma_pago" VARCHAR(255) NOT NULL,
  "requerimiento_adicional" VARCHAR(255) NOT NULL,
  "observacion" VARCHAR(255) NOT NULL,
  "conobservacion" BOOLEAN NOT NULL,
  PRIMARY KEY ("idalcance", "trabajo_campo_solicitud_idsolicitud")
);

-- -------------------------------------------------------------------------
-- Table: formulario_tc
-- -------------------------------------------------------------------------
CREATE TABLE "formulario_tc" (
  "cliente_idcliente" INTEGER NOT NULL,
  "trabajo_campo_solicitud_idsolicitud" INTEGER NOT NULL,
  "formulario_registrado" BOOLEAN NOT NULL,
  PRIMARY KEY ("cliente_idcliente", "trabajo_campo_solicitud_idsolicitud")
);

-- -------------------------------------------------------------------------
-- Table: cliente
-- -------------------------------------------------------------------------
CREATE TABLE "cliente" (
  "idcliente" bigserial NOT NULL,
  "nombre_factura" VARCHAR(255) NOT NULL,
  "nit_ci" BIGINT NOT NULL,
  "nombre_contacto" VARCHAR(255) NOT NULL,
  "telefono_fijo" INTEGER NOT NULL,
  "telefono_celular" INTEGER NOT NULL,
  "direccion_fiscal" VARCHAR(255) NOT NULL,
  "correo" VARCHAR(255) NOT NULL,
  "tipo" VARCHAR(255) NOT NULL,
  "ci_contacto" VARCHAR(255) NOT NULL,
  PRIMARY KEY ("idcliente")
);

-- -------------------------------------------------------------------------
-- Table: formulario_el
-- -------------------------------------------------------------------------
CREATE TABLE "formulario_el" (
  "cliente_idcliente" INTEGER NOT NULL,
  "ensayo_laboratorio_solicitud_idsolicitud" INTEGER NOT NULL,
  "formulario_registrado" BOOLEAN NOT NULL,
  PRIMARY KEY ("cliente_idcliente", "ensayo_laboratorio_solicitud_idsolicitud")
);

-- -------------------------------------------------------------------------
-- Table: detalle_ensayo
-- -------------------------------------------------------------------------
CREATE TABLE "detalle_ensayo" (
  "ensayo_idensayo" INTEGER NOT NULL,
  "ensayo_laboratorio_solicitud_idsolicitud" INTEGER NOT NULL,
  "cantidad_ensayo" INTEGER NOT NULL,
  "precio_total" DECIMAL NOT NULL,
  "precio_unitario" DECIMAL NOT NULL,
  "tiempo_total" INTEGER NOT NULL,
  "tiempo_unidad" INTEGER NOT NULL,
  PRIMARY KEY ("ensayo_idensayo", "ensayo_laboratorio_solicitud_idsolicitud")
);

-- -------------------------------------------------------------------------
-- Table: ensayo
-- -------------------------------------------------------------------------
CREATE TABLE "ensayo" (
  "idensayo" bigserial NOT NULL,
  "codigo" VARCHAR(255) NOT NULL,
  "tipo" VARCHAR(255) NOT NULL,
  "categoria" VARCHAR(255) NOT NULL,
  "descripcion" VARCHAR(255) NOT NULL,
  "unidad" VARCHAR(255) NOT NULL,
  "precio_unitario" DECIMAL NOT NULL,
  "precio_dies_muestra" DECIMAL NOT NULL,
  "duracion" INTEGER NULL,
  PRIMARY KEY ("idensayo")
);

-- -------------------------------------------------------------------------
-- Table: muestra
-- -------------------------------------------------------------------------
CREATE TABLE "muestra" (
  "idmuestra" bigserial NOT NULL,
  "ensayo_laboratorio_solicitud_idsolicitud" INTEGER NOT NULL,
  "ubicacion_general" VARCHAR(255) NOT NULL,
  "ubicacion_especifica" VARCHAR(255) NOT NULL,
  "profundidad" DECIMAL NOT NULL,
  "fecha_toma_muestra" DATE NOT NULL,
  "metodo_extraccion" VARCHAR(255) NOT NULL,
  "punto" INTEGER NOT NULL,
  "tipo" VARCHAR(255) NOT NULL,
  "descripcion" VARCHAR(255) NOT NULL,
  "codigo" VARCHAR(255) NOT NULL,
  PRIMARY KEY ("idmuestra", "ensayo_laboratorio_solicitud_idsolicitud")
);

-- -------------------------------------------------------------------------
-- Table: calendario
-- -------------------------------------------------------------------------
CREATE TABLE "calendario" (
  "idcalendario" bigserial NOT NULL,
  "solicitud_idsolicitud" INTEGER NOT NULL,
  "fecha_inicial" DATE NOT NULL,
  "fecha_final" DATE NOT NULL,
  PRIMARY KEY ("idcalendario", "solicitud_idsolicitud")
);

-- -------------------------------------------------------------------------
-- Table: bitacora
-- -------------------------------------------------------------------------
CREATE TABLE "bitacora" (
  "idbitacora" bigserial NOT NULL,
  "solicitud_idsolicitud" INTEGER NOT NULL,
  "actividad" VARCHAR(255) NOT NULL,
  "fecha" DATE NOT NULL,
  PRIMARY KEY ("idbitacora", "solicitud_idsolicitud")
);

-- -------------------------------------------------------------------------
-- Relations for table: tecnico
-- -------------------------------------------------------------------------
ALTER TABLE "tecnico" ADD FOREIGN KEY ("usuario_idusuario") 
    REFERENCES "usuario" ("idusuario")
      ON DELETE NO ACTION
      ON UPDATE NO ACTION;

-- -------------------------------------------------------------------------
-- Relations for table: auxiliar
-- -------------------------------------------------------------------------
ALTER TABLE "auxiliar" ADD FOREIGN KEY ("usuario_idusuario") 
    REFERENCES "usuario" ("idusuario")
      ON DELETE NO ACTION
      ON UPDATE NO ACTION;

-- -------------------------------------------------------------------------
-- Relations for table: director
-- -------------------------------------------------------------------------
ALTER TABLE "director" ADD FOREIGN KEY ("usuario_idusuario") 
    REFERENCES "usuario" ("idusuario")
      ON DELETE NO ACTION
      ON UPDATE NO ACTION;

-- -------------------------------------------------------------------------
-- Relations for table: contador
-- -------------------------------------------------------------------------
ALTER TABLE "contador" ADD FOREIGN KEY ("usuario_idusuario") 
    REFERENCES "usuario" ("idusuario")
      ON DELETE NO ACTION
      ON UPDATE NO ACTION;

-- -------------------------------------------------------------------------
-- Relations for table: ingeniero
-- -------------------------------------------------------------------------
ALTER TABLE "ingeniero" ADD FOREIGN KEY ("usuario_idusuario") 
    REFERENCES "usuario" ("idusuario")
      ON DELETE NO ACTION
      ON UPDATE NO ACTION;

-- -------------------------------------------------------------------------
-- Relations for table: usuario_rol
-- -------------------------------------------------------------------------
ALTER TABLE "usuario_rol" ADD FOREIGN KEY ("usuario_idusuario") 
    REFERENCES "usuario" ("idusuario")
      ON DELETE NO ACTION
      ON UPDATE NO ACTION;
ALTER TABLE "usuario_rol" ADD FOREIGN KEY ("rol_idrol") 
    REFERENCES "rol" ("idrol")
      ON DELETE NO ACTION
      ON UPDATE NO ACTION;

-- -------------------------------------------------------------------------
-- Relations for table: solicitud_usuario
-- -------------------------------------------------------------------------
ALTER TABLE "solicitud_usuario" ADD FOREIGN KEY ("solicitud_idsolicitud") 
    REFERENCES "solicitud" ("idsolicitud")
      ON DELETE NO ACTION
      ON UPDATE NO ACTION;
ALTER TABLE "solicitud_usuario" ADD FOREIGN KEY ("usuario_idusuario") 
    REFERENCES "usuario" ("idusuario")
      ON DELETE NO ACTION
      ON UPDATE NO ACTION;

-- -------------------------------------------------------------------------
-- Relations for table: solicitud_pago
-- -------------------------------------------------------------------------
ALTER TABLE "solicitud_pago" ADD FOREIGN KEY ("pago_idpago") 
    REFERENCES "pago" ("idpago")
      ON DELETE NO ACTION
      ON UPDATE NO ACTION;
ALTER TABLE "solicitud_pago" ADD FOREIGN KEY ("solicitud_idsolicitud") 
    REFERENCES "solicitud" ("idsolicitud")
      ON DELETE NO ACTION
      ON UPDATE NO ACTION;

-- -------------------------------------------------------------------------
-- Relations for table: trabajo_campo
-- -------------------------------------------------------------------------
ALTER TABLE "trabajo_campo" ADD FOREIGN KEY ("solicitud_idsolicitud") 
    REFERENCES "solicitud" ("idsolicitud")
      ON DELETE NO ACTION
      ON UPDATE NO ACTION;

-- -------------------------------------------------------------------------
-- Relations for table: ensayo_laboratorio
-- -------------------------------------------------------------------------
ALTER TABLE "ensayo_laboratorio" ADD FOREIGN KEY ("solicitud_idsolicitud") 
    REFERENCES "solicitud" ("idsolicitud")
      ON DELETE NO ACTION
      ON UPDATE NO ACTION;

-- -------------------------------------------------------------------------
-- Relations for table: alcance
-- -------------------------------------------------------------------------
ALTER TABLE "alcance" ADD FOREIGN KEY ("trabajo_campo_solicitud_idsolicitud") 
    REFERENCES "trabajo_campo" ("solicitud_idsolicitud")
      ON DELETE NO ACTION
      ON UPDATE NO ACTION;

-- -------------------------------------------------------------------------
-- Relations for table: formulario_tc
-- -------------------------------------------------------------------------
ALTER TABLE "formulario_tc" ADD FOREIGN KEY ("cliente_idcliente") 
    REFERENCES "cliente" ("idcliente")
      ON DELETE NO ACTION
      ON UPDATE NO ACTION;
ALTER TABLE "formulario_tc" ADD FOREIGN KEY ("trabajo_campo_solicitud_idsolicitud") 
    REFERENCES "trabajo_campo" ("solicitud_idsolicitud")
      ON DELETE NO ACTION
      ON UPDATE NO ACTION;

-- -------------------------------------------------------------------------
-- Relations for table: formulario_el
-- -------------------------------------------------------------------------
ALTER TABLE "formulario_el" ADD FOREIGN KEY ("cliente_idcliente") 
    REFERENCES "cliente" ("idcliente")
      ON DELETE NO ACTION
      ON UPDATE NO ACTION;
ALTER TABLE "formulario_el" ADD FOREIGN KEY ("ensayo_laboratorio_solicitud_idsolicitud") 
    REFERENCES "ensayo_laboratorio" ("solicitud_idsolicitud")
      ON DELETE NO ACTION
      ON UPDATE NO ACTION;

-- -------------------------------------------------------------------------
-- Relations for table: detalle_ensayo
-- -------------------------------------------------------------------------
ALTER TABLE "detalle_ensayo" ADD FOREIGN KEY ("ensayo_idensayo") 
    REFERENCES "ensayo" ("idensayo")
      ON DELETE NO ACTION
      ON UPDATE NO ACTION;
ALTER TABLE "detalle_ensayo" ADD FOREIGN KEY ("ensayo_laboratorio_solicitud_idsolicitud") 
    REFERENCES "ensayo_laboratorio" ("solicitud_idsolicitud")
      ON DELETE NO ACTION
      ON UPDATE NO ACTION;

-- -------------------------------------------------------------------------
-- Relations for table: muestra
-- -------------------------------------------------------------------------
ALTER TABLE "muestra" ADD FOREIGN KEY ("ensayo_laboratorio_solicitud_idsolicitud") 
    REFERENCES "ensayo_laboratorio" ("solicitud_idsolicitud")
      ON DELETE NO ACTION
      ON UPDATE NO ACTION;

-- -------------------------------------------------------------------------
-- Relations for table: calendario
-- -------------------------------------------------------------------------
ALTER TABLE "calendario" ADD FOREIGN KEY ("solicitud_idsolicitud") 
    REFERENCES "solicitud" ("idsolicitud")
      ON DELETE NO ACTION
      ON UPDATE NO ACTION;

-- -------------------------------------------------------------------------
-- Relations for table: bitacora
-- -------------------------------------------------------------------------
ALTER TABLE "bitacora" ADD FOREIGN KEY ("solicitud_idsolicitud") 
    REFERENCES "solicitud" ("idsolicitud")
      ON DELETE NO ACTION
      ON UPDATE NO ACTION;

-- -------------------------------------------------------------------------
-- Relations for table: resultado
-- -------------------------------------------------------------------------
ALTER TABLE "resultado" ADD FOREIGN KEY ("solicitud_idsolicitud") 
    REFERENCES "solicitud" ("idsolicitud")
      ON DELETE NO ACTION
      ON UPDATE NO ACTION;