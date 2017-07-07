ALTER TABLE `patient_appointment`
ADD `appointment_type` varchar(20) COLLATE 'latin1_swedish_ci' NOT NULL DEFAULT 'pharmacy'\\

ALTER TABLE `patient_appointment`
ADD `appointment_clinical` varchar(32) COLLATE 'latin1_swedish_ci' NOT NULL AFTER `appointment`;