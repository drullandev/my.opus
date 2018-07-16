-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 21-08-2017 a las 17:54:21
-- Versión del servidor: 5.6.35
-- Versión de PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `habitissimo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `budgeting`
--

CREATE TABLE `budgeting` (
  `id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `category` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `budgeting`
--

INSERT INTO `budgeting` (`id`, `user_id`, `category`, `title`, `description`, `status`) VALUES
(1, 1, 'Loquesea 1', 'El título 1', 'La descripción 1', 'El estatus 1'),
(2, 2, 'Loquesea 2', 'El titulo 2', 'La descripción 2', 'El estatus 2'),
(3, 2, 'MODCategoría', 'MODTítulo', 'MODProbando una descripción...', 'publicada'),
(4, 1, '', 'Título', 'Probando una descripción...', 'descartada'),
(5, 2, 'Categoría', 'Título', 'Probando una descripción...', 'descartada'),
(6, 3, 'Categoría', 'Título', 'Probando una descripción...', 'pendiente'),
(7, 2, 'Categoría', 'Título', 'Probando una descripción...', 'descartada'),
(8, 2, 'Categoría', 'Título', 'Probando una descripción...', 'pendiente'),
(9, 2, 'Categoría', 'Título', 'Probando una descripción...', 'pendiente'),
(10, 2, 'Categoría', 'Título', 'Probando una descripción...', 'descartada'),
(11, 2, 'Categoría', 'Título', 'Probando una descripción...', 'descartada'),
(12, 5, 'La categoría dsf gsd', 'El título refwerf', 'La descripción gdfgwe', 'descartada'),
(13, 2, 'Categoría', 'Título', 'Probando una descripción...', 'descartada'),
(14, 4, 'Categoría', 'Título', 'Probando una descripción...', 'descartada'),
(15, 4, 'Categoría', 'Título', 'Probando una descripción...', 'pendiente'),
(16, 4, 'Categoría', 'Título', 'Probando una descripción...', 'pendiente'),
(17, 4, 'Categoría', 'Título', 'Probando una descripción...', 'pendiente'),
(18, 4, 'Categoría', 'Título', 'Probando una descripción...', 'pendiente'),
(19, 4, 'Categoría', 'Título', 'Probando una descripción...', 'pendiente'),
(20, 4, 'Categoría', 'Título', 'Probando una descripción...', 'pendiente'),
(21, 4, 'Categoría', 'Título', 'Probando una descripción...', 'pendiente'),
(22, 4, 'Categoría', 'Título', 'Probando una descripción...', 'pendiente'),
(23, 5, 'La categoría dsf gsd', 'El título rf', 'La descripción gdfgwe', 'pendiente'),
(24, 5, 'La categoría', 'El título', 'La descripción', 'pendiente'),
(25, 5, 'La categoría', 'El título', 'La descripción', 'pendiente'),
(26, 5, 'La categoría', 'El título', 'La descripción', 'pendiente'),
(27, 5, 'La categoría', 'El título', 'La descripción', 'pendiente'),
(28, 5, 'La categoría', 'El título', 'La descripción', 'pendiente'),
(29, 5, 'La categoría', 'El título', 'La descripción', 'pendiente'),
(30, 5, 'La categoría', 'El título', 'La descripción', 'pendiente'),
(31, 5, 'La categoría', 'El título', 'La descripción', 'pendiente'),
(32, 5, 'La categoría', 'El título', 'La descripción', 'pendiente'),
(33, 5, 'La categoría', 'El título', 'La descripción', 'pendiente'),
(34, 5, 'La categoría', 'El título', 'La descripción', 'pendiente'),
(35, 5, 'La categoría', 'El título', 'La descripción', 'pendiente'),
(36, 5, 'La categoría', 'El título', 'La descripción', 'pendiente'),
(37, 6, 'La categoría', 'El título', 'La descripción', 'pendiente'),
(38, 7, 'La categoría', 'El título', 'La descripción', 'pendiente'),
(39, 5, 'La categoría', 'El título', 'La descripción', 'pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phonenum` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `email`, `phonenum`, `address`) VALUES
(1, 'drullan.dev@gmail.com', '+34677628086', 'La dirección mía'),
(2, 'test.dev@gmail.com', '+3424223', 'Pruebas de dirección'),
(3, 'test2.dev@gmail.com', '+34677628086', 'Pruebas de dirección2'),
(4, 'test.dev5@gmail.com', '+3424223', 'Pruebas de dirección'),
(5, 'email@email.com', '+34677628086', 'La dirección'),
(6, 'emailemail.com', '+34677628086', 'La dirección'),
(7, 'emailemailcom', '+34677628086', 'La dirección');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_training`
--

CREATE TABLE `_training` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `_training`
--

INSERT INTO `_training` (`id`, `category`, `description`) VALUES
(1, 'Calefacción', 'Presupuesto de colocación de 1 termo a gas-butano de 11 litros junker.'),
(2, 'Calefacción', 'Instalacion de caldera tres cuartos, hol pasillo y comedor de calefacion.'),
(3, 'Calefacción', 'Calefaccion en casa, necesitaria radiadores y calefactor ya que todo lo tengo a luz.'),
(4, 'Calefacción', 'Instalar termo de gas natural de 14L, sustituyendo el averiado. Con certificación.'),
(5, 'Calefacción', 'Buenos dias. Me gustaria instalar calefacción electrica en casa. Estoy interesada en poner radiadores electricos o suelo radiante. Entiendo que la segunda opción es mas cara y más complicada de instalar. Dispongo de suelo de tarima. La casa tiene aprox 53 m cuadrados. \n\nEn caso de radiadores electricos, serían instalar dos en el salon comedor, uno en la habitación grande, uno pequeño en la habitación pequeña y un radiador toallero en el baño.'),
(6, 'Calefacción', 'Instalación de caldera (en cocina) para producción de acs y que le de servicio también a una instalación de radiadores para salón y tres dormitorios. (instalación completa)\n\nSalón 22. 40\n\nDormitorios 7. 05, , 10. 70 y 5. 85\n\nAltura 2. 45.'),
(7, 'Calefacción', 'Comprar e instalalion de estufa de pallets para vivienda pareticular.'),
(8, 'Calefacción', 'Sustituir caldera existente por una caldera bazo nox. \n\nContactar via mail. \n\nGracias.'),
(9, 'Calefacción', 'Cambio de caldera de gas natural para calefacción y agua caliente.'),
(10, 'Calefacción', 'Calefaccion gas natural suelo radiante y ACS para un edificio unifamiliar de 4 alturas y sobre 100 metros por planta. La intención es instalar una sola caldera para todo el efificio pero estamos abiertos a escuchar otras opciones.'),
(11, 'Reformas Cocinas', 'Reformar cocina, cambiando azulejos, suelo, puntos de electricidad y fontanería y techo. Retirada de  muebles antiguos  aproximadamente a partir del mes de junio.'),
(12, 'Reformas Cocinas', 'Cocina para restaurante especializado en hamburguesas. Necesitaremos plancha, parrilla eléctrica, horno, freidoras, mesas de trabajo, mise en place, tostadoras, batidoras. Cámara frigorífica positivo y negativo.'),
(13, 'Reformas Cocinas', 'Instalar campana decorativa de 70 modelo tema dh2 70 inox, desmontando una similar que se encuentra actualmente instalada.'),
(14, 'Reformas Cocinas', 'Necesitaria marmolistas que toquen silestone para una cocina.'),
(15, 'Reformas Cocinas', 'Cambiar la encimera e cocina por una de piedra y simi, metros lineales: cinco en esquina.'),
(16, 'Reformas Cocinas', 'Necesito una cocina, solo muebles d abajo, la pared mide 3 metros.'),
(17, 'Reformas Cocinas', 'Cocina  rinconera de 2. 20x1. 70, estilo rustico.'),
(18, 'Reformas Cocinas', 'Renovar cocina. 3m x 2m aprox. \n\nTirar una pared.'),
(19, 'Reformas Cocinas', 'Necesito presupuesto para el cambio de una encimera en una cocina sin estrenar de material de formica a silestone o similar. Facilitaré las medidas a aquellos que se pongan en contacto conmigo. Gracias.'),
(20, 'Reformas Cocinas', 'Encimera aglomerado de color negro. \n\nMedidas 1, 80 x 0, 61 de fondo.'),
(21, 'Reformas Baños', 'Una mampara de ducha de una puerta abatible de 70 no me importaria que fuera barata de expocicion.'),
(22, 'Reformas Baños', 'Cambiar banera 150 x 70 por otra de igual tamaño ya comprada y en casa.'),
(23, 'Reformas Baños', 'Necesito arreglar el baño de casa, tengo que cambiar el plato de ducha (que es muy pequeño) y poner uno nuevo un poco más grande con mamparas. Lo más económico posible.'),
(24, 'Reformas Baños', 'Presupuesto para reformar un baño, en el que hay que quitar la bañera y poner un plato de ducha\n\n'),
(25, 'Reformas Baños', 'Necesito que me esmalten una bañera de hierro con patas, que la saneen y la pinten. En definitiva, que la restauren.'),
(26, 'Reformas Baños', 'Cambiar columna de hidromasaje por ducha.'),
(27, 'Reformas Baños', 'Reforma de baño alicatado y fontaneria.\n\nHay que quitarle el azulejo y los más importante es cambiar toda la fontanería ya que la distribución cambia; en un hueco nuevo hay que montar una ducha, y quitar de sitio los sanitarios '),
(28, 'Reformas Baños', 'Reformar del baño, alicatado, cambiar bañera, cambiar lavabo, quitar racholas, .'),
(29, 'Reformas Baños', 'Cambiar  bañera por un pie de ducha  de lado a lado o sea grande, y colocar una  mampara de acrilico, y colocar alguna baldosa blanca hasta cubrir el espacio descubierto que deja la bañera.'),
(30, 'Reformas Baños', 'Cambiar baño completo. Azulejo, suelo, sanitarios, bañera por ducha. . . \n\nTiene aproximadamente 4. 7 metros cuadrados de superficie (276x186) y 2. 25 de alto\n\nNo me importa dejar el trabajo para el verano salvo que haya fuga. De omento se me han levantado las baldosas del suelo y no parece que haya agua.'),
(31, 'Aire Acondicionado', 'Presupuesto de mantenimiento i reparación de aire acondicionado de la marca  mitsubishi electric.'),
(32, 'Aire Acondicionado', 'Sustituir una bomba de calor roof top ventilador axial averiado de potencias frio/calor del orden de 10 kCal/h y kF/h, caudal : 2. 400 m3/h.'),
(33, 'Aire Acondicionado', 'Instalacion aire acondicionado/bomba de calor para un salon de actos de unos 100 m2. Calidad alta/media.'),
(34, 'Aire Acondicionado', 'Instsalar aire acondicionat en un menjador de 35 m2.'),
(35, 'Aire Acondicionado', 'Instalar aire condicionado en el salon y en el dormitorio \n\nSalon mide 28, 50 m* \n\nDormitorio mide 16 m*.'),
(36, 'Aire Acondicionado', 'Tengo un equipo de aire acondicionado/calefaccion que tiene una perdida de gas. Necesito que detecten la fuga y recargar de nuevo de gas.'),
(37, 'Aire Acondicionado', 'Aire acondicionado mitsubishi electric en valencia, \n\nEl suministro y instalacion del equipo. Solo en el salon la innstalacion. \n\nPrecio economico. En naquera, valencia.'),
(38, 'Aire Acondicionado', 'Hola, tengo una casa de unos 50 m2 con sobrepiso abierto, q me aconsejáis? por lo q he leido la bomba de calor podria encajarme. . . Espero vuestro consejo e información, gracias!!'),
(39, 'Aire Acondicionado', 'Aire acondicionado por conductos, para 4 dormitorios.'),
(40, 'Aire Acondicionado', 'Instalación de aire acondicionado es un compresor y tres splits, dos son para dos habitaciones y el otro para el salón, pero están en plantas diferentes, las habitaciones están contiguas y el salón está en la planta inferior.'),
(41, 'Construcción Casas', 'Necesito presupuesto para construir una casa de dos plantas en churriana de la vega (Granada). Tengo la parcela de 220 metros cuadrados en propiedad. Se trataría de una casa de 3 plantas con 5 o más habitaciones. Estoy pendiente de adquirir el proyecto.'),
(42, 'Construcción Casas', 'Construir una casa desde cero. \n\nTengo localizado un terreno en arroyo de la miel en una zona urbanizada y  tiene los servicios básicos. \n\nEl terreno está nivelado y tiene unos 450m2\n\nLa casa tendría 4 habitaciones 3  baños lubina  cocina y comedor. Aproximadamente 150 m2.'),
(43, 'Construcción Casas', 'Presupuesto para cubrir terraza de 6mts de ancho por 3´70mts de largo, con inclinación de unos 30º, los materiales necesarios se detallan a continuación, agradeceria se detalle el presupuesto. \n\n6 bigas de 3. 70x16x8. \n\n1 biga de 6. 00x16x16. \n\n22m2 de termochip con acabado machimbrado de pino. \n\n22m2 de honduline. \n\n22m2 de teja md. Arabe. \n\n2 ventanas mavlux practicables con acabado de pino 118x65 c/u. \n\nFrontal de aluminio con tres ventanas abatibles acabado blanco 50x110 c/u aproximadamente. \n\nMateriales y mano de obra. \n\nTotal.'),
(44, 'Construcción Casas', 'Quisiera saber precio de construir una casa para ir a hablar con mi banco y llevar una cantidad aproximada.'),
(45, 'Construcción Casas', 'Chalet de 4 habitaciones con baño amplio salon amplio porche de 160 m2 +porche de 30m2+ piscina+ garage 2 plazas + perimetro.'),
(46, 'Construcción Casas', 'Necesito de profesionales en la construcción de 6 unifamiliares en madrid de 709 m2 construidos. Estructura metálica, cerramiento en tosco o termo arcilla, mono capa. Interior en pladur, tarima flotante en las dos plantas y gres en cocina, baños y aseo.'),
(47, 'Construcción Casas', 'Demoler una casa vieja de 100 m2 y construir una nueva en planta de 150m2 de 4 o 5 habitaciones con garaje debajo de la casa y una habitación al lado del garaje.\n\nSólo he visto la casa, y quiera saber si es viable este proyecto.'),
(48, 'Construcción Casas', '200 metros lineales de vigas de hierro HEB 250 y 200 metros lineales de IPN 250.'),
(49, 'Construcción Casas', 'Hola javi, soy eddy, he perdido el  móvil y toda la agenda, me podrías llamar para tener tu número? muchas gracias.'),
(50, 'Construcción Casas', 'Presupuesto ampliar casa\n\nTerreno desnivelado\n\nSant vicents dels horts. Barcelona\n\nReformar planta y anadir un piso.');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `budgeting`
--
ALTER TABLE `budgeting`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `_training`
--
ALTER TABLE `_training`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `budgeting`
--
ALTER TABLE `budgeting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `_training`
--
ALTER TABLE `_training`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;