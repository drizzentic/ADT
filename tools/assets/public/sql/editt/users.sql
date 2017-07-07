SELECT
	CONCAT_WS(p.first_name,p.surname) AS Name,
	u.username AS Username,
	'20c08b6bc1a214bf004c9b2266ef6f4c' AS Password,
	3 AS Access_Level,
	{destination_facility_code} AS Facility_Code,
	1 AS Created_By,
	u.created_on AS Time_Created,
	pa.tel_no1	AS Phone_Number,
	pa.email_address AS Email_Address,
	1 AS Active,
	1 AS Signature,
	{destination_store_id} AS ccc_store_sp
FROM user u 
LEFT JOIN person p ON p.id = u.person_id
LEFT JOIN person_address pa ON p.id=pa.person_id
WHERE u.{migration_flag_column} = {migration_flag_default}
GROUP BY u.id
LIMIT {migration_limit}
OFFSET {migration_offset}//