-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 24, 2022 at 05:17 AM
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
) ENGINE=MyISAM AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `campuses`
--

DROP TABLE IF EXISTS `campuses`;
CREATE TABLE IF NOT EXISTS `campuses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `campus` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb3;

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
) ENGINE=MyISAM AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `citations`
--

INSERT INTO `citations` (`id`, `user_id`, `doc_id`, `cited`) VALUES
(79, 19, 28, 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `citationscopy`
--

INSERT INTO `citationscopy` (`id`, `user_id`, `doc_id`, `cited`) VALUES
(36, 19, 33, 1),
(37, 19, 28, 1),
(40, 41, 34, 1),
(41, 41, 29, 1),
(52, 41, 28, 1),
(63, 41, 35, 1),
(62, 41, 33, 1);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dep` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `dep`) VALUES
(1, 'College of Computer Studies'),
(2, 'College of Teacher Education'),
(3, 'College of Business Management'),
(4, 'NONE'),
(5, 'College of Criminal Justices');

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
  `filename` text NOT NULL,
  `doc_id` int NOT NULL DEFAULT '1',
  `file_id` int NOT NULL DEFAULT '1',
  `uploaded_at` varchar(40) NOT NULL,
  `updated_at` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `doc_id` (`doc_id`),
  KEY `file_id` (`file_id`),
  KEY `stat_id` (`stat_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `user_id`, `title`, `description`, `authors`, `pub_year`, `publisher`, `stat_id`, `filename`, `doc_id`, `file_id`, `uploaded_at`, `updated_at`) VALUES
(29, 26, 'Event Driven Programming', 'Imperative  programming(from  Latin  imperare=  command)  is  the  oldest  programming paradigm.A  program  based  on  this  paradigm  is  made  up  of  a  clearly-defined  sequence  of instructions to a computer.Programming with an explicit sequence of commands that update state.Imperative  programming(from  Latin  imperare=  command)  is  the  oldest  programming paradigm.A  program  based  on  this  paradigm  is  made  up  of  a  clearly-defined  sequence  of instructions to a computer.Therefore,  the  source  code  for  imperative  languages  is  a  series  of  commands,  which  specify what  the  computer  has  to  do ï¿½and  when ï¿½in  order  to  achieve  a  desired  result.  Values  used  in variables  are  changed  at  program  runtime.  To  control  the  commands,  control  structures  such  as loops or branches are integrated into the code.Imperative programming languages are very specific, and operation is system-oriented. On the one hand, the code is easy to understand; on the other hand, many lines of source text are required In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. It is also used to temporarily replace text in a process called greeking, which allows designers to consider the form of a webpage or publication, without the meaning of the text influencing the design.\r\n\r\nLorem ipsum is typically a corrupted version of De finibus bonorum et malorum, a 1st-century BC text by the Roman statesman and philosopher Cicero, with words altered, added, and removed to make it nonsensical and improper Latin.\r\n\r\nVersions of the Lorem ipsum text have been used in typesetting at least since the 1960s, when it was popularized by advertisements for Letraset transfer sheets.[1] Lorem ipsum was introduced to the digital world in the mid-1980s, when Aldus employed it in graphic and word-processing templates for its desktop publishing program PageMaker. Other popular word processors, including Pages and Microsoft Word, have since adopted Lorem ipsum,[2] as have many LaTeX packages,[3][4][5] web content managers such as Joomla! and WordPress, and CSS libraries such as Semantic UI.[6]', 'Pine, Lileth V.', '2021', 'NONE', 2, 'Module 1 - Programming Paradigms.pdf', 2, 5, '2021-11-26 01:22:40pm', '2021-11-28 07:59:41pm'),
(40, 0, 'Test 11', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', 'Test Test', 'January 23, 2022', 'Acer Philippines', 2, 'INV_2022_00001.pdf', 4, 6, '2022-01-23 10:35:57pm', '2022-01-23 11:35:57pm'),
(33, 27, 'Exploration of the perpetuating fast fashion consumption cycle: Young women\'s experiences in pursuit of an ideal self-image', 'The purpose of this qualitative study was to gain an understanding of the lived\r\nexperiences of young women in emerging adulthood who consumed a large quantity of fast\r\nfashion apparel (in excess of 150 pieces annually). Using a phenomenological methodology, this\r\nstudy explored (a) the shopping experiences of the young women, (b) the meaning the young\r\nwomen attached to their clothing purchases, and (c) why the young women were buying large\r\nquantities of fast fashion.\r\nFourteen women between the ages of 19 and 25 from the mid-Atlantic region of the\r\nUnited States participated in the study. The research design consisted of participant blogging\r\nfollowed by individual, semi-structured interviews which lasted between one to one and a half\r\nhours. Interviews were audio recorded and transcribed. Blog entries were combined with\r\ninterview transcriptions into one file per participant and analyzed and interpreted for patterns and\r\ncommon themes using procedural steps recommended by Spiggle (1994).\r\nInterpretative analysis of the data revealed that women in emerging adulthood had\r\ndistinct fashion consumption practices that warranted a description of their shopping behavior.\r\nThe contextualization of their consumption practices aided the thematic interpretation in which\r\nfour topical areas emerged: (a) Pressure and Expectations, (b) Need for Fashion Browsing (c)\r\nPerpetuating Fast Fashion Consumption Cycle, and (d) Positive Emotions.\r\nSeveral key points about participant consumption practices were identified. Women\r\nbrowsed for apparel online more often (daily) in comparison to browsing in-store. They bought\r\nmore clothes online than they did in stores. They shopped consistently at the same fast fashion\r\nstores both online and in the brick-and-mortar stores that they referred to as their â€œgo-toâ€ stores.\r\nWomen preferred to shop online due to the 24/7 shopping convenience and access to unlimited\r\nstores and brands; they preferred in-store shopping to evaluate garment quality and fit and \r\nexperience the store atmosphere. Women bought fashion items on a frequent basis in order to\r\ncreate complete looks enticed by store displays. They described keeping very organized\r\nwardrobes in order to manage a large quantity of clothing. Women disposed of clothing by\r\ndonation to charities to free space in their closets in order to buy new styles.\r\nThe first topical area, Pressure and Expectations, described expectations from influential\r\nadults and pressure from the fashion culture (fashion images from social media, celebrities,\r\nbrand advertisements) that persuaded women to acquire new clothes. The second topical area,\r\nNeed for Fashion Browsing, explained the process of online and in-store browsing to keep up\r\nwith the latest fashion trends. The third topical area, Perpetuating Fast Fashion Consumption\r\nCycle, illustrated why women had a constant need for new apparel. The fourth topical area,\r\nPositive Emotions, described the happiness, excitement and sense of accomplishment women\r\nexperienced when acquiring new apparel.\r\nA model illustrating a perpetuating fast fashion consumption cycle was created to\r\ndemonstrate young womenâ€™s constant need for new apparel in order to achieve an ideal selfimage fueled by pressure and expectations from the fashion culture. Perspectives from the\r\npossible selves and social comparison theories were utilized to guide interpretation of the\r\nthemes.\r\nResults from the present study sought to provide an in-depth understanding of the\r\nshopping experiences and meaning and motivations behind women in emerging adulthoodâ€™s fast\r\nfashion apparel consumption behavior. It suggests that women acquired a large quantity of\r\napparel to achieve an ideal self-image that they internalized from the fashion culture, but as fast\r\nfashion styles changed constantly, the need for new apparel was continuous.', 'Simpson, Leslie H.', '2019', '. Graduate Theses and Dissertations', 2, 'Exploration of the perpetuating fast fashion consumption cycle_ Y.pdf', 4, 5, '2021-11-30 12:10:31pm', '2021-11-30 12:27:59pm'),
(34, 27, 'CRIME INTELLIGENCE SYSTEM', 'This capstone project is a systemic study on police monitoring to promote better police\r\ngovernance. The test bed for this study is for the Philippine National Police (San Juan Police\r\nStation). This systematic study intends to break new grounds in attempt to assist the Philippine\r\nNational Police to improve their services through the use of technology. In addition, this research\r\npaper also further contributes to the literature on policing and crime monitoring. The countryâ€™s\r\nnational police have had a long history of corruption, unethical conducts and other institutional\r\nmatters which resulted to poor governance and mismanagements. The study promotes a decision\r\nsupport model through which the organization could better the monitoring of crimes in order to\r\nimprove policing. This model can greatly aid in their decision making in terms of police\r\nallocation, scheduling and assignment and could be useful to police organizations in other\r\ncountries dealing with the same governance issues. According to this yearâ€™s statistics, crimes\r\nwithin Metro Manila went up by almost 60%. This should not be a cause for contentment and\r\ncomplacency. In order for the PNP to gain the publicâ€™s trust back, they must strive to improve\r\ncrime prevention, guarantee public safety, and sustain order. If technology and innovation are\r\nproperly applied and practiced; criminal intelligence allows the police to effectively understand\r\ncriminality and can help them improve their decision-making in the future. The research paperâ€™s\r\nmain goal is to create a better future for each and every one of us. Crime detection and prevention\r\nis essential in order to provide safety to the people. If safety and security is provided, we can get\r\nmore out of our lives and make a huge difference. It is very important to address this issue because\r\ncrime prevention applies to everyone, every day, regardless of their age and gender.', 'Bertha Griselda T. | Ledesma, Charles | Lim Ryan G., | Miranda, Joseph Louie J. | Tangkeko, Marivic S.', '2013', 'Research Congress', 2, 'HCT-I-008.pdf', 5, 2, '2021-11-30 12:18:00pm', '2021-11-30 12:28:10pm'),
(35, 38, 'Eustass Kid', 'This capstone project is a systemic study on police monitoring to promote better police\r\ngovernance. The test bed for this study is for the Philippine National Police (San Juan Police\r\nStation). This systematic study intends to break new grounds in attempt to assist the Philippine\r\nNational Police to improve their services through the use of technology. In addition, this research\r\npaper also further contributes to the literature on policing and crime monitoring. The countryâ€™s\r\nnational police have had a long history of corruption, unethical conducts and other institutional\r\nmatters which resulted to poor governance and mismanagements. The study promotes a decision\r\nsupport model through which the organization could better the monitoring of crimes in order to\r\nimprove policing. This model can greatly aid in their decision making in terms of police\r\nallocation, scheduling and assignment and could be useful to police organizations in other\r\ncountries dealing with the same governance issues. According to this yearâ€™s statistics, crimes\r\nwithin Metro Manila went up by almost 60%. This should not be a cause for contentment and\r\ncomplacency. In order for the PNP to gain the publicâ€™s trust back, they must strive to improve\r\ncrime prevention, guarantee public safety, and sustain order. If technology and innovation are\r\nproperly applied and practiced; criminal intelligence allows the police to effectively understand\r\ncriminality and can help them improve their decision-making in the future. The research paperâ€™s\r\nmain goal is to create a better future for each and every one of us. Crime detection and prevention\r\nis essential in order to provide safety to the people. If safety and security is provided, we can get\r\nmore out of our lives and make a huge difference. It is very important to address this issue because\r\ncrime prevention applies to everyone, every day, regardless of their age and gender.', 'Eustass Kid', 'September 12, 2018', 'Research Congress', 2, 'Lavalust Full Docs_2.pdf', 2, 6, '2021-12-02 10:46:20pm', '2022-01-23 11:36:35pm'),
(39, 0, 'Acer Test', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 'Dimailig, Noel M.', 'January 23, 2022', 'Dimailig Publishing House', 2, 'Lavalust Full Docs.pdf', 3, 6, '2022-01-23 10:13:39pm', '2022-01-23 10:13:39pm');

-- --------------------------------------------------------

--
-- Table structure for table `document_categories`
--

DROP TABLE IF EXISTS `document_categories`;
CREATE TABLE IF NOT EXISTS `document_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL DEFAULT '-- Select Document --',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `document_categories`
--

INSERT INTO `document_categories` (`id`, `category`) VALUES
(1, '-- Select Document --'),
(2, 'Researches'),
(3, 'Thesis'),
(4, 'Dissertations'),
(5, 'Capstones');

-- --------------------------------------------------------

--
-- Table structure for table `file_categories`
--

DROP TABLE IF EXISTS `file_categories`;
CREATE TABLE IF NOT EXISTS `file_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `file` varchar(255) NOT NULL DEFAULT '-- Select Category --',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `file_categories`
--

INSERT INTO `file_categories` (`id`, `file`) VALUES
(1, '-- Select Category --'),
(2, 'Android Application'),
(3, 'Website Development'),
(4, 'Embedded Systems'),
(5, 'Fashion & Designs'),
(6, 'Automotive Technology'),
(7, 'Education'),
(8, 'Language'),
(9, 'Literature');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

DROP TABLE IF EXISTS `programs`;
CREATE TABLE IF NOT EXISTS `programs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `program` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `program`) VALUES
(1, 'BSIT'),
(2, 'BSCpE'),
(3, 'BSED'),
(4, 'BSHM'),
(5, 'NONE'),
(7, 'BSTM');

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
(2, 'Super Admin'),
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
(2, 'Published'),
(3, 'Unpublished');

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
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `user_id`, `email`) VALUES
(32, 41, 'dimailignoel18@gmail.com');

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
  `campus_id` int NOT NULL DEFAULT '4',
  `program_id` int NOT NULL DEFAULT '4',
  `dep_id` int NOT NULL DEFAULT '4',
  `role_id` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `campus_id` (`campus_id`),
  KEY `program_id` (`program_id`),
  KEY `dep_id` (`dep_id`),
  KEY `role_id` (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `profile`, `username`, `lastname`, `firstname`, `email`, `password`, `campus_id`, `program_id`, `dep_id`, `role_id`) VALUES
