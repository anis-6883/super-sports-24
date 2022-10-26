DROP TABLE IF EXISTS app_contents;

CREATE TABLE `app_contents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `app_id` bigint(20) unsigned NOT NULL,
  `platform` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO app_contents VALUES('1','1','android','android_version_name','1.0.0','2021-07-03 21:46:20','2021-07-03 21:46:20');
INSERT INTO app_contents VALUES('2','1','android','android_version_code','1','2021-07-03 21:46:20','2021-07-03 21:46:20');
INSERT INTO app_contents VALUES('3','1','android','android_force_update','no','2021-07-03 21:46:20','2021-07-03 21:46:20');
INSERT INTO app_contents VALUES('4','1','android','android_app_url','https://supersports24.xyz/superfootball/privacy/index.html','2021-07-03 21:46:20','2021-07-03 21:46:20');
INSERT INTO app_contents VALUES('5','1','android','android_button_text','Update Now','2021-07-03 21:46:20','2021-07-03 21:46:20');
INSERT INTO app_contents VALUES('6','1','android','android_description','Update the app now for getting new amazing features into this app.
Updates Includes
1. Live Streaming in HD
2. Pointtable
3. NBA Sports','2021-07-03 21:46:20','2021-07-03 21:46:20');
INSERT INTO app_contents VALUES('7','1','android','android_privacy_policy','https://supersports24.xyz/','2021-07-04 13:04:49','2021-07-04 13:04:49');
INSERT INTO app_contents VALUES('8','1','android','android_app_share_link','https://supersports24.xyz/','2021-07-04 13:04:49','2021-07-04 13:04:49');
INSERT INTO app_contents VALUES('9','1','android','android_default_page','0','2021-07-04 13:04:49','2021-07-04 13:04:49');
INSERT INTO app_contents VALUES('10','1','android','android_app_publishing_control','on','2021-07-04 13:04:59','2021-07-05 19:00:34');
INSERT INTO app_contents VALUES('11','1','android','android_live_version_code','0','2021-07-04 13:04:59','2021-07-05 19:00:34');
INSERT INTO app_contents VALUES('12','1','android','android_click_control','2','2021-07-04 13:05:05','2021-07-25 11:56:04');
INSERT INTO app_contents VALUES('13','1','android','android_ads_type','google','2021-07-04 13:05:05','2021-07-25 11:56:04');
INSERT INTO app_contents VALUES('14','1','android','android_fb_ads_id','N/A','2021-07-04 13:05:21','2021-07-04 13:05:21');
INSERT INTO app_contents VALUES('15','1','android','android_banner_ads_code','N/A','2021-07-04 13:05:21','2021-07-04 13:05:21');
INSERT INTO app_contents VALUES('16','1','android','android_interstitial_ads_code','N/A','2021-07-04 13:05:21','2021-07-04 13:05:21');
INSERT INTO app_contents VALUES('17','1','android','android_native_ads_code','N/A','2021-07-04 13:05:21','2021-07-04 13:05:21');
INSERT INTO app_contents VALUES('18','1','android','android_gapp_id','433434','2021-07-04 13:05:28','2021-07-04 13:05:28');
INSERT INTO app_contents VALUES('19','1','android','android_gbanner_ads_code','43w423','2021-07-04 13:05:28','2021-07-04 13:05:28');
INSERT INTO app_contents VALUES('20','1','android','android_ginterstitial_ads_code','325532','2021-07-04 13:05:28','2021-07-04 13:05:28');
INSERT INTO app_contents VALUES('21','1','android','android_gnative_ads_code','5325','2021-07-04 13:05:28','2021-07-04 13:05:28');
INSERT INTO app_contents VALUES('22','1','android','android_startapp_app_id','N/A','2021-07-04 13:05:32','2021-07-04 13:05:32');
INSERT INTO app_contents VALUES('23','1','ios','ios_gapp_id','N/A','2021-07-04 13:06:01','2021-07-04 13:06:01');
INSERT INTO app_contents VALUES('24','1','ios','ios_gbanner_ads_code','N/A','2021-07-04 13:06:01','2021-07-04 13:06:01');
INSERT INTO app_contents VALUES('25','1','ios','ios_ginterstitial_ads_code','N/A','2021-07-04 13:06:01','2021-07-04 13:06:01');
INSERT INTO app_contents VALUES('26','1','ios','ios_gnative_ads_code','N/A','2021-07-04 13:06:01','2021-07-04 13:06:01');
INSERT INTO app_contents VALUES('27','1','ios','ios_fb_ads_id','43434','2021-07-04 13:06:02','2021-07-04 13:06:23');
INSERT INTO app_contents VALUES('28','1','ios','ios_banner_ads_code','3434','2021-07-04 13:06:02','2021-07-04 13:06:23');
INSERT INTO app_contents VALUES('29','1','ios','ios_interstitial_ads_code','3434','2021-07-04 13:06:02','2021-07-04 13:06:23');
INSERT INTO app_contents VALUES('30','1','ios','ios_native_ads_code','4334','2021-07-04 13:06:02','2021-07-04 13:06:23');
INSERT INTO app_contents VALUES('31','1','ios','ios_startapp_app_id','N/A','2021-07-04 13:06:06','2021-07-04 13:06:06');
INSERT INTO app_contents VALUES('32','1','ios','ios_version_name','1.0.0','2021-07-04 13:06:18','2021-07-04 13:06:18');
INSERT INTO app_contents VALUES('33','1','ios','ios_version_code','1','2021-07-04 13:06:18','2021-07-04 13:06:18');
INSERT INTO app_contents VALUES('34','1','ios','ios_force_update','no','2021-07-04 13:06:18','2021-07-04 13:06:18');
INSERT INTO app_contents VALUES('35','1','ios','ios_app_url','https://supersports24.xyz/','2021-07-04 13:06:18','2021-07-04 13:06:18');
INSERT INTO app_contents VALUES('36','1','ios','ios_button_text','D','2021-07-04 13:06:18','2021-07-04 13:06:18');
INSERT INTO app_contents VALUES('37','1','ios','ios_description','d','2021-07-04 13:06:18','2021-07-04 13:06:18');
INSERT INTO app_contents VALUES('38','1','ios','ios_click_control','off','2021-07-04 13:06:27','2021-07-04 13:06:27');
INSERT INTO app_contents VALUES('39','1','ios','ios_ads_type','facebook','2021-07-04 13:06:27','2021-07-04 13:06:27');
INSERT INTO app_contents VALUES('40','1','ios','ios_app_publishing_control','on','2021-07-04 13:06:34','2021-07-04 13:06:34');
INSERT INTO app_contents VALUES('41','1','ios','ios_live_version_code','1','2021-07-04 13:06:34','2021-07-04 13:06:34');
INSERT INTO app_contents VALUES('42','1','ios','ios_privacy_policy','https://supersports24.xyz/','2021-07-04 13:06:43','2021-07-04 13:06:43');
INSERT INTO app_contents VALUES('43','1','ios','ios_app_share_link','https://supersports24.xyz/','2021-07-04 13:06:43','2021-07-04 13:06:43');
INSERT INTO app_contents VALUES('44','1','ios','ios_app_rating_link','https://supersports24.xyz/','2021-07-04 13:06:43','2021-07-04 13:06:43');
INSERT INTO app_contents VALUES('45','1','ios','ios_default_page','0','2021-07-04 13:06:43','2021-07-04 13:06:43');



DROP TABLE IF EXISTS apps;

CREATE TABLE `apps` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `app_unique_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `app_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `app_logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default/app.png',
  `notification_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `onesignal_app_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `onesignal_api_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firebase_server_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firebase_topics` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO apps VALUES('1','1625326194_276110498','Super Sports','public/uploads/images/1625326302.jpeg','onesignal','n/a','n/a','','','1','2021-07-03 21:31:42','2021-07-03 21:31:42');
