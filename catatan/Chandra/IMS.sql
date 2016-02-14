/*
Navicat Oracle Data Transfer
Oracle Client Version : 10.2.0.5.0

Source Server         : XE
Source Server Version : 110200
Source Host           : 127.0.0.1:1521
Source Schema         : IMS

Target Server Type    : ORACLE
Target Server Version : 110200
File Encoding         : 65001

Date: 2016-02-11 20:51:05
*/


-- ----------------------------
-- Table structure for USER
-- ----------------------------
DROP TABLE "IMS"."USER";
CREATE TABLE "IMS"."USER" (
"ID" NUMBER NOT NULL ,
"USERNAME" VARCHAR2(150 BYTE) NULL ,
"JABATAN" VARCHAR2(150 BYTE) NULL ,
"NO_HP" VARCHAR2(20 BYTE) NULL ,
"EMAIL" VARCHAR2(150 BYTE) NULL ,
"CREATE_DATE" DATE NULL ,
"UPDATE_DATE" DATE NULL ,
"PASSWORD" VARCHAR2(250 BYTE) NULL ,
"SALT" VARCHAR2(150 BYTE) NULL 
)
LOGGING
NOCOMPRESS
NOCACHE

;

-- ----------------------------
-- Records of USER
-- ----------------------------
INSERT INTO "IMS"."USER" VALUES ('2', 'chandra', 'kepala botak', '0908098090', 'chandra@passionit.co.id', TO_DATE('2016-02-10 00:00:00', 'YYYY-MM-DD HH24:MI:SS'), TO_DATE('2016-02-10 00:00:00', 'YYYY-MM-DD HH24:MI:SS'), '69519e2cfc2eeeae2df2d193398bc30bd97bf278', 'b6f5c3b1cc1a40487ababe7fcf1ae5e2ea1be15f.gwSiG');
INSERT INTO "IMS"."USER" VALUES ('3', 'farid', 'kepala bidang', '0908098090', 'chandra@passionit.co.id', TO_DATE('2016-02-10 00:00:00', 'YYYY-MM-DD HH24:MI:SS'), TO_DATE('2016-02-10 00:00:00', 'YYYY-MM-DD HH24:MI:SS'), 'd95a6e91fdfc425dedfb0f2ca16eb1ff7267ad9f', 'f9996905802739bf85c390fe754b6847c7233a45.4Hs2z');

-- ----------------------------
-- Function structure for CUSTOM_AUTH
-- ----------------------------
CREATE OR REPLACE function "IMS"."CUSTOM_AUTH" (p_username in VARCHAR2, p_password in VARCHAR2)
return BOOLEAN
is
  l_password varchar2(4000);
  l_stored_password varchar2(4000);
  l_expires_on date;
  l_count number;
begin
-- First, check to see if the user is in the user table
select count(*) into l_count from demo_users where user_name = p_username;
if l_count > 0 then
  -- First, we fetch the stored hashed password & expire date
  select password, expires_on into l_stored_password, l_expires_on
   from demo_users where user_name = p_username;

  -- Next, we check to see if the user's account is expired
  -- If it is, return FALSE
  if l_expires_on > sysdate or l_expires_on is null then

    -- If the account is not expired, we have to apply the custom hash
    -- function to the password
    l_password := custom_hash(p_username, p_password);

    -- Finally, we compare them to see if they are the same and return
    -- either TRUE or FALSE
    if l_password = l_stored_password then
      return true;
    else
      return false;
    end if;
  else
    return false;
  end if;
else
  -- The username provided is not in the DEMO_USERS table
  return false;
end if;
end;
/

-- ----------------------------
-- Function structure for CUSTOM_HASH
-- ----------------------------
CREATE OR REPLACE function "IMS"."CUSTOM_HASH" (p_username in varchar2, p_password in varchar2)
return varchar2
is
  l_password varchar2(4000);
  l_salt varchar2(4000) := 'PSHJLQ4FZM50XZNVMJ5NGV6WG2J2CM';
begin

