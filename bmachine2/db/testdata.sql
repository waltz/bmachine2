INSERT INTO channels (
	title, 
	description, 
	icon_url 
) VALUES (
	"First", 
	"Best channel ever!", 
	"http://upload.wikimedia.org/wikipedia/en/thumb/f/f8/Russian_icon_Instaplanet_Saint_Nicholas.JPG/300px-Russian_icon_Instaplanet_Saint_Nicholas.JPG"
);

INSERT INTO channels (
	title, 
	description, 
	icon_url 
) VALUES (
	"Second", 
	"Number 2!", 
	"http://upload.wikimedia.org/wikipedia/en/thumb/f/f8/Russian_icon_Instaplanet_Saint_Nicholas.JPG/300px-Russian_icon_Instaplanet_Saint_Nicholas.JPG"
);

INSERT INTO channels (
	title, 
	description, 
	icon_url 
) VALUES (
	"Third", 
	"what what!", 
	"http://upload.wikimedia.org/wikipedia/en/thumb/f/f8/Russian_icon_Instaplanet_Saint_Nicholas.JPG/300px-Russian_icon_Instaplanet_Saint_Nicholas.JPG"
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
	"Screen is Black",
	"This is the first video. The plot of this video is a noir movie in which a hard boiled detective falls for a damsel in distress...but not everything is as it seems. The damsel turns out to be a femme fatale, leading the detective into the seedy underbelly of necronomica. The action soon turns to zombie evasion as our hero struggles for survival.",
	"http://127.0.0.1/vegworcestercss/bm/thumbnails/7896fd19809694632effe6aefbf94b0b.jpg",
	"20061031",
	2476,
	1,
	"binary/video",
	"http://download.com",
	5478054789547895
);
	
	
INSERT INTO video_credits (
	id,
	name,
	role
) VALUES (
	1,
	"Alex Dismore",
	"Director"
);

INSERT INTO video_credits (
	id,
	name,
	role
) VALUES (
	1,
	"Greg Opperman",
	"Executive Producer"
);
	
INSERT INTO video_tags (
	id,
	name
) VALUES (
	1,
	"noir"
);

INSERT INTO video_tags (
	id,
	name
) VALUES (
	1,
	"zombies"
);

INSERT INTO published (
	channel_id,
	video_id
) VALUES (
	1,
	1
);
