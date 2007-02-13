CREATE TABLE users (
	id INTEGER PRIMARY KEY,
	username varchar(32) UNIQUE NOT NULL,
	name varchar(255) NOT NULL,
	pass varchar(255) NOT NULL,
	email varchar(255) NOT NULL,
	active boolean NOT NULL,
	admin boolean NOT NULL,
	banned boolean NOT NULL
);


CREATE TABLE channels (
	id INTEGER PRIMARY KEY,
	title varchar(255) NOT NULL,
	description text,
	modified timestamp NOT NULL,
	icon_url varchar(255),
	donation_html varchar(255),
	donation_url varchar(255),
	website_url varchar(255), 
	license_name varchar(255),
	license_url varchar(255)
);

CREATE TABLE channel_tags (
	id int NOT NULL,
	name varchar(255),
	PRIMARY KEY (id, name),
	FOREIGN KEY (id) REFERENCES channels (id)
);

CREATE TABLE videos (
	id INTEGER PRIMARY KEY,
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
	runtime int, 
	adult boolean NOT NULL,
	mime varchar(255) NOT NULL,
	fileurl varchar(255) NOT NULL,
	size bigint,
	downloads int NOT NULL
);

CREATE TABLE video_credits (
	id int NOT NULL,
	name varchar(255) NOT NULL,
	role varchar(255) NOT NULL,
	PRIMARY KEY (id, name, role),
	FOREIGN KEY (id) REFERENCES videos (id)
);

CREATE TABLE video_tags (
	id int NOT NULL,
	name varchar(255) NOT NULL,
	PRIMARY KEY (id, name),
	FOREIGN KEY (id) REFERENCES videos (id)
);

CREATE TABLE published (
	channel_id int NOT NULL,
	video_id int NOT NULL,
	publish_date timestamp,
	PRIMARY KEY (channel_id, video_id),
	FOREIGN KEY (channel_id) REFERENCES channels (id)
);

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
);
