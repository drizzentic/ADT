DROP TABLE IF EXISTS dcm_change_log//
CREATE TABLE dcm_change_log (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  patient int(11) NOT NULL,
  status int(11) DEFAULT NULL,
  start_date date DEFAULT NULL,
  end_date date DEFAULT NULL,
  exit_reason int(11) DEFAULT NULL,
  PRIMARY KEY (id),
  KEY patient (patient),
  KEY exit_reason (exit_reason)
)//

insert into dcm_change_log(patient,start_date,status)
SELECT patient_id, max(dispensing_date),1
FROM `patient_visit`
WHERE `differentiated_care` = '1'
group by patient_id//
