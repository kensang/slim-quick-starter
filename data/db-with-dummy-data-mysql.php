<?php

exit;

?>










SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


CREATE TABLE IF NOT EXISTS `category` (
`id` int(11) NOT NULL,
  `title` varchar(500) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

INSERT INTO `category` (`id`, `title`) VALUES
(1, 'Category A'),
(2, 'Category B');

CREATE TABLE IF NOT EXISTS `post` (
`id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `content` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

INSERT INTO `post` (`id`, `category_id`, `title`, `content`, `created_at`, `updated_at`) VALUES
(1, 1, 'Hello World', 'Hello world, this is my first post.', '2015-05-27 16:00:00', '2015-05-27 16:00:00'),
(2, 1, 'Hello Again', 'Hello again, this is my second post.', '2015-05-27 16:00:00', '2015-05-27 16:00:00'),
(3, 2, 'Hi There', 'Hi There.  This is another post.', '2015-05-28 16:00:00', '2015-05-28 16:00:00'),
(4, 2, 'Hi Again', 'Hi, this is yet another post', '2015-05-28 16:00:00', '2015-05-28 16:00:00');


ALTER TABLE `category`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `post`
 ADD PRIMARY KEY (`id`);


ALTER TABLE `category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
ALTER TABLE `post`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