INSERT INTO apps VALUES('2','1625339789_631565352','Cric Live','public/uploads/images/1625339830.png','onesignal','N/A','N/A','','','1','2021-07-04 01:17:10','2021-07-04 01:17:10');
INSERT INTO apps VALUES('4','1627210945_889775124','CricBomb','public/uploads/images/1627211021.png','onesignal','N/A','N/A','','','1','2021-07-25 17:03:41','2021-07-25 17:03:41');



DROP TABLE IF EXISTS failed_jobs;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS live_match_apps;

CREATE TABLE `live_match_apps` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `app_id` bigint(20) unsigned NOT NULL,
  `match_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=338 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO live_match_apps VALUES('55','1','2','2021-07-07 20:01:22','2021-07-07 20:01:22');
INSERT INTO live_match_apps VALUES('56','2','2','2021-07-07 20:01:22','2021-07-07 20:01:22');
INSERT INTO live_match_apps VALUES('95','1','3','2021-07-09 19:41:58','2021-07-09 19:41:58');
INSERT INTO live_match_apps VALUES('96','2','3','2021-07-09 19:41:58','2021-07-09 19:41:58');
INSERT INTO live_match_apps VALUES('164','1','1','2021-07-11 05:09:05','2021-07-11 05:09:05');
INSERT INTO live_match_apps VALUES('165','2','1','2021-07-11 05:09:05','2021-07-11 05:09:05');
INSERT INTO live_match_apps VALUES('264','1','4','2021-07-12 08:16:20','2021-07-12 08:16:20');
INSERT INTO live_match_apps VALUES('265','2','4','2021-07-12 08:16:20','2021-07-12 08:16:20');
INSERT INTO live_match_apps VALUES('266','1','5','2021-07-12 08:44:33','2021-07-12 08:44:33');
INSERT INTO live_match_apps VALUES('267','2','5','2021-07-12 08:44:33','2021-07-12 08:44:33');
INSERT INTO live_match_apps VALUES('270','1','6','2021-07-12 16:47:26','2021-07-12 16:47:26');
INSERT INTO live_match_apps VALUES('271','2','6','2021-07-12 16:47:26','2021-07-12 16:47:26');
INSERT INTO live_match_apps VALUES('282','1','7','2021-07-12 21:24:35','2021-07-12 21:24:35');
INSERT INTO live_match_apps VALUES('283','2','7','2021-07-12 21:24:35','2021-07-12 21:24:35');
INSERT INTO live_match_apps VALUES('314','1','10','2021-07-15 13:00:09','2021-07-15 13:00:09');
INSERT INTO live_match_apps VALUES('315','2','10','2021-07-15 13:00:09','2021-07-15 13:00:09');
INSERT INTO live_match_apps VALUES('332','1','9','2021-07-16 06:28:14','2021-07-16 06:28:14');
INSERT INTO live_match_apps VALUES('333','2','9','2021-07-16 06:28:14','2021-07-16 06:28:14');
INSERT INTO live_match_apps VALUES('336','1','8','2021-07-16 06:38:14','2021-07-16 06:38:14');
INSERT INTO live_match_apps VALUES('337','2','8','2021-07-16 06:38:14','2021-07-16 06:38:14');



DROP TABLE IF EXISTS live_matches;

CREATE TABLE `live_matches` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sports_type_id` bigint(20) unsigned NOT NULL,
  `match_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_one_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_one_image_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_one_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_one_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_two_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_two_image_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_two_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_two_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO live_matches VALUES('8','1','Football Live Sports','T-A','none','','','T-B','none','','','1','2021-07-12 18:14:12','2021-07-12 18:14:12');
INSERT INTO live_matches VALUES('9','1','Foot ball Live','Pro-1','none','','','Pro-2','none','','','1','2021-07-13 11:30:39','2021-07-13 11:30:39');
INSERT INTO live_matches VALUES('10','2','TEST LINK','TA','none','','','TB','none','','','1','2021-07-15 12:34:09','2021-07-15 12:55:39');



DROP TABLE IF EXISTS migrations;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO migrations VALUES('1','2014_10_12_000000_create_users_table','1');
INSERT INTO migrations VALUES('2','2014_10_12_100000_create_password_resets_table','1');
INSERT INTO migrations VALUES('3','2019_08_19_000000_create_failed_jobs_table','1');
INSERT INTO migrations VALUES('4','2021_01_24_153445_create_settings_table','1');
INSERT INTO migrations VALUES('5','2021_04_01_041745_create_live_matches_table','1');
INSERT INTO migrations VALUES('6','2021_04_01_070033_create_notifications_table','1');
INSERT INTO migrations VALUES('7','2021_05_13_424210_create_apps_table','1');
INSERT INTO migrations VALUES('8','2021_06_26_174736_create_app_contents_table','1');
INSERT INTO migrations VALUES('9','2021_06_27_113413_create_sports_types_table','1');
INSERT INTO migrations VALUES('10','2021_06_27_142641_create_live_match_apps_table','1');
INSERT INTO migrations VALUES('11','2021_06_28_113347_create_streaming_sources_table','1');
INSERT INTO migrations VALUES('12','2021_06_28_161744_create_promotions_table','1');
INSERT INTO migrations VALUES('13','2021_06_28_173002_create_popular_series_table','1');



DROP TABLE IF EXISTS notifications;

CREATE TABLE `notifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `apps` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notification_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS password_resets;

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS popular_series;

