CREATE TABLE users (
	id INTEGER PRIMARY KEY,
	username varchar(32) UNIQUE,
	name varchar(128),
	pass varchar(255),
	email varchar(128),
	active tinyint(1),
	admin tinyint(1),
	banned tinyint(1)
);


CREATE TABLE channels (
	id INTEGER PRIMARY KEY,
	title varchar(128),
	description text,
	modified timestamp,
	icon binary,
	donation_html varchar(255),
	donation_url varchar(255),
	website_url varchar(255), 
	license_name varchar(255),
	license_url varchar(255)
);

CREATE TABLE channel_tags (
	id int NOT NULL,
	name varchar(32),
	FOREIGN KEY (id) REFERENCES channels (id)
);

CREATE TABLE videos (
	id INTEGER PRIMARY KEY,
	title varchar(128),
	description text,
	modified timestamp,
	icon binary,
	license_name varchar(128),
	license_url varchar(255),
	website_url varchar(255),
	donation_html varchar(255),
	donation_url varchar(255),
	release_date datetime,
	runtime int, 
	adult tinyint(1),
	mime varchar(32),
	fileurl varchar(255),
	size bigint,
	downloads int
);

CREATE TABLE video_credits (
	id int NOT NULL,
	name varchar(128),
	role varchar(128),
	FOREIGN KEY (id) REFERENCES videos (id)
);

CREATE TABLE video_tags (
	id int NOT NULL,
	name varchar(128),
	FOREIGN KEY (id) REFERENCES videos (id)
);

CREATE TABLE published (
	channel_id int,
	video_id int,
	publish_date timestamp,
	FOREIGN KEY (channel_id) REFERENCES channels (id)
);

CREATE TABLE settings (
	name varchar(128),
	description text,
	open_reg tinyint(1),
	reg_approval tinyint(1),
	bandwidth_limit bigint,
	baseurl varchar(128) UNIQUE,
	iconurl varchar(128),
	donation_html varchar(255),
	donation_url varchar(255),
	donthideporn tinyint(1)
);
