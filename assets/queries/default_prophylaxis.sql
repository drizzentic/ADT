UPDATE patient p 
LEFT JOIN patient_status ps ON ps.id = p.current_status
SET p.drug_prophylaxis = (SELECT id FROM drug_prophylaxis WHERE name LIKE '%cotrimoxazole%')
WHERE ps.Name LIKE '%active%'
AND p.drug_prophylaxis = ''//