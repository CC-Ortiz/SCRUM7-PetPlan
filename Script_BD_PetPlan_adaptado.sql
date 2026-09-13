-- Script SQL adaptado de PetPlan
-- Cambios respecto al script original:
--   1) Los nombres de tabla/columna se normalizaron a ASCII (duenos en vez de dueños_de_mascotas)
--      para evitar problemas de codificación con el framework (Laravel/Eloquent).
--   2) La relación mascota-dueño se invirtió: ahora la FK vive en "mascotas" (id_dueno),
--      no en el dueño. Así, un dueño puede tener muchas mascotas de forma natural.
--   3) La tabla puente "asignacion_cita" ya no es necesaria: "citas" apunta directo a "mascotas".
--   4) "historias_clinicas" depende solo de "mascotas" (el dueño se conoce vía la mascota).
--   5) Se agregaron columnas de autenticación (password) a "duenos", ya que en la aplicación
--      web el dueño es quien inicia sesión.
--   6) Este script es equivalente a las migraciones de Laravel en database/migrations/ y se
--      entrega solo como referencia; la aplicación se crea/actualiza con "php artisan migrate".
--   7) El veterinario ahora también tiene credenciales de acceso (password) porque cuenta con
--      su propio panel: acepta/confirma citas y registra diagnóstico, tratamiento y vacuna
--      recomendada en la historia clínica. El login es el mismo formulario para dueños y
--      veterinarios; la aplicación detecta el rol probando ambas tablas.

