ALTER TABLE facilities ADD autobackup tinyint(1) NOT NULL DEFAULT '0' AFTER map//

ALTER TABLE facilities DROP lost_to_follow_up //

ALTER TABLE facilities ADD lost_to_follow_up int(11) default 90 AFTER autobackup//