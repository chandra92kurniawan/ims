-- SQL Loader Control and Data File created by TOAD
-- Variable length, terminated enclosed data formatting
-- 
-- The format for executing this file with SQL Loader is:
-- SQLLDR control=<filename> Be sure to substitute your
-- version of SQL LOADER and the filename for this file.
--
-- Note: Nested table datatypes are not supported here and
--       will be exported as nulls.
LOAD DATA
INFILE *
BADFILE './MST_BANK.BAD'
DISCARDFILE './MST_BANK.DSC'
APPEND INTO TABLE ADMSIB.MST_BANK
Fields terminated by ";" Optionally enclosed by '"'
(
  ID_BANK,
  NAME_BANK,
  ADDRESS_BANK,
  CREATED_BY,
  CREATED_DATE DATE "MM/DD/YYYY HH24:MI:SS" NULLIF (CREATED_DATE="NULL"),
  MODIFY_BY,
  MODIFY_DATE DATE "MM/DD/YYYY HH24:MI:SS" NULLIF (MODIFY_DATE="NULL"),
  INIT
)
BEGINDATA
"0001";"PT BANK JABAR BANTEN TBK";"Jl. Braga No.12 Kota Bandung - 40111";"";NULL;"";NULL;"BJB"
