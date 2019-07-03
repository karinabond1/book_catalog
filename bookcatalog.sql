-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3307
-- Время создания: Янв 16 2019 г., 22:36
-- Версия сервера: 5.6.38
-- Версия PHP: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `bookcatalog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `author` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `authors`
--

INSERT INTO `authors` (`id`, `author`) VALUES
(1, 'Diane Setterfield'),
(2, 'Christopher Paolini'),
(3, 'Jennifer Robson'),
(4, 'Brigitte Endres'),
(5, 'Joel Tourligna'),
(6, 'Charles Dickens'),
(7, 'Joe L. Wheeler'),
(8, 'Melissa de la Cruz'),
(9, 'J.R.R. Tolkien'),
(10, 'Antoine de Saint-Exupéry'),
(11, 'Susan Cunningham'),
(12, 'Natalie D. Richards'),
(13, 'Mira Grant'),
(18, 'James Patterson'),
(19, 'Brendan DuBois'),
(20, 'Brenda Novak ');

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `book` varchar(50) NOT NULL,
  `about` varchar(999) NOT NULL,
  `price` double NOT NULL,
  `img` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`id`, `book`, `about`, `price`, `img`) VALUES
(1, 'Once Upon a River', 'A dark midwinter’s night in an ancient inn on the Thames. The regulars are entertaining themselves by telling stories when the door bursts open on an injured stranger. In his arms is the drowned corpse of a little child.', 16.8, 'once_upon_a_river.jpg'),
(2, 'The Fork, the Witch, and the Worm: Eragon', 'Welcome back to the world of Alagaësia. It’s been a year since Eragon departed Alagaësia in search of the perfect home to train a new generation of Dragon Riders. Now he is struggling with an endless sea of tasks: constructing a vast dragonhold, wrangling with suppliers, guarding dragon eggs, and dealing with belligerent Urgals and haughty elves. Then a vision from the Eldunarí, unexpected visitors, and an exciting Urgal legend offer a much-needed distraction and a new perspective. ', 5.15, 'Eragon.jpg'),
(3, 'The Gown: A Novel of the Royal Wedding', 'From the internationally bestselling author of Somewhere in France comes an enthralling historical novel about one of the most famous wedding dresses of the twentieth century—Queen Elizabeth’s wedding gown—and the fascinating women who made it.', 13.59, 'the_gown.jpg'),
(4, 'Somewhere in France', 'Lady Elizabeth Neville-Ashford wants to travel the world, pursue a career, and marry for love. But in 1914, the stifling restrictions of aristocratic British society and her mother’s rigid expectations forbid Lily from following her heart. When war breaks out, the spirited young woman seizes her chance for independence.                                                                                ', 13.46, 'somewhere_in_france.jpg'),
(5, 'Listen, I\'m here! The story of a little chameleon', 'In one pet store lived a little chameleon. He sat in his terrarium and dreamed of finding a good host and his own home as soon as possible. But buyers paid attention only to cute rabbits and guinea pigs, and no one noticed the little chameleon. \"Listen, I\'m here!\" he shouted, but no one responded. And then he decided to take the fate in his hands and went in search of the owner himself. ', 4.53, 'iamhere.jpg'),
(6, 'A Christmas Carol', 'If I had my way, every idiot who goes around with Merry Christmas on his lips, would be boiled with his own pudding, and buried with a stake of holly through his heart. Merry Christmas? Bah humbug!', 4.19, 'achristmascarol.jpg'),
(7, 'The Little Prince', 'Moral allegory and spiritual autobiography, The Little Prince is the most translated book in the French language. With a timeless charm it tells the story of a little boy who leaves the safety of his own tiny planet to travel the universe, learning the vagaries of adult behaviour through a series of extraordinary encounters. His personal odyssey culminates in a voyage to Earth and further adventures.', 10.79, 'thelittleprince.jpg'),
(8, 'The Hobbit', 'In a hole in the ground there lived a hobbit. Not a nasty, dirty, wet hole, filled with the ends of worms and an oozy smell, nor yet a dry, bare, sandy hole with nothing in it to sit down on or to eat: it was a hobbit-hole, and that means comfort.', 10.46, 'hobbit.jpg'),
(9, '29 Dates', 'Jisu\'s traditional South Korean parents are concerned by what they see as her lack of attention to her schoolwork and her future. Working with Seoul\'s premiere matchmaker to find the right boyfriend is one step toward ensuring Jisu\'s success, and going on the recommended dates is Jisu\'s compromise to please her parents while finding space to figure out her own dreams. ', 11.99, '29dates.jpg'),
(10, 'Crow Flight', 'Gin trusts logic a little too much. She even designs programs to decide what to eat and how to spend her time. All that changes when she’s paired with a new transfer student, Felix, on a computer modeling assignment to explain certain anomalies in the behavior of crows.\r\n\r\nAs she enters Felix’s world and digs further into the data behind crow behavior, Gin uncovers a terrible secret. And the wrong decision could equal disaster squared . . .', 9.2, 'crowflight.jpg'),
(11, 'What You Hide', '\r\nSpencer volunteers at the library. Sure, it\'s community service, but he likes his work. Especially if it means getting to see Mallory.\r\n\r\nMallory spends a lot of time keeping her head down. When you\'re sixteen and homeless, nothing matters more than being anonymous. But Spencer\'s charm makes her want to be noticed.', 8, 'whatyouhide.jpg'),
(12, 'Kingdom of Needle and Bone', 'We live in an age of wonders.\r\n\r\nModern medicine has conquered or contained many of the diseases that used to carry children away before their time, reducing mortality and improving health. Vaccination and treatment are widely available, not held in reserve for the chosen few. There are still monsters left to fight, but the old ones, the simple ones, trouble us no more.', 40, 'kingdom.jpg'),
(13, 'Deadline', 'Shaun Mason is a man without a mission. Not even running the news organization he built with his sister has the same urgency as it used to. Playing with dead things just doesn\'t seem as fun when you\'ve lost as much as he has.', 9.58, 'deadline.jpg'),
(14, 'Symbiont', 'The SymboGen designed tapeworms were created to relieve humanity of disease and sickness. But the implants in the majority of the world\'s population began attacking their hosts turning them into a ravenous horde.', 20.58, 'symbiot.jpg'),
(62, 'The First Lady', 'President Tucker is caught up in a media firestorm. The scandal of his affair has sent shockwaves through his re-election campaign, and threatens to derail everything he has worked for. To win the vote, he needs the First Lady to stand by his side.', 28.49, 'thefirstlady.jpg'),
(64, 'Before We Were Strangers', 'Something happened to her mother that night. Something no one wants to talk about. But she\'s determined to uncover her family\'s dark secrets, even if they bury her.', 26.89, 'strangers.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `books_authors`
--

CREATE TABLE `books_authors` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `authors_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `books_authors`
--

