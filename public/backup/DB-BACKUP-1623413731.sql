DROP TABLE IF EXISTS block_countries;

CREATE TABLE `block_countries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `live_match_id` int(11) NOT NULL,
  `country_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO block_countries VALUES('1','1','null','2021-06-06 19:24:53','2021-06-06 19:24:53');
INSERT INTO block_countries VALUES('3','2','null','2021-06-07 02:54:41','2021-06-07 02:54:41');
INSERT INTO block_countries VALUES('35','3','uk,de','2021-06-08 02:46:38','2021-06-08 02:46:38');
INSERT INTO block_countries VALUES('39','4','[\"Bahamas\",\"Bangladesh\",\"Barbados\"]','2021-06-08 13:41:38','2021-06-08 13:41:38');
INSERT INTO block_countries VALUES('42','6','[\"Bangladesh\",\"India\"]','2021-06-08 13:48:27','2021-06-08 13:48:27');
INSERT INTO block_countries VALUES('45','5','[\"Afghanistan\",\"Algeria\",\"Andorra\",\"Pakistan\"]','2021-06-08 13:51:38','2021-06-08 13:51:38');
INSERT INTO block_countries VALUES('49','7','[\"Bangladesh\",\"Hungary\",\"India\",\"Indonesia\",\"Ireland\",\"Italy\",\"Pakistan\",\"Sri Lanka\",\"United Kingdom\"]','2021-06-09 00:43:20','2021-06-09 00:43:20');
INSERT INTO block_countries VALUES('51','8','[\"Albania\",\"Bangladesh\",\"Czech Republic\",\"India\",\"Indonesia\",\"Pakistan\",\"South Africa\"]','2021-06-09 00:45:58','2021-06-09 00:45:58');
INSERT INTO block_countries VALUES('55','9','[\"Bangladesh\",\"India\",\"Indonesia\",\"Italy\",\"Lithuania\",\"Pakistan\",\"South Africa\",\"Spain\"]','2021-06-09 00:56:33','2021-06-09 00:56:33');
INSERT INTO block_countries VALUES('56','10','[\"Bangladesh\",\"Bulgaria\",\"France\",\"India\",\"Indonesia\",\"Italy\",\"Pakistan\",\"South Africa\",\"United Kingdom\"]','2021-06-09 00:57:16','2021-06-09 00:57:16');
INSERT INTO block_countries VALUES('62','11','[\"India\",\"Italy\",\"Portugal\",\"South Africa\",\"United Kingdom\"]','2021-06-09 05:25:50','2021-06-09 05:25:50');



DROP TABLE IF EXISTS failed_jobs;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS live_matches;

CREATE TABLE `live_matches` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `game_id` bigint(20) unsigned DEFAULT NULL,
  `team_one_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_one_short_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_one_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_two_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_two_short_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_two_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `match_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `continent` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_block_them` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS migrations;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO migrations VALUES('1','2014_10_12_000000_create_users_table','1');
INSERT INTO migrations VALUES('2','2014_10_12_100000_create_password_resets_table','1');
INSERT INTO migrations VALUES('3','2019_08_19_000000_create_failed_jobs_table','1');
INSERT INTO migrations VALUES('4','2021_01_24_153445_create_settings_table','1');
INSERT INTO migrations VALUES('5','2021_04_01_070033_create_notifications_table','1');
INSERT INTO migrations VALUES('6','2021_04_12_063258_create_block_countries_table','1');
INSERT INTO migrations VALUES('7','2021_05_19_115315_create_temp_live_matches_table','1');
INSERT INTO migrations VALUES('8','2021_05_19_160544_create_streaming_sources_table','1');
INSERT INTO migrations VALUES('9','2021_05_19_161017_create_live_matches_table','1');



DROP TABLE IF EXISTS notifications;

CREATE TABLE `notifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `image_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_for_all` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO notifications VALUES('3','Please rate 5 stars ⭐ on Google Play Store 🤩','We as a team trying our best to provide you with Top Notch Football ⚽','','none','','','no','2021-06-08 11:52:57','2021-06-08 11:52:57');
INSERT INTO notifications VALUES('4','International Friendlies','Watch Hungary vs Ireland Live Now!','','url','https://media.squawka.com/images/en/2021/06/07203938/1207091_1207091_squawka_feature-graphic-feature-2021-06-07T201118.265-1067x600.jpg','','no','2021-06-09 00:42:18','2021-06-09 00:42:18');



