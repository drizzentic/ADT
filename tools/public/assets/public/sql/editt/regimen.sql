SELECT 
	r.code AS regimen_code,
	r.name AS regimen_desc,
	rt.name AS category,
	r.line,
	{destination_store_id} AS ccc_store_sp 
FROM regimen r
LEFT JOIN regimen_type rt ON rt.id = r.regimen_type_id
WHERE r.{migration_flag_column} = {migration_flag_default}
GROUP BY r.id
LIMIT {migration_limit}
OFFSET {migration_offset}//