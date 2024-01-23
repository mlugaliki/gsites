-- gsites.video definition

CREATE TABLE `video` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `video_name` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `title` varchar(100) NOT NULL DEFAULT 'test',
  PRIMARY KEY (`id`),
  UNIQUE KEY `video_unique` (`video_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;


-- gsites.vd_category definition

CREATE TABLE `vd_category` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `created-at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `video_id` bigint(20) NOT NULL,
  `fn_day` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `vd_category_unique` (`category_name`),
  KEY `vd_category_video_FK` (`video_id`),
  CONSTRAINT `vd_category_video_FK` FOREIGN KEY (`video_id`) REFERENCES `video` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;


-- gsites.vd_items definition

CREATE TABLE `vd_items` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `video_url` varchar(256) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `duration` double DEFAULT '0',
  `ex_level` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `vd_items_unique` (`category_id`,`item_name`),
  CONSTRAINT `vd_items_vd_category_FK` FOREIGN KEY (`category_id`) REFERENCES `vd_category` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=710 DEFAULT CHARSET=latin1;