DROP TABLE IF EXISTS password_resets;

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS settings;

CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO settings VALUES('1','company_name','Super Football','2021-06-06 18:59:33','2021-06-07 15:54:50');
INSERT INTO settings VALUES('2','site_title','SF','2021-06-06 18:59:33','2021-06-07 15:54:50');
INSERT INTO settings VALUES('3','timezone','Asia/Karachi','2021-06-06 18:59:33','2021-06-07 15:54:50');
INSERT INTO settings VALUES('4','language','English','2021-06-06 18:59:33','2021-06-07 15:54:50');
INSERT INTO settings VALUES('5','android_version_code','1','2021-06-06 18:59:33','2021-06-06 19:02:17');
INSERT INTO settings VALUES('6','ios_version_code','1','2021-06-06 18:59:33','2021-06-06 18:59:33');
INSERT INTO settings VALUES('7','android_live_control','on','2021-06-06 18:59:33','2021-06-08 01:02:04');
INSERT INTO settings VALUES('8','ios_live_control','off','2021-06-06 18:59:33','2021-06-06 18:59:33');
INSERT INTO settings VALUES('9','privacy_policy','https://superfootball.com/','2021-06-06 18:59:33','2021-06-06 18:59:33');
INSERT INTO settings VALUES('10','facebook','https://www.facebook.com/','2021-06-06 18:59:33','2021-06-06 18:59:33');
INSERT INTO settings VALUES('11','youtube','http://youtube.com/','2021-06-06 18:59:33','2021-06-06 18:59:33');
INSERT INTO settings VALUES('12','instagram','https://instagram.com/','2021-06-06 18:59:33','2021-06-06 18:59:33');
INSERT INTO settings VALUES('13','onesignal_app_id','n/a','2021-06-06 19:00:22','2021-06-07 15:54:50');
INSERT INTO settings VALUES('14','onesignal_api_key','n/a','2021-06-06 19:00:22','2021-06-07 15:54:50');
INSERT INTO settings VALUES('15','android_version_name','1.0.0','2021-06-06 19:02:17','2021-06-06 19:02:17');
INSERT INTO settings VALUES('16','android_force_update','no','2021-06-06 19:02:17','2021-06-06 19:02:17');
INSERT INTO settings VALUES('17','android_app_url','https://google.com','2021-06-06 19:02:17','2021-06-06 19:02:17');
INSERT INTO settings VALUES('18','android_button_text','Update Now','2021-06-06 19:02:17','2021-06-06 19:02:17');
INSERT INTO settings VALUES('19','android_description','Update The app Now','2021-06-06 19:02:17','2021-06-06 19:02:17');
INSERT INTO settings VALUES('20','android_ads_control','1','2021-06-06 19:02:18','2021-06-07 15:40:09');
INSERT INTO settings VALUES('21','android_fb_ads_id','IMG_16_9_APP_INSTALL#2312433698835503_2964944860251047','2021-06-06 19:02:18','2021-06-07 15:40:09');
INSERT INTO settings VALUES('22','android_banner_ads_code','819114222375136_819115509041674','2021-06-06 19:02:18','2021-06-07 15:40:09');
INSERT INTO settings VALUES('23','android_interstitial_ads_code','819114222375136_819116685708223','2021-06-06 19:02:18','2021-06-07 15:40:09');
INSERT INTO settings VALUES('24','android_native_ads_code','IMG_16_9_APP_INSTALL#2312433698835503_2650502525028617','2021-06-06 19:02:18','2021-06-07 15:40:09');
INSERT INTO settings VALUES('25','android_live_version_code','0','2021-06-06 19:02:23','2021-06-08 01:02:04');
INSERT INTO settings VALUES('26','android_privacy_policy','https://google.com','2021-06-06 19:02:44','2021-06-06 19:09:45');
INSERT INTO settings VALUES('27','android_app_share_link','https://play.google.com/store/apps/details?id=com.soccerstream.superfootball','2021-06-06 19:02:44','2021-06-06 19:09:45');
INSERT INTO settings VALUES('28','logo','logo.png','2021-06-06 19:07:14','2021-06-06 19:07:14');
INSERT INTO settings VALUES('29','icon','icon.png','2021-06-06 19:07:14','2021-06-06 19:07:14');



