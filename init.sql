-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Servidor: bd_mysql_inmobiliaria
-- Tiempo de generación: 17-07-2026 a las 17:53:52
-- Versión del servidor: 8.0.44
-- Versión de PHP: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inmobiliaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amenidades`
--

CREATE TABLE `amenidades` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `amenidades`
--

INSERT INTO `amenidades` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Protecciones de Herrería', '2026-07-16 20:53:40', '2026-07-16 20:53:40'),
(2, 'Cerca Eléctrica de Seguridad', '2026-07-16 20:53:40', '2026-07-16 20:53:40'),
(3, 'Portón Eléctrico', '2026-07-16 20:53:40', '2026-07-16 20:53:40'),
(4, 'Cisterna con Bomba', '2026-07-16 20:53:40', '2026-07-16 20:53:40'),
(5, 'Tanque de Gas Estacionario', '2026-07-16 20:53:40', '2026-07-16 20:53:40'),
(6, 'Piso de Porcelanato / Cerámico', '2026-07-16 20:53:40', '2026-07-16 20:53:40'),
(7, 'Cocina Integral Equipada', '2026-07-16 20:53:40', '2026-07-16 20:53:40'),
(8, 'Aires Acondicionados / Minisplits', '2026-07-16 20:53:40', '2026-07-16 20:53:40'),
(9, 'Calentador Solar', '2026-07-16 20:53:40', '2026-07-16 20:53:40'),
(10, 'Vestidor en Recámara Principal', '2026-07-16 20:53:40', '2026-07-16 20:53:40'),
(11, 'Closets Empotrados', '2026-07-16 20:53:40', '2026-07-16 20:53:40'),
(12, 'Jardín Trasero / Patio', '2026-07-16 20:53:40', '2026-07-16 20:53:40'),
(13, 'Área de Asador / Terraza', '2026-07-16 20:53:40', '2026-07-16 20:53:40'),
(14, 'Cuarto de Servicio con Baño', '2026-07-16 20:53:40', '2026-07-16 20:53:40'),
(15, 'Bodega de Almacenamiento', '2026-07-16 20:53:40', '2026-07-16 20:53:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amenidad_vivienda`
--