CREATE TABLE `popular_series` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `apps` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO popular_series VALUES('5','[\"2\"]','Pakistan tour of England','July 8 - July 20','https://www.cricketworld.com/cricket/series/pakistan-tour-of-england-2021/fixtures/119021','1','2021-07-09 04:00:07','2021-07-09 04:00:07');
INSERT INTO popular_series VALUES('6','[\"2\"]','Bangladesh tour of Zimbabwe','July 7 - July 27','https://www.cricketworld.com/cricket/series/bangladesh-tour-of-zimbabwe-2021/fixtures/120467','1','2021-07-09 04:00:38','2021-07-09 04:00:38');
INSERT INTO popular_series VALUES('7','[\"2\"]','India Women tour of England','June 16 - July 15','https://www.cricketworld.com/cricket/series/india-women-tour-of-england-2021/fixtures/120173','1','2021-07-09 04:01:12','2021-07-09 04:01:12');
INSERT INTO popular_series VALUES('8','[\"1\"]','UEFA European Championship','European League','https://www.espn.in/football/league/_/name/uefa.euro','1','2021-07-09 17:10:22','2021-07-09 17:10:22');



DROP TABLE IF EXISTS promotions;

CREATE TABLE `promotions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `apps` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO promotions VALUES('1','[\"1\",\"2\"]','Argentina - Ecuador','Copa America, Knockout stage, Quarterfinals','url','https://media.squawka.com/images/en/2021/07/07082556/1211685_1211685_Brazil-vs-Argentina-live-stream-predictions-team-news-Copa-America-Final.jpg','1','2021-07-04 02:03:12','2021-07-08 13:41:22');
INSERT INTO promotions VALUES('2','[\"1\",\"2\"]','Test','Test2222','url','https://i.ytimg.com/vi/PoAISqXEdtg/maxresdefault.jpg','1','2021-07-04 03:04:11','2021-07-08 13:41:13');
INSERT INTO promotions VALUES('3','[\"2\"]','Argentina vs Brazil','Final Match','url','https://i1.wp.com/bdexamresults.com/wp-content/uploads/2021/07/Brazil-vs-Argentina-Copa-America-Final-Match.jpg?fit=1440%2C810&quality=95&strip=all&ssl=1','1','2021-07-09 17:07:12','2021-07-09 17:07:12');



DROP TABLE IF EXISTS settings;

CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO settings VALUES('1','company_name','Root Stremer','2021-07-03 21:29:23','2021-07-03 21:29:23');
INSERT INTO settings VALUES('2','site_title','Super Sports','2021-07-03 21:29:23','2021-07-03 21:29:23');
INSERT INTO settings VALUES('3','timezone','Asia/Dhaka','2021-07-03 21:29:23','2021-07-03 21:29:23');
INSERT INTO settings VALUES('4','language','English','2021-07-03 21:29:23','2021-07-03 21:29:23');
INSERT INTO settings VALUES('5','android_version_code','1','2021-07-03 21:29:23','2021-07-03 21:29:23');
INSERT INTO settings VALUES('6','ios_version_code','1','2021-07-03 21:29:23','2021-07-03 21:29:23');
INSERT INTO settings VALUES('7','android_live_control','off','2021-07-03 21:29:23','2021-07-03 21:29:23');
INSERT INTO settings VALUES('8','ios_live_control','off','2021-07-03 21:29:23','2021-07-03 21:29:23');
INSERT INTO settings VALUES('9','privacy_policy','https://superfootball.com/','2021-07-03 21:29:23','2021-07-03 21:29:23');
INSERT INTO settings VALUES('10','facebook','https://www.facebook.com/','2021-07-03 21:29:23','2021-07-03 21:29:23');
INSERT INTO settings VALUES('11','youtube','http://youtube.com/','2021-07-03 21:29:23','2021-07-03 21:29:23');
INSERT INTO settings VALUES('12','instagram','https://instagram.com/','2021-07-03 21:29:23','2021-07-03 21:29:23');



DROP TABLE IF EXISTS sports_types;

CREATE TABLE `sports_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sports_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sports_skq` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO sports_types VALUES('1','Football','Football_9QhRGHqP','1','2021-07-05 19:07:28','2021-07-05 19:07:28');
INSERT INTO sports_types VALUES('2','Cricket','Cricket_puAneRqD','1','2021-07-05 19:07:37','2021-07-05 19:07:37');



DROP TABLE IF EXISTS streaming_sources;

CREATE TABLE `streaming_sources` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `match_id` bigint(20) unsigned NOT NULL,
  `stream_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stream_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resulation` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stream_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stream_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `block_country` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_block_them` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=338 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO streaming_sources VALUES('70','2','Otrs LOW','web','720p','https://y.wmsxx.com:30443/live/9/playlist.m3u8','','','India','1','2021-07-07 20:01:22','2021-07-07 20:01:22');
