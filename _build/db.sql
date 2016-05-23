ALTER TABLE `event`
ADD COLUMN `ticketsolve3D` VARCHAR(255) NULL AFTER `ticketsolve`;

ALTER TABLE `eventdate`
ADD COLUMN `type` VARCHAR(45) NULL AFTER `dateLocation`;


ALTER TABLE `event`
CHANGE COLUMN `eventTitle` `eventTitle` VARCHAR(255) NULL ,
CHANGE COLUMN `eventCertificate` `eventCertificate` VARCHAR(255) NULL ,
CHANGE COLUMN `eventRunningTime` `eventRunningTime` VARCHAR(3) NULL ,
CHANGE COLUMN `eventDirector` `eventDirector` VARCHAR(255) NULL ,
CHANGE COLUMN `eventStarring` `eventStarring` TEXT NULL ,
CHANGE COLUMN `eventTrailer` `eventTrailer` VARCHAR(255) NULL ,
CHANGE COLUMN `eventDescription` `eventDescription` TEXT NULL ,
CHANGE COLUMN `eventLink` `eventLink` VARCHAR(255) NULL ,
CHANGE COLUMN `eventPrices` `eventPrices` TEXT NULL ,
CHANGE COLUMN `eventReviews` `eventReviews` TINYINT(4) NULL ,
CHANGE COLUMN `eventAudioDescription` `eventAudioDescription` TINYINT(4) NULL ,
CHANGE COLUMN `eventSubtitles` `eventSubtitles` TINYINT(4) NULL ,
CHANGE COLUMN `event18Free` `event18Free` TINYINT(4) NULL ,
CHANGE COLUMN `eventType` `eventType` TINYINT(4) NULL ,
CHANGE COLUMN `eventStatus` `eventStatus` TINYINT(4) NULL ,
CHANGE COLUMN `eventCreated` `eventCreated` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
CHANGE COLUMN `eventBanner` `eventBanner` VARCHAR(255) NULL ,
CHANGE COLUMN `eventBannerExtension` `eventBannerExtension` VARCHAR(10) NULL ,
CHANGE COLUMN `ticketsolve` `ticketsolve` VARCHAR(255) NULL ;

ALTER TABLE `eventdate`
CHANGE COLUMN `eventID` `eventID` INT(11) NULL ,
CHANGE COLUMN `dateTime` `dateTime` DATETIME NULL ,
CHANGE COLUMN `dateLocation` `dateLocation` TINYINT(4) NULL ;

ALTER TABLE `eventimage`
CHANGE COLUMN `imageName` `imageName` VARCHAR(255) NULL ,
CHANGE COLUMN `imageExtension` `imageExtension` VARCHAR(10) NULL ,
CHANGE COLUMN `thumbTop160` `thumbTop160` TINYINT(4) NULL ,
CHANGE COLUMN `thumbTop200` `thumbTop200` TINYINT(4) NULL ,
CHANGE COLUMN `imageMain` `imageMain` TINYINT(4) NULL ;


ALTER TABLE `twitter`
CHANGE COLUMN `time` `time` TEXT NULL ,
CHANGE COLUMN `text` `text` VARCHAR(255) NULL ,
CHANGE COLUMN `inserted` `inserted` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ;

ALTER TABLE `_swoop_user`
CHANGE COLUMN `username` `username` VARCHAR(255) NULL ,
CHANGE COLUMN `password` `password` VARCHAR(512) NULL ,
CHANGE COLUMN `email` `email` VARCHAR(512) NULL ,
CHANGE COLUMN `first_name` `first_name` VARCHAR(100) NULL ,
CHANGE COLUMN `last_name` `last_name` VARCHAR(100) NULL ,
CHANGE COLUMN `salt` `salt` VARCHAR(50) NULL ,
CHANGE COLUMN `temp_password` `temp_password` INT(1) NULL ;