CREATE TABLE `amenidad_vivienda` (
  `amenidad_id` bigint UNSIGNED NOT NULL,
  `vivienda_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `amenidad_vivienda`
--

INSERT INTO `amenidad_vivienda` (`amenidad_id`, `vivienda_id`) VALUES
(1, 2),
(6, 2),
(1, 4),
(1, 5),
(1, 6),
(6, 6),
(1, 7),
(6, 7),
(1, 8),
(6, 8),
(1, 9),
(6, 9),
(1, 10),
(1, 11),
(1, 14),
(1, 15),
(6, 15),
(1, 16),
(6, 16),
(1, 17),
(6, 17),
(1, 18),
(6, 18),
(1, 19),
(6, 19),
(1, 20),
(6, 20),
(1, 22),
(6, 22),
(1, 23),
(6, 23),
(1, 24),
(1, 26),
(6, 26),
(1, 27),
(6, 27),
(1, 28),
(6, 28),
(1, 29),
(6, 29),
(1, 30),
(6, 30),
(1, 31),
(1, 32),
(6, 32),
(1, 33),
(6, 33),
(1, 34),
(6, 34),
(1, 35),
(6, 35),
(1, 37),
(6, 37),
(1, 38),
(6, 38),
(1, 39),
(6, 39),
(1, 40),
(6, 40),
(1, 41),
(6, 41),
(1, 43),
(6, 43),
(1, 44),
(6, 44),
(1, 45),
(6, 45);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asentamientos`
--

CREATE TABLE `asentamientos` (
  `id` bigint UNSIGNED NOT NULL,
  `codigo_postal` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `municipio` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ciudad` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo_asentamiento` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_asentamiento` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `asentamientos`
--

INSERT INTO `asentamientos` (`id`, `codigo_postal`, `estado`, `municipio`, `ciudad`, `tipo_asentamiento`, `nombre_asentamiento`) VALUES
(98, '94285', 'Veracruz de Ignacio de la Llave', 'Boca del Río', NULL, 'Ranchería', 'El Terraplén'),
(99, '94286', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Fraccionamiento', 'Quinta Al Andalus'),
(100, '94286', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Fraccionamiento', 'Cumbres Residencial'),
(101, '94286', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Fraccionamiento', 'Santa Ana Residencial'),
(102, '94286', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Fraccionamiento', 'Río del Dorado'),
(103, '94286', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Fraccionamiento', 'Lomas del Dorado'),
(104, '94286', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Fraccionamiento', 'Villas Veranda'),
(105, '94286', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Fraccionamiento', 'Rivera de la Condesa'),
(106, '94286', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Fraccionamiento', 'San José Novillero'),
(107, '94286', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Fraccionamiento', 'Casa de la Condesa de Malibrán'),
(108, '94287', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Paso Colorado'),
(109, '94287', 'Veracruz de Ignacio de la Llave', 'Boca del Río', NULL, 'Ranchería', 'Rancho JF'),
(110, '94290', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Camino Real'),
(111, '94290', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Boca del Río Centro'),
(112, '94290', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Costa del Sol'),
(113, '94290', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'La Tampiquera'),
(114, '94290', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Ricardo Flores Magón'),
(115, '94290', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Río Jamapa'),
(116, '94290', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Fraccionamiento', 'El Estero'),
(117, '94290', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Pescadores'),
(118, '94290', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Hicacal'),
(119, '94290', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Unidad habitacional', 'ISSSFAM Militar'),
(120, '94290', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Unidad habitacional', 'Hicacal II'),
(121, '94290', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Fraccionamiento', 'El Dorado Residencial'),
(122, '94293', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Graciano Sánchez Romo'),
(123, '94293', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'El Morro las Colonias'),
(124, '94293', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'San José'),
(125, '94293', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Unidad habitacional', 'INFONAVIT el Morro'),
(126, '94293', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Gardenias'),
(127, '94293', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Lomas Del Mar'),
(128, '94293', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Los Delfines'),
(129, '94293', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Playa Hermosa'),
(130, '94293', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Los Arcos'),
(131, '94293', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Fraccionamiento', 'Cordilleras'),
(132, '94293', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Fraccionamiento', 'Residencial la Joya'),
(133, '94294', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Costa Verde'),
(134, '94294', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Estatuto Juridico'),
(135, '94294', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Unidad habitacional', 'Fovissste'),
(136, '94294', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Galaxia'),
(137, '94294', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Jardines de Virginia'),
(138, '94294', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Fraccionamiento', 'Virginia'),
(139, '94294', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Fraccionamiento', 'SUTSEM'),
(140, '94295', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Bonos Del Ahorro Nacional'),
(141, '94295', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Linda Vista'),
(142, '94295', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Marco Antonio Muñoz'),
(143, '94295', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Remes'),
(144, '94295', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Nueva Era'),
(145, '94295', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Rigo'),
(146, '94295', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Casas Tamsa'),
(147, '94295', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Vista Alegre'),
(148, '94296', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Fraccionamiento', 'Hípico'),
(149, '94296', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Manlio Fabio Altamirano (Lecheros)'),
(150, '94296', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Manuel Nieto'),
(151, '94296', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Revolución'),
(152, '94296', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Unidad habitacional', 'TAMSA'),
(153, '94296', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Virginia Cordero de Murillo Vidal'),
(154, '94297', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Fraccionamiento', 'Cubika'),
(155, '94297', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Fraccionamiento', 'Bambú'),
(156, '94297', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Fraccionamiento', 'Cantera Residencial'),
(157, '94297', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Fraccionamiento', 'Predio Rústico Ex Hacienda la Boticaria'),
(158, '94297', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'El Manantial'),
(159, '94297', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Miguel Alemán Valdés'),
(160, '94297', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', '8 de Marzo'),
(161, '94297', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Plan de Ayala'),
(162, '94297', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Fernando Gutiérrez Barrios'),
(163, '94297', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Guillermo López Portillo'),
(164, '94297', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'José López Portillo'),
(165, '94297', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Unidad habitacional', 'INFONAVIT las Vegas'),
(166, '94297', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Ejido Primero de Mayo Norte'),
(167, '94297', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Ejido Primero de Mayo Sur'),
(168, '94297', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Venustiano Carranza'),
(169, '94297', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Ugocep'),
(170, '94297', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Dante Delgado Ranauro'),
(171, '94297', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Las Vegas II'),
(172, '94297', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', '9 de Marzo'),
(173, '94297', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Venustiano Carranza 3a Sección'),
(174, '94297', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Ampliación Miguel Alemán'),
(175, '94297', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Gobierno Estatal'),
(176, '94297', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Unidad habitacional', 'Militar'),
(177, '94297', 'Veracruz de Ignacio de la Llave', 'Boca del Río', NULL, 'Ranchería', 'La Pinagoga'),
(178, '94298', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Fraccionamiento', 'Joyas de Mocambo (Granjas los Pinos)'),
(179, '94298', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Adalberto Tejeda'),
(180, '94298', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Benito Juárez'),
(181, '94298', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'La Cuchilla'),
(182, '94298', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Lázaro Cárdenas'),
(183, '94298', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Luis Echeverria Álvarez'),
(184, '94298', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Obrera'),
(185, '94298', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Villa Rica'),
(186, '94298', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Ylang Ylang'),
(187, '94298', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Ampliación Villa Rica'),
(188, '94298', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Playa de Oro Mocambo'),
(189, '94298', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Fraccionamiento', 'Las Américas'),
(190, '94299', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Fraccionamiento', 'Costa de Oro'),
(191, '94299', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Fraccionamiento', 'Jardines de Mocambo'),
(192, '94299', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Colonia', 'Petrolera (Heriberto Kehoe)'),
(193, '94299', 'Veracruz de Ignacio de la Llave', 'Boca del Río', 'Boca del Río', 'Fraccionamiento', 'De las Américas'),
(194, '94270', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Colonia', 'Las Mariposas'),
(195, '94270', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Fraccionamiento', 'Jardines de Medellín'),
(196, '94270', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Colonia', 'Antorchista Aquiles Córdoba Morán'),
(197, '94270', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Colonia', 'Ixcoalco'),
(198, '94270', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Colonia', 'El Guasimal'),
(199, '94270', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Colonia', 'Veinte de Noviembre de Medellín de Bravo'),
(200, '94270', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Ranchería', 'El Rancho Del Padre'),
(201, '94270', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Pueblo', 'Medellín'),
(202, '94270', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Colonia', 'Lázaro Cárdenas'),
(203, '94273', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Colonia', 'Adalberto Tejeda'),
(204, '94273', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Colonia', 'Gutiérrez Rosas'),
(205, '94273', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Fraccionamiento', 'Leonardo Rodríguez Alcaine'),
(206, '94273', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Colonia', 'La Joya'),
(207, '94273', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Colonia', 'Jardines de Dos Bocas'),
(208, '94273', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Ejido', 'Dos Bocas'),
(209, '94273', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Ejido', 'El Tejar'),
(210, '94273', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Colonia', 'Benito Juárez (Marcos Vélez)'),
(211, '94273', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Colonia', 'Paso Colorado'),
(212, '94273', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Colonia', 'El Paraíso II'),
(213, '94273', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Colonia', 'Villa de Guadalupe'),
(214, '94273', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Fraccionamiento', 'Arboleda San Miguel'),
(215, '94274', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Fraccionamiento', 'Lagos de Puente Moreno'),
(216, '94274', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Fraccionamiento', 'Dieciocho de Marzo'),
(217, '94274', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Colonia', 'Primero de La Palma'),
(218, '94274', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Fraccionamiento', 'Arboleda San Ramón'),
(219, '94274', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Colonia', 'Playa de Vacas'),
(220, '94274', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Fraccionamiento', 'Puente Moreno'),
(221, '94274', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Fraccionamiento', 'Las Palmas'),
(222, '94274', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Fraccionamiento', 'Residencial Marino'),
(223, '94274', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Fraccionamiento', 'Paseos del Campestre'),
(224, '94275', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Colonia', 'San Francisco'),
(225, '94275', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Colonia', 'Moreno Seco'),
(226, '94275', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Colonia', 'Los Pichones'),
(227, '94275', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Colonia', 'Palmira'),
(228, '94275', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Colonia', 'Lomas del Porvenir'),
(229, '94275', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Colonia', 'Moralillo'),
(230, '94275', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Colonia', 'Cedral'),
(231, '94275', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Ranchería', 'Rincón del Copite'),
(232, '94275', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Colonia', 'Mata Ortiz'),
(233, '94275', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Colonia', 'Mozambique'),
(234, '94276', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Ranchería', 'La Esperanza'),
(235, '94276', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Ranchería', 'El Infiernillo'),
(236, '94276', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Colonia', 'Las Balsas'),
(237, '94276', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Ranchería', 'Potrerillo'),
(238, '94277', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Rancho', 'Los Pinos'),
(239, '94277', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Fraccionamiento', 'Nuevo Medellín'),
(240, '94277', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Colonia', 'Alvaradito'),
(241, '94277', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Colonia', 'La Bocana (Dos Bocas)'),
(242, '94277', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Colonia', 'Herón Proal (Campestre)'),
(243, '94277', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Fraccionamiento', 'Conjunto Habitacional Tinajitas'),
(244, '94277', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Colonia', 'La Gloria'),
(245, '94277', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Pueblo', 'Paso Del Toro'),
(246, '94277', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Colonia', 'José Lozano'),
(247, '94278', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Colonia', 'La Pepehua'),
(248, '94278', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Colonia', 'Celaya'),
(249, '94280', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Colonia', 'El Doce (Rancho Nuevo)'),
(250, '94280', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Pueblo', 'Los Robles'),
(251, '94280', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Colonia', 'La Laguna y Monte del Castillo'),
(252, '94280', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Ranchería', 'Salazar (El Bosque)'),
(253, '94284', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Colonia', 'El Mangal'),
(254, '94284', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Colonia', 'La Providencia'),
(255, '94284', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Colonia', 'La Esmeralda'),
(256, '94284', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Colonia', 'La Candelaria'),
(257, '94284', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Colonia', 'Salsipuedes'),
(258, '94284', 'Veracruz de Ignacio de la Llave', 'Medellín de Bravo', NULL, 'Colonia', 'El Copital'),
(259, '91690', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Pueblo', 'Delfino Victoria (Santa Fe)'),
(260, '91690', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Pueblo', 'Paso San Juan'),
(261, '91693', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Pueblo', 'San Julián'),
(262, '91693', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Colonia', 'Vargas'),
(263, '91694', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Ranchería', 'Villarín'),
(264, '91696', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Pueblo', 'Santa Rita'),
(265, '91696', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Fraccionamiento', 'Cabo Verde'),
(266, '91697', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Fraccionamiento', 'Privanzas'),
(267, '91697', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Fraccionamiento', 'Paseo de las Palmas II'),
(268, '91697', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Fraccionamiento', 'La Querencia Residencial'),
(269, '91697', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Colonia', 'Colina de los Pájaros'),
(270, '91697', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Colonia', 'Cardenista Antonio Luna'),
(271, '91697', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Colonia', 'Libertad'),
(272, '91697', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Fraccionamiento', 'Residencial del Bosque Segunda Sección'),
(273, '91697', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Fraccionamiento', 'Ciudad Natura'),
(274, '91697', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Condominio', 'Hacienda Roal'),
(275, '91697', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Ranchería', 'El Pando'),
(276, '91697', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Colonia', 'Tejería'),
(277, '91697', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Zona industrial', 'Bruno Pagliai'),
(278, '91697', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Colonia', '16 de Febrero'),
(279, '91697', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Colonia', 'Dos Lomas'),
(280, '91697', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Colonia', 'La Guadalupe'),
(281, '91697', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Unidad habitacional', 'Valente Díaz INFONAVIT'),
(282, '91697', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Colonia', 'Rosario Saldaña'),
(283, '91697', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Colonia', 'Geovillas Del Palmar'),
(284, '91697', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Colonia', 'Progreso'),
(285, '91697', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Colonia', 'Valente Díaz'),
(286, '91697', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Fraccionamiento', 'Dorado Real'),
(287, '91697', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Unidad habitacional', 'Geovillas del Sol'),
(288, '91697', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Colonia', 'Rodríguez Huerta'),
(289, '91697', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Pueblo', 'Mata Cocuite'),
(290, '91697', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Fraccionamiento', 'Residencial del Bosque'),
(291, '91697', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Fraccionamiento', 'Hacienda la Parroquia'),
(292, '91697', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Colonia', 'Unidad Antorchista'),
(293, '91697', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Fraccionamiento', 'El Cortijo'),
(294, '91697', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Fraccionamiento', 'Valle Alto'),
(295, '91697', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Colonia', 'Sentimientos de la Nación'),
(296, '91697', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Fraccionamiento', 'Paseo de las Palmas (Casas Ruba)'),
(297, '91698', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Fraccionamiento', 'Los Torrentes Aeropuerto'),
(298, '91698', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Fraccionamiento', 'Los Héroes Veracruz'),
(299, '91698', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Colonia', 'Las Amapolas'),
(300, '91698', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Colonia', 'Las Amapolas Dos'),
(301, '91698', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Colonia', 'Campestre las Bajadas'),
(302, '91698', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Colonia', 'San José'),
(303, '91698', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Fraccionamiento', 'La Florida'),
(304, '91698', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Colonia', 'Malibran de las Brujas'),
(305, '91699', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Fraccionamiento', 'Puerta Paraíso'),
(306, '91699', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Fraccionamiento', 'Pueblo Nuevo'),
(307, '91699', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Fraccionamiento', 'Xana Plus'),
(308, '91699', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Aeropuerto', 'Veracruz (General Heriberto Jara)'),
(309, '91699', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Colonia', 'Mata de Pita'),
(310, '91699', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Fraccionamiento', 'Hacienda Sotavento'),
(311, '91699', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Fraccionamiento', 'Hacienda Paraíso'),
(312, '91699', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Fraccionamiento', 'Bonaterra'),
(313, '91699', 'Veracruz de Ignacio de la Llave', 'Veracruz', NULL, 'Fraccionamiento', 'Dream Lagoons'),
(314, '91700', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Veracruz Centro'),
(315, '91700', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Madero'),
(316, '91700', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Pino Suárez'),
(317, '91709', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Zona federal', 'Ampliación Puerto de Veracruz'),
(318, '91709', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Faros'),
(319, '91709', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Zona federal', 'Puerto de Veracruz'),
(320, '91710', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'La Armada'),
(321, '91710', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Unidad Veracruzana'),
(322, '91712', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Miguel Hidalgo'),
(323, '91713', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Populares'),
(324, '91713', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Luis Gómez Zepeda'),
(325, '91713', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Nueva Esperanza'),
(326, '91713', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Vías Férreas'),
(327, '91713', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Los Reyes'),
(328, '91714', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Unidad habitacional', 'Chivería INFONAVIT'),
(329, '91715', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'El Vergel'),
(330, '91715', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Asociación Civil'),
(331, '91716', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Benito Juárez'),
(332, '91717', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Lázaro Cárdenas'),
(333, '91717', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Niños Héroes'),
(334, '91717', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Triunfo Unido'),
(335, '91717', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Lázaro Cárdenas II'),
(336, '91717', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Unidad habitacional', 'Casa Blanca'),
(337, '91717', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Lomas de Tarimoya'),
(338, '91718', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Prolongación Miguel Hidalgo (Populares)'),
(339, '91720', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', '21 de Abril'),
(340, '91726', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Nuevo Veracruz'),
(341, '91726', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Pueblos Mágicos'),
(342, '91726', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Xana II'),
(343, '91726', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'El Paraíso'),
(344, '91726', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', '2 Caminos'),
(345, '91726', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Los Laureles'),
(346, '91726', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Los Almendros'),
(347, '91726', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'La Pochota'),
(348, '91726', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Libertad de Expresión'),
(349, '91726', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Las Bajadas'),
(350, '91726', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'El Fénix'),
(351, '91726', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Xana'),
(352, '91726', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Claustros de San Juan Sección Norte'),
(353, '91726', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Hacienda los Portales Sección Norte'),
(354, '91726', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Claustros de San Juan Sección Sur'),
(355, '91726', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Hacienda los Portales Sección Sur'),
(356, '91726', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Los Mangos'),
(357, '91726', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Costa Sol'),
(358, '91726', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Ampliación Las Bajadas'),
(359, '91726', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Emancipación Campesina'),
(360, '91726', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Aeropuerto'),
(361, '91726', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Colinas de San Marcos'),
(362, '91726', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Los Carriles'),
(363, '91726', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Albatros'),
(364, '91727', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Agustín Acosta Lagunes'),
(365, '91727', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Caballerizas'),
(366, '91727', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'La Loma'),
(367, '91727', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Unidad habitacional', 'Los Volcanes'),
(368, '91727', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'La Laguna'),
(369, '91727', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Dora María Treviño'),
(370, '91728', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Panaderos'),
(371, '91729', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Pocitos y Rivera'),
(372, '91729', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Unidad habitacional', 'Coyol Bolívar I'),
(373, '91729', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Unidad habitacional', 'Coyol Bolívar II'),
(374, '91730', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Villa de Guadalupe'),
(375, '91739', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Heriberto Jara Corona'),
(376, '91739', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Julio Tejeda'),
(377, '91740', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Chapultepec'),
(378, '91749', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'San Isidro'),
(379, '91750', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Pascual Ortiz Rubio'),
(380, '91755', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Cristóbal Colón'),
(381, '91756', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'México'),
(382, '91757', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Primero de Mayo'),
(383, '91759', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Venustiano Carranza'),
(384, '91760', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'El Lago'),
(385, '91760', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Condominio', 'El Coyol'),
(386, '91769', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'María Esther Zuno de Echeverría'),
(387, '91770', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Adolfo Ruiz Cortines'),
(388, '91777', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Rafael Díaz Serdan'),
(389, '91777', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Predio 1'),
(390, '91777', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Predio 2'),
(391, '91777', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Predio 3'),
(392, '91777', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Predio 4'),
(393, '91777', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Geovillas Del Puerto'),
(394, '91777', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Periodismo Veraz'),
(395, '91777', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Siglo XXI'),
(396, '91777', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Emiliano Zapata'),
(397, '91777', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Laureles'),
(398, '91778', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Adolfo López Mateos'),
(399, '91779', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Unidad habitacional', 'El Coyol (1a Sección)'),
(400, '91779', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Coyol Magisterio'),
(401, '91779', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Conjunto habitacional', 'Ficus'),
(402, '91779', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Las Palmas'),
(403, '91779', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Coyol Sección IV'),
(404, '91779', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Coyol Zona C'),
(405, '91779', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Coyol Framboyanes'),
(406, '91779', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Coyol Sección A'),
(407, '91779', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Coyol Zona D'),
(408, '91779', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Unidad habitacional', 'Coyol FOVISSSTE'),
(409, '91780', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'El Coyol'),
(410, '91780', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Vista Mar'),
(411, '91780', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Unidad habitacional', 'El Coyol Ivec'),
(412, '91780', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Nezahualcóyotl'),
(413, '91780', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Los Faros'),
(414, '91788', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Unidad habitacional', 'Setse'),
(415, '91788', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'INFONAVIT Medano Buenavista'),
(416, '91789', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Candido Aguilar'),
(417, '91790', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Cuauhtémoc'),
(418, '91790', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Laguna Real'),
(419, '91790', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Ampliación Cuauhtémoc'),
(420, '91799', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Pedro Ignacio Mata'),
(421, '91799', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Unidad habitacional', 'Aries'),
(422, '91800', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Astilleros de Veracruz'),
(423, '91800', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Camino Real'),
(424, '91800', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Villa Rica 1'),
(425, '91800', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Villa Rica 2'),
(426, '91807', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Zona industrial', 'Puerto Seco'),
(427, '91808', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Álika'),
(428, '91808', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Unidad habitacional', 'Riveras de Río Medio'),
(429, '91808', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Lomas del Río Medio V'),
(430, '91808', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Bahía Libre'),
(431, '91808', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Infonavit Orquideas'),
(432, '91808', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Chalchihuecan'),
(433, '91808', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Renacimiento'),
(434, '91808', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Granjas de Rio Medio'),
(435, '91808', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Patria (Diez Hectáreas)'),
(436, '91808', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Condado de Valle Dorado'),
(437, '91808', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'El Campanario'),
(438, '91808', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Unidad habitacional', 'Geovillas los Pinos'),
(439, '91808', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Del Proletariado (Pica Pica)'),
(440, '91808', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Zona industrial', 'Parke 2000'),
(441, '91808', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Costa Dorada'),
(442, '91808', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Los Torrentes'),
(443, '91808', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Geovillas los Pinos II'),
(444, '91808', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Colinas de San Jorge'),
(445, '91808', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Colinas de Santa Fe'),
(446, '91808', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Lomas de Río Medio IV'),
(447, '91808', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Heberto Castillo Martínez'),
(448, '91808', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Arboledas'),
(449, '91808', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Oasis'),
(450, '91808', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Unidad habitacional', 'La Herradura'),
(451, '91808', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Real de los Pinos'),
(452, '91809', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Unidad habitacional', 'Las Hortalizas FOVISSSTE'),
(453, '91809', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Las Brisas'),
(454, '91809', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Las Hortalizas'),
(455, '91809', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Lomas de Río Medio'),
(456, '91809', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Marina Mercante'),
(457, '91809', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Unidad habitacional', 'Río Medio'),
(458, '91809', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Lombardo Toledano'),
(459, '91809', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Del Norte'),
(460, '91809', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'INFONAVIT las Brisas'),
(461, '91809', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Lomas de Río Medio II'),
(462, '91809', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Lomas de Río Medio III'),
(463, '91810', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Playa Linda'),
(464, '91817', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Unidad habitacional', 'Lomas Del Vergel'),
(465, '91820', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Fernando López Arias'),
(466, '91826', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Agrícola Industrial'),
(467, '91826', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Buenavista'),
(468, '91826', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Sánchez'),
(469, '91826', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Cortés'),
(470, '91826', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Geovillas Campestre'),
(471, '91826', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Palma Real'),
(472, '91826', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Palma Real II'),
(473, '91826', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Rincón de Palma Real'),
(474, '91829', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Adolfo Ruiz Cortines Ipe'),
(475, '91840', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Unidad habitacional', 'Empleados Municipales'),
(476, '91841', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Tablajeros'),
(477, '91850', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Unidad habitacional', 'Buenavista INFONAVIT'),
(478, '91850', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Reserva Tarimoya I'),
(479, '91855', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Bosques de Tarimoya'),
(480, '91855', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Ejido Tarimoya'),
(481, '91855', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', '10 de Febrero'),
(482, '91855', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Reserva Tarimoya II'),
(483, '91855', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Reserva Tarimoya III'),
(484, '91855', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Lomas del Ángel'),
(485, '91855', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Santa Teresa'),
(486, '91855', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Las Torres'),
(487, '91859', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Quinta María'),
(488, '91860', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Miguel Ángel de Quevedo'),
(489, '91870', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Los Pinos'),
(490, '91870', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Tecnológico'),
(491, '91870', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Los Pinitos'),
(492, '91880', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Jardín'),
(493, '91880', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Rincón Mexicano'),
(494, '91890', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Virgilio Uribe'),
(495, '91891', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Independencia'),
(496, '91897', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Formando Hogar'),
(497, '91898', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Miguel Alemán'),
(498, '91899', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Manuel Contreras'),
(499, '91900', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Ricardo Flores Magón'),
(500, '91910', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Ignacio Zaragoza'),
(501, '91916', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Electricistas'),
(502, '91918', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Moderno'),
(503, '91919', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Reforma'),
(504, '91920', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Del Maestro'),
(505, '91930', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Militar (Ahorro Postal)'),
(506, '91936', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Las Antillas'),
(507, '91938', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Granjas Veracruz'),
(508, '91940', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Floresta'),
(509, '91947', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Articulo 123'),
(510, '91947', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Unidad habitacional', 'Malibran'),
(511, '91948', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Unidad habitacional', 'Arboledas'),
(512, '91948', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'El Jobo'),
(513, '91948', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Flores Del Valle'),
(514, '91960', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Francisco Villa'),
(515, '91965', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'María C de Rojas'),
(516, '91966', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Fraccionamiento', 'Los Sauces'),
(517, '91966', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Granjas de La Boticaria'),
(518, '91966', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Lorenzo Barcelata'),
(519, '91966', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Alfredo V Bonfil'),
(520, '91966', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Los Ríos'),
(521, '91966', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Bajos del Jobo (Puente Moreno)'),
(522, '91968', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Enrique C Rebsamen'),
(567, '91969', 'Veracruz de Ignacio de la Llave', 'Veracruz', 'Veracruz', 'Colonia', 'Las Razas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido_paterno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido_materno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `rfc` varchar(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `curp` varchar(18) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asentamiento_id` bigint UNSIGNED DEFAULT NULL,
  `calle_numero` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nss` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo_infonavit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contrasena_infonavit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo_redito_id` bigint UNSIGNED DEFAULT NULL,
  `precalificacion` decimal(15,2) NOT NULL DEFAULT '0.00',
  `avaluo_solicitado` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `estado_civil` enum('Soltero','Casado','Divorciado','Viudo','Union_Libre') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `regimen_casamiento` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_documentos`
--

CREATE TABLE `cliente_documentos` (
  `id` bigint UNSIGNED NOT NULL,
  `cliente_id` bigint UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_original` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo_documento` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peso_bytes` int DEFAULT NULL,
  `verificado` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_referencias`
--

CREATE TABLE `cliente_referencias` (
  `id` bigint UNSIGNED NOT NULL,
  `cliente_id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `celular` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parentesco` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asentamiento_id` bigint UNSIGNED DEFAULT NULL,
  `calle_numero` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_telefonos`
--

CREATE TABLE `cliente_telefonos` (
  `id` bigint UNSIGNED NOT NULL,
  `cliente_id` bigint UNSIGNED NOT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_telefono` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Celular',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_zonas_interes`
--

CREATE TABLE `cliente_zonas_interes` (
  `cliente_id` bigint UNSIGNED NOT NULL,
  `asentamiento_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credito_vivienda`
--

CREATE TABLE `credito_vivienda` (
  `tipo_credito_id` bigint UNSIGNED NOT NULL,
  `vivienda_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `credito_vivienda`
--

INSERT INTO `credito_vivienda` (`tipo_credito_id`, `vivienda_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 38),
(1, 39),
(1, 40),
(1, 41),
(1, 42),
(1, 43),
(1, 44),
(1, 45);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_07_14_031524_create_asentamientos_table', 1),
(5, '2026_07_14_040013_create_tipos_credito_table', 1),
(6, '2026_07_14_041428_create_tipos_vivienda_table', 1),
(7, '2026_07_14_042351_create_amenidades_table', 1),
(8, '2026_07_15_012644_create_viviendas_tables', 1),
(9, '2026_07_15_012701_create_credito_y_amenidad_vivienda_tables', 1),
(10, '2026_07_16_015717_create_clientes_table', 2),
(11, '2026_07_16_015803_create_cliente_zonas_interes_table', 2),
(12, '2026_07_16_015811_create_cliente_telefonos_table', 2),
(13, '2026_07_16_015818_create_cliente_referencias_table', 2),
(14, '2026_07_16_015828_create_cliente_documentos_table', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'administrador', 'Perfil con todos los permisos del sistema', '2026-07-16 07:48:58', '2026-07-16 07:48:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil_permiso`
--

CREATE TABLE `perfil_permiso` (
  `perfil_id` bigint UNSIGNED NOT NULL,
  `permiso_id` bigint UNSIGNED NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `is_create` tinyint(1) NOT NULL DEFAULT '0',
  `is_update` tinyint(1) NOT NULL DEFAULT '0',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `perfil_permiso`
--

INSERT INTO `perfil_permiso` (`perfil_id`, `permiso_id`, `is_read`, `is_create`, `is_update`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, '2026-07-16 07:48:58', '2026-07-16 07:48:58'),
(1, 2, 1, 1, 1, 1, '2026-07-16 07:48:58', '2026-07-16 07:48:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil_user`
--

CREATE TABLE `perfil_user` (
  `user_id` bigint UNSIGNED NOT NULL,
  `perfil_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `perfil_user`
--

INSERT INTO `perfil_user` (`user_id`, `perfil_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'administrador', 'Permiso del sistema', '2026-07-16 07:48:58', '2026-07-16 07:48:58'),
(2, 'mod-est-anl', 'Permiso modulo de configuracion', '2026-07-16 07:48:58', '2026-07-16 07:48:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('6P7cnIGUmW3NL44VslLaZOS9o1taCP6CRXOTGjgJ', 1, '192.168.96.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJIbEs1RmRYOTZJbzJiYW9pRVJ2YXBOQVFaeXM0Uks2WndtTnFPQjBvIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDgwXC92aXZpZW5kYXMiLCJyb3V0ZSI6InZpdmllbmRhcy5pbmRleCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxfQ==', 1784310803);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_credito`
--

CREATE TABLE `tipos_credito` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aplica_vivienda` tinyint(1) NOT NULL DEFAULT '1',
  `aplica_cliente` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipos_credito`
--

INSERT INTO `tipos_credito` (`id`, `nombre`, `descripcion`, `aplica_vivienda`, `aplica_cliente`, `created_at`, `updated_at`) VALUES
(1, 'PASIVO INFONAVIT', 'Crédito Infonavit para adquisición de vivienda con pasivo existente (gravamen).', 1, 0, '2026-07-17 02:54:42', '2026-07-17 02:54:42'),
(2, 'FOVISSSTE', 'Crédito para trabajadores al servicio del Estado.', 1, 1, '2026-07-17 02:54:42', '2026-07-17 02:54:42'),
(3, 'HIPOTECARIO', 'Crédito hipotecario tradicional a través de instituciones bancarias comerciales.', 1, 0, '2026-07-17 02:54:42', '2026-07-17 02:54:42'),
(4, 'ISSFAM', 'Crédito para miembros del Instituto de Seguridad Social para las Fuerzas Armadas.', 1, 1, '2026-07-17 02:54:42', '2026-07-17 02:54:42'),
(5, 'INFONAVIT', 'Crédito tradicional INFONAVIT para derechohabientes.', 0, 1, '2026-07-17 02:54:42', '2026-07-17 02:54:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_vivienda`
--

CREATE TABLE `tipos_vivienda` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipos_vivienda`
--

INSERT INTO `tipos_vivienda` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Casa', 'Vivienda unifamiliar completa, independiente o en condominio.', '2026-07-17 02:54:42', '2026-07-17 02:54:42'),
(2, 'Planta baja', 'Departamento o unidad habitacional ubicada a nivel de suelo.', '2026-07-17 02:54:42', '2026-07-17 02:54:42'),
(3, '1er nivel', 'Unidad habitacional ubicada en el primer piso del edificio.', '2026-07-17 02:54:42', '2026-07-17 02:54:42'),
(4, '2do nivel', 'Unidad habitacional ubicada en el segundo piso del edificio.', '2026-07-17 02:54:42', '2026-07-17 02:54:42'),
(5, '3er nivel', 'Unidad habitacional ubicada en el tercer piso o nivel superior.', '2026-07-17 02:54:42', '2026-07-17 02:54:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `usuario` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido_paterno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido_materno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_activo` tinyint(1) NOT NULL DEFAULT '1',
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firma` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `usuario`, `name`, `apellido_paterno`, `apellido_materno`, `email`, `email_verified_at`, `password`, `is_activo`, `foto`, `firma`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrador', 'Sistema', 'Inmobiliaria', 'admin@altamardev.com', NULL, '$2y$12$38kdPmtIwxWhnIk57OPaC.pGN7sMqk1D3QhQ.6TOUT/AALbzuLSBW', 1, NULL, NULL, NULL, '2026-07-16 07:48:58', '2026-07-16 07:48:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viviendas`
--

CREATE TABLE `viviendas` (
  `id` bigint UNSIGNED NOT NULL,
  `fraccionamiento` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asentamiento_id` bigint UNSIGNED DEFAULT NULL,
  `tipo_vivienda_id` bigint UNSIGNED DEFAULT NULL,
  `precio_lista` decimal(12,2) NOT NULL,
  `recamaras` int NOT NULL DEFAULT '0',
  `direccion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `llaves` tinyint(1) NOT NULL DEFAULT '0',
  `estatus_vivienda` enum('Disponible','Apartada','Vendida','Rentada','Mantenimiento','Suspendida') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Disponible',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `viviendas`
--

INSERT INTO `viviendas` (`id`, `fraccionamiento`, `asentamiento_id`, `tipo_vivienda_id`, `precio_lista`, `recamaras`, `direccion`, `llaves`, `estatus_vivienda`, `created_at`, `updated_at`) VALUES
(1, 'valle alto', 294, 4, 395000.00, 2, 'perdiz 355-c', 1, 'Disponible', '2026-04-08 09:39:06', '2026-07-17 08:57:05'),
(2, 'avenida sotavento', 310, 4, 398000.00, 2, 'privada palma real 25 int e', 0, 'Disponible', '2026-04-08 09:43:11', '2026-07-17 08:58:45'),
(3, 'SAN MIGUEL', 214, 1, 400000.00, 1, 'rincon de copite 73', 0, 'Apartada', '2026-04-08 09:49:36', '2026-07-17 08:59:30'),
(4, 'VALLE ALTO', 294, 4, 425000.00, 2, 'pinguino 346 int c', 0, 'Disponible', '2026-04-08 09:57:37', '2026-07-17 09:00:13'),
(5, 'campanario', 437, 1, 480000.00, 1, 'nicho 4140', 0, 'Disponible', '2026-04-08 10:21:44', '2026-07-17 09:00:45'),
(6, 'TORRENTES AEROPUERTO', 297, 3, 485000.00, 1, 'aerolinea 1504int d', 0, 'Apartada', '2026-04-08 10:25:23', '2026-07-17 09:01:38'),
(7, 'san miguel', 214, 1, 440000.00, 1, 'copite 53', 1, 'Disponible', '2026-04-08 10:29:37', '2026-07-17 09:02:13'),
(8, 'LOMAS 4', 446, 4, 450000.00, 2, 'rio esva 45 int 5', 0, 'Disponible', '2026-04-08 10:45:44', '2026-07-17 09:03:14'),
(9, 'HACIENDA SOTAVENTO', 310, 4, 450000.00, 2, 'PRIV. AMAPOLITA 846 INT F', 1, 'Disponible', '2026-04-10 03:39:46', '2026-07-17 09:04:46'),
(10, 'JARDINES de santa fe', 259, 5, 415000.00, 2, 'cerro ixbul 86-h', 0, 'Disponible', '2026-04-10 03:50:05', '2026-07-17 09:08:13'),
(11, 'ARA PALMA REAL', 473, 4, 430000.00, 0, 'carolina 44-8d', 0, 'Disponible', '2026-04-10 06:36:25', '2026-07-17 09:10:26'),
(12, 'JARDINES de santa fe', 259, 4, 430000.00, 2, 'jiutepec', 0, 'Disponible', '2026-04-10 06:38:32', '2026-07-17 09:29:17'),
(13, 'rincon de palma real', 473, 4, 440000.00, 2, 'florida 1-d', 1, 'Disponible', '2026-04-10 06:41:42', '2026-07-17 09:24:54'),
(14, 'hacienda SOTAVENTO', 310, 3, 455000.00, 2, 'laguna de alvarado 163-c', 1, 'Disponible', '2026-04-10 06:54:21', '2026-07-17 09:23:01'),
(15, 'san miguel', 214, 1, 445000.00, 1, 'av. san miguel 46', 0, 'Disponible', '2026-04-11 03:57:23', '2026-07-17 21:38:55'),
(16, 'lomas 4', 446, 4, 450000.00, 2, 'rio acre 153 int 5', 0, 'Disponible', '2026-04-11 04:00:06', '2026-07-17 21:39:52'),
(17, 'colinas santa fe', 445, 2, 460000.00, 2, 'san cristobal 371', 0, 'Disponible', '2026-04-11 04:07:01', '2026-07-17 21:40:55'),
(18, 'rincon de palma real', 473, 3, 470000.00, 2, 'palma florida 3 int 5-b', 0, 'Disponible', '2026-04-11 04:12:31', '2026-07-17 21:41:26'),
(19, 'san miguel', 214, 1, 490000.00, 2, 'salazar 18', 0, 'Disponible', '2026-04-11 04:16:38', '2026-07-17 21:42:23'),
(20, 'privanzas', 266, 4, 490000.00, 2, 'lance 96 int 201', 0, 'Disponible', '2026-04-11 04:19:51', '2026-07-17 21:43:02'),
(21, 'hacienda sotavento', 310, 3, 495000.00, 2, 'priv. ascension 22', 1, 'Disponible', '2026-04-11 04:26:24', '2026-07-17 21:43:58'),
(22, 'colinas santa fe', 445, 2, 495000.00, 2, 'san cristobal 216 int b', 1, 'Disponible', '2026-04-11 04:28:57', '2026-07-17 21:44:24'),
(23, 'privanzas', 266, 3, 495000.00, 2, 'dehesa 67 int 101', 1, 'Disponible', '2026-04-11 04:35:47', '2026-07-17 21:44:58'),
(24, 'colinas santa fe', 445, 2, 497000.00, 1, 'san rafael 208-a', 0, 'Disponible', '2026-04-11 04:38:29', '2026-07-17 21:45:53'),
(25, 'EXOME', NULL, 3, 500000.00, 2, '5 de mayo norte 44 f', 1, 'Apartada', '2026-04-11 04:43:24', '2026-05-29 08:51:10'),
(26, 'campanario', 437, 1, 545000.00, 1, 'boveda 4302', 0, 'Disponible', '2026-04-11 04:46:36', '2026-07-17 21:48:26'),
(27, 'colinas santa fe', 445, 1, 560000.00, 2, 'san adrian 251', 0, 'Disponible', '2026-04-11 04:56:46', '2026-07-17 21:48:48'),
(28, 'colinas santa fe', 445, 1, 570000.00, 2, 'san soriano 233', 0, 'Disponible', '2026-04-11 05:13:59', '2026-07-17 21:49:42'),
(29, 'florida', 303, 1, 580000.00, 1, 'acacia 502', 0, 'Disponible', '2026-04-11 05:40:44', '2026-07-17 21:52:17'),
(30, 'ara palma real', 473, 1, 595000.00, 1, 'paseo de montijo 36', 1, 'Disponible', '2026-04-11 05:44:13', '2026-07-17 21:56:52'),
(31, 'hacienda SOTAVENTO', 310, 1, 598000.00, 2, 'priv janara 120', 1, 'Disponible', '2026-04-11 05:47:15', '2026-07-17 21:57:39'),
(32, 'torrentes aeropuerto', 297, 1, 620000.00, 2, 'avion 671-b', 0, 'Disponible', '2026-04-11 05:53:59', '2026-07-17 21:58:13'),
(33, 'LA PARROQUIA', 291, 1, 630000.00, 1, 'san martin de porre 561', 0, 'Disponible', '2026-04-11 05:57:51', '2026-07-17 21:58:49'),
(34, 'la parroquia', 291, 1, 650000.00, 2, 'san arcadio 34', 1, 'Disponible', '2026-04-11 06:05:14', '2026-07-17 22:05:39'),
(35, 'COLINAS SANTA FE', 445, 1, 680000.00, 2, 'isidro 267', 1, 'Vendida', '2026-04-11 06:06:57', '2026-07-17 22:06:40'),
(36, 'COL. MEXICO/VICTORIA', NULL, 4, 740000.00, 3, 'paraguay 2143 dep 3', 1, 'Vendida', '2026-04-11 06:09:36', '2026-04-11 06:13:00'),
(37, 'ponti cortijo', 293, 1, 795000.00, 2, 'retorno escarbado 93', 1, 'Vendida', '2026-04-11 06:12:33', '2026-07-17 21:37:33'),
(38, 'torrentes', 442, 1, 820000.00, 2, 'ala 1095 int a', 0, 'Disponible', '2026-04-11 06:14:42', '2026-07-17 21:38:08'),
(39, 'TORRENTES AEROPUERTO', 297, 1, 835000.00, 2, 'aeropuerto 1049-b', 1, 'Disponible', '2026-04-11 06:17:51', '2026-07-17 22:08:52'),
(40, 'GEO CAMPESTRE', 470, 1, 850000.00, 3, 'bosques de caoba 51', 0, 'Vendida', '2026-04-11 06:20:26', '2026-07-17 22:09:46'),
(41, 'rio medio', 455, 1, 865000.00, 3, 'rio panuco 1245', 1, 'Vendida', '2026-04-11 06:23:50', '2026-07-17 21:35:55'),
(42, 'laguna real', 418, 1, 870000.00, 2, 'retorno estiaje 17', 1, 'Disponible', '2026-04-11 06:27:00', '2026-07-17 21:35:08'),
(43, 'RIO MEDIO 1', 457, 1, 890000.00, 2, 'magdalena 1451', 0, 'Vendida', '2026-04-11 06:29:00', '2026-07-17 09:28:35'),
(44, 'HACIENDA LOS PORTALES', 355, 1, 920000.00, 2, 'valencia 13', 1, 'Disponible', '2026-04-11 06:30:59', '2026-07-17 09:27:39'),
(45, 'HACIENDA PARAISO', 311, 1, 950000.00, 2, 'hacienda santa cruz 33', 0, 'Disponible', '2026-04-11 06:33:11', '2026-07-17 09:26:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vivienda_contactos`
--

CREATE TABLE `vivienda_contactos` (
  `id` bigint UNSIGNED NOT NULL,
  `vivienda_id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `relacion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `vivienda_contactos`
--

INSERT INTO `vivienda_contactos` (`id`, `vivienda_id`, `nombre`, `relacion`, `telefono`, `correo`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 'gerardo ramos ortega', 'Contacto de Venta', '2291728150', NULL, NULL, '2026-04-08 09:39:06', '2026-07-17 23:09:01'),
(2, 2, 'adrian torres salamanca', 'Contacto de Venta', '2292140434', NULL, NULL, '2026-04-08 09:43:11', '2026-07-17 08:58:45'),
(3, 3, 'alfredo ortiz ramirez', 'Contacto de Venta', '2296001118', NULL, NULL, '2026-04-08 09:49:36', '2026-07-17 08:59:30'),
(4, 4, 'thais osorio gomez', 'Contacto de Venta', '2291447263', NULL, NULL, '2026-04-08 09:57:37', '2026-07-17 09:00:13'),
(5, 5, 'juana solis', 'Contacto de Venta', '2294158602', NULL, NULL, '2026-04-08 10:21:44', '2026-07-17 09:00:45'),
(6, 6, 'ernesto montero', 'Contacto de Venta', '2299011124', NULL, NULL, '2026-04-08 10:25:23', '2026-07-17 09:01:38'),
(7, 7, 'daniel cervantes', 'Contacto de Venta', '2299472975', NULL, NULL, '2026-04-08 10:29:37', '2026-07-17 09:03:55'),
(8, 8, 'angel ixtapan lopez', 'Contacto de Venta', '7122098509', NULL, NULL, '2026-04-08 10:45:44', '2026-07-17 09:03:14'),
(9, 9, 'GUADALUPE DOMINGUEZ VELAZQUEZ', 'Contacto de Venta', '7581688845', NULL, '', '2026-04-10 03:39:46', '2026-07-17 09:04:46'),
(10, 10, 'jose eden hernandez', 'Contacto de Venta', '2295303810', NULL, NULL, '2026-04-10 03:50:05', '2026-07-17 09:08:13'),
(11, 11, 'juan santiago barradas', 'Contacto de Venta', '2295414112', NULL, '', '2026-04-10 06:36:25', '2026-07-17 09:10:26'),
(12, 12, 'jose manuel chiquito rodriguez', 'Contacto de Venta', '2291823013', NULL, NULL, '2026-04-10 06:38:32', '2026-07-17 09:29:17'),
(13, 13, 'rogel zaqueo olivares', 'Contacto de Venta', '2293550716', NULL, '', '2026-04-10 06:41:42', '2026-07-17 09:24:54'),
(14, 14, 'gerardi reyes rodriguez', 'Contacto de Venta', '2294943940', NULL, '', '2026-04-10 06:54:21', '2026-07-17 09:23:28'),
(15, 15, 'erick daniel rosado', 'Contacto de Venta', '2297332379', NULL, '', '2026-04-11 03:57:23', '2026-07-17 21:38:55'),
(16, 16, 'mariaelena olvera', 'Contacto de Venta', '2295493385', NULL, '', '2026-04-11 04:00:06', '2026-07-17 21:40:12'),
(17, 17, 'concepcion carmona', 'Contacto de Venta', '2293392240', NULL, '', '2026-04-11 04:07:01', '2026-07-17 21:40:55'),
(18, 18, 'carlos valente diaz', 'Contacto de Venta', '2291434816', NULL, NULL, '2026-04-11 04:12:31', '2026-07-17 21:41:26'),
(19, 19, 'maria antonia murillo', 'Contacto de Venta', '2291416157', NULL, NULL, '2026-04-11 04:16:38', '2026-07-17 21:42:23'),
(20, 20, 'leonardo martinez garcia', 'Contacto de Venta', '2291619312', NULL, ' ', '2026-04-11 04:19:51', '2026-07-17 21:43:02'),
(21, 21, 'maria dolores fiscal toto', 'Contacto de Venta', '2941180635', NULL, NULL, '2026-04-11 04:26:24', '2026-07-17 21:44:02'),
(22, 22, 'mertha mendez carmona', 'Contacto de Venta', '2295313740', NULL, NULL, '2026-04-11 04:28:57', '2026-07-17 21:44:24'),
(23, 23, 'abell lozano vargas', 'Contacto de Venta', '2293647141', NULL, '', '2026-04-11 04:35:47', '2026-07-17 21:45:12'),
(24, 24, 'mauro rafael hernandez lara', 'Contacto de Venta', '2292089295', NULL, NULL, '2026-04-11 04:38:29', '2026-07-17 21:45:53'),
(25, 25, 'gloria luz huerta martinez', 'Contacto de Venta', '2292659913', NULL, NULL, '2026-04-11 04:43:24', '2026-05-29 08:51:10'),
(26, 26, 'juan ibarra lopez', 'Contacto de Venta', '2292036171', NULL, NULL, '2026-04-11 04:46:36', '2026-07-17 21:48:26'),
(27, 27, 'rafael medina', 'Contacto de Venta', '2293994235', NULL, NULL, '2026-04-11 04:56:46', '2026-07-17 21:48:48'),
(28, 28, 'jose reinaldo gutierrez', 'Contacto de Venta', '2291601147', NULL, '', '2026-04-11 05:13:59', '2026-07-17 21:50:26'),
(29, 29, 'esteban morales', 'Contacto de Venta', '2299087575', NULL, '', '2026-04-11 05:40:44', '2026-07-17 21:52:29'),
(30, 30, 'jose manuel barojas garin', 'Contacto de Venta', '2297784278', NULL, NULL, '2026-04-11 05:44:13', '2026-07-17 21:56:52'),
(31, 31, 'rosario de los angeles hernandez', 'Contacto de Venta', '2291193801', NULL, NULL, '2026-04-11 05:47:15', '2026-07-17 21:57:39'),
(32, 32, 'berenice vega colorado', 'Contacto de Venta', '6122279120', NULL, NULL, '2026-04-11 05:53:59', '2026-07-17 21:58:13'),
(33, 33, 'omar amezcua aleman', 'Contacto de Venta', '2296972976', NULL, '', '2026-04-11 05:57:51', '2026-07-17 21:58:49'),
(34, 34, 'francisco cisceros libreros', 'Contacto de Venta', '2293672405', NULL, NULL, '2026-04-11 06:05:14', '2026-07-17 22:05:39'),
(35, 35, 'juana lidia martinez', 'Contacto de Venta', '2292054296', NULL, NULL, '2026-04-11 06:06:57', '2026-07-17 22:06:40'),
(36, 36, 'alejandra', 'Contacto de Venta', '2289795527', NULL, NULL, '2026-04-11 06:09:36', '2026-04-11 06:13:00'),
(37, 37, 'julian diaz escalante', 'Contacto de Venta', '2851125373', NULL, NULL, '2026-04-11 06:12:33', '2026-07-17 21:37:33'),
(38, 38, 'jaime castillo romero', 'Contacto de Venta', '2295504893', NULL, NULL, '2026-04-11 06:14:42', '2026-07-17 21:38:08'),
(39, 39, 'luis fernando barrientos', 'Contacto de Venta', '2297245089', NULL, '', '2026-04-11 06:17:51', '2026-07-17 22:08:52'),
(40, 40, 'angelica hernandez cruz', 'Contacto de Venta', '2297811499', NULL, '', '2026-04-11 06:20:26', '2026-07-17 22:09:46'),
(41, 41, 'ricardo medina dominguez', 'Contacto de Venta', '2292509794', NULL, NULL, '2026-04-11 06:23:50', '2026-07-17 21:36:16'),
(42, 42, 'myrna reyes roman', 'Contacto de Venta', '2294665527', NULL, NULL, '2026-04-11 06:27:00', '2026-07-17 21:35:08'),
(43, 43, 'pablo dominguez delgado', 'Contacto de Venta', '2291752182', NULL, 'Teléfono secundario histórico: 2299578155', '2026-04-11 06:29:00', '2026-07-17 09:28:35'),
(44, 44, 'ivan saldaña nava', 'Contacto de Venta', '2291395915', NULL, '', '2026-04-11 06:30:59', '2026-07-17 09:27:39'),
(45, 45, 'juan alberto ruiz', 'Contacto de Venta', '2293120976', NULL, '', '2026-04-11 06:33:11', '2026-07-17 09:26:11'),
(46, 9, 'GUADALUPE DOMINGUEZ VELAZQUEZ', 'Contacto de Venta', '2791059653', '', '', '2026-07-17 09:04:46', '2026-07-17 09:04:46'),
(47, 11, 'juan santiago barradas', 'Contacto de Venta', '2291783909', '', '', '2026-07-17 09:10:26', '2026-07-17 09:10:26'),
(48, 14, 'gerardi reyes rodriguez', 'Contacto de Venta', '2294127431', '', '', '2026-07-17 09:23:28', '2026-07-17 09:23:28'),
(49, 13, 'rogel zaqueo olivares', 'Contacto de Venta', '2291056127', '', '', '2026-07-17 09:24:54', '2026-07-17 09:24:54'),
(50, 45, 'juan alberto ruiz', 'Contacto de Venta', '2291244447', '', '', '2026-07-17 09:26:11', '2026-07-17 09:26:11'),
(51, 44, 'ivan saldaña nava', 'Contacto de Venta', '5560851302', '', '', '2026-07-17 09:27:39', '2026-07-17 09:27:39'),
(52, 43, 'pablo dominguez delgado', 'Contacto de Venta', '2299578155', '', 'Teléfono secundario histórico: 2299578155', '2026-07-17 09:28:35', '2026-07-17 09:28:35'),
(53, 15, 'erick daniel rosado', 'Contacto de Venta', '2294361873', '', '', '2026-07-17 21:38:55', '2026-07-17 21:38:55'),
(54, 16, 'mariaelena olvera', 'Contacto de Venta', '2299099098', '', '', '2026-07-17 21:40:12', '2026-07-17 21:40:12'),
(55, 17, 'concepcion carmona', 'Contacto de Venta', '2294959189', '', '', '2026-07-17 21:40:55', '2026-07-17 21:40:55'),
(56, 20, 'leonardo martinez garcia', 'Contacto de Venta', '2293672645', '', '', '2026-07-17 21:43:02', '2026-07-17 21:43:02'),
(57, 23, 'abell lozano vargas', 'Contacto de Venta', '2295301536', '', '', '2026-07-17 21:45:12', '2026-07-17 21:45:12'),
(58, 28, 'jose reinaldo gutierrez', 'Contacto de Venta', '2283159966', '', '', '2026-07-17 21:50:26', '2026-07-17 21:50:26'),
(59, 29, 'esteban morales', 'Contacto de Venta', '2294402580', '', '', '2026-07-17 21:52:29', '2026-07-17 21:52:29'),
(60, 39, 'luis fernando barrientos', 'Contacto de Venta', '2291265114', '', '', '2026-07-17 22:08:52', '2026-07-17 22:08:52'),
(61, 40, 'angelica hernandez cruz', 'Contacto de Venta', '2291265114', '', '', '2026-07-17 22:09:46', '2026-07-17 22:09:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vivienda_documentos`
--

CREATE TABLE `vivienda_documentos` (
  `id` bigint UNSIGNED NOT NULL,
  `vivienda_id` bigint UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_original` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo_documento` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peso_bytes` int DEFAULT NULL,
  `verificado` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vivienda_fotos`
--

CREATE TABLE `vivienda_fotos` (
  `id` bigint UNSIGNED NOT NULL,
  `vivienda_id` bigint UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_original` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orden` int NOT NULL DEFAULT '0',
  `es_principal` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `amenidades`
--
ALTER TABLE `amenidades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `amenidad_vivienda`
--
ALTER TABLE `amenidad_vivienda`
  ADD PRIMARY KEY (`amenidad_id`,`vivienda_id`),
  ADD KEY `amenidad_vivienda_vivienda_id_foreign` (`vivienda_id`);

--
-- Indices de la tabla `asentamientos`
--
ALTER TABLE `asentamientos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asentamientos_cp_index` (`codigo_postal`);

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clientes_rfc_unique` (`rfc`),
  ADD UNIQUE KEY `clientes_curp_unique` (`curp`),
  ADD KEY `clientes_asentamiento_id_foreign` (`asentamiento_id`),
  ADD KEY `clientes_tipo_redito_id_foreign` (`tipo_redito_id`);

--
-- Indices de la tabla `cliente_documentos`
--
ALTER TABLE `cliente_documentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_documento_tipo_index` (`cliente_id`,`tipo_documento`);

--
-- Indices de la tabla `cliente_referencias`
--
ALTER TABLE `cliente_referencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_referencias_asentamiento_id_foreign` (`asentamiento_id`),
  ADD KEY `referencias_cliente_id_index` (`cliente_id`);

--
-- Indices de la tabla `cliente_telefonos`
--
ALTER TABLE `cliente_telefonos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `telefonos_cliente_id_index` (`cliente_id`);

--
-- Indices de la tabla `cliente_zonas_interes`
--
ALTER TABLE `cliente_zonas_interes`
  ADD PRIMARY KEY (`cliente_id`,`asentamiento_id`),
  ADD KEY `cliente_zonas_interes_asentamiento_id_foreign` (`asentamiento_id`);

--
-- Indices de la tabla `credito_vivienda`
--
ALTER TABLE `credito_vivienda`
  ADD PRIMARY KEY (`tipo_credito_id`,`vivienda_id`),
  ADD KEY `credito_vivienda_vivienda_id_foreign` (`vivienda_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `perfiles_nombre_unique` (`nombre`);

--
-- Indices de la tabla `perfil_permiso`
--
ALTER TABLE `perfil_permiso`
  ADD PRIMARY KEY (`perfil_id`,`permiso_id`),
  ADD KEY `perfil_permiso_permiso_id_foreign` (`permiso_id`);

--
-- Indices de la tabla `perfil_user`
--
ALTER TABLE `perfil_user`
  ADD PRIMARY KEY (`user_id`,`perfil_id`),
  ADD KEY `perfil_user_perfil_id_foreign` (`perfil_id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permisos_nombre_unique` (`nombre`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `tipos_credito`
--
ALTER TABLE `tipos_credito`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos_vivienda`
--
ALTER TABLE `tipos_vivienda`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_usuario_unique` (`usuario`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `viviendas`
--
ALTER TABLE `viviendas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `viviendas_asentamiento_id_foreign` (`asentamiento_id`),
  ADD KEY `viviendas_tipo_vivienda_id_foreign` (`tipo_vivienda_id`),
  ADD KEY `viviendas_estatus_index` (`estatus_vivienda`),
  ADD KEY `viviendas_fraccionamiento_index` (`fraccionamiento`);

--
-- Indices de la tabla `vivienda_contactos`
--
ALTER TABLE `vivienda_contactos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contactos_vivienda_id_index` (`vivienda_id`);

--
-- Indices de la tabla `vivienda_documentos`
--
ALTER TABLE `vivienda_documentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vivienda_documento_tipo_index` (`vivienda_id`,`tipo_documento`);

--
-- Indices de la tabla `vivienda_fotos`
--
ALTER TABLE `vivienda_fotos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vivienda_fotos_vivienda_id_foreign` (`vivienda_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `amenidades`
--
ALTER TABLE `amenidades`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `asentamientos`
--
ALTER TABLE `asentamientos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=568;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cliente_documentos`
--
ALTER TABLE `cliente_documentos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cliente_referencias`
--
ALTER TABLE `cliente_referencias`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cliente_telefonos`
--
ALTER TABLE `cliente_telefonos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipos_credito`
--
ALTER TABLE `tipos_credito`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tipos_vivienda`
--
ALTER TABLE `tipos_vivienda`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `viviendas`
--
ALTER TABLE `viviendas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `vivienda_contactos`
--
ALTER TABLE `vivienda_contactos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `vivienda_documentos`
--
ALTER TABLE `vivienda_documentos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `vivienda_fotos`
--
ALTER TABLE `vivienda_fotos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `amenidad_vivienda`
--
ALTER TABLE `amenidad_vivienda`
  ADD CONSTRAINT `amenidad_vivienda_amenidad_id_foreign` FOREIGN KEY (`amenidad_id`) REFERENCES `amenidades` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `amenidad_vivienda_vivienda_id_foreign` FOREIGN KEY (`vivienda_id`) REFERENCES `viviendas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_asentamiento_id_foreign` FOREIGN KEY (`asentamiento_id`) REFERENCES `asentamientos` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `clientes_tipo_redito_id_foreign` FOREIGN KEY (`tipo_redito_id`) REFERENCES `tipos_credito` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `cliente_documentos`
--
ALTER TABLE `cliente_documentos`
  ADD CONSTRAINT `cliente_documentos_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cliente_referencias`
--
ALTER TABLE `cliente_referencias`
  ADD CONSTRAINT `cliente_referencias_asentamiento_id_foreign` FOREIGN KEY (`asentamiento_id`) REFERENCES `asentamientos` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `cliente_referencias_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cliente_telefonos`
--
ALTER TABLE `cliente_telefonos`
  ADD CONSTRAINT `cliente_telefonos_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cliente_zonas_interes`
--
ALTER TABLE `cliente_zonas_interes`
  ADD CONSTRAINT `cliente_zonas_interes_asentamiento_id_foreign` FOREIGN KEY (`asentamiento_id`) REFERENCES `asentamientos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cliente_zonas_interes_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `credito_vivienda`
--
ALTER TABLE `credito_vivienda`
  ADD CONSTRAINT `credito_vivienda_tipo_credito_id_foreign` FOREIGN KEY (`tipo_credito_id`) REFERENCES `tipos_credito` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `credito_vivienda_vivienda_id_foreign` FOREIGN KEY (`vivienda_id`) REFERENCES `viviendas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `perfil_permiso`
--
ALTER TABLE `perfil_permiso`
  ADD CONSTRAINT `perfil_permiso_perfil_id_foreign` FOREIGN KEY (`perfil_id`) REFERENCES `perfiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `perfil_permiso_permiso_id_foreign` FOREIGN KEY (`permiso_id`) REFERENCES `permisos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `perfil_user`
--
ALTER TABLE `perfil_user`
  ADD CONSTRAINT `perfil_user_perfil_id_foreign` FOREIGN KEY (`perfil_id`) REFERENCES `perfiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `perfil_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `viviendas`
--
ALTER TABLE `viviendas`
  ADD CONSTRAINT `viviendas_asentamiento_id_foreign` FOREIGN KEY (`asentamiento_id`) REFERENCES `asentamientos` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `viviendas_tipo_vivienda_id_foreign` FOREIGN KEY (`tipo_vivienda_id`) REFERENCES `tipos_vivienda` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `vivienda_contactos`
--
ALTER TABLE `vivienda_contactos`
  ADD CONSTRAINT `vivienda_contactos_vivienda_id_foreign` FOREIGN KEY (`vivienda_id`) REFERENCES `viviendas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `vivienda_documentos`
--
ALTER TABLE `vivienda_documentos`
  ADD CONSTRAINT `vivienda_documentos_vivienda_id_foreign` FOREIGN KEY (`vivienda_id`) REFERENCES `viviendas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `vivienda_fotos`
--
ALTER TABLE `vivienda_fotos`
  ADD CONSTRAINT `vivienda_fotos_vivienda_id_foreign` FOREIGN KEY (`vivienda_id`) REFERENCES `viviendas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
