-- Volcando estructura de base de datos para bienesraices_crud
CREATE DATABASE IF NOT EXISTS `bienesraices_crud` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `bienesraices_crud`;

-- Volcando estructura para tabla bienesraices_crud.propiedades
CREATE TABLE IF NOT EXISTS `propiedades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `imagen` varchar(200) DEFAULT NULL,
  `descripcion` longtext DEFAULT NULL,
  `habitaciones` int(11) DEFAULT NULL,
  `wc` int(11) DEFAULT NULL,
  `estacionamientos` int(11) DEFAULT NULL,
  `creado` date DEFAULT NULL,
  `vendedor_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vendedor_id` (`vendedor_id`),
  CONSTRAINT `vendedor_id` FOREIGN KEY (`vendedor_id`) REFERENCES `vendedores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla bienesraices_crud.propiedades: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `propiedades` DISABLE KEYS */;
INSERT INTO `propiedades` (`id`, `titulo`, `precio`, `imagen`, `descripcion`, `habitaciones`, `wc`, `estacionamientos`, `creado`, `vendedor_id`) VALUES
	(1, 'titulo(actualizar)', 1245.00, '1f8bddc938533f62b1b08f6afde00f2a.jpg', 'titulo(actualizar) titulo(actualizar) titulo(actualizar) titulo(actualizar) titulo(actualizar) titulo(actualizar) titulo(actualizar) titulo(actualizar) titulo(actualizar) titulo(actualizar) titulo(actualizar) titulo(actualizar) titulo(actualizar) titulo(actualizar) titulo(actualizar) titulo(actualizar) titulo(actualizar) titulo(actualizar) titulo(actualizar) titulo(actualizar) titulo(actualizar) ', 2, 3, 5, '2023-06-27', 1),
	(2, 'titulo de prueba 2', 1234.00, '965f81b4dbb8dc9fb110d00695fca72a.jpg', 'titulo de prueba 2titulo de prueba 2titulo de prueba 2titulo de prueba 2titulo de prueba 2titulo de prueba 2titulo de prueba 2titulo de prueba 2titulo de prueba 2titulo de prueba 2titulo de prueba 2titulo de prueba 2titulo de prueba 2', 2, 2, 2, '2023-06-27', 1),
	(3, 'Titulo de prueba', 12097.00, '4babac182c96708d3506d20d6e7d3d54.jpg', 'Titulo de pruebaTitulo de pruebaTitulo de pruebaTitulo de pruebaTitulo de pruebaTitulo de pruebaTitulo de pruebaTitulo de pruebaTitulo de pruebaTitulo de pruebaTitulo de pruebaTitulo de pruebaTitulo de prueba', 3, 4, 2, '2023-06-28', 1),
	(4, 'titulo de prueba 3', 123456.00, '47f6c80b3b7e2770d0ebbf5c588fd85c.jpg', 'titulo de prueba 3titulo de prueba 3titulo de prueba 3titulo de prueba 3titulo de prueba 3titulo de prueba 3titulo de prueba 3titulo de prueba 3titulo de prueba 3titulo de prueba 3titulo de prueba 3titulo de prueba 3titulo de prueba 3titulo de prueba 3titulo de prueba 3', 2, 3, 4, '2023-06-29', 3);
/*!40000 ALTER TABLE `propiedades` ENABLE KEYS */;

-- Volcando estructura para tabla bienesraices_crud.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` char(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla bienesraices_crud.usuarios: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `email`, `password`) VALUES
	(1, 'oscar.ecg06@gmail.com', '$2y$10$pbxmBNGV7P1DFGmXgFS00uRn0NF/pj/LVcO0JmJbn6Vw3N7BgsTq.');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

-- Volcando estructura para tabla bienesraices_crud.vendedores
CREATE TABLE IF NOT EXISTS `vendedores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `telefono` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla bienesraices_crud.vendedores: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `vendedores` DISABLE KEYS */;
INSERT INTO `vendedores` (`id`, `nombre`, `apellido`, `telefono`) VALUES
	(1, 'oscar', 'canache', '213212121'),
	(3, 'Enrique', 'Canache', '12345678987');
