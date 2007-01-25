CREATE TABLE users (
	id int NOT NULL AUTO_INCREMENT,
	username varchar(32) UNIQUE,
	pass varchar(255),
	email varchar(128),
	active tinyint(1),
	admin tinyint(1),
	banned tinyint(1),
	PRIMARY KEY (id)
);


CREATE TABLE channels (
	id int NOT NULL AUTO_INCREMENT,
	title varchar(64),
	description text,
	modified timestamp,
	icon binary,
	donation_html varchar(255),
	donation_url varchar(255),
	website_url varchar(255), 
	license_name varchar(255),
	license_url varchar(255),
	PRIMARY KEY (id)
);

CREATE TABLE channel_tags (
	id int NOT NULL,
	name varchar(32),
	FOREIGN KEY (id) REFERENCES channels (id)
);

CREATE TABLE videos (
	id int NOT NULL AUTO_INCREMENT,
	title varchar(128),
	description text,
	modified timestamp,
	icon binary,
	transcript text,
	license_name varchar(64),
	license_url varchar(255)
	website_url varchar(128),
	donation_url varchar(128),
	release_date datetime,
	length int, 
	adult tinyint(1),
	mime varchar(32),
	fileurl varchar(255),
	size bigint,
	downloads int,
	PRIMARY KEY (id)
);

CREATE TABLE video_credits (
	id int NOT NULL,
	name varchar(128),
	FOREIGN KEY (id) REFERENCES channels (id)
);

CREATE TABLE video_tags (
	id int NOT NULL,
	name varchar(128),
	FOREIGN KEY (id) REFERENCES videos (id)
);

CREATE TABLE published (
	id channel_id int,
	id video_id int,
	publish_date timestamp,
	FOREIGN KEY (channel_id) REFERENCES channels (id),
	FOREIGN KEY (video_id) REFERENCES videos (id)
);

CREATE TABLE settings (
	name varchar(128),
	description text,
	open_reg tinyint(1),
	reg_approval tinyint(1),
	bandwidth_limit bigint,
	baseurl varchar(128),
	iconurl varchar(128),
	donation_html varchar(255),
	donation_url varchar(255),
);