-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:8889
-- Tiempo de generación: 16-07-2018 a las 18:26:45
-- Versión del servidor: 5.6.38
-- Versión de PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `my-api-1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `charge`
--

-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:8889
-- Tiempo de generación: 16-07-2018 a las 18:45:23
-- Versión del servidor: 5.6.38
-- Versión de PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `my-api-1`
--
CREATE DATABASE IF NOT EXISTS `my-api-1` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `my-api-1`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `charge`
--

DROP TABLE IF EXISTS `charge`;
CREATE TABLE `charge` (
  `id` int(8) UNSIGNED NOT NULL,
  `payment_id` int(8) UNSIGNED NOT NULL,
  `amount` float(9,2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `charge`
--

INSERT INTO `charge` (`id`, `payment_id`, `amount`) VALUES
(1, 2, 10129.57),
(2, 2, 10129.57),
(3, 1, 132.19),
(4, 1, 132.19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE `payment` (
  `id` int(8) UNSIGNED NOT NULL,
  `name` varchar(128) NOT NULL,
  `type` set('CC','DD') NOT NULL DEFAULT 'CC',
  `iban` varchar(32) DEFAULT NULL,
  `expiry` date DEFAULT NULL,
  `cc` int(4) DEFAULT NULL,
  `ccv` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `payment`
--

INSERT INTO `payment` (`id`, `name`, `type`, `iban`, `expiry`, `cc`, `ccv`) VALUES
(1, 'XXXXXX YYYYYY ZZZZZ', 'DD', 'ES098798768765RAND98769876987647', NULL, NULL, NULL),
(2, 'XXXXX YYYYY ZZZZZ', 'CC', NULL, '2024-12-05', 298, 3419);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `charge`
--
ALTER TABLE `charge`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_id` (`payment_id`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `charge`
--
ALTER TABLE `charge`
  MODIFY `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `charge`
--
ALTER TABLE `charge`
  ADD CONSTRAINT `charge_ibfk_1` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
