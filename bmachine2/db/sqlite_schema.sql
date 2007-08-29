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
	modified timestamp NOT NULL,
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
	id int NOT NULL,
	name blob NOT NULL,
	PRIMARY KEY (id, name),
	FOREIGN KEY (id) REFERENCES channels (id)
);

CREATE TABLE videos (
	id INTEGER PRIMARY KEY,
	title blob NOT NULL UNIQUE,
	title_url varchar(255),
	description text,
	modified timestamp NOT NULL,
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
	id int NOT NULL,
	name blob NOT NULL,
	role blob NOT NULL,
	PRIMARY KEY (id, name, role),
	FOREIGN KEY (id) REFERENCES videos (id)
);

CREATE TABLE video_tags (
	id int NOT NULL,
	name blob NOT NULL,
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
	name blob NOT NULL,
	description text,
	open_reg boolean NOT NULL,
	reg_approval boolean NOT NULL,
	bandwidth_limit bigint NOT NULL,
	base_url blob UNIQUE NOT NULL,
	icon_url blob NOT NULL,
        donthideporn boolean NOT NULL,
	theme blob NOT NULL,
	donation_html blob NOT NULL,
	donation_url blob NOT NULL,
	PRIMARY KEY (base_url)
);
