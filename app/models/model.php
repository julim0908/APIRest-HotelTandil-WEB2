<?php
require_once 'config.php';

class Model {
    protected $db;

    function __construct() {
        // Conexión inicial al servidor para verificar o crear la base de datos
        $this->db = new PDO('mysql:host='. DB_HOST .';charset=utf8', DB_USER, DB_PASS);
        $this->createDatabase();

        // Reconexión incluyendo el nombre de la base de datos
        $this->db = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME .';charset=utf8', DB_USER, DB_PASS);

        $this->deploy();
    }

    function createDatabase() {
        // Crear la base de datos si no existe
        $sql = 'CREATE DATABASE IF NOT EXISTS ' . DB_NAME . ' CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci';
        $this->db->exec($sql);
    }

    function deploy() {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();

        if (count($tables) == 0) {
            $sql =<<<END
                    CREATE TABLE `clientes` (
            `id_cliente` int(11) NOT NULL,
            `nombre` varchar(100) NOT NULL,
            `apellido` varchar(100) NOT NULL,
            `email` varchar(100) NOT NULL,
            `telefono` varchar(100) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

            --
            -- Volcado de datos para la tabla `clientes`
            --

            INSERT INTO `clientes` (`id_cliente`, `nombre`, `apellido`, `email`, `telefono`) VALUES
            (7, 'marcos', 'sincovich', 'marquitos@yy.com', '2262553535'),
            (25, 'Marta', 'Perez', 'martap@gmail.com', '2373738828'),
            (29, 'Valentina', 'carceles', 'chicaju.10@gmail.com', '2373738828'),
            (32, 'Valentina', 'Perez', 'juliancordoba534@gmail.com', '2373738828');

            -- --------------------------------------------------------

            --
            -- Estructura de tabla para la tabla `reservaciones`
            --

            CREATE TABLE `reservaciones` (
            `id_reservacion` int(11) NOT NULL,
            `numero_habitacion` int(11) NOT NULL,
            `fecha_entrada` date NOT NULL,
            `fecha_salida` date NOT NULL,
            `monto` float NOT NULL,
            `id_cliente` int(11) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

            -- --------------------------------------------------------

            --
            -- Estructura de tabla para la tabla `usuarios`
            --

            CREATE TABLE `usuarios` (
            `id` int(11) NOT NULL,
            `email` varchar(100) NOT NULL,
            `password` char(60) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

            --
            -- Volcado de datos para la tabla `usuarios`
            --

            INSERT INTO `usuarios` (`id`, `email`, `password`) VALUES
            (1, 'webadmin@yy.com', '$2y$10$D5j3Rxbi9lyucLQ6arAnSeAHJ.I7Z.LeXEcULrSRCd6zYT2eCRF6G');

            --
            -- Índices para tablas volcadas
            --

            --
            -- Indices de la tabla `clientes`
            --
            ALTER TABLE `clientes`
            ADD PRIMARY KEY (`id_cliente`);

            --
            -- Indices de la tabla `reservaciones`
            --
            ALTER TABLE `reservaciones`
            ADD PRIMARY KEY (`id_reservacion`),
            ADD KEY `fk_cliente` (`id_cliente`);

            --
            -- Indices de la tabla `usuarios`
            --
            ALTER TABLE `usuarios`
            ADD PRIMARY KEY (`id`);

            --
            -- AUTO_INCREMENT de las tablas volcadas
            --

            --
            -- AUTO_INCREMENT de la tabla `clientes`
            --
            ALTER TABLE `clientes`
            MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

            --
            -- AUTO_INCREMENT de la tabla `reservaciones`
            --
            ALTER TABLE `reservaciones`
            MODIFY `id_reservacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

            --
            -- AUTO_INCREMENT de la tabla `usuarios`
            --
            ALTER TABLE `usuarios`
            MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

            --
            -- Restricciones para tablas volcadas
            --

            --
            -- Filtros para la tabla `reservaciones`
            --
            ALTER TABLE `reservaciones`
            ADD CONSTRAINT `fk_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`);
            COMMIT; 
                        
            END;
            $this->db->exec($sql);
        }
    }
}


