CREATE DATABASE IF NOT EXISTS cafebar_mvc CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE cafebar_mvc;

CREATE TABLE usuarios (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(120) NOT NULL,
    usuario VARCHAR(40) NOT NULL UNIQUE,
    correo VARCHAR(190) NOT NULL UNIQUE,
    telefono VARCHAR(25) NOT NULL DEFAULT '',
    direccion VARCHAR(250) NOT NULL DEFAULT '',
    password_hash VARCHAR(255) NOT NULL,
    rol ENUM('administrador', 'empleado', 'cliente') NOT NULL DEFAULT 'cliente',
    estado BOOLEAN NOT NULL DEFAULT 1,
    creado TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB;

CREATE TABLE categorias (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(80) NOT NULL UNIQUE,
    descripcion VARCHAR(500) NOT NULL,
    estado BOOLEAN NOT NULL DEFAULT 1
) ENGINE = InnoDB;

CREATE TABLE productos (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    categoria_id INT UNSIGNED NOT NULL,
    nombre VARCHAR(120) NOT NULL,
    descripcion VARCHAR(1000) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    stock INT UNSIGNED NOT NULL DEFAULT 0,
    imagen VARCHAR(255) NOT NULL DEFAULT 'images/cafe.svg',
    estado BOOLEAN NOT NULL DEFAULT 1,
    FOREIGN KEY (categoria_id) REFERENCES categorias (id) ON DELETE RESTRICT,
    CHECK (precio > 0),
    INDEX (categoria_id, estado)
) ENGINE = InnoDB;

CREATE TABLE pedidos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT UNSIGNED NOT NULL,
    fecha TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(12, 2) NOT NULL,
    estado ENUM(
        'pendiente',
        'preparando',
        'entregado',
        'cancelado'
    ) NOT NULL DEFAULT 'pendiente',
    token CHAR(64) NOT NULL UNIQUE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios (id) ON DELETE RESTRICT,
    INDEX (usuario_id, fecha),
    INDEX (estado, fecha),
    CHECK (total >= 0)
) ENGINE = InnoDB;

CREATE TABLE detalle_pedido (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    pedido_id BIGINT UNSIGNED NOT NULL,
    producto_id INT UNSIGNED NOT NULL,
    nombre_producto VARCHAR(120) NOT NULL,
    cantidad INT UNSIGNED NOT NULL,
    precio_unitario DECIMAL(10, 2) NOT NULL,
    subtotal DECIMAL(12, 2) NOT NULL,
    UNIQUE (pedido_id, producto_id),
    FOREIGN KEY (pedido_id) REFERENCES pedidos (id) ON DELETE CASCADE,
    FOREIGN KEY (producto_id) REFERENCES productos (id) ON DELETE RESTRICT,
    CHECK (
        cantidad > 0
        AND precio_unitario > 0
        AND subtotal > 0
    )
) ENGINE = InnoDB;

CREATE TABLE mensajes_contacto (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(120) NOT NULL,
    correo VARCHAR(190) NOT NULL,
    asunto VARCHAR(150) NOT NULL,
    contenido TEXT NOT NULL,
    fecha TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('nuevo', 'leido', 'respondido') NOT NULL DEFAULT 'nuevo'
) ENGINE = InnoDB;

-- Cuentas de laboratorio: admin, empleado y cliente. Contraseña para las tres: CafeBar2026!
-- Hash real generado con password_hash('CafeBar2026!', PASSWORD_DEFAULT).
INSERT INTO
    usuarios (
        nombre,
        usuario,
        correo,
        telefono,
        direccion,
        password_hash,
        rol
    )
VALUES
    (
        'Administración CafeBar',
        'admin',
        'admin@cafebar.test',
        '70000001',
        'Oruro, Bolivia',
        '$2y$10$R2xVBfMwa/LobobjsjhGSO8qu/YURDGjHwk4GbpdzR0eGOg3FUK7m',
        'administrador'
    ),
    (
        'Personal CafeBar',
        'empleado',
        'empleado@cafebar.test',
        '70000002',
        'Oruro, Bolivia',
        '$2y$10$R2xVBfMwa/LobobjsjhGSO8qu/YURDGjHwk4GbpdzR0eGOg3FUK7m',
        'empleado'
    ),
    (
        'Cliente de demostración',
        'cliente',
        'cliente@cafebar.test',
        '70000003',
        'Oruro, Bolivia',
        '$2y$10$R2xVBfMwa/LobobjsjhGSO8qu/YURDGjHwk4GbpdzR0eGOg3FUK7m',
        'cliente'
    );

INSERT INTO
    categorias (nombre, descripcion)
VALUES
    (
        'Cafés',
        'Café recién preparado para acompañar tu día.'
    ),
    ('Jugos', 'Fruta y frescura en cada vaso.'),
    ('Postres', 'Dulces elaborados en nuestra cocina.'),
    ('Sándwiches', 'Una pausa sabrosa y completa.');

INSERT INTO
    productos (
        categoria_id,
        nombre,
        descripcion,
        precio,
        stock,
        imagen
    )
VALUES
    (
        1,
        'Espresso de la casa',
        'Café intenso, aromático y de extracción corta.',
        12.00,
        60,
        'images/espresso.jpg'
    ),
    (
        1,
        'Capuchino cremoso',
        'Espresso con leche vaporizada y una suave capa de espuma.',
        18.00,
        45,
        'images/capuchino.jpg'
    ),
    (
        1,
        'Latte caramelo',
        'Café con leche y un delicado toque de caramelo.',
        22.00,
        35,
        'images/latte.jpg'
    ),
    (
        2,
        'Jugo de naranja',
        'Naranja exprimida al momento, sin azúcar añadida.',
        15.00,
        30,
        'images/jugo-naranja.jpg'
    ),
    (
        2,
        'Jugo de frutos rojos',
        'Una mezcla fresca de frutas rojas de temporada.',
        18.00,
        25,
        'images/jugo-frutos-rojos.jpg'
    ),
    (
        3,
        'Torta de chocolate',
        'Porción de bizcocho de cacao con cobertura de chocolate.',
        20.00,
        18,
        'images/torta-chocolate.jpg'
    ),
    (
        3,
        'Cheesecake de frutos rojos',
        'Base crujiente, crema de queso y salsa de frutos rojos.',
        24.00,
        15,
        'images/cheesecake.jpg'
    ),
    (
        4,
        'Sándwich de pollo',
        'Pan tostado con pollo, lechuga, tomate y salsa de la casa.',
        25.00,
        25,
        'images/sandwich-pollo.jpg'
    ),
    (
        4,
        'Sándwich vegetariano',
        'Verduras frescas, queso y una suave crema de hierbas.',
        23.00,
        20,
        'images/sandwich-vegetariano.jpg'
    );

INSERT INTO
    mensajes_contacto (nombre, correo, asunto, contenido)
VALUES
    (
        'Ana de prueba',
        'ana@example.test',
        'Consulta sobre reservas',
        'Hola, ¿puedo reservar una mesa para cuatro personas?'
    );

-- Cuenta solicitada: usuario jaqueline, contraseña inicial jaqui123.
INSERT INTO
    usuarios (
        nombre,
        usuario,
        correo,
        password_hash,
        rol,
        estado
    )
VALUES
    (
        'Jaqueline',
        'jaqueline',
        'jaqueline@cafebar.test',
        '$2y$10$FJCBQpqLmFTNft4Nit8MPeL5yvNmlztMKWnFGA1I8To00Do4Qc282',
        'administrador',
        1
    );

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
