DROP TABLE IF EXISTS users;
CREATE TABLE users (
	id INTEGER PRIMARY KEY,
	username blob NOT NULL,
	name blob NOT NULL,
	pass blob NOT NULL,
	email blob NOT NULL,
	active boolean NOT NULL,
	admin boolean NOT NULL,
	banned boolean NOT NULL
);

DROP TABLE IF EXISTS channels;
CREATE TABLE channels (
	id INTEGER PRIMARY KEY,
	title blob NOT NULL,
	description text NOT NULL,
	modified timestamp NOT NULL,
	icon_url blob NOT NULL,
	donation_html blob,
	donation_url blob,
	website_url blob, 
	license_name blob,
	license_url blob
);

DROP TABLE IF EXISTS channel_tags;
CREATE TABLE channel_tags (
	id int NOT NULL,
	name blob NOT NULL,
	PRIMARY KEY (id, name),
	FOREIGN KEY (id) REFERENCES channels (id)
);

DROP TABLE IF EXISTS videos;
CREATE TABLE videos (
	id INTEGER PRIMARY KEY,
	title blob NOT NULL,
	description text,
	modified timestamp NOT NULL,
	icon_url blob,
	license_name blob,
	license_url blob,
	website_url blob,
	donation_html blob,
	donation_url blob,
	release_date datetime,
	runtime int, 
	adult boolean NOT NULL,
	mime blob NOT NULL,
	fileurl blob NOT NULL,
	size bigint,
	downloads int NOT NULL
);

DROP TABLE IF EXISTS video_credits;
CREATE TABLE video_credits (
	id int NOT NULL,
	name blob NOT NULL,
	role blob NOT NULL,
	PRIMARY KEY (id, name, role),
	FOREIGN KEY (id) REFERENCES videos (id)
);

DROP TABLE IF EXISTS video_tags;
CREATE TABLE video_tags (
	id int NOT NULL,
	name blob NOT NULL,
	PRIMARY KEY (id, name),
	FOREIGN KEY (id) REFERENCES videos (id)
);

DROP TABLE IF EXISTS published;
CREATE TABLE published (
	channel_id int NOT NULL,
	video_id int NOT NULL,
	publish_date timestamp,
	PRIMARY KEY (channel_id, video_id),
	FOREIGN KEY (channel_id) REFERENCES channels (id)
);

DROP TABLE IF EXISTS settings;
CREATE TABLE settings (
	name blob NOT NULL,
	description text,
	open_reg boolean NOT NULL,
	reg_approval boolean NOT NULL,
	bandwidth_limit bigint NOT NULL,
	baseurl blob UNIQUE NOT NULL,
	iconurl blob NOT NULL,
        donthideporn boolean NOT NULL,
	theme blob NOT NULL,
	donation_html blob NOT NULL,
	donation_url blob NOT NULL,
	PRIMARY KEY (baseurl)
);