DROP TABLE IF EXISTS streaming_sources;

CREATE TABLE `streaming_sources` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `match_id` bigint(20) unsigned NOT NULL,
  `stream_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stream_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stream_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stream_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `host` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accept` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `origin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referer` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accept_encoding` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accept_language` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO streaming_sources VALUES('1','1','Restricted Streamming','restricted','http://34.120.143.9/live/DVSqsSDqssza/chunks.m3u8','','34.120.143.9','*/*','http://www.hesgoal.com','http://www.hesgoal.com/','gzip, deflate','en-US,en;q=0.9','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.77 Safari/537.36 Edg/91.0.864.41','2021-06-06 19:24:53','2021-06-06 19:24:53');
INSERT INTO streaming_sources VALUES('2','1','Local Streaming Server','own','http://203.95.220.98:8080/alwaysUpFromMazeda/video.m3u8','alwaysUpFromMazeda','','','','','','','','2021-06-06 19:24:53','2021-06-06 19:24:53');
INSERT INTO streaming_sources VALUES('3','1','Direct From Flussonic','own','http://139.177.207.221/football_live/video.m3u8','football_live','','','','','','','','2021-06-06 19:24:53','2021-06-06 19:24:53');
INSERT INTO streaming_sources VALUES('5','2','HD 1','restricted','http://d8bqv2pijj2hp.cloudfront.net/edge/SSF/playlist.m3u8','','d8bqv2pijj2hp.cloudfront.net','*/*','http://liveonscore.tv','http://liveonscore.tv/','gzip, deflate','en-US,en;q=0.9','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.77 Safari/537.36','2021-06-07 02:54:41','2021-06-07 02:54:41');
INSERT INTO streaming_sources VALUES('37','3','HD','restricted','http://45.148.26.173/hls/S1.m3u8','','45.148.26.173','*/*','http://nbaweb.site','http://nbaweb.site/today/events/Germa-Lat/?sport=soccer','gzip, deflate','en-US,en;q=0.9','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.77 Safari/537.36','2021-06-08 02:46:38','2021-06-08 02:46:38');
INSERT INTO streaming_sources VALUES('41','4','AA','own','https://www.directprivateltd.com/live_matches/create','create','','','','','','','','2021-06-08 13:41:38','2021-06-08 13:41:38');
INSERT INTO streaming_sources VALUES('44','6','check','own','https://googlw.com/public.m3u8','public','','','','','','','','2021-06-08 13:48:27','2021-06-08 13:48:27');
INSERT INTO streaming_sources VALUES('47','5','aaa','own','https://www.directprivateltd.com/live_matches/create','live_matches','','','','','','','','2021-06-08 13:51:38','2021-06-08 13:51:38');
INSERT INTO streaming_sources VALUES('51','7','HD','restricted','http://45.148.26.173/hls/S1.m3u8','','45.148.26.173','*/*','http://nbaweb.site','http://nbaweb.site/today/events/Pol-Ice/?sport=soccer','gzip, deflate','en-US,en;q=0.9','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.77 Safari/537.36','2021-06-09 00:43:20','2021-06-09 00:43:20');
INSERT INTO streaming_sources VALUES('53','8','HD','own','http://77.247.109.111/hls/A1.m3u8','Nothing','','','','','','','','2021-06-09 00:45:58','2021-06-09 00:45:58');
INSERT INTO streaming_sources VALUES('59','9','HD','restricted','http://45.148.26.173/hls/S2.m3u8','','45.148.26.173','*/*','http://nbaweb.site','http://nbaweb.site/today/events/Spa-Lithu/?sport=soccer','gzip, deflate','en-US,en;q=0.9','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.77 Safari/537.36','2021-06-09 00:56:33','2021-06-09 00:56:33');
INSERT INTO streaming_sources VALUES('60','10','HD','own','http://kihvpsbfoesjfsef.com.global.prod.fastly.net/hls/bong2.m3u8','Bonge Stream','','','','','','','','2021-06-09 00:57:16','2021-06-09 00:57:16');
INSERT INTO streaming_sources VALUES('61','10','HD 2','restricted','http://d31rx14wlk0gow.cloudfront.net/edge/SSME/playlist.m3u8','','d31rx14wlk0gow.cloudfront.net','*/*','http://liveonscore.tv','http://liveonscore.tv/','gzip, deflate','en-US,en;q=0.9','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.77 Safari/537.36','2021-06-09 00:57:16','2021-06-09 00:57:16');
INSERT INTO streaming_sources VALUES('62','10','SD','restricted','http://45.148.26.173/hls/S1.m3u8','','45.148.26.173','*/*','http://nbaweb.site','http://nbaweb.site/today/events/Pol-Ice/?sport=soccer','gzip, deflate','en-US,en;q=0.9','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.77 Safari/537.36','2021-06-09 00:57:16','2021-06-09 00:57:16');
INSERT INTO streaming_sources VALUES('74','11','HD','restricted','http://d31rx14wlk0gow.cloudfront.net/edge/NBA5/playlist.m3u8','','d31rx14wlk0gow.cloudfront.net','*/*','http://liveonscore.tv','http://liveonscore.tv/','gzip, deflate','en-US,en;q=0.9','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.77 Safari/537.36','2021-06-09 05:25:50','2021-06-09 05:25:50');
INSERT INTO streaming_sources VALUES('75','11','HD 2','restricted','http://45.148.26.173/hls/S3.m3u8','','45.148.26.173','*/*','http://nbaweb.site','http://nbaweb.site/today/events/Colom-Arge/?sport=soccer','gzip, deflate','en-US,en;q=0.9','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.77 Safari/537.36','2021-06-09 05:25:50','2021-06-09 05:25:50');
INSERT INTO streaming_sources VALUES('76','11','SD','own','http://kihvpsbfoesjfsef.com.global.prod.fastly.net/hls/bong2.m3u8','Testing','','','','','','','','2021-06-09 05:25:50','2021-06-09 05:25:50');