-- This function should be wrapped, as the hash algorhythm is exposed here.
-- You can change the value of l_salt or the method of which to call the
-- DBMS_OBFUSCATOIN toolkit, but you much reset all of your passwords
-- if you choose to do this.

l_password := utl_raw.cast_to_raw(dbms_obfuscation_toolkit.md5
  (input_string => p_password || substr(l_salt,10,13) || p_username ||
    substr(l_salt, 4,10)));
return l_password;
end;
/

-- ----------------------------
-- Sequence structure for DEMO_CUST_SEQ
-- ----------------------------
DROP SEQUENCE "IMS"."DEMO_CUST_SEQ";
CREATE SEQUENCE "IMS"."DEMO_CUST_SEQ"
 INCREMENT BY 1
 MINVALUE 1
 MAXVALUE 9999999999999999999999999999
 START WITH 21
 CACHE 20;

-- ----------------------------
-- Sequence structure for DEMO_ORD_SEQ
-- ----------------------------
DROP SEQUENCE "IMS"."DEMO_ORD_SEQ";
CREATE SEQUENCE "IMS"."DEMO_ORD_SEQ"
 INCREMENT BY 1
 MINVALUE 1
 MAXVALUE 9999999999999999999999999999
 START WITH 11
 CACHE 20;

-- ----------------------------
-- Sequence structure for DEMO_ORDER_ITEMS_SEQ
-- ----------------------------
DROP SEQUENCE "IMS"."DEMO_ORDER_ITEMS_SEQ";
CREATE SEQUENCE "IMS"."DEMO_ORDER_ITEMS_SEQ"
 INCREMENT BY 1
 MINVALUE 1
 MAXVALUE 9999999999999999999999999999
 START WITH 61
 CACHE 20;

-- ----------------------------
-- Sequence structure for DEMO_PROD_SEQ
-- ----------------------------
DROP SEQUENCE "IMS"."DEMO_PROD_SEQ";
CREATE SEQUENCE "IMS"."DEMO_PROD_SEQ"
 INCREMENT BY 1
 MINVALUE 1
 MAXVALUE 9999999999999999999999999999
 START WITH 21
 CACHE 20;

-- ----------------------------
-- Sequence structure for DEMO_USERS_SEQ
-- ----------------------------
DROP SEQUENCE "IMS"."DEMO_USERS_SEQ";
CREATE SEQUENCE "IMS"."DEMO_USERS_SEQ"
 INCREMENT BY 1
 MINVALUE 1
 MAXVALUE 9999999999999999999999999999
 START WITH 21
 CACHE 20;

-- ----------------------------
-- Sequence structure for TRG_SEQ_USER
-- ----------------------------
DROP SEQUENCE "IMS"."TRG_SEQ_USER";
CREATE SEQUENCE "IMS"."TRG_SEQ_USER"
 INCREMENT BY 1
 MINVALUE 0
 MAXVALUE 999999999999999999999999999
 START WITH 0
 NOCACHE ;

-- ----------------------------
-- Sequence structure for USER_ID
-- ----------------------------
DROP SEQUENCE "IMS"."USER_ID";
CREATE SEQUENCE "IMS"."USER_ID"
 INCREMENT BY 1
 MINVALUE 1
 MAXVALUE 9999999999999999999999999999
 START WITH 21
 CACHE 20;

-- ----------------------------
-- Indexes structure for table USER
-- ----------------------------

-- ----------------------------
-- Triggers structure for table USER
-- ----------------------------
CREATE OR REPLACE TRIGGER "IMS"."trg_user_id" BEFORE INSERT ON "IMS"."USER" REFERENCING OLD AS "OLD" NEW AS "NEW" FOR EACH ROW ENABLE
BEGIN
   SELECT user_id.NEXTVAL INTO :NEW.ID FROM DUAL ;
END; 
-- ----------------------------
-- Checks structure for table USER
-- ----------------------------
ALTER TABLE "IMS"."USER" ADD CHECK ("ID" IS NOT NULL);

-- ----------------------------
-- Primary Key structure for table USER
-- ----------------------------
ALTER TABLE "IMS"."USER" ADD PRIMARY KEY ("ID");
