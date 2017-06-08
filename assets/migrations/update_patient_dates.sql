UPDATE patient 
SET dob = DATE_FORMAT(dob, '%Y-%m-%d'), 
date_enrolled = DATE_FORMAT(date_enrolled, '%Y-%m-%d'), 
start_regimen_date = DATE_FORMAT(start_regimen_date, '%Y-%m-%d'),
status_change_date = DATE_FORMAT(status_change_date, '%Y-%m-%d'),
nextappointment = DATE_FORMAT(nextappointment, '%Y-%m-%d')//

UPDATE patient_appointment
SET appointment = DATE_FORMAT(appointment, '%Y-%m-%d')//

UPDATE patient_visit
SET dispensing_date = DATE_FORMAT(dispensing_date, '%Y-%m-%d')//

UPDATE drug_stock_movement
SET transaction_date = DATE_FORMAT(transaction_date, '%Y-%m-%d'), expiry_date = DATE_FORMAT(expiry_date, '%Y-%m-%d')//