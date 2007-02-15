CREATE TABLE users (
	id int UNSIGNED NOT NULL AUTO_INCREMENT,
	username varchar(255) UNIQUE NOT NULL,
	name varchar(255) NOT NULL,
	pass varchar(255) NOT NULL,
	email varchar(255) NOT NULL,
	active boolean NOT NULL,
	admin boolean NOT NULL,
	banned boolean NOT NULL,
	PRIMARY KEY (id)
) ENGINE=InnoDB, CHARACTER SET utf8;


CREATE TABLE channels (
	id int unsigned NOT NULL AUTO_INCREMENT,
	title varchar(255) NOT NULL,
	description text,
	modified timestamp NOT NULL,
	icon_url varchar(255),
	donation_html varchar(255),
	donation_url varchar(255),
	website_url varchar(255), 
	license_name varchar(255),
	license_url varchar(255),
	PRIMARY KEY (id)
) ENGINE=InnoDB, CHARACTER SET utf8;

CREATE TABLE channel_tags (
	id int unsigned NOT NULL,
	name varchar(255),
	PRIMARY KEY (id, name),
	FOREIGN KEY (id) REFERENCES channels (id)
) ENGINE=InnoDB, CHARACTER SET utf8;

CREATE TABLE videos (
	id int unsigned NOT NULL AUTO_INCREMENT,
	title varchar(255) NOT NULL,
	description text,
	modified timestamp NOT NULL,
	icon_url varchar(255),
	license_name varchar(255),
	license_url varchar(255),
	website_url varchar(255),
	donation_html varchar(255),
	donation_url varchar(255),
	release_date datetime,
	runtime int unsigned, 
	adult boolean NOT NULL,
	mime varchar(255) NOT NULL,
	fileurl varchar(255) NOT NULL,
	size bigint,
	downloads int unsigned NOT NULL,
	PRIMARY KEY (id)
) ENGINE=InnoDB, CHARACTER SET utf8;

CREATE TABLE video_credits (
	id int unsigned NOT NULL,
	name varchar(128) NOT NULL,
	role varchar(128) NOT NULL,
	PRIMARY KEY (id, name, role),
	FOREIGN KEY (id) REFERENCES videos (id)
) ENGINE=InnoDB, CHARACTER SET utf8;

CREATE TABLE video_tags (
	id int unsigned NOT NULL,
	name varchar(255) NOT NULL,
	PRIMARY KEY (id, name),
	FOREIGN KEY (id) REFERENCES videos (id)
) ENGINE=InnoDB, CHARACTER SET utf8;

CREATE TABLE published (
	channel_id int unsigned NOT NULL,
	video_id int unsigned NOT NULL,
	publish_date timestamp,
	PRIMARY KEY (channel_id, video_id),
	FOREIGN KEY (channel_id) REFERENCES channels (id)
) ENGINE=InnoDB, CHARACTER SET utf8;

CREATE TABLE settings (
	name varchar(255) NOT NULL,
	description text,
	open_reg boolean NOT NULL,
	reg_approval boolean NOT NULL,
	bandwidth_limit bigint NOT NULL,
	baseurl varchar(255) UNIQUE NOT NULL,
	iconurl varchar(255),
	donation_html varchar(255),
	donation_url varchar(255),
	donthideporn boolean NOT NULL,
	PRIMARY KEY (baseurl)
) ENGINE=InnoDB, CHARACTER SET utf8;
