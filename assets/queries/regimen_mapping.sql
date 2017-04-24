UPDATE regimen r 
LEFT JOIN sync_regimen sr ON sr.code = r.regimen_code
SET r.map = sr.id
WHERE r.map = '';