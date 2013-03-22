-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 15, 2013 at 08:15 AM
-- Server version: 5.5.29
-- PHP Version: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+11:00";

--
-- Database: `haozblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `vw_showcase`
--

CREATE TABLE `vw_showcase` (
  `topic_id` int(11) NOT NULL AUTO_INCREMENT,
  `topic` varchar(50) NOT NULL,
  `review_link` varchar(255) DEFAULT NULL,
  `intro` longtext,
  `presented_date` varchar(50) NOT NULL,
  PRIMARY KEY (`topic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `vw_showcase`
--

INSERT INTO `vw_showcase` (`topic_id`, `topic`, `review_link`, `intro`, `presented_date`) VALUES
(1, 'u-turn', 'http://vibewire.org/2012/02/fastbreak-u-turn-review/', 'A crowd gathered underneath planes of a by-gone era and braved the early morning.\r\n								A large black steam engine, a glossy burgundy tram carriage and a number of other vintage cars, all suspended in time, surrounded attendees at the Powerhouse Museum.\r\n								With these relics from the past, it was a fitting place for five diverse speakers to explain how they had a U-Turn\\'' in their lives and give advice to the crowd on how to tackle the future.', '24 February 2012'),
(2, 'play', 'http://vibewire.org/2012/04/fastbreak-play-review-2/', 'The young at heart met at our monthly fastBREAK event to hear stories of fun, play, and how to keep imaginations running wild when maturity, a career and commitments come knocking at the door.', '30 March 2012'),
(3, 'rage', 'http://vibewire.org/2012/04/fastbreak-rage-review/', 'Rage captivated its morning audience, as bleary eyes and tired yawns gave way to inspring speakers compelling their audience to channel personal rage into something positive.\r\n								The speakers dispelled the negative undertones associated with rage, suggesting rather that rage is a catalyst for action.', '27 April 2012'),
(6, 'epic', 'http://vibewire.org/2012/05/fastbreak-epic-review/', 'Epic truly lived up to its name as our passionate speakers took to the stage and discussed their own epic eureka moments. It proved a compelling insight into the creative processes involved in embarking on a new project. And reminded the audience that our ideas can shape the world around us, but only if we nurture them.', '18 May 2012'),
(8, 'stuffed', 'http://vibewire.org/2012/06/fastbreak-stuffed-2/', 'This month\\''s fastBREAK: Stuffed served as a welcomed replacement for the conventional cup of hot coffee. Energy kicks and wide-eyes came from thought provoking ideas that explored how stuffed doesn\\''t simply mean a dead-end result for everyone. Rather, it can inspire positive change.', '29 June 2012'),
(9, 'lies', 'http://vibewire.org/2012/07/fastbreak-lies-review/', 'This month\\''s fastBREAK: Lies was an engaging look at deception. Early risers were treated with five individual stories about the nature of lying and how it seeps into every day life.', '27 July 2012'),
(10, 'danger', 'http://vibewire.org/2012/08/fastbreak-danger-review/', 'We live in a society abuzz with the sound of high tech gadgets. We live in a society where news of recent scientific discoveries and technological progress have filtered into the conversations of the everyday. From the discovery of the Higgs-Boson particle to the launch of NASA\\''s Curiosity\\'' rover, science has become the talk of the town.\r\nThis month\\''s fastBREAK speakers joined the discussion with the full force of scientific curiosity and inquisitiveness. The speakers engaged in questioning the dangers of science, provoking deep thought yet drawing laughter from their audience.', '24 August 2012'),
(11, 'cure', 'http://vibewire.org/2012/09/fastbreak-cure-review/', 'It\\''s human nature to want to fix what we perceive as broken. This was the underlying theme of this month\\''s fastBREAK, where six passionate speakers discussed creative cures for society\\''s shortcomings.', '28 September 2012'),
(12, 'tasty', NULL, 'Fill your fastBREAK appetite this month with \\''Tasty\\'' talks coming from home-grown specialists and also an overseas special guest!\r\nTasty is all things food and will delve into the reasons why we eat as well as what we eat. The things we do to get food in this modern day and age are remarkable, whether it be importing goods from overseas, or having massive plantations that the everyday person hasn\\''t even considered.\r\nSometimes we need to slow down and enjoy what we\\''ve really got. Come and celebrate and talk seriously about food and enjoy the delights of every fastBREAK.', '26 October 2012'),
(13, 'magic', NULL, 'fastBREAK this month brings together a series of creatives and who have had varied experiences in the fields they have worked, the lives they have led and the world they wish to be apart of.\r\nMagic can be deceptive or it can be the way the world is seen. To those who are oblivious to the details, it can sometimes be mysterious or supernatural. For those in the know, it can boil down to be a simple parlour trick. As a child, many things seem almost magical because of the lack of explanation. As adults we uncover the truths about how the world works.\r\nTo think creatively allows each individual to see the world in a different light and the speakers this month all have a very unique perspective. Seeing something old in a new way can really help.\r\nThis month at fastBREAK: Magic come and see what this year\\''s series has come to create.', '30 November 2012'),
(14, 'do as you are told', NULL, NULL, '25 November 2011'),
(15, 'better together', NULL, NULL, '30 September 2011'),
(16, 'back to basics', NULL, NULL, '25 February 2011'),
(17, 'what is stopping you', NULL, NULL, '25 March 2011'),
(18, 'are we there yet', NULL, NULL, '29 April 2011'),
(19, 'read much', NULL, NULL, '20 May 2011'),
(20, 'what turns you on', NULL, NULL, '24 June 2011'),
(21, 'is old new again', NULL, NULL, '29 July 2011'),
(22, 'why do you care', NULL, NULL, '26 August 2011'),
(23, 'what is broken', NULL, NULL, '28 October 2011'),
(24, 'what matters', NULL, NULL, '26 February 2010'),
(25, 'are you ready', NULL, NULL, '26 March 2010'),
(26, 'are you alone', NULL, NULL, '30 April 2010'),
(27, 'are you satisfied', NULL, NULL, '28 May 2010'),
(28, 'what now', NULL, NULL, '25 June 2010'),
(29, 'what is your story', NULL, NULL, '30 July 2010'),
(30, 'things change', NULL, NULL, '27 August 2010'),
(31, 'power', NULL, NULL, '24 September 2010'),
(32, 'failure', NULL, NULL, '29 October 2010'),
(33, 'love', NULL, NULL, '30 November 2010');

