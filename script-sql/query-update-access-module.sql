DROP TABLE IF EXISTS `modulo`;
CREATE TABLE `modulo` (
  `id` int(11) NOT NULL,
  `activo` int(11) DEFAULT NULL,
  `icono` text DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL,
  `panel_admin` int(11) DEFAULT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `url` text DEFAULT NULL,
  `orden` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`id`, `activo`, `icono`, `tipo`, `panel_admin`, `nombre`, `url`, `orden`) VALUES
(1, 1, 'mdi-home', 1, 0, 'Pagos', 'Pago', 2),
(2, 1, 'mdi-chart-bubble', 1, 0, 'Módulos', 'cursos/index', 3),
(3, 1, 'mdi-library-books', 1, 10, 'Biblioteca', 'bibliotecas/index', 4),
(4, 1, 'mdi-forum', 1, 0, 'Foros', 'foroCategoria/method/index', 5),
(7, 1, 'mdi-account-multiple', 0, 0, 'Mi Comunidad', '/usuario/mi_comunidad', 8),
(8, 1, 'mdi-poll', 1, 0, 'Encuestas', 'encuestas/index', 9),
(9, 1, '', 2, 1, 'Gestión de Periodos', 'periodo/index', 1),
(10, 1, '', 2, 1, 'Gestión de Sedes', 'sede/index_sede', 2),
(11, 1, '', 2, 1, 'Gestión de Documentos', 'documento/index', 3),
(12, 1, '', 2, 1, 'Gestión de Exámenes', '/examen/index', 4),
(13, 1, '', 2, 1, 'Admisión de Carreras', 'admisioncarrera/buscar', 5),
(14, 1, '', 2, 1, 'Gestión de Postulantes', 'gestionpostulantes/index', 7),
(15, 1, '', 2, 2, 'Gestión de Certificados', '#', NULL),
(16, 1, '', 2, 2, 'Gestión de Programas Presenciales', 'progpresencial/buscar', 10),
(17, 1, '', 2, 2, 'Gestión de Alumnos', 'gestionalumnos/buscar', 3),
(18, 1, '', 2, 2, 'Carga Masiva de Carreras', '#', NULL),
(19, 1, '', 2, 2, 'Gestión Indicadores Históricos', '#', NULL),
(20, 1, '', 2, 2, 'Indicadores de Carreras', 'indicadorescarreras/buscar_ind_carreras', 8),
(21, 1, '', 2, 2, 'Gestión de Carreras', 'carrera/index_carrera', 9),
(22, 1, '', 2, 2, 'Gestión de Asignaturas', 'asignatura/index_asignatura', 12),
(23, 1, '', 2, 2, 'Gestión de Indicadores de Carreras', '#', NULL),
(24, 1, '', 2, 2, 'Indicadores Académicos', 'indicadoresacademicos/index', 10),
(25, 1, '', 2, 3, 'Registro de pagos de alumnos', '#', NULL),
(26, 1, '', 2, 3, 'Valorización de horas docente', 'valorizacion/index', 2),
(31, 1, '', 2, 4, 'Crear Comunidad', 'comunidad/crear_comunidad', NULL),
(32, 1, '', 2, 4, 'Buscar Comunidad', 'comunidad/buscar_comunidad', NULL),
(33, 1, '', 2, 4, 'Modificar Ayuda de la Comunidad', '#', NULL),
(34, 1, '', 2, 4, 'Crear Categoría de Comunidad', '#', NULL),
(35, 1, '', 2, 4, 'Buscar Categoría de Comunidad', 'categoriacomunidad/buscar', 1),
(36, 1, '', 2, 5, 'Agregar Usuario', 'usuario/crear_usuario', NULL),
(37, 1, '', 2, 5, 'Buscar Usuario', 'usuario/buscar_usuario', NULL),
(38, 1, '', 2, 5, 'Carga Masiva de Usuarios', '#', NULL),
(39, 1, '', 2, 5, 'Exportar Usuarios', '#', NULL),
(43, 1, '', 2, 5, 'Modulo', 'Modulo/buscar_modulo', NULL),
(44, 1, '', 2, 5, 'Role Usuarios', 'Roles/buscar_roles', NULL),
(46, 1, '', 2, 6, 'Agregar Objeto de Aprendizaje', '#', NULL),
(47, 1, '', 2, 6, 'Buscar Objeto de Aprendizaje', '#', NULL),
(48, 1, '', 2, 7, 'Agregar Encuesta o Banco de Preguntas', 'encuesta/crear_encuesta', NULL),
(49, 1, '', 2, 7, 'Buscar Encuesta o Banco de Preguntas', 'encuesta/buscar_encuesta', NULL),
(50, 1, '', 2, 7, 'Administrar Encuestas', '#', NULL),
(51, 1, '', 2, 7, 'Gestión Resumen Encuestas', '#', NULL),
(52, 1, '', 2, 7, 'Resumen Encuestas', '#', NULL),
(62, 1, 'mdi-home', 1, 0, 'Inicio', 'Home', 1),
(64, 1, '', 2, 3, 'Generador de Documentos', 'GeneradorDocs/index', NULL),
(65, 1, '', 2, 3, 'Crear Documento', 'GeneradorDocs/crear_documento', NULL),
(66, 1, 'none', 0, 0, 'Mis comunidades', '/comunidad', 1),
(67, 1, '', 0, 0, 'Perfil de usuarios', '/Profile', 1),
(68, 1, '', 0, 0, 'Buzon de Mensajes', 'Mensajeria/inbox', 1),
(69, 1, 'none', 0, 0, 'biblioteca acceder', 'bibliotecas/doc', 1),
(70, 1, 'none', 0, 0, 'ver noticias', 'Noticias/noticiaPreviewPublic', 1),
(71, 1, '', 0, 0, 'Biblioteca->comment', 'bibliotecas/biblioComment', 1),
(72, 1, 'none', 0, 0, 'encuestas->run', 'encuestas/encuestarun', 1),
(73, 1, 'none', 0, 0, 'noticias->comentarios', 'Noticias/noticiaComentario', 1),
(74, 1, 'none', 0, 0, 'modulos->curso_detalle', 'cursos/curso_detalle', 1),
(75, 1, 'none', 0, 0, 'Noticias->index', 'Noticias/index', 1),
(76, 1, 'none', 0, 0, 'noticias->view2', 'Noticias/noticiaPreview', 1),
(77, 1, 'none', 0, 0, 'foros->tema_detalle', 'ForoPost/foro_tema_detalle', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `clave` varchar(3) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `clave`, `name`, `is_active`, `user_id`) VALUES
(1, 'ALU', 'Alumnos', 1, 1),
(2, 'TUT', 'Gestor Administrativo', 1, 1),
(3, 'PRO', 'Profesores', 1, 1),
(4, 'PUB', 'Coordinadores', 1, 1),
(5, 'VIS', 'Curricular', 1, 1),
(6, 'ADM', 'Administradores', 1, 1),
(7, 'POS', 'Administrador de Admisión', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_permisos`
--

DROP TABLE IF EXISTS `role_permisos`;
CREATE TABLE `role_permisos` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `modulo_id` int(11) DEFAULT NULL,
  `acceso` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `role_permisos`
--

INSERT INTO `role_permisos` (`id`, `role_id`, `modulo_id`, `acceso`) VALUES
(1, 6, 1, '1,2,3'),
(2, 6, 2, '1,2,3'),
(3, 6, 3, '1,2,3'),
(4, 6, 14, '2,3'),
(5, 6, 15, '2,3'),
(6, 6, 16, '2,3'),
(7, 6, 7, '1,2,3'),
(8, 6, 8, '1,2,3'),
(9, 6, 9, '1,2,3'),
(10, 6, 10, '1,2,3'),
(11, 6, 11, '1,2,3'),
(12, 6, 12, '1,2,3'),
(13, 6, 13, '1,2,3'),
(16, 6, 16, '1,2,3'),
(17, 6, 17, '1,2,3'),
(18, 6, 18, '1,2,3'),
(19, 6, 19, '1,2,3'),
(20, 6, 20, '1,2,3'),
(21, 6, 21, '1,2,3'),
(22, 6, 22, '1,2,3'),
(23, 6, 23, '1,2,3'),
(24, 6, 24, '1,2,3'),
(25, 6, 25, '1,2,3'),
(26, 6, 26, '1,2,3'),
(27, 6, 27, '1,2,3'),
(28, 6, 28, '1,2,3'),
(29, 6, 29, '1,2,3'),
(30, 6, 30, '1,2,3'),
(31, 6, 31, '1,2,3'),
(32, 6, 32, '1,2,3'),
(33, 6, 33, '1,2,3'),
(34, 6, 34, '1,2,3'),
(35, 6, 35, '1,2,3'),
(36, 6, 36, '1,2,3'),
(37, 6, 37, '1,2,3'),
(38, 6, 38, '1,2,3'),
(39, 6, 39, '1,2,3'),
(40, 6, 40, '1,2,3'),
(41, 6, 41, '1,2,3'),
(42, 6, 42, '1,2,3'),
(43, 6, 43, '1,2,3'),
(44, 6, 44, '1,2,3'),
(45, 6, 45, '1,2,3'),
(46, 6, 46, '1,2,3'),
(47, 6, 47, '1,2,3'),
(48, 6, 48, '1,2,3'),
(49, 6, 49, '1,2,3'),
(50, 6, 50, '1,2,3'),
(51, 6, 51, '1,2,3'),
(52, 6, 52, '1,2,3'),
(53, 6, 53, '1,2,3'),
(54, 6, 54, '1,2,3'),
(55, 6, 55, '2,3'),
(56, 6, 56, '2,3'),
(57, 6, 57, '1,2,3'),
(58, 6, 58, '1,2,3'),
(59, 6, 59, '1,2,3'),
(60, 6, 60, '1,2,3'),
(61, 6, 61, '1,2,3'),
(68, 6, 62, '1,2,3'),
(69, 1, 1, '1'),
(70, 1, 3, '1,2,3'),
(71, 1, 4, '1,2,3'),
(72, 1, 5, '1,2,3'),
(73, 1, 6, '1,2,3'),
(74, 1, 7, '1,2,3'),
(75, 1, 8, '1,2,3'),
(76, 6, 4, '1,2,3'),
(77, 6, 64, '1,2,3'),
(78, 6, 65, '1,2,3'),
(79, 1, 66, '1,2,3'),
(80, 2, 66, '1,2,3'),
(81, 3, 66, '1,2,3'),
(82, 4, 66, '1,2,3'),
(83, 7, 66, '1,2,3'),
(84, 1, 67, '1,2,3'),
(85, 1, 68, '1,2,3'),
(86, 1, 69, '1,2,3'),
(87, 1, 62, '1,2,3'),
(88, 1, 70, '1,2,3'),
(89, 1, 71, '1,2,3'),
(90, 1, 72, '1,2,3'),
(91, 1, 2, '1,2,3'),
(92, 1, 25, '1,2,3'),
(93, 1, 73, '1,2,3'),
(94, 1, 74, '1,2,3'),
(95, 1, 75, '1,2,3'),
(96, 1, 76, '1,2,3'),
(97, 1, 77, '1,2,3');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `role_permisos`
--
ALTER TABLE `role_permisos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `role_permisos`
--
ALTER TABLE `role_permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;