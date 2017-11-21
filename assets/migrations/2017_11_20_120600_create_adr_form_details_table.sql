
DROP TABLE IF EXISTS adr_form_details//
CREATE TABLE adr_form_details (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  adr_id bigint(20) NOT NULL,
  drug int(11) NOT NULL,
  dose varchar(20) NOT NULL,
  route_freq varchar(20) NOT NULL,
  date_started date NOT NULL,
  date_stopped date NOT NULL,
  indication int(11) NOT NULL,
  suspecteddrug varchar(10) NOT NULL,
  visitid int(11) NOT NULL,
  PRIMARY KEY (id),
  KEY adr_id (adr_id),
  CONSTRAINT adr_form_details_ibfk_1 FOREIGN KEY (adr_id) REFERENCES adr_form (id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1//