UPDATE patient p   
JOIN patient_visit pv on p.patient_number_ccc = pv.patient_id
JOIN drugcode dc on  pv.drug_id = dc.id
SET p.isoniazid_start_date  = pv.dispensing_date , p.isoniazid_end_date = pv.dispensing_date + INTERVAL 168 DAY
WHERE dc.drug LIKE '%iso%'  and p.isoniazid_start_date = ''//