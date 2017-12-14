CREATE TABLE api_config (
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  config varchar(50) NOT NULL,
  value varchar(100) NOT NULL,
  type varchar(100) 
)//

INSERT INTO api_config (id, config, value,type) VALUES
(1,	'api_status',	'off','toggle'),
(2,	'api_patients_module',	'on','toggle'),
(3,	'api_dispense_module',	'on','toggle'),
(4,	'api_appointments_module',	'on','toggle'),
(5,	'api_adt_url',	'http://localhost:81/ADT/tools/api','char'),
(6,	'api_adt_port',	'6671','char'),
(7,	'api_il_ip',	'192.168.1.44','char'),
(8,	'api_il_port',	'9720','char'),
(9,	'api_logging',	'on','toggle')//