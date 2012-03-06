-- First make the database structure

CREATE TABLE IF NOT EXISTS `channels` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `title` blob NOT NULL,
  `description` text NOT NULL,
  `modified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `icon_url` varchar(255) NOT NULL,
  `website_url` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `title` (`title`(100))
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `channel_donations`
--

CREATE TABLE IF NOT EXISTS `channel_donations` (
  `channel_id` int(10) unsigned NOT NULL,
  `donation_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`channel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `channel_licenses`
--

CREATE TABLE IF NOT EXISTS `channel_licenses` (
  `channel_id` int(10) unsigned NOT NULL,
  `license_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`channel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `channel_tags`
--

CREATE TABLE IF NOT EXISTS `channel_tags` (
  `channel_id` int(10) unsigned NOT NULL,
  `name` blob NOT NULL,
  PRIMARY KEY  (`channel_id`,`name`(100))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE IF NOT EXISTS `donations` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `donation_html` blob NOT NULL,
  `donation_url` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `licenses`
--

CREATE TABLE IF NOT EXISTS `licenses` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `license_name` blob NOT NULL,
  `license_url` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `published`
--

CREATE TABLE IF NOT EXISTS `published` (
  `channel_id` int(10) unsigned NOT NULL,
  `video_id` int(10) unsigned NOT NULL,
  `publish_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`channel_id`,`video_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `name` blob NOT NULL,
  `description` text,
  `open_reg` tinyint(1) NOT NULL,
  `reg_approval` tinyint(1) NOT NULL,
  `bandwidth_limit` bigint(20) NOT NULL,
  `base_url` varchar(255) NOT NULL,
  `icon_url` varchar(255) NOT NULL,
  `donthideporn` tinyint(1) NOT NULL,
  `theme` blob NOT NULL,
  `donation_html` blob NOT NULL,
  `donation_url` varchar(255) NOT NULL,
  PRIMARY KEY  (`base_url`),
  UNIQUE KEY `base_url` (`base_url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `username` blob NOT NULL,
  `name` blob NOT NULL,
  `pass` blob NOT NULL,
  `email` blob NOT NULL,
  `active` tinyint(1) NOT NULL default '0',
  `admin` tinyint(1) NOT NULL default '0',
  `banned` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`(100))
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE IF NOT EXISTS `videos` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `title` blob NOT NULL,
  `description` text,
  `modified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `icon_url` varchar(255) NOT NULL,
  `website_url` varchar(255) NOT NULL,
  `release_date` datetime default NULL,
  `runtime` int(10) unsigned default NULL,
  `adult` tinyint(1) NOT NULL,
  `mime` blob NOT NULL,
  `file_url` varchar(255) NOT NULL,
  `size` bigint(20) default NULL,
  `downloads` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `title` (`title`(100))
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `video_credits`
--

CREATE TABLE IF NOT EXISTS `video_credits` (
  `video_id` int(10) unsigned NOT NULL,
  `name` blob NOT NULL,
  `role` blob NOT NULL,
  PRIMARY KEY  (`video_id`,`name`(100),`role`(100))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `video_donations`
--

CREATE TABLE IF NOT EXISTS `video_donations` (
  `video_id` int(10) unsigned NOT NULL,
  `donation_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`video_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `video_licenses`
--

CREATE TABLE IF NOT EXISTS `video_licenses` (
  `video_id` int(10) unsigned NOT NULL,
  `license_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`video_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `video_tags`
--

CREATE TABLE IF NOT EXISTS `video_tags` (
  `video_id` int(10) unsigned NOT NULL,
  `name` blob NOT NULL,
  PRIMARY KEY  (`video_id`,`name`(100))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `channel_donations`
--
ALTER TABLE `channel_donations`
  ADD CONSTRAINT `channel_donations_ibfk_1` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`);

--
-- Constraints for table `channel_licenses`
--
ALTER TABLE `channel_licenses`
  ADD CONSTRAINT `channel_licenses_ibfk_1` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`);

--
-- Constraints for table `channel_tags`
--
ALTER TABLE `channel_tags`
  ADD CONSTRAINT `channel_tags_ibfk_1` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`);

--
-- Constraints for table `published`
--
ALTER TABLE `published`
  ADD CONSTRAINT `published_ibfk_1` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`);

--
-- Constraints for table `video_credits`
--
ALTER TABLE `video_credits`
  ADD CONSTRAINT `video_credits_ibfk_1` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`);

--
-- Constraints for table `video_donations`
--
ALTER TABLE `video_donations`
  ADD CONSTRAINT `video_donations_ibfk_1` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`);

--
-- Constraints for table `video_licenses`
--
ALTER TABLE `video_licenses`
  ADD CONSTRAINT `video_licenses_ibfk_1` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`);

--
-- Constraints for table `video_tags`
--
ALTER TABLE `video_tags`
  ADD CONSTRAINT `video_tags_ibfk_1` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`);