--
-- Table structure for table `vw_showcase_details`
--

CREATE TABLE `vw_showcase_speakers` (
  `details_id` int(11) NOT NULL AUTO_INCREMENT,
  `topic_id` int(11) NOT NULL,
  `speaker` varchar(50) NOT NULL,
  `youtube_link` varchar(255) NOT NULL,
  PRIMARY KEY (`details_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=112 ;

--
-- Dumping data for table `vw_showcase_details`
--

INSERT INTO `vw_showcase_speakers` (`details_id`, `topic_id`, `speaker`, `youtube_link`) VALUES
(1, 1, 'Monica Kade', 'http://www.youtube.com/embed/vqGGrImW0b4'),
(2, 1, 'Philip Gomes', 'http://www.youtube.com/embed/cSOl3LJ6dhk'),
(3, 1, 'Robert Beson', 'http://www.youtube.com/embed/qzOKYqBNmWU'),
(4, 1, 'Ralph Hobbs', 'http://www.youtube.com/embed/6TXv_XLAzcI'),
(5, 1, 'Katherine Tu', 'http://www.youtube.com/embed/XvFT93fgPEo'),
(6, 2, 'Gavin Smith', 'http://www.youtube.com/embed/NH8GhTC1cN0'),
(7, 2, 'Flutter Lyon', 'http://www.youtube.com/embed/lQm2Eroozjw'),
(8, 2, 'Ben Rennie', 'http://www.youtube.com/embed/c7_Syy26cQE'),
(9, 2, 'Lisa O\\''Brien', 'http://www.youtube.com/embed/u-JL7uJ4gnE'),
(10, 2, 'Michael Scholz', 'http://www.youtube.com/embed/8vf_nEiiJ5c'),
(11, 3, 'Dan Ilic', 'http://www.youtube.com/embed/ujgc0MLDxts'),
(12, 3, 'Jeroen van Kernebeek', 'http://www.youtube.com/embed/2cRfBR3_Xks'),
(13, 3, 'Rami Mandow', 'http://www.youtube.com/embed/si0NIQ-0sRM'),
(14, 3, 'Allison Baker', 'http://www.youtube.com/embed/a5ApZdYVZ3Y'),
(15, 3, 'Sheron Sultan', 'http://www.youtube.com/embed/PVYP0eTDctQ'),
(16, 6, 'Kate Middleton', 'http://www.youtube.com/embed/7WRS6P9yJfk'),
(17, 6, 'Dr. Avnesh Ratnanesan', 'http://www.youtube.com/embed/lVb6-qz5P5I'),
(18, 6, 'Joshua Capelin', 'http://www.youtube.com/embed/mga81Y45KqU'),
(19, 6, 'Catherine Keenan', 'http://www.youtube.com/embed/irfyUhP1mVc'),
(20, 6, 'Kate Anderson', 'http://www.youtube.com/embed/KGxpGLULqaU'),
(21, 8, 'Marita Cheng', 'http://www.youtube.com/embed/8EOycwTI6ss'),
(22, 8, 'Luke Geary', 'http://www.youtube.com/embed/NC5Bw0wJPX0'),
(23, 8, 'Clover Moore', 'http://www.youtube.com/embed/dQfe6pJpKT0'),
(24, 8, 'Annalie Killian', 'http://www.youtube.com/embed/gB1IXM7o7XQ'),
(25, 8, 'Nic Newling', 'http://www.youtube.com/embed/gJeiyTd-BC4'),
(26, 9, 'Hannah Law', 'http://www.youtube.com/embed/7eXiHsSVBOg'),
(27, 9, 'Tim Burrows', 'http://www.youtube.com/embed/H64rAUE91t4'),
(28, 9, 'Jack Hilton', 'http://www.youtube.com/embed/RXzLUrbakbw'),
(29, 9, 'Dev Singh', 'http://www.youtube.com/embed/vZLTaJLjokk'),
(30, 9, 'Simon Cant', 'http://www.youtube.com/embed/C4GL1r3b2yo'),
(31, 10, 'Wendy Zuckerman', 'http://www.youtube.com/embed/lB4rwRWGBrM'),
(32, 10, 'Lisa Harvey Smith', 'http://www.youtube.com/embed/u6lI4SLieBw'),
(33, 10, 'Daniel Keogh', 'http://www.youtube.com/embed/7foovsFCIvk'),
(34, 10, 'Dr Michael Biercuk', 'http://www.youtube.com/embed/O6VkxMhv3xs'),
(57, 11, 'Seema Duggal', 'http://www.youtube.com/embed/3eV_2gzts1w'),
(58, 11, 'Scott Brown', 'http://www.youtube.com/embed/JXRv7N6R4Do'),
(59, 11, 'Nathaniel Smith', 'http://www.youtube.com/embed/bqZMTqwuCDE'),
(60, 11, 'Giverny Lewis', 'http://www.youtube.com/embed/uVl13-pJV2c'),
(61, 11, 'Jamie Moore', 'http://www.youtube.com/embed/SK-XBYJ_nOQ'),
(62, 11, 'Ellie Webster', 'http://www.youtube.com/embed/Xgby5rfjjk0'),
(64, 12, 'Alex Adams', 'http://www.youtube.com/embed/1M_Fbui8LFQ'),
(65, 12, 'Marko Iljadica', 'http://www.youtube.com/embed/PxopBVlYHWg'),
(66, 12, 'Costa Geordiadis', 'http://www.youtube.com/embed/WVxrqouxF94'),
(67, 12, 'Dana Cordell', 'http://www.youtube.com/embed/zOJvk9q8Q7E'),
(68, 13, 'Lizza Gebilagin', 'http://www.youtube.com/embed/HEETaNolosU'),
(69, 13, 'Ehon Chan', 'http://www.youtube.com/embed/jIEVVrghSxs'),
(70, 13, 'Danielle Lauren', 'http://www.youtube.com/embed/NwCrIPCHlUU'),
(71, 13, 'Jess Scully', 'http://www.youtube.com/embed/GTm4UEOsXsI'),
(72, 14, 'Jacquie Hoyes', 'http://www.youtube.com/embed/e4RCJEU1a6w'),
(73, 15, 'The Fortynine', 'http://www.youtube.com/embed/1_nFQbGZ8CI'),
(74, 15, 'Gavin Artz', 'http://www.youtube.com/embed/2YGujccRv0U'),
(75, 15, 'Greedy Hen', 'http://www.youtube.com/embed/GrE8yCdRP94'),
(76, 15, 'Doug Millen', 'http://www.youtube.com/embed/h8Q1MXgJVyY'),
(77, 15, 'Ruchir Punjabi', 'http://www.youtube.com/embed/YM2c6kHi4D0'),
(78, 22, 'Erika Taylor', 'http://www.youtube.com/embed/2oJYTGerw8g'),
(79, 22, 'Neeraj Sharma', 'http://www.youtube.com/embed/sJMFP-cPNLY'),
(80, 22, 'Mia Sharma', 'http://www.youtube.com/embed/e9t--QE_fzg'),
(81, 22, 'Peter Macreadie', 'http://www.youtube.com/embed/OAjegXHZUME'),
(82, 22, 'Dominic Hare', 'http://www.youtube.com/embed/i5kJnGqmmHo'),
(83, 21, 'Diego Bonetto', 'http://www.youtube.com/embed/wX5JwAvyW4I'),
(84, 21, 'Mathieu Gallois', 'http://www.youtube.com/embed/hWGeqWTzhbk'),
(85, 21, 'Darryl Nichols', 'http://www.youtube.com/embed/zYa-WHYS-JY'),
(86, 21, 'Amanda Talbot', 'http://www.youtube.com/embed/PS7tIHp7dUk'),
(87, 20, 'Catherine Alcorn', 'http://www.youtube.com/embed/56sE6iDYGKo'),
(88, 20, 'Alan Crabbe', 'http://www.youtube.com/embed/Hie9l9S22ec'),
(89, 20, 'Eddie Sharp', 'http://www.youtube.com/embed/jH4Ldo8Lzzw'),
(90, 20, 'Elizabeth White & Robert Moorman', 'http://www.youtube.com/embed/gyChjr5dpYE'),
(91, 20, 'Willurei Kirkbright', 'http://www.youtube.com/embed/nwUanNIvj0I'),
(92, 17, 'Zoe Lamont', 'http://www.youtube.com/embed/l-7L0o-gw5U'),
(93, 17, 'Courtney Tight', 'http://www.youtube.com/embed/txYfY06IRck'),
(94, 17, 'Leanne Townsend', 'http://www.youtube.com/embed/atg_M1l9QPM'),
(95, 17, 'Alicia Freile', 'http://www.youtube.com/embed/RnIufybweBg'),
(96, 17, 'Louise Helliwell & Alex DeBonnis', 'http://www.youtube.com/embed/Cim2tzI2DS4'),
(97, 31, 'Lilly McComb', 'http://www.youtube.com/embed/veXVq9YhII4'),
(98, 31, 'Ant McPhail', 'http://www.youtube.com/embed/nUTwLfkyCKQ'),
(99, 31, 'Vanessa Cullen', 'http://www.youtube.com/embed/09_z6EdduTI'),
(100, 31, 'Jenni Illoski', 'http://www.youtube.com/embed/lMPcqKKIsPA'),
(101, 25, 'Scott Drummond', 'http://www.youtube.com/embed/kVAqX3xl_8Y'),
(102, 25, 'Monique Schafter', 'http://www.youtube.com/embed/QN1ooGJkF70'),
(103, 33, 'Chris Thé', 'http://www.youtube.com/embed/X0J8DwBvNys'),
(104, 33, 'Jono Fisher', 'http://www.youtube.com/embed/V5MD1yoFMho'),
(105, 33, 'Luke Escombe', 'http://www.youtube.com/embed/vpMr6ZBHQ7Q'),
(106, 33, 'Rai Santana', 'http://www.youtube.com/embed/_OalCShhcTE'),
(107, 33, 'Meggan Grose', 'http://www.youtube.com/embed/7tDKG8rXKUk'),
(108, 24, 'Michael Fox', 'http://www.youtube.com/embed/EOMttXhBhhI'),
(109, 24, 'Matt Huynh', 'http://www.youtube.com/embed/7FWtgciYQxo'),
(110, 30, 'Wendy Yeung', 'http://www.youtube.com/embed/ExMQhG3M9X8'),
(111, 30, 'Sam Strong', 'http://www.youtube.com/embed/Ye0RFzJWiy0');

