UPDATE `sync_regimen_category` SET `Active` = '1' WHERE `Active` = ''//

UPDATE `sync_regimen_category` SET `Active` = '0' WHERE  `Name` IN('Other Pediatric Regimen', 'OIs Medicines {CM} and {OC} For Diflucan Donation Program ONLY')//