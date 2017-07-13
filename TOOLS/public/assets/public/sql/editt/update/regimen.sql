UPDATE regimen r 
INNER JOIN regimen_category rc ON rc.Name = r.category AND rc.ccc_store_sp = {destination_store_id}
SET r.category = rc.id
WHERE r.ccc_store_sp = {destination_store_id}//