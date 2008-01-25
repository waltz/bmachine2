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
	"Treatment of multiple sclerosis",
	"The most common initial course of the disease is the relapsing-remitting subtype, which is characterized by unpredictable attacks (relapses) followed by periods of relative remission with no new signs of disease activity. After some years, many of the people who have this subtype begin to experience neurologic decline without acute relapses. When this happens it is called secondary progressive multiple sclerosis. Other, less common, courses of the disease are the primary progressive (decline from the beginning without attacks) and the progressive-relapsing (steady neurologic decline and superimposed attacks).",
	"http://vegworcester.com/bmm/bmachine2/themes/default/images/icons/1.jpg",
	"20061031",
	26,
	1,
	"binary/video",
	"http://getthevideos.com/id/76896",
	5478054789547895
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
	"Ronald Paul Bucca",
	"Bucca was a 22-year veteran of the department; he was promoted to Fire Marshall in 1992. He was on the 78th floor of the South Tower of the World Trade Center with Battalion Chief Orio Palmer when the building collapsed after the September 11, 2001 attacks.",
	"http://vegworcester.com/bmm/bmachine2/themes/default/images/icons/2.jpg",
	"20070103",
	9926,
	1,
	"binary/video",
	"http://getthevideos.com/id/7635356",
	5478054789547895
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
	"Morgan Carroll",
	"Morgan Carroll (born 1971 in Denver, Colorado) is an American politician from Colorado. A Democrat, she is a member of the Colorado House of Representatives, representing the state's 36th district.",
	"http://vegworcester.com/bmm/bmachine2/themes/default/images/icons/3.png",
	"20030411",
	926,
	1,
	"binary/video",
	"http://getthevideos.com/id/7635356",
	5478054789547895
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
	"Ronald Paul Bucca",
	"Bucca was a 22-year veteran of the department; he was promoted to Fire Marshall in 1992. He was on the 78th floor of the South Tower of the World Trade Center with Battalion Chief Orio Palmer when the building collapsed after the September 11, 2001 attacks.",
	"http://vegworcester.com/bmm/bmachine2/themes/default/images/icons/2.jpg",
	"20070103",
	9926,
	1,
	"binary/video",
	"http://getthevideos.com/id/7635356",
	5478054789547895
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
	"Watch out for trees",
	"Expose on trees with big branches.",
	"http://vegworcester.com/bmm/bmachine2/themes/default/images/icons/4.jpg",
	"20070103",
	9926,
	1,
	"binary/video",
	"http://getthevideos.com/id/7635356",
	5478054789547895
);













	
	
INSERT INTO video_credits (
	video_id,
	name,
	role
) VALUES (
	1,
	"Alex Dismore",
	"Director"
);

INSERT INTO video_credits (
	video_id,
	name,
	role
) VALUES (
	1,
	"Greg Opperman",
	"Executive Producer"
);
	
INSERT INTO video_tags (
	video_id,
	name
) VALUES (
	1,
	"noir"
);

INSERT INTO video_tags (
	video_id,
	name
) VALUES (
	1,
	"zombies"
);

INSERT INTO video_tags (
	video_id,
	name
) VALUES (
	14,
	"zombies"
);

INSERT INTO video_tags (
	video_id,
	name
) VALUES (
	14,
	"funny"
);

INSERT INTO video_tags (
	video_id,
	name
) VALUES (
	13,
	"news"
);

INSERT INTO video_tags (
	video_id,
	name
) VALUES (
	13,
	"USA"
);

INSERT INTO published (
	channel_id,
	video_id
) VALUES (
	1,
	1
);
