-- gsites.video definition

CREATE TABLE `video` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `video_name` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `title` varchar(100) NOT NULL DEFAULT 'test',
  PRIMARY KEY (`id`),
  UNIQUE KEY `video_unique` (`video_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- gsites.vd_category definition

CREATE TABLE `vd_category` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `created-at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `video_id` bigint NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `vd_category_unique` (`category_name`),
  KEY `vd_category_video_FK` (`video_id`),
  CONSTRAINT `vd_category_video_FK` FOREIGN KEY (`video_id`) REFERENCES `video` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- gsites.vd_items definition

CREATE TABLE `vd_items` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `category_id` bigint NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `video_url` varchar(256) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `vd_items_unique` (`category_id`,`item_name`),
  CONSTRAINT `vd_items_vd_category_FK` FOREIGN KEY (`category_id`) REFERENCES `vd_category` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;