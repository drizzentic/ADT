SELECT 
	Regimencode as regimen,
	DrugInRegimen as drugcode,
	{destination_store_id} AS ccc_store_sp 
FROM xxdrugsinregimen
WHERE {migration_flag_column} = {migration_flag_default}
LIMIT {migration_limit}
OFFSET {migration_offset}//