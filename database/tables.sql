CREATE TABLE IF NOT EXISTS `patients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(249) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `ethinicity` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `civil_state` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `place_birth` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `religion` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cep` int(8) unsigned NOT NULL,
  `address` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` int(8) unsigned,
  `complement` varchar(16) COLLATE utf8mb4_unicode_ci,
  `district` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coutry` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int(18) unsigned NOT NULL,
  `email` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `record_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `record_types`(`name`) VALUES
  (`Primeira Consulta`),
  (`Retorno`),
  (`Urgência/Emergência`),
  (`Evolução`),
  (`Intercorrência`);

CREATE TABLE IF NOT EXISTS `records` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `time` timestamp NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `patient_id` int(10) unsigned NOT NULL,
  `header` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `q_heart` smallint unsigned NOT NULL COMMENT `In beats per minute`,
  `q_breath` smallint unsigned NOT NULL COMMENT `In breaths per minute`,
  `q_saturation` smallint unsigned NOT NULL COMMENT `In percentage`,
  `q_temperature` float unsigned NOT NULL COMMENT `In degrees Celcius`,
  `q_weight` float unsigned NOT NULL COMMENT `In kilograms`,
  `q_height` float unsigned NOT NULL COMMENT `In meters`,
  `q_sbp` smallint unsigned NOT NULL COMMENT `Systolic BP, in mmHg`,
  `q_dbp` smallint unsigned NOT NULL COMMENT `Diastolic BP, in mmHg`,
  `exam_general` varchar(256) COLLATE utf8mb4_unicode_ci,
  `exam_head` varchar(256) COLLATE utf8mb4_unicode_ci,
  `exam_cardio` varchar(256) COLLATE utf8mb4_unicode_ci,
  `exam_lungs` varchar(256) COLLATE utf8mb4_unicode_ci,
  `exam_abdomen` varchar(256) COLLATE utf8mb4_unicode_ci,
  `exam_privates` varchar(256) COLLATE utf8mb4_unicode_ci,
  `exam_lowermembers` varchar(256) COLLATE utf8mb4_unicode_ci,
  `exam_other` longtext COLLATE utf8mb4_unicode_ci,
  `impression` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `directions` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `sign_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY(`type_id`)
    REFERENCES `record_types`(`id`)
    ON UPDATE CASCADE ON DELETE RESTRICT,
  FOREIGN KEY(`patient_id`)
    REFERENCES `patients`(`id`)
    ON UPDATE CASCADE ON DELETE RESTRICT,
  FOREIGN KEY(`sign_id`)
    REFERENCES `users`(`id`)
    ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `prescriptions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `time` timestamp NOT NULL,
  `patient_id` int(10) unsigned NOT NULL,
  `sign_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY(`patient_id`)
    REFERENCES `patients`(`id`)
    ON UPDATE CASCADE ON DELETE RESTRICT,
  FOREIGN KEY(`sign_id`)
    REFERENCES `users`(`id`)
    ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `meds` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `prescription_id` int(10) unsigned NOT NULL,
  `order` tinyint unsigned NOT NULL DEFAULT 1,
  `drug` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `posology` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `directions` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY(`prescription_id`)
    REFERENCES `prescriptions`(`id`)
    ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `leaves` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `time` timestamp NOT NULL,
  `patient_id` int(10) unsigned NOT NULL,
  `days` tinyint unsigned NOT NULL DEFAULT 1,
  `icd10_id` int(10) unsigned NOT NULL,
  `disclosure` boolean NOT NULL DEFAULT 0,
  `sign_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY(`patient_id`)
    REFERENCES `patients`(`id`)
    ON UPDATE CASCADE ON DELETE RESTRICT,
  FOREIGN KEY(`icd10_id`)
    REFERENCES `icd10`(`id`)
    ON UPDATE CASCADE ON DELETE RESTRICT,
  FOREIGN KEY(`sign_id`)
    REFERENCES `users`(`id`)
    ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
