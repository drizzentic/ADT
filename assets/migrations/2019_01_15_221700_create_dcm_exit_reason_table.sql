DROP TABLE IF EXISTS dcm_exit_reason//
CREATE TABLE dcm_exit_reason (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(150) NOT NULL,
  active int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (id),
  UNIQUE KEY name (name)
)//
INSERT INTO dcm_exit_reason (id, name, active) VALUES
(1,	'Occupational exposure.',	1),
(2,	'Sexual assault',	1),
(3,	'Other reasons',	1),
(4,	'Human bite.',	1),
(5,	'Condom burst.',	1),
(6,	'Unprotected sex.',	1)//