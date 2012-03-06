CREATE TABLE users (
	id INTEGER PRIMARY KEY,
	username varchar(255) NOT NULL UNIQUE,
	name varchar(255) NOT NULL,
	pass varchar(255) NOT NULL,
	email varchar(255) NOT NULL,
	active boolean NOT NULL DEFAULT FALSE,
	admin boolean NOT NULL DEFAULT FALSE,
	banned boolean NOT NULL DEFAULT FALSE
);

CREATE TABLE licenses (
        id integer PRIMARY KEY,
        license_name varchar(255) NOT NULL,
        license_url varchar(255) NOT NULL
);

CREATE TABLE donations (
        id int unsigned PRIMARY KEY,
        donation_html varchar(255) NOT NULL,
        donation_url varchar(255) NOT NULL
);

CREATE TABLE channels (
	id INTEGER PRIMARY KEY,
	title varchar(255) NOT NULL UNIQUE,
	description text NOT NULL,
	modified NOT NULL DEFAULT CURRENT_TIMESTAMP,
	icon_url varchar(255) NOT NULL,
	website_url varchar(255) NOT NULL
);

CREATE TABLE channel_donations (
        channel_id int unsigned NOT NULL,
        donation_id int unsigned NOT NULL,
        PRIMARY KEY (channel_id)
);

CREATE TABLE channel_licenses (
	channel_id int unsigned NOT NULL,
        license_id int unsigned NOT NULL,
        PRIMARY KEY (channel_id)
);

CREATE TABLE channel_tags (
	channel_id int NOT NULL,
	name varchar(255) NOT NULL,
	PRIMARY KEY (channel_id, name),
	FOREIGN KEY (channel_id) REFERENCES channels (id)
);

CREATE TABLE videos (
	id INTEGER PRIMARY KEY,
	title varchar(255) NOT NULL UNIQUE,
	description text,
	modified NOT NULL DEFAULT CURRENT_TIMESTAMP,
	icon_url varchar(255),
	website_url varchar(255),
	release_date datetime,
	runtime int, 
	adult boolean NOT NULL,
	mime varchar(255) NOT NULL,
	file_url varchar(255) NOT NULL,
	size bigint,
	downloads int NOT NULL DEFAULT '0'
);

CREATE TABLE video_donations (
        video_id int unsigned NOT NULL,
        donation_id int unsigned NOT NULL,
        PRIMARY KEY (video_id)
);

CREATE TABLE video_licenses (
        video_id int unsigned NOT NULL,
        license_id int unsigned NOT NULL,
        PRIMARY KEY (video_id)
);

CREATE TABLE video_credits (
	video_id int NOT NULL,
	name varchar(255) NOT NULL,
	role varchar(255) NOT NULL,
	PRIMARY KEY (video_id, name, role),
	FOREIGN KEY (video_id) REFERENCES videos (id)
);

CREATE TABLE video_tags (
	video_id int NOT NULL,
	name varchar(255) NOT NULL,
	PRIMARY KEY (video_id, name),
	FOREIGN KEY (video_id) REFERENCES videos (id)
);

CREATE TABLE published (
	channel_id int NOT NULL,
	video_id int NOT NULL,
	publish_date NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (channel_id, video_id),
	FOREIGN KEY (channel_id) REFERENCES channels (id)
);

CREATE TABLE settings (
	name varchar(255) NOT NULL,
	description text,
	open_reg boolean NOT NULL,
	reg_approval boolean NOT NULL,
	bandwidth_limit bigint NOT NULL,
	base_url varchar(255) UNIQUE NOT NULL,
	icon_url varchar(255) NOT NULL,
        donthideporn boolean NOT NULL,
	theme varchar(255) NOT NULL,
	donation_html varchar(255) NOT NULL,
	donation_url varchar(255) NOT NULL,
	PRIMARY KEY (base_url)
);
