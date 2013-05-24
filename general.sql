-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 24, 2013 at 08:54 AM
-- Server version: 5.5.29
-- PHP Version: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `haozblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `hz_showcase_fb`
--

CREATE TABLE `hz_showcase_fb` (
  `topic_id` int(11) NOT NULL AUTO_INCREMENT,
  `topic` varchar(50) NOT NULL,
  `review_link` varchar(255) DEFAULT NULL,
  `intro` longtext,
  `presented_date` date NOT NULL,
  PRIMARY KEY (`topic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `hz_showcase_fb`
--

INSERT INTO `hz_showcase_fb` (`topic_id`, `topic`, `review_link`, `intro`, `presented_date`) VALUES
(1, 'u-turn', 'http://vibewire.org/2012/02/fastbreak-u-turn-review/', 'A crowd gathered underneath planes of a by-gone era and braved the early morning.\r\n								A large black steam engine, a glossy burgundy tram carriage and a number of other vintage cars, all suspended in time, surrounded attendees at the Powerhouse Museum.\r\n								With these relics from the past, it was a fitting place for five diverse speakers to explain how they had a U-Turn\\'' in their lives and give advice to the crowd on how to tackle the future.', '2012-02-24'),
(2, 'play', 'http://vibewire.org/2012/04/fastbreak-play-review-2/', 'The young at heart met at our monthly fastBREAK event to hear stories of fun, play, and how to keep imaginations running wild when maturity, a career and commitments come knocking at the door.', '2012-03-30'),
(3, 'rage', 'http://vibewire.org/2012/04/fastbreak-rage-review/', 'Rage captivated its morning audience, as bleary eyes and tired yawns gave way to inspring speakers compelling their audience to channel personal rage into something positive.\r\n								The speakers dispelled the negative undertones associated with rage, suggesting rather that rage is a catalyst for action.', '2012-04-27'),
(6, 'epic', 'http://vibewire.org/2012/05/fastbreak-epic-review/', 'Epic truly lived up to its name as our passionate speakers took to the stage and discussed their own epic eureka moments. It proved a compelling insight into the creative processes involved in embarking on a new project. And reminded the audience that our ideas can shape the world around us, but only if we nurture them.', '2012-05-18'),
(8, 'stuffed', 'http://vibewire.org/2012/06/fastbreak-stuffed-2/', 'This month\\''s fastBREAK: Stuffed served as a welcomed replacement for the conventional cup of hot coffee. Energy kicks and wide-eyes came from thought provoking ideas that explored how stuffed doesn\\''t simply mean a dead-end result for everyone. Rather, it can inspire positive change.', '2012-06-29'),
(9, 'lies', 'http://vibewire.org/2012/07/fastbreak-lies-review/', 'This month\\''s fastBREAK: Lies was an engaging look at deception. Early risers were treated with five individual stories about the nature of lying and how it seeps into every day life.', '2012-07-27'),
(10, 'danger', 'http://vibewire.org/2012/08/fastbreak-danger-review/', 'We live in a society abuzz with the sound of high tech gadgets. We live in a society where news of recent scientific discoveries and technological progress have filtered into the conversations of the everyday. From the discovery of the Higgs-Boson particle to the launch of NASA\\''s Curiosity\\'' rover, science has become the talk of the town.\r\nThis month\\''s fastBREAK speakers joined the discussion with the full force of scientific curiosity and inquisitiveness. The speakers engaged in questioning the dangers of science, provoking deep thought yet drawing laughter from their audience.', '2012-08-24'),
(11, 'cure', 'http://vibewire.org/2012/09/fastbreak-cure-review/', 'It\\''s human nature to want to fix what we perceive as broken. This was the underlying theme of this month\\''s fastBREAK, where six passionate speakers discussed creative cures for society\\''s shortcomings.', '2012-09-28'),
(12, 'tasty', NULL, 'Fill your fastBREAK appetite this month with \\''Tasty\\'' talks coming from home-grown specialists and also an overseas special guest!\r\nTasty is all things food and will delve into the reasons why we eat as well as what we eat. The things we do to get food in this modern day and age are remarkable, whether it be importing goods from overseas, or having massive plantations that the everyday person hasn\\''t even considered.\r\nSometimes we need to slow down and enjoy what we\\''ve really got. Come and celebrate and talk seriously about food and enjoy the delights of every fastBREAK.', '2012-10-26'),
(13, 'magic', NULL, 'fastBREAK this month brings together a series of creatives and who have had varied experiences in the fields they have worked, the lives they have led and the world they wish to be apart of.\r\nMagic can be deceptive or it can be the way the world is seen. To those who are oblivious to the details, it can sometimes be mysterious or supernatural. For those in the know, it can boil down to be a simple parlour trick. As a child, many things seem almost magical because of the lack of explanation. As adults we uncover the truths about how the world works.\r\nTo think creatively allows each individual to see the world in a different light and the speakers this month all have a very unique perspective. Seeing something old in a new way can really help.\r\nThis month at fastBREAK: Magic come and see what this year\\''s series has come to create.', '2012-11-30'),
(14, 'do as you are told', NULL, NULL, '2011-11-25'),
(15, 'better together', NULL, NULL, '2011-09-30'),
(16, 'back to basics', NULL, NULL, '2011-02-25'),
(17, 'what is stopping you', NULL, NULL, '2011-03-25'),
(18, 'are we there yet', NULL, NULL, '2011-04-29'),
(19, 'read much', NULL, NULL, '2011-05-20'),
(20, 'what turns you on', NULL, NULL, '2011-06-24'),
(21, 'is old new again', NULL, NULL, '2011-07-29'),
(22, 'why do you care', NULL, NULL, '2011-08-26'),
(23, 'what is broken', NULL, NULL, '2011-10-28'),
(24, 'what matters', NULL, NULL, '2010-02-26'),
(25, 'are you ready', NULL, NULL, '2010-03-26'),
(26, 'are you alone', NULL, NULL, '2010-04-30'),
(27, 'are you satisfied', NULL, NULL, '2010-05-28'),
(28, 'what now', NULL, NULL, '2010-06-25'),
(29, 'what is your story', NULL, NULL, '2010-07-30'),
(30, 'things change', NULL, NULL, '2010-08-27'),
(31, 'power', NULL, NULL, '2010-09-24'),
(32, 'failure', NULL, NULL, '2010-10-29'),
(33, 'love', NULL, NULL, '2010-11-30'),
(34, 'together', 'http://vibewire.org/fastbreak-together/', 'When you think of TOGETHER many things spring to mind. Family, sharing, collaboration, love and equality are just a few. It is said that humans are social creatures by nature but in this day and age, technology can mask how we relate with one another. We now live in a world that is connected through a multitude of platforms, from the internet, the telephone, easily accessible transportation methods and of course, social media.\r\n								But the idea of truly connecting is one that can be somewhat elusive. Some go through life never having a companion, others have many throughout their lifespan. For some, there is that special someone from day one. Love and loss are key components to everyones\\'' lives. Having a sense of togetherness builds family and communities and is something that most long for.\r\n								On Friday 22nd February, to launch this year\\''s series, fastBREAK: Together will have speakers sharing stories of the impact they have in bringing people together.', '2013-02-22'),
(35, 'craft', 'http://vibewire.org/2013/03/fastbreak-craft/', 'To practice your own craft implies a standard of expertise, of passion, of devotion and artistry. A persons craft is considered to be their profession, but it is also the skill they possess with the most knowledge, proficiency and understanding.\r\n								Craft suggests playfulness, it is moments of impulsive creativity leading to ingenuity and craftsmanship. Consequently it is the key in creating a niche market, a way of perfecting a skill within your field. It is the art of being crafty, of thinking on your feet and creating new ways of getting things done.', '2013-03-22'),
(36, 'upstarts', 'http://vibewire.org/fastbreak-upstarts/', 'The ability to think differently has proven to push the boundaries of what is possible. In an age where technology is constantly evolving, it is clear that people with unique and creative ideas have come to shape our future.\r\n								When these ideas come to full fruition they can change the nature of the market they succeed in, upstarts have the ability to challenge industries and add to an evolution of social and economic change. To wade through certain challenges and to come out clean on the other side is how the upstart triumphs.', '2013-04-26');