-- Second, create a test channel

INSERT INTO channels (
	title, 
	description,
	icon_url,
	website_url
) VALUES (
	"Rocketboom",
	"Rocket boom is a daily internet TV show.",
	"http://vegworcester.com/bmm/images/rocketboom.gif",
	"http://rocketboom.com"
);

-- Give the channel some tags

INSERT INTO channel_tags (
	channel_id,
	name
) VALUES (
	2,
	"funny"
);

INSERT INTO channel_tags (
	channel_id,
	name
) VALUES (
	2,
	"news"
);

-- Create some test videos for the test channel

INSERT INTO videos (
	title, 
	description,
	icon_url,
	release_date,
	runtime,
	adult,
	mime,
	file_url,
	size
) VALUES (
	"Know Your Meme : Corys Sunglasses",
	"Rocketboom episode Tuesday Feb 5, 2008",
	"http://vegworcester.com/bmm/images/Tuesday-Feb-5-2008-Know-Your-Meme-Corys-Sunglasses.png",
	"20080205",
	926,
	1,
	"binary/video",
	"http://blip.tv/file/get/rb_08_feb_06.MP4",
	99999
);

INSERT INTO videos (
	title, 
	description,
	icon_url,
	release_date,
	runtime,
	adult,
	mime,
	file_url,
	size
) VALUES (
	"Pi Episide",
	"Rocketboom episode Tuesday Feb 1, 2008",
	"http://vegworcester.com/bmm/images/Rocketboom-rb_08_feb_01624-28.jpg",
	"20080201",
	926,
	1,
	"binary/video",
	"http://blip.tv/file/get/rb_08_feb_01.MP4",
	99999
);

INSERT INTO videos (
	title, 
	description,
	icon_url,
	release_date,
	runtime,
	adult,
	mime,
	file_url,
	size
) VALUES (
	"The Lost Sock",
	"Rocketboom episode Tuesday Jan 25, 2008",
	"http://vegworcester.com/bmm/images/Rocketboom-rb_08_jan_25172-375.jpg",
	"20080125",
	926,
	1,
	"binary/video",
	"http://blip.tv/file/get/rb_08_jan_25_hd.m4v",
	99999
);

INSERT INTO videos (
	title, 
	description,
	icon_url,
	release_date,
	runtime,
	adult,
	mime,
	file_url,
	size
) VALUES (
	"The Next Episode",
	"Rocketboom episode Tuesday Jan 30, 2008",
	"http://vegworcester.com/bmm/images/Rocketboom-rb_08_jan_30930-577.jpg",
	"20080130",
	926,
	1,
	"binary/video",
	"http://blip.tv/file/get/rb_08_jan_30_hd.m4v",
	99999
);


INSERT INTO videos (
	title, 
	description,
	icon_url,
	release_date,
	runtime,
	adult,
	mime,
	file_url,
	size
) VALUES (
	"Kenya Post-Election Market Stress",
	"Rocketboom episode Tuesday Jan 16, 2008",
	"http://vegworcester.com/bmm/images/Rocketboom-rb_08_jan_16b704-335.jpg",
	"20080116",
	926,
	1,
	"binary/video",
	"http://blip.tv/file/get/rb_08_jan_16b_hd.m4v",
	99999
);

-- Publish these videos in the channel

INSERT INTO published (
	channel_id,
	video_id
) VALUES (
	2,
	1
);

INSERT INTO published (
	channel_id,
	video_id
) VALUES (
	2,
	2
);

INSERT INTO published (
	channel_id,
	video_id
) VALUES (
	2,
	3
);

INSERT INTO published (
	channel_id,
	video_id
) VALUES (
	2,
	4
);

INSERT INTO published (
	channel_id,
	video_id
) VALUES (
	2,
	5
);

-- Create some video tags

INSERT INTO video_tags (
video_id,
name
)
VALUES (
'1', 'funny'
), (
'1', 'news'
), (
'1', 'old'
), (
'1', 'opensource'
), (
'1', 'math'
), (
'2', 'funny'
), (
'2', 'british'
), (
'2', 'silly'
), (
'2', 'weird'
), (
'2', 'omg'
), (
'3', 'news'
), (
'3', 'funny'
), (
'3', 'german'
), (
'3', 'religious'
), (
'4', 'news'
), (
'5', 'indy'
), (
'5', 'musical'
), (
'5', 'funny'
);

-- Create some video credits for the first video
	
INSERT INTO video_credits (
	video_id,
	name,
	role
) VALUES (
	1,
	"Alex Dismore",
	"Director"
);

INSERT INTO video_credits (
	video_id,
	name,
	role
) VALUES (
	1,
	"Greg Opperman",
	"Executive Producer"
);