INSERT INTO `books_authors` (`id`, `book_id`, `authors_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 3),
(5, 5, 4),
(6, 5, 5),
(7, 6, 6),
(8, 6, 7),
(9, 7, 10),
(10, 8, 9),
(11, 9, 8),
(12, 10, 11),
(13, 11, 12),
(14, 12, 13),
(17, 13, 13),
(18, 14, 13),
(27, 62, 18),
(28, 62, 19),
(40, 64, 20);

-- --------------------------------------------------------

--
-- Структура таблицы `books_genres`
--

CREATE TABLE `books_genres` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `books_genres`
--

INSERT INTO `books_genres` (`id`, `book_id`, `genre_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 1),
(5, 2, 2),
(6, 3, 1),
(7, 3, 3),
(8, 4, 4),
(9, 4, 1),
(10, 4, 3),
(11, 5, 5),
(12, 6, 6),
(13, 6, 1),
(14, 6, 2),
(15, 7, 6),
(16, 7, 1),
(17, 7, 2),
(18, 7, 5),
(19, 8, 2),
(20, 8, 6),
(21, 8, 1),
(22, 9, 4),
(23, 9, 1),
(24, 10, 7),
(26, 11, 4),
(27, 12, 8),
(28, 12, 1),
(29, 13, 8),
(30, 13, 1),
(31, 14, 8),
(32, 14, 1),
(41, 62, 7),
(42, 62, 1),
(71, 64, 7),
(72, 64, 9);

-- --------------------------------------------------------

--
-- Структура таблицы `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `genre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `genres`
--

INSERT INTO `genres` (`id`, `genre`) VALUES
(1, 'Fiction'),
(2, 'Fantasy'),
(3, 'Historical'),
(4, 'Romance'),
(5, 'Children'),
(6, 'Classics'),
(7, 'Mystery'),
(8, 'Horror'),
(9, 'Thriller');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `books_authors`
--
ALTER TABLE `books_authors`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `books_genres`
--
ALTER TABLE `books_genres`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT для таблицы `books_authors`
--
ALTER TABLE `books_authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT для таблицы `books_genres`
--
ALTER TABLE `books_genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT для таблицы `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