DROP TABLE IF EXISTS temp_live_matches;

CREATE TABLE `temp_live_matches` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `game_id` bigint(20) unsigned DEFAULT NULL,
  `team_one_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_one_short_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_one_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_two_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_two_short_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_two_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `result` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `score` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_added` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO temp_live_matches VALUES('1','561063','Venezuela','VEN','https://a.espncdn.com/combiner/i?img=/i/teamlogos/countries/500/ven.png&h=50','Uruguay','URU','https://a.espncdn.com/combiner/i?img=/i/teamlogos/countries/500/uru.png&h=50','LIVE','v','0','2021-06-09 06:12:42','2021-06-09 06:12:42');
INSERT INTO temp_live_matches VALUES('2','561059','Colombia','COL','https://a.espncdn.com/combiner/i?img=/i/teamlogos/countries/500/col.png&h=50','Argentina','ARG','https://a.espncdn.com/combiner/i?img=/i/teamlogos/countries/500/arg.png&h=50','LIVE','v','0','2021-06-09 06:12:42','2021-06-09 06:12:42');
INSERT INTO temp_live_matches VALUES('3','578791','Grenada','GRN','https://a.espncdn.com/combiner/i?img=/i/teamlogos/countries/500/grn.png&h=50','Montserrat','MSR','https://a.espncdn.com/combiner/i?img=/i/teamlogos/countries/500/msr.png&h=50','LIVE','v','0','2021-06-09 06:12:42','2021-06-09 06:12:42');
INSERT INTO temp_live_matches VALUES('4','578790','Curacao','CUR','https://a.espncdn.com/combiner/i?img=/i/teamlogos/soccer/500/11678.png&h=50','Guatemala','GUA','https://a.espncdn.com/combiner/i?img=/i/teamlogos/countries/500/gua.png&h=50','LIVE','v','0','2021-06-09 06:12:42','2021-06-09 06:12:42');



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
  `status` int(11) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO users VALUES('1','Admin','Admin','super@admin.com','admin','','$2y$10$D0xeSHApCm3TooyWlreOJuFC1ZLSnKzMidYgvdqgKHF7Y7UnLKMH.','profile.png','1','cgt4VCmzYOCIZMVA6VwL00E4dvnml0RNTMFFe3J3nrmV5ceDTLIaYzOMmIhC','2021-06-06 18:58:55','2021-06-06 18:58:55');



