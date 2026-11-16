CREATE TABLE IF NOT EXISTS musica_canciones (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    artista VARCHAR(120) NOT NULL,
    fuente ENUM('archivo', 'youtube') NOT NULL,
    recurso VARCHAR(255) NOT NULL,
    activo BOOLEAN NOT NULL DEFAULT 1,
    creado TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS musica_sugerencias (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT UNSIGNED NOT NULL,
    cancion_id INT UNSIGNED NULL,
    titulo VARCHAR(150) NOT NULL,
    artista VARCHAR(120) NOT NULL,
    youtube_id CHAR(11) NULL,
    estado ENUM(
        'pendiente',
        'en_cola',
        'reproduciendo',
        'reproducida',
        'rechazada',
        'omitida'
    ) NOT NULL DEFAULT 'pendiente',
    creado TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    aprobado DATETIME NULL,
    moderador_id INT UNSIGNED NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios (id) ON DELETE RESTRICT,
    FOREIGN KEY (cancion_id) REFERENCES musica_canciones (id) ON DELETE RESTRICT,
    FOREIGN KEY (moderador_id) REFERENCES usuarios (id) ON DELETE RESTRICT,
    INDEX (estado, aprobado, id),
    INDEX (usuario_id, creado)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS musica_reproductor (
    id TINYINT UNSIGNED PRIMARY KEY,
    sugerencia_id BIGINT UNSIGNED NULL,
    ultima_cancion_id INT UNSIGNED NULL,
    dispositivo CHAR(64) NULL,
    actualizado DATETIME NULL,
    FOREIGN KEY (sugerencia_id) REFERENCES musica_sugerencias (id) ON DELETE RESTRICT
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

INSERT IGNORE INTO
    musica_reproductor (id)
VALUES
    (1);
