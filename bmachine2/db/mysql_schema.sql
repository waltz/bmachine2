CREATE TABLE IF NOT EXISTS users (
	id int UNSIGNED NOT NULL AUTO_INCREMENT,
	username blob NOT NULL,
	name blob NOT NULL,
	pass blob NOT NULL,
	email blob NOT NULL,
	active boolean NOT NULL,
	admin boolean NOT NULL,
	banned boolean NOT NULL,
	PRIMARY KEY (id),
	KEY (username(100))
) ENGINE=InnoDB, CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS licenses (
        id int unsigned NOT NULL AUTO_INCREMENT,
        license_name blob NOT NULL,
        license_url varchar(255) NOT NULL,
        PRIMARY KEY (id)
) ENGINE=InnoDB, CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS donations (
        id int unsigned NOT NULL AUTO_INCREMENT,
        donation_html blob NOT NULL,
        donation_url varchar(255) NOT NULL,
        PRIMARY KEY (id)
) ENGINE=InnoDB, CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS channels (
	id int unsigned NOT NULL AUTO_INCREMENT,
	title blob NOT NULL,
	description text NOT NULL,
	modified timestamp NOT NULL,
	icon_url varchar(255) NOT NULL,
	website_url varchar(255) NOT NULL, 
	PRIMARY KEY (id)
) ENGINE=InnoDB, CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS channel_licenses (
	channel_id int unsigned NOT NULL,
	license_id int unsigned NOT NULL,
	PRIMARY KEY (channel_id),
	FOREIGN KEY (channel_id) REFERENCES channels (id)
) ENGINE=InnoDB, CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS channel_donations (
	channel_id int unsigned NOT NULL,
	donation_id int unsigned NOT NULL,
	PRIMARY KEY (channel_id),
	FOREIGN KEY (channel_id) REFERENCES channels (id)
) ENGINE=INNODB, CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS channel_tags (
	id int unsigned NOT NULL,
	name blob NOT NULL,
	PRIMARY KEY (id, name(100)),
	FOREIGN KEY (id) REFERENCES channels (id)
) ENGINE=InnoDB, CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS videos (
	id int unsigned NOT NULL AUTO_INCREMENT,
	title blob NOT NULL,
	title_url varchar(255),
	description text,
	modified timestamp NOT NULL,
	icon_url varchar(255) NOT NULL,
	website_url varchar(255) NOT NULL,
	release_date datetime,
	runtime int unsigned, 
	adult boolean NOT NULL,
	mime blob NOT NULL,
	file_url varchar(255) NOT NULL,
	size bigint,
	downloads int unsigned NOT NULL,
	PRIMARY KEY (id)
) ENGINE=InnoDB, CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS video_donations (
	video_id int unsigned NOT NULL,
	donation_id int unsigned NOT NULL,
	PRIMARY KEY (video_id),
	FOREIGN KEY (video_id) REFERENCES videos (id)	
) ENGINE=InnoDB, CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS video_licenses (
        video_id int unsigned NOT NULL,
        license_id int unsigned NOT NULL,
        PRIMARY KEY (video_id),
        FOREIGN KEY (video_id) REFERENCES videos (id)
) ENGINE=InnoDB, CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS video_credits (
	id int unsigned NOT NULL,
	name blob NOT NULL,
	role blob NOT NULL,
	PRIMARY KEY (id, name(100), role(100)),
	FOREIGN KEY (id) REFERENCES videos (id)
) ENGINE=InnoDB, CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS video_tags (
	id int unsigned NOT NULL,
	name blob NOT NULL,
	PRIMARY KEY (id, name(100)),
	FOREIGN KEY (id) REFERENCES videos (id)
) ENGINE=InnoDB, CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS published (
	channel_id int unsigned NOT NULL,
	video_id int unsigned NOT NULL,
	publish_date timestamp,
	PRIMARY KEY (channel_id, video_id),
	FOREIGN KEY (channel_id) REFERENCES channels (id)
) ENGINE=InnoDB, CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS settings (
	name blob NOT NULL,
	description text,
	open_reg boolean NOT NULL,
	reg_approval boolean NOT NULL,
	bandwidth_limit bigint NOT NULL,
	baseurl varchar(255) UNIQUE NOT NULL,
	iconurl varchar(255) NOT NULL,
	donthideporn boolean NOT NULL,
	theme blob NOT NULL,
        donation_html blob NOT NULL,
        donation_url varchar(255) NOT NULL,
	PRIMARY KEY (baseurl)
) ENGINE=InnoDB, CHARACTER SET utf8;
