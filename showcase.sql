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
