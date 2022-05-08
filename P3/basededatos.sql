-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: mysql:3306
-- Tiempo de generación: 08-05-2022 a las 17:52:42
-- Versión del servidor: 8.0.28
-- Versión de PHP: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `SIBW`
--
CREATE DATABASE IF NOT EXISTS `SIBW` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `SIBW`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int NOT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `nombreyapellidos` varchar(100) DEFAULT NULL,
  `descripcion` varchar(5000) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `img` varchar(100) DEFAULT NULL,
  `juego_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id`, `titulo`, `nombreyapellidos`, `descripcion`, `fecha`, `img`, `juego_id`) VALUES
(1, 'Me gusta', 'Juan Pérez', 'Me ha gustado muchisimo el juego, la historia es entretenida pese a que los gráficos dejen mucho que desear', '2022-03-28 10:34:09', 'avatar.png', 1),
(2, 'No está mal', 'Nerea López', 'Juego simple. Sin ningún tipo de enganche. Un poco peor y lo podría considerar algo mediocre', '2022-03-28 09:22:34', 'avatar1.png', 1),
(3, 'Qué tremenda decepción', 'Antonio García', 'Prefiero jugar al cooking mama antes que volver a este videojuego', '2022-03-28 02:22:34', 'avatar2.png', 1),
(4, 'El mejor juego que he jugado nunca', 'María Hernández', 'Qué maravilla de juego. 10/10', '2022-03-27 21:55:51', 'avatar3.png', 1),
(5, 'Muy bueno', 'Maria Gómez Libreros', 'Simplemente fantástico, una version fresca y muy entretenida que aporta muchisimas horas de diversion', '2018-06-18 10:34:34', 'avatar.png', 2),
(6, 'Insuperable', 'Pedro Diaz Cortés', 'El mejor juego de la saga CON DIFERENCIA. Que maravilla. ', '2018-06-19 18:21:01', 'avatar1.png', 2),
(7, 'Meh', 'Clara Vilchez Román', 'Deja mucho que desear. ', '2021-01-20 22:30:45', 'avatar3.png', 2),
(8, 'GOOD', 'Carlos Clarin Aguilera', 'Me encantaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa ', '2021-01-20 03:23:57', 'avatar2.png', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `id` int NOT NULL,
  `img` varchar(50) DEFAULT NULL,
  `id_juego` int DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id`, `img`, `id_juego`, `descripcion`) VALUES
(1, 'arceus.jpg', 1, 'Montura de Braviary'),
(2, 'arceus1.jpg', 1, 'Primera imagen del juego'),
(3, 'arceus2.jpg', 1, 'Arceus, el Pokemon Legendario'),
(4, 'arceus3.jpg', 1, 'Más de 200 Pokémon por atrapar!'),
(5, 'kirby1.jpg', 2, 'Kirby en la ciudad'),
(6, 'kirby2.jpg', 2, 'Kirby absorviendo'),
(7, 'kirby.jpg', 2, 'Transformación de Kirby en coche'),
(8, 'kirby3.jpg', 2, 'Derrota enemigos'),
(9, 'arceus4.jpg', 1, 'Investiga el misterioso fenómeno de los Pokemon Alfas'),
(10, 'arceus5.jpg', 1, 'Montura de Wyrdeer'),
(11, 'kirby5.jpg', 2, 'Kirby sobrevolando la ciudad'),
(12, 'kirby4.jpg', 2, 'Transformate en lo que quieras! '),
(13, 'odissey.jpg', 3, 'Mario en la ciudad'),
(14, 'odissey1.jpg', 3, 'Controla a tus enemigos!'),
(15, 'odissey2.jpg', 3, 'Consigue energilunas para viajar!'),
(16, 'odissey3.jpg', 3, 'Explora gran cantidad de lugares!'),
(17, 'odissey4.jpg', 3, 'Sobrevive a las adversidades'),
(18, 'odissey5.jpg', 3, 'Diversión 100% asegurada'),
(19, 'odissey6.jpg', 3, 'Salva a la princesa Peach del malvado Bowser'),
(20, 'zelda.jpg', 4, 'Link te espera en una nueva aventura'),
(21, 'zelda1.jpg', 4, 'Primeras imagenes del juego'),
(22, 'zelda2.jpg', 4, 'Explora lugares extraordinarios'),
(23, 'zelda3.jpg', 4, 'Vive la mayor aventura de tu vida'),
(24, 'zelda4.jpg', 4, 'Derrota a tus enemigos'),
(25, 'zelda5.jpg', 4, 'Diviertete como nunca!'),
(26, 'animal5.png', 5, 'Juega con tus amigos!'),
(27, 'animal.jpg', 5, 'Disfruta de los eventos'),
(28, 'animal4.jpg', 5, 'Disfruta de los eventos'),
(29, 'animal1.png', 5, 'Decora tu isla libremente'),
(30, 'animal2.png', 5, 'Infinitas cosas por hacer!'),
(31, 'animal3.png', 5, '¡¡Diversión asegurada!!'),
(32, 'marioparty.jpg', 6, 'Juega con tus amigos!'),
(33, 'marioparty1.jpg', 6, 'Coopera con tus compañeros'),
(34, 'marioparty2.jpg', 6, 'Compite contra tus rivales en una gran variedad de minijuegos'),
(35, 'marioparty3.jpg', 6, 'Muchísimos minijuegos de diversión asegurada!'),
(36, 'marioparty4.jpg', 6, 'Gana la partida completando el tablero!'),
(37, 'marioparty5.jpg', 6, 'Pringate! :P'),
(38, 'misterioso1.jpg', 7, 'Preparate para revivir la aventura!'),
(39, 'misterioso.jpg', 7, 'Completa misiones de rescate'),
(40, 'misterioso2.jpg', 7, 'Harás una fuerte y gran amistad'),
(41, 'misterioso3.jpg', 7, 'Explora zonas inalcanzables'),
(42, 'misterioso4.jpg', 7, 'Salva al planeta del caos'),
(43, 'misterioso5.jpg', 7, 'La aldea será el lugar de reuniones'),
(44, 'letsgo.png', 8, 'Primera ruta del juego'),
(45, 'letsgo1.jpg', 8, '¡Haz combátes Pokemon!'),
(46, 'letsgo2.jpg', 8, 'Explora todos los rincones de Kanto'),
(47, 'letsgo3.jpg', 8, 'Averigua qué trama el Team Rocket'),
(48, 'letsgo4.jpg', 8, 'Juega con tus amigos'),
(49, 'letsgo5.jpg', 8, 'Usa las monturas y diviertete'),
(50, 'just.jpg', 9, 'Imagen 1'),
(51, 'just1.jpg', 9, 'Imagen 2'),
(52, 'just2.jpg', 9, 'Imagen 3'),
(53, 'just3.jpg', 9, 'Imagen 4'),
(54, 'just4.jpg', 9, 'Imagen 5'),
(55, 'just5.jpg', 9, 'Imagen 6'),
(56, 'sonicduo.png', 10, 'Imagen 1'),
(57, 'sonicduo1.png', 10, 'Imagen 2'),
(58, 'sonicduo2.jpg', 10, 'Imagen 3'),
(59, 'sonicduo3.jpg', 10, 'Imagen 4'),
(60, 'sonicduo4.jpg', 10, 'Imagen 5'),
(61, 'sonicduo5.jpg', 10, 'Imagen 6'),
(62, 'diamanbri.jpg', 11, 'Imagen 1'),
(63, 'diamanbri1.jpg', 11, 'Imagen 2'),
(64, 'diamanbri2.jpg', 11, 'Imagen 3'),
(65, 'diamanbri3.jpg', 11, 'Imagen 4'),
(66, 'diamanbri4.jpg', 11, 'Imagen 5'),
(67, 'diamanbri5.jpg', 11, 'Imagen 6');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juegos`
--

CREATE TABLE `juegos` (
  `id` int NOT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `descripcion` varchar(5000) DEFAULT NULL,
  `portada` varchar(100) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `video` varchar(100) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `genero` varchar(50) DEFAULT NULL,
  `plataforma` varchar(50) DEFAULT NULL,
  `desarrollador` varchar(50) DEFAULT NULL,
  `puntuacion` int DEFAULT NULL,
  `web` varchar(200) DEFAULT NULL,
  `masinfo` varchar(100) DEFAULT NULL,
  `facebook` varchar(50) DEFAULT NULL,
  `twitter` varchar(50) DEFAULT NULL,
  `instagram` varchar(50) DEFAULT NULL,
  `link` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ;

--
-- Volcado de datos para la tabla `juegos`
--

INSERT INTO `juegos` (`id`, `titulo`, `descripcion`, `portada`, `precio`, `video`, `fecha`, `genero`, `plataforma`, `desarrollador`, `puntuacion`, `web`, `masinfo`, `facebook`, `twitter`, `instagram`, `link`) VALUES
(1, 'LEYENDAS POKEMON™ : ARCEUS', 'Tus aventuras se desarrollan en el majestuoso entorno natural de la región de Hisui, donde te encargarás de investigar Pokémon para crear la primera Pokédex de la región.\n\nTendrás la ayuda de tus Pokémon a la hora de combatir contra los Pokémon salvajes que quieras atrapar. No tienes más que lanzar la Poké Ball que contiene a tu Pokémon cerca de un Pokémon salvaje, y el combate se iniciará automáticamente. Para luchar, elige entre los movimientos que tu aliado conoce.\n\nEsta aventura te llevará a la región de Sinnoh, donde transcurrían Pokémon Diamante y Pokémon Perla. Sin embargo, hay que remontarse muchos años atrás, antes incluso de que se concibiera la idea de ser Entrenador o Entrenadora Pokémon o de la existencia de una Liga Pokémon.\n\nTe encontrarás con Pokémon viviendo en estado salvaje en entornos muy poco acogedores, que te descubrirán una región de Sinnoh muy distinta a la que tal vez recuerdes de Pokémon Diamante o Pokémon Perla.\n\nCuando empieces tu aventura, podrás elegir a Rowlet, Cyndaquil u Oshawott para que te acompañen en tu tarea de crear la primera Pokédex de la región.\n\nLlegaron de la mano de un Profesor Pokémon que los encontró durante sus investigaciones en varias regiones.', 'arceus.png', 59.99, '9RbjFjYgNNg', '2022-01-28', 'RPG', 'Nintendo Switch', 'Game Freak', 8, 'https://legends.pokemon.com/es-es/', 'https://www.nintendo.es/Juegos/Nintendo-Switch/Leyendas-Pokemon-Arceus-1930510.html', 'NintendoES', 'NintendoES', 'nintendoswitches', 'pokemon_leyendas_arceus'),
(2, 'Kirby y la tierra olvidada', 'Un buen día, un extraño vórtice aparece en el cielo del planeta Pop y absorbe todo lo que pilla... ¡Kirby incluido! Más tarde, nuestro héroe de color rosa recobra el conocimiento en un mundo en ruinas, en el que civilización y naturaleza comparten entorno. Ahora le toca a Kirby rescatar a los Waddle Dees, que han sido raptados por un temible grupo llamado \"la jauría\".\n\n¡En compañía de su nuevo amigo Elfilin, Kirby emprende una gran aventura para rescatar a los Waddle Dees y regresar a casa! \n\n\n¡Te aguarda un mundo totalmente nuevo! Descubre distintas regiones, cada una con diferentes fases que puedes recorrer y con muchos objetivos para completar. Corre, salta y escala para explorar hasta el rincón más recóndito, y absorbe a los enemigos para copiar sus habilidades o para escupirlos como proyectiles.\n\n\nEscudriña aquí y allá en busca de zonas ocultas y tesoros, así como objetivos secretos. Eso sí, ¡ve con cuidado, porque la jauría anda al acecho y no se dejará vencer tan fácilmente! Enfréntate a temibles jefes y acaba de una vez por todas\ncon estas sabandijas.', 'kirby.jpg', 49.99, 'K3-ZPH2gUVI', '2022-03-25', 'Plataformas', 'Nintendo Switch', 'HAL Laboratory', 9, 'https://www.nintendo.es/Juegos/Nintendo-Switch/Kirby-y-la-tierra-olvidada-2045110.html', 'https://www.nintendo.es/Juegos/Nintendo-Switch/Kirby-y-la-tierra-olvidada-2045110.html', 'NintendoES', 'NintendoES', 'nintendoswitches', 'kirby_tierra_prometida'),
(3, 'Super Mario Odissey', 'Esta aventura 3D de Mario de estilo “sandbox” o mundo abierto —la primera desde Super Mario 64 en 1997 y Super Mario Sunshine para Game Cube en 2002— está llena a reventar de secretos y sorpresas. Explora enormes reinos 3D llenos de secretos y sorpresas, incluidos atuendos para Mario y montones de maneras diferentes de interactuar con el entorno: circula en vehículos que incorporan la vibración HD del mando Joy-Con o explora lugares como Mario Pixelado.\n\nCada reino esconde docenas de secretos y las lunas que servirán de combustible a tu aeronave, la Odyssey, con la que Mario viajará a otros reinos.\n\nMario no está solo en esta misión para encontrar a Bowser, cuenta con un nuevo amigo: Cappy, un misterioso personaje del país de los sombreros que se ha convertido en la emblemática gorra de Mario. Usa la gorra de Mario para enfrentarte a tus enemigos o para saltar más alto. Gracias a su nuevo amigo Cappy, Mario tiene nuevos movimientos, como lanzamiento de sombrero, Salto Sombrero o captura. Con captura, Mario puede tomar el control de todo tipo de cosas, incluidos objetos y enemigos. Hasta es capaz de tomar el control de rivales como Goombas, Chomp Cadenas, balones, taxis y un tiranosaur.\n\nCada reino del juego tiene su moneda local con la que puedes comprar atuendos para Mario. Para el lanzamiento estarán disponibles tres nuevas figuras amiibo: Mario, princesa Peach y Bowser vestidos de boda. Podrás usar amiibo compatibles para recibir ayuda en el juego.\nEn modo portátil con los Joy-Con acoplados a tu Nintendo Switch. O en modos TV y tabletop con los Joy-Con desencajados, dentro del soporte para mandos o usando el Mando Pro de Nintendo Switch. Si juegas con los mandos Joy-Con desencajados podrás usar los sensores de movimiento para dirigir ataques usando a Cappy. Esto permite un control muy intuitivo y sencillo. El juego permite que dos jugadores cooperen usando cada uno un mando Joy Con: uno controlará a Mario y el otro, a Cappy.', 'odissey.jpg', 49.99, 'EF5YynyWvQo', '2017-10-27', 'Plataformas, Mundo Abierto', 'Nintendo Switch', 'Nintendo EPD Tokyo 1-UP Studio', 10, 'https://supermario.nintendo.com/es/', 'https://www.nintendo.es/Juegos/Nintendo-Switch/Super-Mario-Odyssey-1173332.html', 'NintendoES', 'mario_odysseyJP', 'nintendoswitches', 'super_mario_odissey'),
(4, 'Zelda: Breath Of The Wild', 'Olvida todo lo que sabes sobre los juegos de The Legend of Zelda. Entra en un mundo de descubrimientos, exploración y aventura en The Legend of Zelda: Breath of the Wild, un nuevo juego de la aclamada serie que rompe con las convenciones.\n\nTras un sueño de 100 años, Link despierta en un mundo que no es capaz de recordar. Nuestro héroe legendario deberá explorar un mundo vasto y peligroso, y recuperar su memoria antes de que Hyrule desaparezca para siempre. Link emprende un viaje para encontrar respuestas en el que solo dispondrá de aquello que encuentre por el camino.\n\nExplora los parajes de Hyrule como te plazca. Escala torres y montañas en busca de nuevos destinos y utiliza la misteriosa piedra sheikah para ver un mapa de Hyrule y descubrir sus lugares más interesantes. Link podrá cubrir grandes distancias a caballo, navegar sobre las aguas de Hyrule en balsa o deslizarse montaña abajo sobre su escudo. Y por si esto fuera poco, el transporte aéreo también está al alcance de su mano gracias a la paravela.\n\nGracias a su ingenio y recursos, Link podrá adquirir un montón de armas diferentes para usar en combate. Estas armas, sin embargo, se irán desgastando con el paso del tiempo, así que no deberá perder ocasión de renovar su arsenal. Por supuesto, la clave en el combate no reside únicamente en las armas. Link deberá aprender distintos ataques, como los disparos curvos y altos con el arco o la manipulación de explosivos.\n\nCaza animales salvajes, recoge frutas y vegetales o saquea los campamentos enemigos en busca de comida. ¡También aprenderás nuevas recetas para darles un toque de sabor a tus ingredientes! Estas innovaciones culinarias no solo son más sabrosas, sino que también servirán para curar a Link y mejorar sus estadísticas. Link lleva algunos conjuntos ciertamente elegantes, pero algunos tienen una función añadida, como protegerlo de los elementos o desviar los ataques enemigos. Encontrarás todo tipo de ropas para Link, desde prendas para la nieve hasta armaduras, pero ten en cuenta un detalle, en caso de tormenta, llevar un atuendo metálico puede no ser la mejor de las ideas...', 'zelda.jpg', 45.99, 'ofH5ptn5w-A', '2017-03-03', 'Acción y Aventura', 'Nintendo Switch', 'Nintendo EPD - Monolith Soft', 10, 'https://www.zelda.com/breath-of-the-wild/es/', 'https://www.nintendo.es/Juegos/Nintendo-Switch/The-Legend-of-Zelda-Breath-of-the-Wild-1173609.html', 'NintendoES', 'ZeldaOfficialJP', 'nintendoswitches', 'zelda_breath_of_the_wild'),
(5, 'Animal Crossing: New Horizons', 'Vive a tu ritmo mientras cuidas tu jardín, pescas, decoras, recoges bichos y fósiles, conoces a los animales que habitan la isla y mucho más. La hora del día y las estaciones coinciden con el mundo real, por lo que la vida en la isla continúa aunque tú no estés ahí.\n\nAtrapar insectos, bucear en busca de criaturas marinas y pescar... peces, son actividades muy populares en tu isla. Encuentra diferentes criaturas según la temporada y la hora del día. Cada criatura recién descubierta se agrega automáticamente a tu Capturapedia en el juego. Si quieres, ¡puedes donarlo al museo! Sócrates está encantado de recibir nuevas especies de insectos y peces, y analizará cualquier fósil que desentierres\n\nPersonaliza tu isla a tu ritmo añadiendo vegetación, muebles y objetos decorativos que podrás colocar donde quieras… ¡en el interior y en el exterior! Puedes usar todo lo que fabriques en la mesa de taller de Tom Nook para decorar tu isla paradisíaca. Plantar flores añade belleza a tu isla, así que… ¡planta todas las que quieras! Riega tu jardín hasta que florezcan tus plantas y luego recógelas o poliniza otras. ¡Puede que sean de colores difíciles de conseguir!\n\nCrea tu propio paraíso y personaliza tu personaje, tu hogar, los adornos e incluso el paisaje. Tú eres quien decide lo que quieres construir y dónde, ¡ya sea en el interior o en el exterior! Tu isla dispone de todo tipo de recursos naturales que podrás utilizar para fabricar y mejorar herramientas, muebles y otros artículos.\n\nCada día te trae nuevas sorpresas al compartir tu isla con los encantadores animales que habitan en ella. Elige un lugar para que instalen su tienda de campaña, habla con ellos cuando quieras y haz que tu comunidad crezca a tu ritmo. Hasta ocho jugadores pueden vivir en la misma isla de un juego. Con una consola Nintendo Switch y un juego, hasta cuatro jugadores pueden jugar en la misma isla al mismo tiempo (se requieren accesorios adicionales)', 'animal.jpg', 49.99, '5YPxiTLMcdg', '2020-03-20', 'Simulación de vida', 'Nintendo Switch', 'Nintendo EPD', 9, 'https://animal-crossing.com/es/', 'https://www.nintendo.es/Juegos/Nintendo-Switch/Animal-Crossing-New-Horizons-1438623.html', 'AnimalCrossingES', 'animalcrossing', 'animalcrossing_official', 'animal_crossing_new_horizons'),
(6, 'Super Mario Party', '¡Monta una fiesta donde, cuando y con quien quieras!¡Pásatelo bomba con 80 minijuegos totalmente nuevos en una gran variedad de modos!¡Disfruta con tu familia y amigos en el modo multijugador, o juega en solitario!\n\n¡Tira los dados para moverte por el tablero! Cuando caigas en una casilla, se activará un evento especial, como, por ejemplo, un minijuego. Compite en docenas de minijuegos y consigue monedas que podrás intercambiar por objetos y estrellas. ¡Obtén más estrellas que nadie para hacerte con la victoria!\n\nSi te sientes con suerte, puedes probar a tirar el dado específico de tu personaje en lugar del dado normal. O puede que también te resulte útil en tu estrategia para ganar…', 'party.jpg', 39.99, 'OrLEHNF8qTg', '2018-10-05', 'Minijuegos, Tablero y Fiesta', 'Nintendo Switch', 'Nd Cube', 7, 'https://www.nintendo.es/Juegos/Nintendo-Switch/Super-Mario-Party-1388641.html', 'https://es.wikipedia.org/wiki/Super_Mario_Party', 'MarioPartyLegacy', 'SuperMarioES', 'nintendoes', 'super_mario_party'),
(7, 'Pokemon Mundo Misterioso E.R. DX', 'Conviértete en un Pokémon y crea tu propio equipo de rescate con miembros como Pikachu, Eevee y Charmander, para salvar el mundo mientras exploras territorios misteriosos cuya estructura cambia cada vez que te adentras en ellos.\n\nPrepárate para explorar un precioso mundo reimaginado en Pokémon Mundo misterioso: equipo de rescate DX para Nintendo Switch, una revisión de los juegos originales para Nintendo DS y Game Boy Advance\n\nUn buen día te despiertas en un mundo habitado por Pokémon ¡y te das cuenta de que te has convertido en uno de ellos! Vive mil aventuras con los Pokémon, interactúa con ellos en una aldea muy animada y descubre el misterio que se oculta tras tu curiosa situación. Para ello, deberás entablar amistad con otros Pokémon y emprender todo tipo de misiones para encontrar, rescatar y poner a salvo a Pokémon que se han perdido en lugares peligrosos. \n\nTe enfrentarás a los enemigos que acechan en el interior de estos laberintos y descubrirás grandes tesoros por el camino. Aunque ándate con ojo: ¡la disposición de los territorios cambia cada vez que te adentras en ellos! Además, si te desmayas en su interior, perderás el dinero y cualquier objeto que lleve tu equipo.\n\nA lo largo de la aventura, crearás un equipo de rescate para salvar el mundo de desastres naturales, ¡así que necesitarás que sus miembros estén en plena forma! Usa la experiencia que obtengas en los combates para subir de nivel al equipo, enséñales nuevos movimientos para que mejoren sus capacidades ofensivas o defensivas, y haz buenas migas con distintos tipos de Pokémon para ampliar tu repertorio de estrategias.\n\nCuando no estés explorando un territorio, ¡visita la aldea Pokémon y prepárate para tu próxima aventura! Consigue ventaja en los combates combinando movimientos en Gulpin\'s Link Shop, cómprales objetos y movimientos útiles a una pareja de Kecleon o fortalece a tus Pokémon haciendo que se entrenen en el Dojo Makuhita.\ntreecko.png\n\nSi te desmayas mientras exploras un territorio, ¡ya te puedes despedir del dinero y los objetos que lleves encima! Aunque no te preocupes: puedes depositar el dinero en Persian\'s Felicity Bank y los objetos en Kangaskhan\'s Storage para mantenerlos a buen recaudo. ¡Luego solo tienes que hacerles una visitilla para recoger tus pertenencias cuando quieras!', 'misterioso.jpg', 34.99, '1-KNT_kPTY8', '2020-03-06', 'Mazmorras', 'Nintendo Switch', 'Spike Chunsoft', 7, 'https://www.nintendo.es/Juegos/Nintendo-Switch/Pokemon-Mundo-misterioso-equipo-de-rescate-DX-1695693.html', 'https://en.wikipedia.org/wiki/Pok%C3%A9mon_Mystery_Dungeon:_Rescue_Team_DX', 'Pokemon', 'Pokemon', 'PokemonES', 'pokemon_mundo_misterioso_dx'),
(8, 'Pokemon Let\'s Go Pikachu', 'Al comenzar la partida, te meterás en la piel de un Entrenador o Entrenadora. Encontrarás, capturarás y entrenarás muchos Pokémon a lo largo de tu viaje para perfeccionar tu destreza y convertirte en el mejor Entrenador posible. Por el camino ayudarás a un sinnúmero de personas y desbaratarás los maquiavélicos planes de aquellos que se proponen utilizar a los Pokémon como meros instrumentos para fines abominables. Naturalmente, no podrás conseguirlo en solitario: deberás aunar fuerzas con tu compañero Pikachu o Eevee, así como el resto de tus aliados Pokémon, para superar un reto de estas proporciones.\nFemale TrainerMale Trainer\nTu compañero Pokémon\n\nAl comenzar la aventura conocerás a Pikachu o a Eevee, que te acompañará a lo largo de un viaje donde ambos viviréis todo tipo de peripecias. A diferencia de otros Pokémon, tu compañero prefiere quedarse fuera de su Poké Ball e ir posado sobre tu hombro o cabeza. Además, ¡parece que no tiene interés alguno en evolucionar!\n\nEl aspecto de tu compañero cambiará ligeramente según sea macho o hembra.\n¡Tendrás que comprobarlo por tu cuenta!\n\nKanto es una región variopinta, repleta de pueblos pequeños, ciudades, montañas, ríos, bosques y mares. Aquí podrás explorar abundantes escenarios y encontrar montones de Pokémon.\n\nTu viaje comienza en Pueblo Paleta, una localidad sencilla y acogedora donde también vive tu simpático rival, que, casualmente, es el vecino de al lado.\n\nPueblo Paleta también es el lugar de residencia del Profesor Oak, cuyo laboratorio está muy cerca de tu casa. Este amable investigador se dedica a estudiar a los Pokémon y te dará un valioso regalo antes de que te pongas en marcha: ¡la Pokédex! Su gran anhelo es llegar a ver una Pokédex completa algún día. ¿Serás capaz de ayudarle a hacer su sueño realidad?', 'letsgo.jpg', 44.99, 'lmyH1GKLGvI', '2018-11-16', 'RPG', 'Nintendo Switch', 'GameFreak', 9, 'https://pokemonletsgo.pokemon.com/es-es/', 'https://www.nintendo.es/Juegos/Nintendo-Switch/Pokemon-Let-s-Go-Pikachu--1382836.html', 'Pokemon', 'Pokemon', 'PokemonES', 'pokemon_letsgo'),
(9, 'Just Dance 2022', 'Just Dance® 2022, la mejor experiencia de todas en juegos de baile, está de vuelta con nuevos universos y 40 nuevas canciones de las listas de éxitos como \"Believer\" de Imagine Dragons, \"Level Up\" de Ciara, ¡y muchos otros!\n\n¿Buscas el juego perfecto para bailar los últimos éxitos y divertirte con tus amigos y familiares? ¡Just Dance 2022 es para ti!\n\n• Haz ejercicio mientras te diviertes y crea tu propia rutina con el modo Sweat. Mantén la motivación, controla las calorías que gastas y el tiempo que pasas bailando.\n\n• Forma equipo con tus amigos para conquistar la pista con el modo Co-op.\n\n¡Únete a más de 138 millones de jugadores de todo el mundo y no paréis de Just Dance!', 'just.jpg', 29.99, 'VtSzAMlHapI', '2021-11-04', 'Baile', 'Nintendo Switch', 'Ubisoft Paris', 6, 'https://www.ubisoft.com/es-es/game/just-dance/2022', 'https://www.nintendo.es/Juegos/Nintendo-Switch/JUST-DANCE-2022-1986930.html', 'justdance.es', 'justdancegame', 'justdance_es', 'just_dance_2022'),
(10, 'Sonic Mania + Team Sonic Racing', '\r\n\r\nTeam Sonic Racing™ combina lo mejor de los juegos para recreativas y los juegos de carreras competitivos. Enfréntate a tus amigos en espectaculares carreras multijugador y corred juntos como un equipo compartiendo potenciadores y turbos en escenarios alucinantes. Elige tu propio estilo de carrera seleccionando entre tres tipos distintos de personaje y desbloquea piezas con las que podrás personalizar tu vehículo para adaptarlo a tu estilo y cambiar el curso de la competición.\r\n\r\n¡Prepárate y a correr! ¡Compite con tu equipo a todo trapo!\r\n\r\n-------------------------------------------------------\r\n\r\n\r\nDisfruta del homenaje definitivo al pasado y al futuro en Sonic Mania, una nueva aventura de Sonic en 2D a la que podrás jugar cuando quieras y donde quieras en Nintendo Switch. Vuelve a vivir los juegos clásicos de Sonic y entra en nuevas zonas repletas de rutas ocultas nunca vistas y otros secretos.\r\n\r\nPrepárate para vivir emocionantes giros de guion en zonas emblemáticas de Sonic The Hedgehog, Sonic The Hedgehog 2, Sonic CD y Sonic The Hedgehog 3 and Knuckles, y disfruta de asombrosos gráficos retro en HD así como de la física \"pixel-perfect\" a 60FPS.\r\n\r\nJuega como Sonic, Tails y Knuckles mientras luchas contra formidables jefes y usas las habilidades de cada personaje para derrotar al ejército de malvados robots del Dr. Eggman. Usa la nueva habilidad Drop Dash y rompe la barrera del sonido, asciende por los aires como Tails o arrasa con los obstáculos en tu camino gracias a la fuerza bruta y habilidades de escalada de Knuckles.\r\n\r\n', 'sonic.jpg', 25.99, 'Mi93LzCskrk', '2020-10-27', 'Carreras y Plataformas', 'Nintendo Switch', 'Headcannon, PagodaWest Games, Sumo Digital', 5, 'https://www.nintendo.es/Juegos/Programas-descargables-Nintendo-Switch/Sonic-Mania-1174779.html', 'https://www.nintendo.es/Juegos/Nintendo-Switch/Team-Sonic-Racing--1562283.html', 'Sonic', 'sonic_hedgehog', 'sonicthehedgehog', 'sonic_mania_team_racing'),
(11, 'Pokemon Diamante Brillante', 'Deja que la nostalgia se apodere de ti y vuelve a disfrutar de Pokémon Diamante™ y Pokémon Perla™ en las consolas de la familia Nintendo Switch™.\r\n\r\nUnos esperados remakes en los que se ha respetado la historia original, pero que cuentan con funciones muy útiles e intuitivas propias de los juegos más recientes de Pokémon. En ellos, también se podrán vivir los combates muy de cerca\r\n\r\nA medida que explores la región y vayas completando tu Pokédex, tendrás que enfrentarte a los Entrenadores Pokémon más fuertes de cada ciudad: los Líderes de Gimnasio.\r\n\r\nSi los derrotas, conseguirás Medallas de Gimnasio como prueba de tus victorias. Tendrás que reunir ocho Medallas de Gimnasio para poder competir en la Liga Pokémon, donde te verás las caras con los Entrenadores de más nivel: el Alto Mando y la Campeona.\r\n\r\n¡Supera cada desafío y conviértete en Campeón o Campeona de la Liga Pokémon, un título reservado solo para los mejores Entrenadores!\r\n\r\nDurante tu viaje, te toparás con los Pokémon legendarios Dialga o Palkia, dependiendo de si juegas a Pokémon Diamante Brillante o a Pokémon Perla Reluciente, respectivamente.\r\n\r\nDialga y Palkia son dos Pokémon legendarios que aparecen en los mitos de Sinnoh. Se dice que Dialga es la deidad del tiempo y Palkia, la deidad del espacio. Para los habitantes de Sinnoh, ambos Pokémon son una gran leyenda.\r\n\r\nEn el centro de la región de Sinnoh se alza el Monte Corona con su impresionante pico nevado. Esta enorme montaña se considera sagrada para la gente de Sinnoh. En su interior alberga un gran laberinto en el que, a medida que te adentres, encontrarás Pokémon salvajes cada vez más fuertes.\r\n\r\nEn la cima del Monte Corona, hay unas ruinas abandonadas que reciben el nombre de Columnas Lanza. Nadie sabe realmente si pertenecían a un antiguo templo o si en ellas habitaba una criatura sagrada.', 'diamante.jpg', 54.99, 'ZZdAC0pL_D8', '2021-11-19', 'RPG, Rol, Aventura', 'Nintendo Switch', 'ILCA', 8, 'https://diamondpearl.pokemon.com/es-es/', 'https://www.nintendo.es/Juegos/Nintendo-Switch/Pokemon-Diamante-Brillante-1930566.html', 'Pokemon', 'Pokemon_ES_ESP', 'Pokemon', 'pokemon_diamante_brillante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `malaspalabras`
--

CREATE TABLE `malaspalabras` (
  `palabra` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `malaspalabras`
--

INSERT INTO `malaspalabras` (`palabra`) VALUES
('mierda'),
('gilipollas'),
('xbox'),
('playstation'),
('puta'),
('polla'),
('maricon'),
('cabron'),
('maricona'),
('negrata'),
('imbecil'),
('subnormal');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `juegos`
--
ALTER TABLE `juegos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `url` (`link`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `juegos`
--
ALTER TABLE `juegos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
