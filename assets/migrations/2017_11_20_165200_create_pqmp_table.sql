DROP TABLE IF EXISTS pqmp//
CREATE TABLE pqmp (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  facility_name text,
  district_name text,
  province_name text,
  facility_address text,
  facility_phone text,
  brand_name text,
  generic_name text,
  batch_no text,
  manufacture_date text,
  expiry_date text,
  receipt_date text,
  manufacturer_name text,
  origin_county text,
  supplier_name text,
  supplier_address text,
  formulation_oral text,
  formulation_injection text,
  formulation_diluent text,
  formulation_powdersuspension text,
  formulation_powderinjection text,
  formulation_eyedrops text,
  formulation_eardrops text,
  formulation_nebuliser text,
  formulation_cream text,
  other_formulation text,
  formulation_other text,
  complaint_colour text,
  complaint_separating text,
  complaint_powdering text,
  complaint_caking text,
  complaint_moulding text,
  complaint_change text,
  complaint_mislabeilng text,
  complaint_incomplete text,
  other_complaint text,
  complaint_other text,
  description text,
  comments text NOT NULL,
  product_refrigiration text,
  product_availability text,
  product_returned text,
  product_storage text,
  reporter_name text,
  reporter_phone text,
  reporter_title text,
  reporter_signature text,
  PRIMARY KEY (id)
)//
