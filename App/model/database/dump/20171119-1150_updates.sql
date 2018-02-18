ALTER TABLE `tmp_formacion` ADD COLUMN `keywords` TEXT AFTER `nombre`;
ALTER TABLE `tmp_formacion` ADD COLUMN `areas_referencia` VARCHAR(2000) DEFAULT NULL;
ALTER TABLE `tmp_formacion` ADD COLUMN `formaciones_referencia` VARCHAR(2000) DEFAULT NULL;
