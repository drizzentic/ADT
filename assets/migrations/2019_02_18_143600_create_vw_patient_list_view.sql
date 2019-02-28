DROP VIEW IF EXISTS vw_patient_list//
create vw_patient_list as 
select p.id AS patient_id
,p.patient_number_ccc AS ccc_number
,p.first_name AS first_name
,p.other_name AS other_name
,p.last_name AS last_name
,p.dob AS date_of_birth
,round(((to_days(curdate()) - to_days(p.dob)) / 365),0) AS age
,if((round(((to_days(curdate()) - to_days(p.dob)) / 365),0) >= 15),'Adult','Paediatric') AS maturity
,p.pob AS pob
,if((p.gender = 1),'MALE','FEMALE') AS gender
,p.adherence
,if((p.pregnant = 1),'YES','NO') AS pregnant
,p.weight AS current_weight
,p.height AS current_height
,p.sa AS current_bsa
,p.bmi AS current_bmi
,p.phone AS phone_number
,p.physical AS physical_address
,p.alternate AS alternate_address
,p.other_illnesses AS other_illnesses
,p.other_drugs AS other_drugs
,p.adr AS drug_allergies
,if((p.tb = 1),'YES','NO') AS tb
,if((p.smoke = 1),'YES','NO') AS smoke
,if((p.alcohol = 1),'YES','NO') AS alcohol
,p.date_enrolled AS date_enrolled
,ps.name AS patient_source
,s.Name AS supported_by
,rst.name AS service
,r1.regimen_desc AS start_regimen
,p.start_regimen_date AS start_regimen_date
,(SELECT r.regimen_code  from patient_visit pv left join regimen r on r.id = pv.regimen where p.patient_number_ccc = pv.patient_id order by dispensing_date desc limit 1) as last_regimen
,pst.Name AS current_status
,if((p.sms_consent = 1),'YES','NO') AS sms_consent
,p.fplan AS family_planning
,p.tbphase AS tbphase
,p.startphase AS startphase
,p.endphase AS endphase
,if((p.partner_status = 1),'Concordant',if((p.partner_status = 2),'Discordant',if((p.partner_status = 3),'Unknown',''))) AS partner_status
,p.status_change_date AS status_change_date
,if((p.partner_type = 1),'YES','NO') AS disclosure
,p.support_group AS support_group
,r.regimen_desc AS current_regimen
,p.nextappointment AS nextappointment
,p.clinicalappointment AS clinicalappointment
,(to_days(p.nextappointment) - to_days(curdate())) AS days_to_nextappointment
,p.start_height AS start_height
,p.start_weight AS start_weight
,p.start_bsa AS start_bsa
,p.start_bmi AS start_bmi
,if((p.transfer_from <> ''),f.name,'N/A') AS transfer_from
,replace(replace(replace(replace(p.drug_prophylaxis,(select drug_prophylaxis.id from drug_prophylaxis limit 1),(select drug_prophylaxis.name from drug_prophylaxis limit 1)),(select drug_prophylaxis.id from drug_prophylaxis limit 1,1),(select drug_prophylaxis.name from drug_prophylaxis limit 1,1)),(select drug_prophylaxis.id from drug_prophylaxis limit 2,1),(select drug_prophylaxis.name from drug_prophylaxis limit 2,1)),(select drug_prophylaxis.id from drug_prophylaxis limit 3,1),(select drug_prophylaxis.name from drug_prophylaxis limit 3,1)) AS prophylaxis
,p.isoniazid_start_date AS isoniazid_start_date
,p.isoniazid_end_date AS isoniazid_end_date
,pep_reason.name AS pep_reason
,prep_reason.name AS prep_reason
,patient_prep_test.test_date AS prep_reason_test_date
,patient_prep_test.test_result AS prep_reason_test_result
,(select patient_viral_load.result from patient_viral_load where (patient_viral_load.patient_ccc_number = p.patient_number_ccc) order by patient_viral_load.test_date desc limit 1) AS viral_load_test_results
,if((p.differentiated_care = 1),'differentiated',if((p.differentiated_care = 0),'notdifferentiated','notdifferentiated')) AS differentiated_care_status
from ((((((((((((patient p left join regimen r on((r.id = p.current_regimen))) left join regimen r1 on((r1.id = p.start_regimen))) left join patient_source ps on((ps.id = p.source))) left join supporter s on((s.id = p.supported_by))) left join regimen_service_type rst on((rst.id = p.service))) left join patient_status pst on((pst.id = p.current_status))) left join facilities f on((f.facilitycode = p.transfer_from))) left join drug_prophylaxis dp on((dp.id = p.drug_prophylaxis))) left join patient_prep_test on((p.id = patient_prep_test.patient_id))) left join prep_reason on((patient_prep_test.prep_reason_id = prep_reason.id))) left join pep_reason on((p.pep_reason = pep_reason.id)))) 
where (p.active = 1)//