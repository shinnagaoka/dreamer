-- --------------------------------------------------------

--
-- テーブルの構造 `posts`
--

CREATE TABLE IF NOT EXISTS `dr_users` (
  `user_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `user_name` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_image_path` varchar(255) NOT NULL,
  `now_dream_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `dr_dreams` (
  `dream_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `dream_contents` varchar(255) NOT NULL,
  `dream_image_path` varchar(255) NOT NULL,
  `category` int(11) NOT NULL,
  `d_schedule` date NOT NULL,
  `achieve_1` varchar(255) NOT NULL,
  `achieve_2` varchar(255) NOT NULL,
  `achieve_3` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `dr_steps` (
  `step_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `dream_id` int(11) NOT NULL,
  `step_contents` varchar(255) NOT NULL,
  `s_schedule` datetime NOT NULL,
  `daily_goal_contents` varchar(255) NOT NULL,
  `daily_time` int(11) NOT NULL,
  `achieve` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `dr_evas` (
  `eva_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `dream_id` int(11) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `dr_tags` (
  `tag_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `dream_id` int(11) NOT NULL,
  `tag_contents` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `dr_cheers` (
  `cheer_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `dream_id` int(11) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `dr_histories` (
  `history_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `dream_id` int(11) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `dr_chats` (
  `chat_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `dream_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `chats_contents` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `dr_dreams` (`dream_id`, `user_id`, `dream_contents`, `dream_image_path`, `category`, `d_schedule`, `achieve_1`, `achieve_2`, `achieve_3`, `created`, `modified`) VALUES
(1, 1, 'Make a girlfriend.', '1.jpg', 1, '2018-01-01 00:00:00', '', '', '', '2016-01-01 00:00:00','');
INSERT INTO `dr_dreams` (`dream_id`, `user_id`, `dream_contents`, `dream_image_path`, `category`, `d_schedule`, `achieve_1`, `achieve_2`, `achieve_3`, `created`, `modified`) VALUES
(2, 2, 'Go to America.', '1.jpg', 1, '2018-01-01 00:00:00', '', '', '', '2016-01-01 00:00:00','');
INSERT INTO `dr_dreams` (`dream_id`, `user_id`, `dream_contents`, `dream_image_path`, `category`, `d_schedule`, `achieve_1`, `achieve_2`, `achieve_3`, `created`, `modified`) VALUES
(3, 1, 'Strat a company.', '1.jpg', 1, '2018-01-01 00:00:00', '', '', '', '2016-01-01 00:00:00','');
INSERT INTO `dr_dreams` (`dream_id`, `user_id`, `dream_contents`, `dream_image_path`, `category`, `d_schedule`, `achieve_1`, `achieve_2`, `achieve_3`, `created`, `modified`) VALUES
(4, 3, 'To be God.', '1.jpg', 1, '2018-01-01 00:00:00', '', '', '', '2016-01-01 00:00:00','');
INSERT INTO `dr_dreams` (`dream_id`, `user_id`, `dream_contents`, `dream_image_path`, `category`, `d_schedule`, `achieve_1`, `achieve_2`, `achieve_3`, `created`, `modified`) VALUES
(5, 1, 'Strat a company.', '1.jpg', 1, '2018-01-01 00:00:00', '', '', '', '2016-01-01 00:00:00','');
INSERT INTO `dr_dreams` (`dream_id`, `user_id`, `dream_contents`, `dream_image_path`, `category`, `d_schedule`, `achieve_1`, `achieve_2`, `achieve_3`, `created`, `modified`) VALUES
(6, 3, 'To be God.', '1.jpg', 1, '2018-01-01 00:00:00', '', '', '', '2016-01-01 00:00:00','');

INSERT INTO `dr_dreams` (`dream_id`, `user_id`, `dream_contents`, `dream_image_path`, `category`, `d_schedule`, `achieve_1`, `achieve_2`, `achieve_3`, `created`, `modified`) VALUES
(7, 1, 'Make a girlfriend.', '3.jpg', 2, '2018-01-01 00:00:00', '', '', '', '2016-01-01 00:00:00','');
INSERT INTO `dr_dreams` (`dream_id`, `user_id`, `dream_contents`, `dream_image_path`, `category`, `d_schedule`, `achieve_1`, `achieve_2`, `achieve_3`, `created`, `modified`) VALUES
(8, 2, 'Go to America.', '3.jpg', 2, '2018-01-01 00:00:00', '', '', '', '2016-01-01 00:00:00','');
INSERT INTO `dr_dreams` (`dream_id`, `user_id`, `dream_contents`, `dream_image_path`, `category`, `d_schedule`, `achieve_1`, `achieve_2`, `achieve_3`, `created`, `modified`) VALUES
(9, 1, 'Strat a company.', '3.jpg', 2, '2018-01-01 00:00:00', '', '', '', '2016-01-01 00:00:00','');
INSERT INTO `dr_dreams` (`dream_id`, `user_id`, `dream_contents`, `dream_image_path`, `category`, `d_schedule`, `achieve_1`, `achieve_2`, `achieve_3`, `created`, `modified`) VALUES
(10, 3, 'To be God.', '3.jpg', 2, '2018-01-01 00:00:00', '', '', '', '2016-01-01 00:00:00','');
INSERT INTO `dr_dreams` (`dream_id`, `user_id`, `dream_contents`, `dream_image_path`, `category`, `d_schedule`, `achieve_1`, `achieve_2`, `achieve_3`, `created`, `modified`) VALUES
(11, 1, 'Strat a company.', '3.jpg', 2, '2018-01-01 00:00:00', '', '', '', '2016-01-01 00:00:00','');
INSERT INTO `dr_dreams` (`dream_id`, `user_id`, `dream_contents`, `dream_image_path`, `category`, `d_schedule`, `achieve_1`, `achieve_2`, `achieve_3`, `created`, `modified`) VALUES
(12, 3, 'To be God.', '3.jpg', 2, '2018-01-01 00:00:00', '', '', '', '2016-01-01 00:00:00','');

INSERT INTO `dr_dreams` (`dream_id`, `user_id`, `dream_contents`, `dream_image_path`, `category`, `d_schedule`, `achieve_1`, `achieve_2`, `achieve_3`, `created`, `modified`) VALUES
(13, 1, 'Make a girlfriend.', '4.jpg', 3, '2018-01-01 00:00:00', '', '', '', '2016-01-01 00:00:00','');
INSERT INTO `dr_dreams` (`dream_id`, `user_id`, `dream_contents`, `dream_image_path`, `category`, `d_schedule`, `achieve_1`, `achieve_2`, `achieve_3`, `created`, `modified`) VALUES
(14, 2, 'Go to America.', '4.jpg', 3, '2018-01-01 00:00:00', '', '', '', '2016-01-01 00:00:00','');
INSERT INTO `dr_dreams` (`dream_id`, `user_id`, `dream_contents`, `dream_image_path`, `category`, `d_schedule`, `achieve_1`, `achieve_2`, `achieve_3`, `created`, `modified`) VALUES
(15, 1, 'Strat a company.', '4.jpg', 3, '2018-01-01 00:00:00', '', '', '', '2016-01-01 00:00:00','');
INSERT INTO `dr_dreams` (`dream_id`, `user_id`, `dream_contents`, `dream_image_path`, `category`, `d_schedule`, `achieve_1`, `achieve_2`, `achieve_3`, `created`, `modified`) VALUES
(16, 3, 'To be God.', '4.jpg', 3, '2018-01-01 00:00:00', '', '', '', '2016-01-01 00:00:00','');
INSERT INTO `dr_dreams` (`dream_id`, `user_id`, `dream_contents`, `dream_image_path`, `category`, `d_schedule`, `achieve_1`, `achieve_2`, `achieve_3`, `created`, `modified`) VALUES
(17, 1, 'Strat a company.', '4.jpg', 3, '2018-01-01 00:00:00', '', '', '', '2016-01-01 00:00:00','');
INSERT INTO `dr_dreams` (`dream_id`, `user_id`, `dream_contents`, `dream_image_path`, `category`, `d_schedule`, `achieve_1`, `achieve_2`, `achieve_3`, `created`, `modified`) VALUES
(18, 3, 'To be God.', '4.jpg', 3, '2018-01-01 00:00:00', '', '', '', '2016-01-01 00:00:00','');

INSERT INTO `dr_dreams` (`dream_id`, `user_id`, `dream_contents`, `dream_image_path`, `category`, `d_schedule`, `achieve_1`, `achieve_2`, `achieve_3`, `created`, `modified`) VALUES
(19, 1, 'Make a girlfriend.', '5.jpg', 4, '2018-01-01 00:00:00', '', '', '', '2016-01-01 00:00:00','');
INSERT INTO `dr_dreams` (`dream_id`, `user_id`, `dream_contents`, `dream_image_path`, `category`, `d_schedule`, `achieve_1`, `achieve_2`, `achieve_3`, `created`, `modified`) VALUES
(20, 2, 'Go to America.', '5.jpg', 4, '2018-01-01 00:00:00', '', '', '', '2016-01-01 00:00:00','');
INSERT INTO `dr_dreams` (`dream_id`, `user_id`, `dream_contents`, `dream_image_path`, `category`, `d_schedule`, `achieve_1`, `achieve_2`, `achieve_3`, `created`, `modified`) VALUES
(21, 1, 'Strat a company.', '5.jpg', 4, '2018-01-01 00:00:00', '', '', '', '2016-01-01 00:00:00','');
INSERT INTO `dr_dreams` (`dream_id`, `user_id`, `dream_contents`, `dream_image_path`, `category`, `d_schedule`, `achieve_1`, `achieve_2`, `achieve_3`, `created`, `modified`) VALUES
(22, 3, 'To be God.', '5.jpg', 4, '2018-01-01 00:00:00', '', '', '', '2016-01-01 00:00:00','');
INSERT INTO `dr_dreams` (`dream_id`, `user_id`, `dream_contents`, `dream_image_path`, `category`, `d_schedule`, `achieve_1`, `achieve_2`, `achieve_3`, `created`, `modified`) VALUES
(23, 1, 'Strat a company.', '5.jpg', 4, '2018-01-01 00:00:00', '', '', '', '2016-01-01 00:00:00','');
INSERT INTO `dr_dreams` (`dream_id`, `user_id`, `dream_contents`, `dream_image_path`, `category`, `d_schedule`, `achieve_1`, `achieve_2`, `achieve_3`, `created`, `modified`) VALUES
(24, 3, 'To be God.', '5.jpg', 4, '2018-01-01 00:00:00', '', '', '', '2016-01-01 00:00:00','');

INSERT INTO `dr_dreams` (`dream_id`, `user_id`, `dream_contents`, `dream_image_path`, `category`, `d_schedule`, `achieve_1`, `achieve_2`, `achieve_3`, `created`, `modified`) VALUES
(25, 1, 'Make a girlfriend.', '6.jpg', 5, '2018-01-01 00:00:00', '', '', '', '2016-01-01 00:00:00','');
INSERT INTO `dr_dreams` (`dream_id`, `user_id`, `dream_contents`, `dream_image_path`, `category`, `d_schedule`, `achieve_1`, `achieve_2`, `achieve_3`, `created`, `modified`) VALUES
(26, 2, 'Go to America.', '6.jpg', 5, '2018-01-01 00:00:00', '', '', '', '2016-01-01 00:00:00','');
INSERT INTO `dr_dreams` (`dream_id`, `user_id`, `dream_contents`, `dream_image_path`, `category`, `d_schedule`, `achieve_1`, `achieve_2`, `achieve_3`, `created`, `modified`) VALUES
(27, 1, 'Strat a company.', '6.jpg', 5, '2018-01-01 00:00:00', '', '', '', '2016-01-01 00:00:00','');
INSERT INTO `dr_dreams` (`dream_id`, `user_id`, `dream_contents`, `dream_image_path`, `category`, `d_schedule`, `achieve_1`, `achieve_2`, `achieve_3`, `created`, `modified`) VALUES
(28, 3, 'To be God.', '6.jpg', 5, '2018-01-01 00:00:00', '', '', '', '2016-01-01 00:00:00','');
INSERT INTO `dr_dreams` (`dream_id`, `user_id`, `dream_contents`, `dream_image_path`, `category`, `d_schedule`, `achieve_1`, `achieve_2`, `achieve_3`, `created`, `modified`) VALUES
(29, 1, 'Strat a company.', '6.jpg', 5, '2018-01-01 00:00:00', '', '', '', '2016-01-01 00:00:00','');
INSERT INTO `dr_dreams` (`dream_id`, `user_id`, `dream_contents`, `dream_image_path`, `category`, `d_schedule`, `achieve_1`, `achieve_2`, `achieve_3`, `created`, `modified`) VALUES
(30, 3, 'To be God.', '6.jpg', 5, '2018-01-01 00:00:00', '', '', '', '2016-01-01 00:00:00','');

INSERT INTO `dr_dreams` (`dream_id`, `user_id`, `dream_contents`, `dream_image_path`, `category`, `d_schedule`, `achieve_1`, `achieve_2`, `achieve_3`, `created`, `modified`) VALUES
(31, 1, 'Make a girlfriend.', '2.jpg', 6, '2018-01-01 00:00:00', '', '', '', '2016-01-01 00:00:00','');
INSERT INTO `dr_dreams` (`dream_id`, `user_id`, `dream_contents`, `dream_image_path`, `category`, `d_schedule`, `achieve_1`, `achieve_2`, `achieve_3`, `created`, `modified`) VALUES
(32, 2, 'Go to America.', '2.jpg', 6, '2018-01-01 00:00:00', '', '', '', '2016-01-01 00:00:00','');
INSERT INTO `dr_dreams` (`dream_id`, `user_id`, `dream_contents`, `dream_image_path`, `category`, `d_schedule`, `achieve_1`, `achieve_2`, `achieve_3`, `created`, `modified`) VALUES
(33, 1, 'Strat a company.', '2.jpg', 6, '2018-01-01 00:00:00', '', '', '', '2016-01-01 00:00:00','');
INSERT INTO `dr_dreams` (`dream_id`, `user_id`, `dream_contents`, `dream_image_path`, `category`, `d_schedule`, `achieve_1`, `achieve_2`, `achieve_3`, `created`, `modified`) VALUES
(34, 3, 'To be God.', '2.jpg', 6, '2018-01-01 00:00:00', '', '', '', '2016-01-01 00:00:00','');
INSERT INTO `dr_dreams` (`dream_id`, `user_id`, `dream_contents`, `dream_image_path`, `category`, `d_schedule`, `achieve_1`, `achieve_2`, `achieve_3`, `created`, `modified`) VALUES
(35, 1, 'Strat a company.', '2.jpg', 6, '2018-01-01 00:00:00', '', '', '', '2016-01-01 00:00:00','');
INSERT INTO `dr_dreams` (`dream_id`, `user_id`, `dream_contents`, `dream_image_path`, `category`, `d_schedule`, `achieve_1`, `achieve_2`, `achieve_3`, `created`, `modified`) VALUES
(36, 3, 'To be God.', '2.jpg', 6, '2018-01-01 00:00:00', '', '', '', '2016-01-01 00:00:00','');

INSERT INTO `dr_steps` (`step_id`, `dream_id`, `step_contents`, `s_schedule`, `daily_time`, `achieve`, `created`, `modified`) VALUES
(1, 1, 'Go to home.', '2018-01-01 00:00:00', 10, '', '2016-01-01 00:00:00', '');
INSERT INTO `dr_steps` (`step_id`, `dream_id`, `step_contents`, `s_schedule`, `daily_time`, `achieve`, `created`, `modified`) VALUES
(2, 1, 'Go to school.', '2018-01-01 00:00:00', 10, '', '2016-01-01 00:00:00', '');

INSERT INTO `dr_steps` (`step_id`, `dream_id`, `step_contents`, `s_schedule`, `daily_time`, `achieve`, `created`, `modified`) VALUES
(3, 2, 'Go to trip company.', '2018-01-01 00:00:00', 10, '', '2016-01-01 00:00:00', '');
INSERT INTO `dr_steps` (`step_id`, `dream_id`, `step_contents`, `s_schedule`, `daily_time`, `achieve`, `created`, `modified`) VALUES
(4, 2, 'save up.', '2018-01-01 00:00:00', 10, '', '2016-01-01 00:00:00', '');

INSERT INTO `dr_steps` (`step_id`, `dream_id`, `step_contents`, `s_schedule`, `daily_time`, `achieve`, `created`, `modified`) VALUES
(5, 3, 'study about it.', '2018-01-01 00:00:00', 10, '', '2016-01-01 00:00:00', '');
INSERT INTO `dr_steps` (`step_id`, `dream_id`, `step_contents`, `s_schedule`, `daily_time`, `achieve`, `created`, `modified`) VALUES
(6, 3, 'think about it.', '2018-01-01 00:00:00', 10, '', '2016-01-01 00:00:00', '');

INSERT INTO `dr_steps` (`step_id`, `dream_id`, `step_contents`, `s_schedule`, `daily_time`, `achieve`, `created`, `modified`) VALUES
(7, 4, 'think world.', '2018-01-01 00:00:00', 10, '', '2016-01-01 00:00:00', '');
INSERT INTO `dr_steps` (`step_id`, `dream_id`, `step_contents`, `s_schedule`, `daily_time`, `achieve`, `created`, `modified`) VALUES
(8, 4, 'think about myself.', '2018-01-01 00:00:00', 10, '', '2016-01-01 00:00:00', '');

INSERT INTO `dr_cheers`(`cheer_id`, `user_id`, `dream_id`, `created`) VALUES (1,1,3,'2016-01-01 00:00:00');
INSERT INTO `dr_cheers`(`cheer_id`, `user_id`, `dream_id`, `created`) VALUES (2,1,1,'2017-01-01 00:00:00');
INSERT INTO `dr_cheers`(`cheer_id`, `user_id`, `dream_id`, `created`) VALUES (3,1,2,'2016-06-01 00:00:00');
INSERT INTO `dr_cheers`(`cheer_id`, `user_id`, `dream_id`, `created`) VALUES (4,2,1,'2016-04-01 00:00:00');
INSERT INTO `dr_cheers`(`cheer_id`, `user_id`, `dream_id`, `created`) VALUES (5,1,4,'2017-04-01 00:00:00');
INSERT INTO `dr_cheers`(`cheer_id`, `user_id`, `dream_id`, `created`) VALUES (6,1,5,'2017-03-01 00:00:00');
INSERT INTO `dr_cheers`(`cheer_id`, `user_id`, `dream_id`, `created`) VALUES (7,3,1,'2016-06-01 00:00:00');
INSERT INTO `dr_cheers`(`cheer_id`, `user_id`, `dream_id`, `created`) VALUES (8,3,2,'2017-02-01 00:00:00');
INSERT INTO `dr_cheers`(`cheer_id`, `user_id`, `dream_id`, `created`) VALUES (9,3,3,'2016-07-01 00:00:00');
INSERT INTO `dr_cheers`(`cheer_id`, `user_id`, `dream_id`, `created`) VALUES (10,2,2,'2016-05-01 00:00:00');
INSERT INTO `dr_cheers`(`cheer_id`, `user_id`, `dream_id`, `created`) VALUES (11,2,3,'2016-03-01 00:00:00');
INSERT INTO `dr_cheers`(`cheer_id`, `user_id`, `dream_id`, `created`) VALUES (12,1,6,'2017-08-01 00:00:00');
INSERT INTO `dr_cheers`(`cheer_id`, `user_id`, `dream_id`, `created`) VALUES (13,1,7,'2017-08-01 00:00:00');
INSERT INTO `dr_cheers`(`cheer_id`, `user_id`, `dream_id`, `created`) VALUES (14,2,4,'2017-02-01 00:00:00');
INSERT INTO `dr_cheers`(`cheer_id`, `user_id`, `dream_id`, `created`) VALUES (15,2,5,'2016-03-01 00:00:00');
INSERT INTO `dr_cheers`(`cheer_id`, `user_id`, `dream_id`, `created`) VALUES (16,2,6,'2017-07-01 00:00:00');

INSERT INTO `dr_histories`(`history_id`, `user_id`, `dream_id`, `created`) VALUES (1,1,1,'2017-07-01 00:00:00');
INSERT INTO `dr_histories`(`history_id`, `user_id`, `dream_id`, `created`) VALUES (2,2,2,'2017-07-02 00:00:00');
INSERT INTO `dr_histories`(`history_id`, `user_id`, `dream_id`, `created`) VALUES (3,2,3,'2017-07-01 00:00:01');
INSERT INTO `dr_histories`(`history_id`, `user_id`, `dream_id`, `created`) VALUES (4,3,4,'2017-07-02 00:00:01');
INSERT INTO `dr_histories`(`history_id`, `user_id`, `dream_id`, `created`) VALUES (5,1,5,'2017-07-01 00:00:02');
INSERT INTO `dr_histories`(`history_id`, `user_id`, `dream_id`, `created`) VALUES (6,2,6,'2017-08-02 00:00:02');
INSERT INTO `dr_histories`(`history_id`, `user_id`, `dream_id`, `created`) VALUES (7,3,7,'2017-08-03 00:00:03');
INSERT INTO `dr_histories`(`history_id`, `user_id`, `dream_id`, `created`) VALUES (8,1,8,'2017-08-4 00:00:01');
INSERT INTO `dr_histories`(`history_id`, `user_id`, `dream_id`, `created`) VALUES (9,1,9,'2017-08-02 00:00:03');
INSERT INTO `dr_histories`(`history_id`, `user_id`, `dream_id`, `created`) VALUES (10,2,10,'2017-08-03 00:00:04');
INSERT INTO `dr_histories`(`history_id`, `user_id`, `dream_id`, `created`) VALUES (11,3,11,'2017-08-4 00:00:02');
INSERT INTO `dr_histories`(`history_id`, `user_id`, `dream_id`, `created`) VALUES (12,2,12,'2017-08-02 00:00:04');
INSERT INTO `dr_histories`(`history_id`, `user_id`, `dream_id`, `created`) VALUES (13,1,13,'2017-08-03 00:00:05');
INSERT INTO `dr_histories`(`history_id`, `user_id`, `dream_id`, `created`) VALUES (14,2,14,'2017-08-4 00:00:03');
INSERT INTO `dr_histories`(`history_id`, `user_id`, `dream_id`, `created`) VALUES (15,1,15,'2017-08-02 00:00:05');
INSERT INTO `dr_histories`(`history_id`, `user_id`, `dream_id`, `created`) VALUES (16,2,16,'2017-08-03 00:00:06');
INSERT INTO `dr_histories`(`history_id`, `user_id`, `dream_id`, `created`) VALUES (17,3,17,'2017-08-4 00:00:04');
INSERT INTO `dr_histories`(`history_id`, `user_id`, `dream_id`, `created`) VALUES (18,1,18,'2017-08-02 00:00:06');
INSERT INTO `dr_histories`(`history_id`, `user_id`, `dream_id`, `created`) VALUES (19,3,19,'2017-08-03 00:00:07');
INSERT INTO `dr_histories`(`history_id`, `user_id`, `dream_id`, `created`) VALUES (20,2,20,'2017-08-4 00:00:05');


INSERT INTO `dr_evas` (`eva_id`, `step_id`, `way`, `time`, `yn`, `created`, `modified`) VALUES
(1, 1, 'time', 11, 'true', '2016-01-01 00:00:00', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
--
-- AUTO_INCREMENT for dumped tables
--