INSERT INTO streaming_sources VALUES('71','2','Own Server','root_stream','480p','http://203.95.220.98:8080/alwaysUpFromMazeda/video.m3u8','alwaysUpFromMazeda','','','0','2021-07-07 20:01:22','2021-07-07 20:01:22');
INSERT INTO streaming_sources VALUES('72','2','Local Server','root_stream','1080p','http://203.95.220.98:8080/localServerLive1/video.m3u8','localServerLive1','','','0','2021-07-07 20:01:22','2021-07-07 20:01:22');
INSERT INTO streaming_sources VALUES('117','3','HD','root_stream','480p','http://203.95.220.98:8080/alwaysUpFromMazeda/video.m3u8','alwaysUpFromMazeda','','','0','2021-07-09 19:41:58','2021-07-09 19:41:58');
INSERT INTO streaming_sources VALUES('118','3','Daddy Live','restricted','720p','https://39.pkcast123.me:999/hls/fTPcX1BhLK20190901.m3u8?','','','India','1','2021-07-09 19:41:58','2021-07-09 19:41:58');
INSERT INTO streaming_sources VALUES('119','3','Star Sports HD','restricted','720p','https://39.pkcast123.me:999/hls/sELghL3SBe20210415.m3u8','','','India','1','2021-07-09 19:41:58','2021-07-09 19:41:58');
INSERT INTO streaming_sources VALUES('236','1','HD','m3u8','360p','http://164.68.124.111/fs1.m3u8','','','India','1','2021-07-11 05:09:05','2021-07-11 05:09:05');
INSERT INTO streaming_sources VALUES('237','1','Sky Sports Cricket','m3u8','480p','http://stream.tvtap.live:8081/live/skysports-cricket1.stream/chunks.m3u8','','','India','1','2021-07-11 05:09:05','2021-07-11 05:09:05');
INSERT INTO streaming_sources VALUES('238','1','CricHD','restricted','1080p','https://39.pkcast123.me:999/hls/oO2yzEPpPg20201011.m3u8','','','India','1','2021-07-11 05:09:05','2021-07-11 05:09:05');
INSERT INTO streaming_sources VALUES('239','1','LIVE Link','m3u8','720p','https://e10.cdnfoxtv.me/ingestbr/espnbr/master.m3u8','','','India','1','2021-07-11 05:09:05','2021-07-11 05:09:05');
INSERT INTO streaming_sources VALUES('278','4','Rex Six','restricted','1080p','https://39.pkcast123.me:999/hls/oO2yzEPpPg20201011.m3u8','','{\"a\":\"a1\",\"b\":\"b1\",\"c\":\"c1\"}','British Indian Ocean Ter','1','2021-07-12 08:16:20','2021-07-12 08:16:20');
INSERT INTO streaming_sources VALUES('279','4','BAN vs ZIM','restricted','720p','https://39.pkcast123.me:999/hls/6k6bIiEf4320190929.m3u8','','[]','India','1','2021-07-12 08:16:20','2021-07-12 08:16:20');
INSERT INTO streaming_sources VALUES('280','4','Bongo Sony T-2','restricted','720p','https://live.bongobd.com/hls/cEzb_yh2xG3bxPvfP8gilw/1625925032/ten_sports_2.m3u8','','[]','Pakistan','1','2021-07-12 08:16:20','2021-07-12 08:16:20');
INSERT INTO streaming_sources VALUES('281','4','Bongo Sony 6','restricted','720p','https://live.bongobd.com/hls/93ujrSTe0T99lyX48YXYJQ/1625925429/sony_six.m3u8','','[]','Japan','1','2021-07-12 08:16:20','2021-07-12 08:16:20');
INSERT INTO streaming_sources VALUES('282','5','11','restricted','1080p','http://localhost/office/superfootball/live_matches/create','','{\"Content-Type\":\"application\\/json; charset=UTF-8\",\"Host\":\"1\",\"Accept\":\"*\\/*\",\"Origin\":\"1\",\"Referer\":\"1\",\"Accept-Encoding\":\"deflate, gzip\",\"Accept-Language\":\"en-US,en;q=0.9\",\"User-Agent\":\"Mozilla\\/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"Connection\":\"keep-alive\"}','','0','2021-07-12 08:44:33','2021-07-12 08:44:33');
INSERT INTO streaming_sources VALUES('284','6','Sony Six','restricted','720p','https://live.bongobd.com/hls/p5fwryhQXUOQwRHc-sHssg/1626088085/sony_six.m3u8','','{\"Accept-Encoding\":\"gzip, deflate, br\",\"Accept-Language\":\"en-US,en;q=0.9,bn;q=0.8\",\"Host\":\"live.bongobd.com\",\"Origin\":\"https:\\/\\/bongobd.com\",\"Referer\":\"https:\\/\\/bongobd.com\\/\",\"User-Agent\":\"Mozilla\\/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"Connection\":\"keep-alive\"}','Pakistan','1','2021-07-12 16:47:26','2021-07-12 16:47:26');
INSERT INTO streaming_sources VALUES('295','7','Link - 1','m3u8','720p','http://cdn2.niazitv.pk:8080/PTV_Sports_fun_tv/playlist.m3u8','','','India','1','2021-07-12 21:24:35','2021-07-12 21:24:35');
INSERT INTO streaming_sources VALUES('322','10','LINK PK','restricted','720p','https://e10.cdnfoxtv.me/ingestnb4s/espn_usa/f.m3u8','','{\"Referer\":\"https:\\/\\/freefeds.com\\/internal\\/110005.html\",\"Cache-Control\":\"no-cache\",\"Pragma\":\"no-cache\",\"Connection\":\"keep-alive\",\"User-Agent\":\"Mozilla\\/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/88.0.4324.192 Safari\\/537.36\"}','Pakistan','1','2021-07-15 13:00:09','2021-07-15 13:00:09');
INSERT INTO streaming_sources VALUES('330','9','SPORTS TV','restricted','720p','https://x.wmsxx.com:30443/live/49/chunks.m3u8','','{\"Referer\":\"https:\\/\\/www.eplayer.to\\/\",\"Cache-Control\":\"no-cache\",\"Pragma\":\"no-cache\",\"Connection\":\"keep-alive\",\"User-Agent\":\"Mozilla\\/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\"}','Pakistan','1','2021-07-16 06:28:14','2021-07-16 06:28:14');
INSERT INTO streaming_sources VALUES('334','8','Restricted','restricted','720p','https://live.bongobd.com/hls/T3lr3WyJeAKXVbczowMnaA/1626333482/sony_six.m3u8','','{\"Host\":\"live-jadoo-banani.bongobd.com\",\"Accept\":\"*\\/*\",\"Origin\":\"https:\\/\\/bongobd.com\",\"Referer\":\"https:\\/\\/bongobd.com\\/\",\"Accept-Encoding\":\"gzip, deflate, br\",\"Accept-Language\":\"en-US,en;q=0.9,bn;q=0.8\",\"User-Agent\":\"Mozilla\\/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/91.0.4472.114 Safari\\/537.36\",\"Connection\":\"keep-alive\"}','Pakistan','1','2021-07-16 06:38:14','2021-07-16 06:38:14');
INSERT INTO streaming_sources VALUES('335','8','Link - 2 (m3u8)','m3u8','720p','http://cdn2.niazitv.pk:8080/PTV_Sports_fun_tv/playlist.m3u8','','','Afghanistan','1','2021-07-16 06:38:14','2021-07-16 06:38:14');
INSERT INTO streaming_sources VALUES('336','8','Link-3 (m3u8)','m3u8','720p','http://77.83.117.60:8888/02_SPORTTV_1_720p/chunklist.m3u8','','','Pakistan','1','2021-07-16 06:38:14','2021-07-16 06:38:14');
INSERT INTO streaming_sources VALUES('337','8','test 2','m3u8','1080p','https://daddylive.me/channels/stream-31.php','','','','0','2021-07-16 06:38:14','2021-07-16 06:38:14');



DROP TABLE IF EXISTS users;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'profile.png',
  `status` int(11) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO users VALUES('1','Root','Stremer','rootstreamer@admin.com','admin','','$2y$10$gpGrO3y4Q7dq/GAuSMgaS.3FKG3ZbCd.LiP5q2T6mK6USzHUJiP5q','profile.png','1','','2021-07-03 21:28:53','2021-07-03 21:28:53');



