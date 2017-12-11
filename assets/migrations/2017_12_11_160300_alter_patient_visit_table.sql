create table temp_visits (select * from patient_visit)//
truncate table patient_visit//
ALTER TABLE patient_visit ADD UNIQUE patient_dispense (patient_id,dispensing_date,drug_id)//
insert into temp_visits select * from temp_visits group by patient_id,dispensing_date,drug_id//
drop table temp_visits //