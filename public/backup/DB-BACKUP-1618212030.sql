DROP TABLE IF EXISTS ads;

CREATE TABLE `ads` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `popup_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `button_text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS block_countries;

CREATE TABLE `block_countries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `live_match_id` int(11) NOT NULL,
  `country_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO block_countries VALUES('1','2','sssss,ssss,s','2021-04-12 06:37:41','2021-04-12 06:37:41');
INSERT INTO block_countries VALUES('2','6','null','2021-04-12 06:43:07','2021-04-12 06:43:07');
INSERT INTO block_countries VALUES('4','8','wweewwe,weewewew','2021-04-12 06:44:33','2021-04-12 06:44:33');
INSERT INTO block_countries VALUES('5','9','ewewew,ew,ww','2021-04-12 06:47:51','2021-04-12 06:47:51');
INSERT INTO block_countries VALUES('6','10','ewwewe,w','2021-04-12 06:49:29','2021-04-12 06:49:29');
INSERT INTO block_countries VALUES('7','7','dfdfdf,fdfdfd,fdtrtrtr','2021-04-12 07:26:27','2021-04-12 07:26:27');



DROP TABLE IF EXISTS failed_jobs;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS live_matches;

CREATE TABLE `live_matches` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `team_one_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_one_image_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_one_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_one_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_two_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_two_image_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_two_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_two_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `match_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stream_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stream_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `continent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_block_them` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO live_matches VALUES('1','AAAA','none','','','AAAAA','none','','','AAAA','http://localhost/a2zsports/live_matches/create','http://localhost/a2zsports/live_matches/create','global','1','2021-04-12 06:37:24','2021-04-12 06:37:24');
INSERT INTO live_matches VALUES('2','AAAA','none','','','AAAAA','none','','','AAAA','http://localhost/a2zsports/live_matches/create','http://localhost/a2zsports/live_matches/create','global','1','2021-04-12 06:37:41','2021-04-12 06:37:41');
INSERT INTO live_matches VALUES('3','ss','none','','','www','none','','','www','http://localhost/a2zsports/live_matches/create','weew','europe','','2021-04-12 06:38:28','2021-04-12 06:38:28');
INSERT INTO live_matches VALUES('4','saassa','none','','','sss','none','','','sasa','http://localhost/a2zsports/live_matches/create','sdsd','asia','','2021-04-12 06:41:08','2021-04-12 06:41:08');
INSERT INTO live_matches VALUES('5','saassa','none','','','sss','none','','','sasa','http://localhost/a2zsports/live_matches/create','sdsd','asia','','2021-04-12 06:41:44','2021-04-12 06:41:44');
INSERT INTO live_matches VALUES('6','saassa','none','','','sss','none','','','sasa','http://localhost/a2zsports/live_matches/create','sdsd','asia','','2021-04-12 06:43:07','2021-04-12 06:43:07');
INSERT INTO live_matches VALUES('7','AAA','none','','','AAA','none','','','AAAAA','http://localhost/a2zsports/live_matches/create','wwe','europe','1','2021-04-12 06:44:07','2021-04-12 06:44:07');
INSERT INTO live_matches VALUES('8','Admin Admin','none','','','www','none','','','ad','http://localhost/a2zsports/live_matches/create','ewewe','global','1','2021-04-12 06:44:32','2021-04-12 06:44:32');
INSERT INTO live_matches VALUES('9','Admin Admin','none','','','qw','none','','','qwqw','http://localhost/a2zsports/live_matches/create','ewew','europe','1','2021-04-12 06:47:50','2021-04-12 06:47:50');
INSERT INTO live_matches VALUES('10','www','none','','','www','none','','','ww','http://localhost/a2zsports/live_matches/create','ewe','europe','','2021-04-12 06:49:29','2021-04-12 06:49:29');



DROP TABLE IF EXISTS migrations;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO migrations VALUES('1','2014_10_12_000000_create_users_table','1');
INSERT INTO migrations VALUES('2','2014_10_12_100000_create_password_resets_table','1');
INSERT INTO migrations VALUES('3','2019_08_19_000000_create_failed_jobs_table','1');
INSERT INTO migrations VALUES('4','2021_01_24_153445_create_settings_table','1');
INSERT INTO migrations VALUES('6','2021_04_01_070033_create_notifications_table','1');
INSERT INTO migrations VALUES('7','2021_04_01_114034_create_ads_table','1');
INSERT INTO migrations VALUES('8','2021_04_05_100324_create_predictions_table','1');
INSERT INTO migrations VALUES('9','2021_04_07_110319_create_website_ads_table','1');
INSERT INTO migrations VALUES('12','2021_04_01_041745_create_live_matches_table','2');
INSERT INTO migrations VALUES('13','2021_04_12_063258_create_block_countries_table','2');



DROP TABLE IF EXISTS notifications;

CREATE TABLE `notifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `image_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_for_all` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS password_resets;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS predictions;

CREATE TABLE `predictions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `team_one_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_one_image_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_one_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_one_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_two_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_two_image_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_two_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_two_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `match_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prediction` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS settings;

CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO settings VALUES('1','company_name','A2Z Sports','2021-04-12 10:24:31','2021-04-12 05:24:58');
INSERT INTO settings VALUES('2','site_title','A2Z Sports','2021-04-12 10:24:31','2021-04-12 05:24:58');
INSERT INTO settings VALUES('3','timezone','Africa/Brazzaville','2021-04-12 10:24:31','2021-04-12 05:24:58');
INSERT INTO settings VALUES('4','language','English','2021-04-12 10:24:31','2021-04-12 05:24:58');
INSERT INTO settings VALUES('5','ads_control','off','2021-04-12 10:24:32','2021-04-12 10:24:32');
INSERT INTO settings VALUES('6','live_control','off','2021-04-12 10:24:32','2021-04-12 10:24:32');
INSERT INTO settings VALUES('7','privacy_policy','https://cric2day.com/','2021-04-12 10:24:32','2021-04-12 10:24:32');
INSERT INTO settings VALUES('8','facebook','https://www.facebook.com/','2021-04-12 10:24:32','2021-04-12 08:10:06');
INSERT INTO settings VALUES('9','youtube','http://youtube.com/','2021-04-12 10:24:32','2021-04-12 08:10:06');
INSERT INTO settings VALUES('10','telegram','https://telegram.org/','2021-04-12 10:24:32','2021-04-12 10:24:32');
INSERT INTO settings VALUES('11','company_reg_key','111','2021-04-12 05:24:58','2021-04-12 05:24:58');
INSERT INTO settings VALUES('12','server_id','111','2021-04-12 05:24:58','2021-04-12 05:24:58');
INSERT INTO settings VALUES('13','Instagram','#','2021-04-12 08:10:06','2021-04-12 08:10:06');
INSERT INTO settings VALUES('14','Twitter','#','2021-04-12 08:10:06','2021-04-12 08:10:06');



DROP TABLE IF EXISTS users;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'profile.png',
  `status` int(11) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO users VALUES('1','Admin','Admin','admin@demo.com','admin','','$2y$10$o/1sUuO/NZF3SyZmBM.JHOuQxc4V7olW.Q24QyU2iW2bgf2j.tunG','profile.png','1','Ebte6IemxpCB84DxGn2EPrn1TWAJ8skwKpAV2kBi8kKBWyVpfDHBbzLZKJbm','2021-04-12 10:23:26','2021-04-12 10:23:26');



DROP TABLE IF EXISTS website_ads;

CREATE TABLE `website_ads` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




