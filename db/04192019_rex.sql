CREATE TABLE `erp_item_categories` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(45) NOT NULL , `parent_category` INT NOT NULL , `category_string` TEXT NOT NULL , `created` DATETIME NOT NULL , `updated` DATETIME NOT NULL , `status` TINYINT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

ALTER TABLE `erp_item_categories` ADD `company` INT NOT NULL AFTER `id`;