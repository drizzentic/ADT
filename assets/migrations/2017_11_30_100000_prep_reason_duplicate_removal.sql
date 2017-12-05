-- Create temp table for storing data
create table temp_prep_reason (SELECT * FROM prep_reason)//
-- prep_reason usage(s) --> patient_prep_test.prep_reason_id

-- // alter foreign key usage to varchar
ALTER TABLE patient_prep_test CHANGE prep_reason_id prep_reason_id varchar(100) NULL AFTER patient_id//
-- // update replace prep_reason_id with name
update patient_prep_test pt inner join temp_prep_reason pr on pr.id = pt.prep_reason_id  set pt.prep_reason_id = pr.name//
-- truncate prep_reason table
truncate table prep_reason //
-- // fill prep_reason table with unique values from temp table
insert into prep_reason select * from temp_prep_reason group by name//
-- // add unique constraint to prep_reason table
ALTER TABLE prep_reason ADD UNIQUE name (name)//
-- // update varchar values on foreign key columns to id(integer)
update patient_prep_test pt inner join prep_reason pr on lower(pr.name) = lower(pt.prep_reason_id)  set pt.prep_reason_id = pr.id//
-- // alter foreign key columns from varchar to int
ALTER TABLE patient_prep_test CHANGE prep_reason_id prep_reason_id int(10) NULL AFTER patient_id//
-- // drop temp table
drop table temp_prep_reason//

-- // wrap!