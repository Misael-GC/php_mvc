CREATE database IF NOT EXISTS `contactos` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;

CREATE TABLE `contact` (
  `coct_id_contact` int NOT NULL AUTO_INCREMENT,
  `coct_name` varchar(30) DEFAULT NULL,
  `coct_last_name` varchar(50) DEFAULT NULL,
  `coct_age` varchar(50) DEFAULT NULL,
  `coct_email` varchar(50) DEFAULT NULL,
  `coct_description` text,
  `coct_url_img_profile` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`coct_id_contact`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