(3, 'odoodatabase.png', 'Steve Rogers', 'NONE', 'NONE', 'steve@gmail.com', '$2y$10$EEog4MsP8kiRJsn8x9t.xezYMHHyz.MqBWmxWqqLy/QJrQgeFEB2e', 1, 1, 1, 3),
(19, 'dsdm.JPG', 'Bruce Wayne', 'Wayne', 'Bruce', 'bruce@gmail.com', '$2y$10$NKhaDzaiDLBwRuKke.Xcju9w2xWWVY7FL.VVHE1q47BnxXltqPjMC', 2, 3, 2, 3),
(26, 'PhotoCollage.JPG', 'Tony Stark', 'NONE', 'NONE', 'stark@yahoo.com', '$2y$10$Ayl0LjVUZ3jzcSU/tbGLb.GP0E8nzs.WXqpJ7EBhkv0yHJlGo2ogS', 1, 2, 1, 3),
(38, 'bcb2.png', 'Noel Dimailig', 'Dimailig', 'Noel', 'noel@gmail.com', '$2y$10$BZvQ94fsjmr0YL1R0hTQFOZfe5.cV4OAQ4T8PnW0/qYYxwnmc/M.6', 1, 1, 1, 1),
(41, 'WIN_20220103_17_32_22_Pro.jpg', 'acer', 'acers', 'acers', 'acers@gmail.com', '$2y$04$NAvbo4MVC./CtUCpwkalCOp533dEhacGX2xhmmx7FmZXy60L3TEA6', 1, 1, 1, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