CREATE TABLE IF NOT EXISTS tipos_de_documento (
  id_tipo_documento INT NOT NULL AUTO_INCREMENT,
  nombre_tipo_documento VARCHAR(45) NOT NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  PRIMARY KEY (id_tipo_documento),
  UNIQUE INDEX nombre_tipo_documento_UNIQUE (nombre_tipo_documento ASC)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS tipos_de_mascotas (
  id_tipo_mascota INT NOT NULL AUTO_INCREMENT,
  nombre_tipo_mascota VARCHAR(45) NOT NULL,
  nombre_raza VARCHAR(45) NOT NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  PRIMARY KEY (id_tipo_mascota)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS duenos (
  id_dueno INT NOT NULL AUTO_INCREMENT,
  num_contacto VARCHAR(15) NOT NULL,
  email VARCHAR(50) NOT NULL,
  nombre VARCHAR(60) NOT NULL,
  apellido VARCHAR(45) NOT NULL,
  num_documento VARCHAR(15) NOT NULL,
  tipo_documento_id INT NULL,
  password VARCHAR(255) NOT NULL,
  remember_token VARCHAR(100) NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  PRIMARY KEY (id_dueno),
  UNIQUE INDEX num_contacto_UNIQUE (num_contacto ASC),
  UNIQUE INDEX email_UNIQUE (email ASC),
  UNIQUE INDEX num_documento_UNIQUE (num_documento ASC),
  INDEX fk_duenos_tipos_de_documento_idx (tipo_documento_id ASC),
  CONSTRAINT fk_duenos_tipos_de_documento
    FOREIGN KEY (tipo_documento_id)
    REFERENCES tipos_de_documento (id_tipo_documento)
    ON DELETE SET NULL
    ON UPDATE NO ACTION
) ENGINE = InnoDB;

-- La FK mascota -> dueño vive aquí (antes vivía en dueños_de_mascotas)
CREATE TABLE IF NOT EXISTS mascotas (
  id_mascota INT NOT NULL AUTO_INCREMENT,
  nombre_mascota VARCHAR(45) NOT NULL,
  edad_mascota VARCHAR(45) NOT NULL,
  peso_mascota VARCHAR(45) NOT NULL,
  color_mascota VARCHAR(45) NULL,
  fecha_nacimiento DATE NULL,
  observaciones TEXT NULL,
  id_tipo_mascota INT NOT NULL,
  id_dueno INT NOT NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  PRIMARY KEY (id_mascota),
  INDEX id_tipo_mascota_idx (id_tipo_mascota ASC),
  INDEX id_dueno_idx (id_dueno ASC),
  CONSTRAINT fk_mascotas_tipos_de_mascotas
    FOREIGN KEY (id_tipo_mascota)
    REFERENCES tipos_de_mascotas (id_tipo_mascota)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT fk_mascotas_duenos
    FOREIGN KEY (id_dueno)
    REFERENCES duenos (id_dueno)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS citas (
  id_citas INT NOT NULL AUTO_INCREMENT,
  fecha_cita DATETIME NOT NULL,
  categoria VARCHAR(45) NOT NULL DEFAULT 'Consulta General',
  descripcion TEXT NOT NULL,
  confirmacion TINYINT(1) NOT NULL DEFAULT 0,
  id_mascota INT NOT NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  PRIMARY KEY (id_citas),
  INDEX id_mascota_idx (id_mascota ASC),
  CONSTRAINT fk_citas_mascotas
    FOREIGN KEY (id_mascota)
    REFERENCES mascotas (id_mascota)
    ON DELETE CASCADE
    ON UPDATE NO ACTION
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS veterinarios (
  id_veterinario INT NOT NULL AUTO_INCREMENT,
  nombre_veterinario VARCHAR(30) NOT NULL,
  apellido_veterinario VARCHAR(30) NOT NULL,
  num_documento_vet VARCHAR(15) NOT NULL,
  num_tarjeta_profesional VARCHAR(45) NOT NULL,
  email_veterinario VARCHAR(45) NOT NULL,
  num_contacto_veterinario VARCHAR(45) NOT NULL,
  password VARCHAR(255) NOT NULL,
  remember_token VARCHAR(100) NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  PRIMARY KEY (id_veterinario),
  UNIQUE INDEX num_documento_vet_UNIQUE (num_documento_vet ASC),
  UNIQUE INDEX num_tarjeta_profesional_UNIQUE (num_tarjeta_profesional ASC),
  UNIQUE INDEX email_veterinario_UNIQUE (email_veterinario ASC),
  UNIQUE INDEX num_contacto_veterinario_UNIQUE (num_contacto_veterinario ASC)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS cita_veterinario (
  id_citas INT NOT NULL,
  id_veterinario INT NOT NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  PRIMARY KEY (id_citas, id_veterinario),
  INDEX id_veterinario_idx (id_veterinario ASC),
  CONSTRAINT fk_cita_veterinario_citas
    FOREIGN KEY (id_citas)
    REFERENCES citas (id_citas)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT fk_cita_veterinario_veterinarios
    FOREIGN KEY (id_veterinario)
    REFERENCES veterinarios (id_veterinario)
    ON DELETE CASCADE
    ON UPDATE NO ACTION
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS historias_clinicas (
  id_historia_clinica INT NOT NULL AUTO_INCREMENT,
  id_mascota INT NOT NULL,
  diagnostico VARCHAR(255) NULL,
  tratamiento VARCHAR(255) NULL,
  vacuna_recomendada VARCHAR(100) NULL,
  fecha_registro DATE NULL,
  historia_clinica TEXT NOT NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  PRIMARY KEY (id_historia_clinica),
  INDEX id_mascota_idx (id_mascota ASC),
  CONSTRAINT fk_historias_clinicas_mascotas
    FOREIGN KEY (id_mascota)
    REFERENCES mascotas (id_mascota)
    ON DELETE CASCADE
    ON UPDATE NO ACTION
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS historia_veterinario (
  id_historia_clinica INT NOT NULL,
  id_veterinario INT NOT NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  PRIMARY KEY (id_historia_clinica, id_veterinario),
  INDEX id_veterinario_idx (id_veterinario ASC),
  CONSTRAINT fk_historia_veterinario_historias
    FOREIGN KEY (id_historia_clinica)
    REFERENCES historias_clinicas (id_historia_clinica)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT fk_historia_veterinario_veterinarios
    FOREIGN KEY (id_veterinario)
    REFERENCES veterinarios (id_veterinario)
    ON DELETE CASCADE
    ON UPDATE NO ACTION
) ENGINE = InnoDB;
