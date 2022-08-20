-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2022-08-20 06:11:35
-- 服务器版本： 10.4.21-MariaDB
-- PHP 版本： 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `serverside`
--

-- --------------------------------------------------------

--
-- 表的结构 `Category`
--

CREATE TABLE `Category` (
  `categoryId` int(11) NOT NULL,
  `categoryName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `Category`
--

INSERT INTO `Category` (`categoryId`, `categoryName`) VALUES
(1, 'Drama'),
(2, 'Romance'),
(3, 'Comedy'),
(4, 'Crime'),
(5, 'Action');

-- --------------------------------------------------------

--
-- 表的结构 `Movie`
--

CREATE TABLE `Movie` (
  `movieId` int(11) NOT NULL,
  `movieName` varchar(100) NOT NULL,
  `description` varchar(800) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `categoryId` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `Movie`
--

INSERT INTO `Movie` (`movieId`, `movieName`, `description`, `date`, `categoryId`, `year`, `image`) VALUES
(1, 'The Shawshank Redemption', 'Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.', '2022-08-16 21:18:37', 1, 1994, NULL),
(4, 'The Chaos Class', 'Lazy, uneducated students share a very close bond. They live together in the dormitory, where they plan their latest pranks. When a new headmaster arrives, the students naturally try to overthrow him. A comic war of nitwits follows.', '2022-08-16 18:47:47', 1, 1975, NULL),
(5, 'Fight Club', 'An insomniac office worker and a devil-may-care soap maker form an underground fight club that evolves into much more.', '2022-08-14 21:07:51', 1, 1999, NULL),
(6, 'Forrest Gump', 'The presidencies of Kennedy and Johnson, the Vietnam War, the Watergate scandal and other historical events unfold from the perspective of an Alabama man with an IQ of 75, whose only desire is to be reunited with his childhood sweetheart.', '2022-08-15 01:29:18', 1, 1994, NULL),
(11, 'Saving Private Ryan', 'Following the Normandy Landings, a group of U.S. soldiers go behind enemy lines to retrieve a paratrooper whose brothers have been killed in action.', '2022-08-16 04:01:59', 1, 1998, NULL),
(13, 'Before Sunrise', 'A young man and woman meet on a train in Europe, and wind up spending one evening together in Vienna. Unfortunately, both know that this will probably be their only night together.', '2022-08-17 02:08:53', 2, 1995, NULL),
(15, 'Your Name.', '&lt;p&gt;Two strangers find themselves linked in a bizarre way. When a connection forms, will distance be the only thing to keep them apart?&lt;/p&gt;\r\n', '2022-08-17 02:31:18', 2, 2016, NULL),
(16, 'Roman Holiday', '&lt;p&gt;A bored and sheltered princess escapes her guardians and falls in love with an American newsman in Rome.&lt;/p&gt;\r\n', '2022-08-17 02:37:05', 2, 1953, NULL),
(17, 'The Dark Knight', '&lt;p&gt;When the menace known as the Joker wreaks havoc and chaos on the people of Gotham, Batman must accept one of the greatest psychological and physical tests of his ability to fight injustice.&lt;/p&gt;\r\n', '2022-08-17 02:39:23', 5, 2008, NULL),
(18, 'The Lord of the Rings: The Return of the King', '&lt;p&gt;Gandalf and Aragorn lead the World of Men against Sauron&#39;s army to draw his gaze from Frodo and Sam as they approach Mount Doom with the One Ring.&lt;/p&gt;\r\n', '2022-08-17 02:41:55', 5, 2003, NULL),
(20, 'Life Is Beautiful', 'When an open-minded Jewish waiter and his son become victims of the Holocaust, he uses a perfect mixture of will, humor, and imagination to protect his son from the dangers around their camp.', '2022-08-18 00:02:39', 3, 1997, 'Life Is Beautiful.jpg'),
(21, 'Mirror Game', '&lt;p&gt;Ayna is an actor and the prison is his stage. He slips into the characters of the powerful convicted in exchange of money and take their place in prison. &lt;/p&gt;', '2022-08-18 01:16:37', 1, 2016, NULL),
(24, '12 Angry Men', '&lt;p&gt;The jury in a New York City murder trial is frustrated by a single member whose skeptical caution forces them to more carefully consider the evidence before jumping to a hasty verdict.&lt;/p&gt;\r\n', '2022-08-18 01:08:21', 4, 1957, NULL),
(25, 'Pulp Fiction', '&lt;p&gt;The lives of two mob hitmen, a boxer, a gangster and his wife, and a pair of diner bandits intertwine in four tales of violence and redemption.&lt;/p&gt;\r\n', '2022-08-18 01:09:49', 4, 1994, 'Pulp_Fiction.jpeg');

-- --------------------------------------------------------

--
-- 表的结构 `Review`
--

CREATE TABLE `Review` (
  `reviewId` int(11) NOT NULL,
  `content` varchar(10000) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `movieId` int(11) NOT NULL,
  `userName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `Review`
--

INSERT INTO `Review` (`reviewId`, `content`, `date`, `movieId`, `userName`) VALUES
(1, 'Why do I want to write the 234th comment on The Shawshank Redemption? I am not sure - almost everything that could be possibly said about it has been said. But like so many other people who wrote comments, I was and am profoundly moved by this simple and eloquent depiction of hope and friendship and redemption.', '2022-08-19 14:46:06', 1, 'sdds'),
(2, 'It is no wonder that the film has such a high rating, it is quite literally breathtaking. What can I say that hasn\'t said before? Not much, it\'s the story, the acting, the premise, but most of all, this movie is about how it makes you feel. Sometimes you watch a film, and can\'t remember it days later, this film loves with you, once you\'ve seen it, you don\'t forget.', '2022-08-19 14:46:31', 1, 'askittrell2'),
(3, 'This movie is not your ordinary Hollywood flick. It has a great and deep message. This movie has a foundation and just kept on being built on from their and that foundation is hope.', '2022-08-19 14:46:43', 1, 'mmolson3'),
(4, 'This is a trademark cynicism. Ayanabaji has very consciously picked up the story of the image of social conflict of locality . People live in the midst of nature. Dialectics of the realities of the main themes of the movie. Director has cleared all his talent and labor. The story has become a full movie Ayanabaji as per variation of screenplay structure, humorous dialogue and full dedication to be a successful production in the contemporary period.', '2022-08-19 14:46:52', 21, 'gkarpf4'),
(5, 'A great combination of story and direction nice cinematography. Promising acting overall a great work. Amitab reza a new director from Bangladesh who just showed that it possible to do a better work if you give such effort. A great combination of thriller, romance and comedy. Its kind of a psychological thriller. Chanchal Ahmed a great actor showed his talent. I would suggest every movie lovers to watch this movie in the theater. Its a pre-release review so a details review will come soon after the release. This is the directors first big screen direction. I always loved his work. He did some excellent drama in Bangladeshi TV drama.', '2022-08-19 14:40:40', 21, 'nbashar01'),
(6, 'Amitabh Raza: He is one of the finest maker in Bangladesh. Previously he made so many excellent TV dramas and commercials, so when I heard that he&#039;s coming into the big screen and making his debut film, I was so thrilled and excited. Besides that, Rashed Zaman, the cinematographer (whom I call Bangladesh&#039;s Emmanuel Lubezki) was the other captivating element of this film which entices me even more. Today, I went to see the film which was the very first day of it&#039;s release and came back home with wide wonderment and joy.', '2022-08-19 14:55:54', 21, 'sudip_rulz'),
(7, 'The movie is one piece of excellent film making in Bangladesh film industry till date. The hard work of the Director totally reflected including the entire teams work. Cinematography of the movie shows the development of the creative minds and technology use.', '2022-08-19 14:56:48', 21, 'ljencken5'),
(8, 'Before I saw this I assumed it was probably overrated. I was wrong. It lives up to and surpasses its reputation in pretty much every way. I would definitely recommend.', '2022-08-20 02:21:04', 25, 'hockeydog-75085'),
(9, 'Pulp Fiction is the most original, rule breaking film I have ever seen. Instead of following the widely used 3 act structure, Pulp Fiction makes up its own and while the 3 stories may seem completely disconnected at first, once you look closely you can find the underlying themes that they all share. Anyone who says that the movie lacks focus or has no meaning hasn&#039;t analysed enough. I highly recommend this film since it is number one on my list of my favourite movies of all time.', '2022-08-20 02:21:21', 25, 'jaaanmerz'),
(10, 'Emotional extremes abound, the story takes you round and around, elevating high, then smashing you down, your guiding light, an endearing clown.  The essence of all that&#039;s right, that&#039;s wrong, a fathers love for his wife and son, to the thieves of liberty with power, and a gun, the worst of man, the world undone.', '2022-08-20 02:22:05', 20, 'Xstal'),
(11, 'This may be one of the best films ever made. I&#039;ve never seen a movie with such a balance of hysterical comedy and serious drama. Roberto Benigni totally deserved his Oscars. People on this site have said such negative things about him and this film. Mr. Benigni had a lot of guts to make this film, and there&#039;s not another film like it. He handled both the comedy and drama aspects beautifully. I loved the beautiful cinematography, scenery, and the characters. This movie is magnificent in every way. Don&#039;t miss it!', '2022-08-20 02:22:20', 20, 'Monika-5');

-- --------------------------------------------------------

--
-- 表的结构 `User`
--

CREATE TABLE `User` (
  `userId` int(11) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `User`
--

INSERT INTO `User` (`userId`, `userName`, `email`, `password`, `isAdmin`) VALUES
(578, 'admin', 'admin@cds.com', '$2y$10$vz5HS0BYMSCaFlatb8KuseTyr6E5c4dDebCvuuUr2dMiuuSbtXaF6', 1),
(579, 'wally', 'mypass@cdcds.co ', '$2y$10$THYKMwp2ozfpYZHcsWS2ueMcCIuysuBtQhNw0wFnbVno7paLJS6UK', 1),
(580, 'fewfgds', 'dsf@cdsevd.conm', '$2y$10$R//z6Q9GIb.Hcg7vbRth1uqdg6WHV9MR/zoPfxucdGhMxsMgmiD9y', 0),
(581, 'dcsv', 'fdvg@cdv.com', '$2y$10$v6SRYUXng4S2/vVyTLpj/OkkdNwbSq8mEbxZXZb8NSSUV/H8JM0kG', 0),
(582, 'vfdbgf', 'fbdg@cdvfv.com', '$2y$10$qxjWLiB5Ak78oPX2DLAIJ.997oy.wA6hCTTvWuke1udeHNyE3qpEW', 0);

--
-- 转储表的索引
--

--
-- 表的索引 `Category`
--
ALTER TABLE `Category`
  ADD PRIMARY KEY (`categoryId`);

--
-- 表的索引 `Movie`
--
ALTER TABLE `Movie`
  ADD PRIMARY KEY (`movieId`),
  ADD KEY `FK` (`categoryId`);

--
-- 表的索引 `Review`
--
ALTER TABLE `Review`
  ADD PRIMARY KEY (`reviewId`),
  ADD KEY `Foreign key` (`movieId`);

--
-- 表的索引 `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`userId`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `Category`
--
ALTER TABLE `Category`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `Movie`
--
ALTER TABLE `Movie`
  MODIFY `movieId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- 使用表AUTO_INCREMENT `Review`
--
ALTER TABLE `Review`
  MODIFY `reviewId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 使用表AUTO_INCREMENT `User`
--
ALTER TABLE `User`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=583;

--
-- 限制导出的表
--

--
-- 限制表 `Movie`
--
ALTER TABLE `Movie`
  ADD CONSTRAINT `FK` FOREIGN KEY (`categoryId`) REFERENCES `Category` (`categoryId`);

--
-- 限制表 `Review`
--
ALTER TABLE `Review`
  ADD CONSTRAINT `Foreign key` FOREIGN KEY (`movieId`) REFERENCES `Movie` (`movieId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
