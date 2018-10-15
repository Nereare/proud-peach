CREATE TABLE IF NOT EXISTS `icd10` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(4) NOT NULL,
  `description` text NOT NULL,
  `abbr` varchar(256) NOT NULL,
  PRIMARY KEY(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
