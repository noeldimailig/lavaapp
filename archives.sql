-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 02, 2022 at 02:34 AM
-- Server version: 8.0.27
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `archives`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks`
--

DROP TABLE IF EXISTS `bookmarks`;
CREATE TABLE IF NOT EXISTS `bookmarks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `doc_id` int NOT NULL DEFAULT '0',
  `user_id` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `doc_id` (`doc_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `bookmarks`
--

INSERT INTO `bookmarks` (`id`, `doc_id`, `user_id`) VALUES
(92, 29, 52),
(98, 29, 67),
(101, 39, 19),
(100, 39, 66),
(93, 29, 56),
(97, 33, 66),
(96, 41, 66),
(95, 29, 60);

-- --------------------------------------------------------

--
-- Table structure for table `campuses`
--

DROP TABLE IF EXISTS `campuses`;
CREATE TABLE IF NOT EXISTS `campuses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `campus` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `campuses`
--

INSERT INTO `campuses` (`id`, `campus`) VALUES
(1, 'MinSU Calapan City Campus'),
(2, 'MinSU Main Campus'),
(4, 'NONE'),
(3, 'MinSU Bongabong Campus');

-- --------------------------------------------------------

--
-- Table structure for table `citations`
--

DROP TABLE IF EXISTS `citations`;
CREATE TABLE IF NOT EXISTS `citations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `doc_id` int NOT NULL,
  `cited` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`doc_id`)
) ENGINE=MyISAM AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `citations`
--

INSERT INTO `citations` (`id`, `user_id`, `doc_id`, `cited`) VALUES
(79, 19, 28, 1),
(85, 60, 29, 1),
(83, 56, 29, 1),
(82, 52, 29, 1),
(84, 19, 34, 1),
(86, 66, 29, 1),
(87, 66, 39, 1),
(88, 19, 39, 1);

-- --------------------------------------------------------

--
-- Table structure for table `citationscopy`
--

DROP TABLE IF EXISTS `citationscopy`;
CREATE TABLE IF NOT EXISTS `citationscopy` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `doc_id` int NOT NULL,
  `cited` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `doc_id` (`doc_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `citationscopy`
--

INSERT INTO `citationscopy` (`id`, `user_id`, `doc_id`, `cited`) VALUES
(36, 19, 33, 1),
(37, 19, 28, 1),
(40, 41, 34, 1),
(41, 41, 29, 1),
(52, 41, 28, 1),
(70, 66, 39, 1),
(69, 66, 29, 1),
(68, 60, 29, 1),
(67, 19, 34, 1),
(66, 56, 29, 1),
(65, 52, 29, 1),
(64, 19, 39, 1),
(63, 41, 35, 1),
(62, 41, 33, 1);

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
CREATE TABLE IF NOT EXISTS `documents` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `authors` text NOT NULL,
  `pub_year` varchar(255) NOT NULL DEFAULT 'NONE',
  `publisher` varchar(255) NOT NULL DEFAULT 'NONE',
  `stat_id` int NOT NULL DEFAULT '1',
  `archive` int NOT NULL DEFAULT '0',
  `filename` text NOT NULL,
  `doc_id` int NOT NULL DEFAULT '1',
  `uploaded_at` varchar(40) NOT NULL,
  `updated_at` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `doc_id` (`doc_id`),
  KEY `stat_id` (`stat_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `user_id`, `title`, `description`, `authors`, `pub_year`, `publisher`, `stat_id`, `archive`, `filename`, `doc_id`, `uploaded_at`, `updated_at`) VALUES
(29, 66, 'Event Driven Programming', 'Imperative  programming(from  Latin  imperare=  command)  is  the  oldest  programming paradigm.A  program  based  on  this  paradigm  is  made  up  of  a  clearly-defined  sequence  of instructions to a computer.Programming with an explicit sequence of commands that update state.Imperative  programming(from  Latin  imperare=  command)  is  the  oldest  programming paradigm.A  program  based  on  this  paradigm  is  made  up  of  a  clearly-defined  sequence  of instructions to a computer.Therefore,  the  source  code  for  imperative  languages  is  a  series  of  commands,  which  specify what  the  computer  has  to  do ï¿½and  when ï¿½in  order  to  achieve  a  desired  result.  Values  used  in variables  are  changed  at  program  runtime.  To  control  the  commands,  control  structures  such  as loops or branches are integrated into the code.Imperative programming languages are very specific, and operation is system-oriented. On the one hand, the code is easy to understand; on the other hand, many lines of source text are required In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. It is also used to temporarily replace text in a process called greeking, which allows designers to consider the form of a webpage or publication, without the meaning of the text influencing the design.\r\n\r\nLorem ipsum is typically a corrupted version of De finibus bonorum et malorum, a 1st-century BC text by the Roman statesman and philosopher Cicero, with words altered, added, and removed to make it nonsensical and improper Latin.\r\n\r\nVersions of the Lorem ipsum text have been used in typesetting at least since the 1960s, when it was popularized by advertisements for Letraset transfer sheets.[1] Lorem ipsum was introduced to the digital world in the mid-1980s, when Aldus employed it in graphic and word-processing templates for its desktop publishing program PageMaker. Other popular word processors, including Pages and Microsoft Word, have since adopted Lorem ipsum,[2] as have many LaTeX packages,[3][4][5] web content managers such as Joomla! and WordPress, and CSS libraries such as Semantic UI.[6]', 'Pine, Lileth V.', '2021', 'NONE', 2, 0, 'Module 1 - Programming Paradigms.pdf', 2, '2021-11-26 01:22:40pm', '2021-11-28 07:59:41pm'),
(41, 66, 'Sample Doc', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32', 'Eustass Kid K.', 'January 23, 2022', 'Dimailig Publishing House', 2, 0, 'INV_2022_00002.pdf', 4, '2022-02-01 03:33:16pm', '2022-02-03 02:23:21pm'),
(33, 27, 'Exploration of the perpetuating fast fashion consumption cycle: Young women\'s experiences in pursuit of an ideal self-image', 'The purpose of this qualitative study was to gain an understanding of the lived\r\nexperiences of young women in emerging adulthood who consumed a large quantity of fast\r\nfashion apparel (in excess of 150 pieces annually). Using a phenomenological methodology, this\r\nstudy explored (a) the shopping experiences of the young women, (b) the meaning the young\r\nwomen attached to their clothing purchases, and (c) why the young women were buying large\r\nquantities of fast fashion.\r\nFourteen women between the ages of 19 and 25 from the mid-Atlantic region of the\r\nUnited States participated in the study. The research design consisted of participant blogging\r\nfollowed by individual, semi-structured interviews which lasted between one to one and a half\r\nhours. Interviews were audio recorded and transcribed. Blog entries were combined with\r\ninterview transcriptions into one file per participant and analyzed and interpreted for patterns and\r\ncommon themes using procedural steps recommended by Spiggle (1994).\r\nInterpretative analysis of the data revealed that women in emerging adulthood had\r\ndistinct fashion consumption practices that warranted a description of their shopping behavior.\r\nThe contextualization of their consumption practices aided the thematic interpretation in which\r\nfour topical areas emerged: (a) Pressure and Expectations, (b) Need for Fashion Browsing (c)\r\nPerpetuating Fast Fashion Consumption Cycle, and (d) Positive Emotions.\r\nSeveral key points about participant consumption practices were identified. Women\r\nbrowsed for apparel online more often (daily) in comparison to browsing in-store. They bought\r\nmore clothes online than they did in stores. They shopped consistently at the same fast fashion\r\nstores both online and in the brick-and-mortar stores that they referred to as their â€œgo-toâ€ stores.\r\nWomen preferred to shop online due to the 24/7 shopping convenience and access to unlimited\r\nstores and brands; they preferred in-store shopping to evaluate garment quality and fit and \r\nexperience the store atmosphere. Women bought fashion items on a frequent basis in order to\r\ncreate complete looks enticed by store displays. They described keeping very organized\r\nwardrobes in order to manage a large quantity of clothing. Women disposed of clothing by\r\ndonation to charities to free space in their closets in order to buy new styles.\r\nThe first topical area, Pressure and Expectations, described expectations from influential\r\nadults and pressure from the fashion culture (fashion images from social media, celebrities,\r\nbrand advertisements) that persuaded women to acquire new clothes. The second topical area,\r\nNeed for Fashion Browsing, explained the process of online and in-store browsing to keep up\r\nwith the latest fashion trends. The third topical area, Perpetuating Fast Fashion Consumption\r\nCycle, illustrated why women had a constant need for new apparel. The fourth topical area,\r\nPositive Emotions, described the happiness, excitement and sense of accomplishment women\r\nexperienced when acquiring new apparel.\r\nA model illustrating a perpetuating fast fashion consumption cycle was created to\r\ndemonstrate young womenâ€™s constant need for new apparel in order to achieve an ideal selfimage fueled by pressure and expectations from the fashion culture. Perspectives from the\r\npossible selves and social comparison theories were utilized to guide interpretation of the\r\nthemes.\r\nResults from the present study sought to provide an in-depth understanding of the\r\nshopping experiences and meaning and motivations behind women in emerging adulthoodâ€™s fast\r\nfashion apparel consumption behavior. It suggests that women acquired a large quantity of\r\napparel to achieve an ideal self-image that they internalized from the fashion culture, but as fast\r\nfashion styles changed constantly, the need for new apparel was continuous.', 'Simpson, Leslie H.', '2019', 'Graduate Theses and Dissertations', 2, 0, 'Exploration of the perpetuating fast fashion consumption cycle_ Y.pdf', 4, '2021-11-30 12:10:31pm', '2021-11-30 12:27:59pm'),
(34, 27, 'CRIME INTELLIGENCE SYSTEM', 'This capstone project is a systemic study on police monitoring to promote better police\r\ngovernance. The test bed for this study is for the Philippine National Police (San Juan Police\r\nStation). This systematic study intends to break new grounds in attempt to assist the Philippine\r\nNational Police to improve their services through the use of technology. In addition, this research\r\npaper also further contributes to the literature on policing and crime monitoring. The countryâ€™s\r\nnational police have had a long history of corruption, unethical conducts and other institutional\r\nmatters which resulted to poor governance and mismanagements. The study promotes a decision\r\nsupport model through which the organization could better the monitoring of crimes in order to\r\nimprove policing. This model can greatly aid in their decision making in terms of police\r\nallocation, scheduling and assignment and could be useful to police organizations in other\r\ncountries dealing with the same governance issues. According to this yearâ€™s statistics, crimes\r\nwithin Metro Manila went up by almost 60%. This should not be a cause for contentment and\r\ncomplacency. In order for the PNP to gain the publicâ€™s trust back, they must strive to improve\r\ncrime prevention, guarantee public safety, and sustain order. If technology and innovation are\r\nproperly applied and practiced; criminal intelligence allows the police to effectively understand\r\ncriminality and can help them improve their decision-making in the future. The research paperâ€™s\r\nmain goal is to create a better future for each and every one of us. Crime detection and prevention\r\nis essential in order to provide safety to the people. If safety and security is provided, we can get\r\nmore out of our lives and make a huge difference. It is very important to address this issue because\r\ncrime prevention applies to everyone, every day, regardless of their age and gender.', 'Bertha Griselda T. | Ledesma, Charles | Lim Ryan G., | Miranda, Joseph Louie J. | Tangkeko, Marivic S.', '2013', 'Research Congress', 2, 0, 'HCT-I-008.pdf', 5, '2021-11-30 12:18:00pm', '2021-11-30 12:28:10pm'),
(39, 68, 'Acer Test', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 'Dimailig, Noel M.', 'January 23, 2022', 'Dimailig Publishing House', 2, 0, 'Lavalust Full Docs.pdf', 3, '2022-01-23 10:13:39pm', '2022-01-23 10:13:39pm'),
(55, 66, 'asdasdsad', 'werrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr', 'Noel Dimailig', '2022-02-01', 'Dimailig Publishing House', 1, 0, 'Web-MFinals.docx.pdf', 2, '2022-02-14 11:17:50am', NULL),
(53, 66, 'Test Email Verification', 'Compiled the video edits of the proclamation rallies of all the candidates (except for Ping\'s -- I like him a lot but I couldn\'t find his). These were sent to me by the PR teams and supporters of each campaign.\r\nOf course I\'m biased for BBM as I personally hired and worked with many of the people on his team and it makes me so proud of them when I see how good their production value has gotten, but if I\'m being objective, I think all the camps did very well here. Cool to see', 'Dimailig, Noel', '2022-02-03', 'Dimailig Publishing House', 1, 0, 'Event-Finals.pdf', 3, '2022-02-13 10:38:40pm', NULL),
(56, 0, 'asdasd', 'asdasd', 'assdasd', '2022-02-16', 'dsadasd', 2, 0, 'Application-Midterm.pdf', 3, '2022-02-16 11:03:50am', '2022-02-16 11:03:50am'),
(57, 0, 'New Update', '0/06/2020 · Try quickfix: Anyway, before (un)checking enable load on every query or actually changing any query to remove your issue, you could: 1) try to revert back to the archived by geting', 'assdasd', '2022-02-16', 'dsadasd', 2, 1, 'INV_2022_00019.pdf', 1, '2022-02-16 11:05:04am', '2022-02-16 11:13:49am'),
(58, 66, 'New File', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\r\n\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 'Dimailig, Noel M.', '2022-02-16', 'Acer Philippines', 2, 0, 'INV_2022_00002 (1).pdf', 4, '2022-02-16 12:52:08pm', NULL),
(59, 74, 'new upload', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 'Pine Lileth', '2022-02-01', 'Acer Philippines', 2, 0, 'Module 2 - Interrogating-Globalization.pdf', 3, '2022-02-16 01:20:19pm', NULL),
(60, 0, 'add doc', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', 'Eustass Kid', '2022-02-04', 'Acer Philippines', 2, 0, 'Module 6 - Contemporary Global Governance.pdf', 4, '2022-02-16 01:24:09pm', '2022-02-16 01:24:37pm');

-- --------------------------------------------------------

--
-- Table structure for table `document_categories`
--

DROP TABLE IF EXISTS `document_categories`;
CREATE TABLE IF NOT EXISTS `document_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL DEFAULT '-- Select Document --',
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `document_categories`
--

INSERT INTO `document_categories` (`id`, `category`, `status`) VALUES
(1, '-- Select Document --', 1),
(2, 'Researches', 1),
(3, 'Thesis', 1),
(4, 'Dissertations', 1),
(5, 'Capstones', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'User'),
(2, 'Document Admin'),
(3, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
CREATE TABLE IF NOT EXISTS `states` (
  `id` int NOT NULL AUTO_INCREMENT,
  `state` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `state`) VALUES
(1, 'Pending'),
(2, 'Published');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

DROP TABLE IF EXISTS `subscribers`;
CREATE TABLE IF NOT EXISTS `subscribers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `user_id`, `email`) VALUES
(36, 66, 'dimailignoel18@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `profile` varchar(255) NOT NULL DEFAULT 'profile.png',
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `lastname` varchar(255) NOT NULL DEFAULT 'NONE',
  `firstname` varchar(255) NOT NULL DEFAULT 'NONE',
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `role_id` int NOT NULL DEFAULT '1',
  `validation_code` int NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `profile`, `username`, `lastname`, `firstname`, `email`, `password`, `role_id`, `validation_code`, `status`) VALUES
(3, 'Picture1.png', 'lileth09', 'Pine', 'Lileth', 'lileth@gmail.com', '$2y$10$EEog4MsP8kiRJsn8x9t.xezYMHHyz.MqBWmxWqqLy/QJrQgeFEB2e', 1, 75342, 1),
(19, 'groups_rating.PNG', 'Bruce Wayne', 'Wayne', 'Bruces', 'bruce@gmail.com', '$2y$10$NKhaDzaiDLBwRuKke.Xcju9w2xWWVY7FL.VVHE1q47BnxXltqPjMC', 2, 23245, 1),
(26, 'PhotoCollage.JPG', 'Tony Stark', 'NONE', 'NONE', 'stark@yahoo.com', '$2y$10$Ayl0LjVUZ3jzcSU/tbGLb.GP0E8nzs.WXqpJ7EBhkv0yHJlGo2ogS', 1, 74637, 1),
(38, 'bcb2.png', 'Noel Dimailig', 'Dimailig', 'Noel', 'noel@gmail.com', '$2y$10$BZvQ94fsjmr0YL1R0hTQFOZfe5.cV4OAQ4T8PnW0/qYYxwnmc/M.6', 1, 19342, 1),
(41, 'profile.png', 'acer', 'acers', 'acers', 'acers@gmail.com', '$2y$04$NAvbo4MVC./CtUCpwkalCOp533dEhacGX2xhmmx7FmZXy60L3TEA6', 1, 43452, 1),
(66, 'profile.png', 'noelskie', 'Dimailig', 'Noel', 'dimailignoel18@gmail.com', '$2y$04$dSGLLlcfq5/A5JgTJOHv3OxvLE94BoyhqiecP01wrolUu6gfIuirC', 1, 46013, 1),
(74, 'profile.png', 'lileth09', 'NONE', 'NONE', 'pinelileth28@gmail.com', '$2y$04$skABmJDJQ7szjqYEL80YWOL7mEnZnAfl21uaHMXUj/eRzBAoU..Im', 3, 87082, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
