PRAGMA ENCODING="UTF-8";

CREATE TABLE users (
	id INTEGER PRIMARY KEY,
	username blob NOT NULL UNIQUE,
	name blob NOT NULL,
	pass blob NOT NULL,
	email blob NOT NULL,
	active boolean NOT NULL DEFAULT FALSE,
	admin boolean NOT NULL DEFAULT FALSE,
	banned boolean NOT NULL DEFAULT FALSE
);

CREATE TABLE licenses (
        id integer PRIMARY KEY,
        license_name blob NOT NULL,
        license_url varchar(255) NOT NULL
);

CREATE TABLE donations (
        id int unsigned PRIMARY KEY,
        donation_html blob NOT NULL,
        donation_url varchar(255) NOT NULL
);

CREATE TABLE channels (
	id INTEGER PRIMARY KEY,
	title blob NOT NULL UNIQUE,
	description text NOT NULL,
	modified NOT NULL DEFAULT CURRENT_TIMESTAMP,
	icon_url blob NOT NULL,
	website_url blob NOT NULL
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
	name blob NOT NULL,
	PRIMARY KEY (channel_id, name),
	FOREIGN KEY (channel_id) REFERENCES channels (id)
);

CREATE TABLE videos (
	id INTEGER PRIMARY KEY,
	title blob NOT NULL UNIQUE,
	description text,
	modified NOT NULL DEFAULT CURRENT_TIMESTAMP,
	icon_url blob,
	website_url blob,
	release_date datetime,
	runtime int, 
	adult boolean NOT NULL,
	mime blob NOT NULL,
	file_url blob NOT NULL,
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
	name blob NOT NULL,
	role blob NOT NULL,
	PRIMARY KEY (video_id, name, role),
	FOREIGN KEY (video_id) REFERENCES videos (id)
);

CREATE TABLE video_tags (
	video_id int NOT NULL,
	name blob NOT NULL,
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
