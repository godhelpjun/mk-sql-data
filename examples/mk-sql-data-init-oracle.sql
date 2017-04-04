/*

	SQL script file for mk-sql-data.php - oracle intefrface

 creates the tables fk_city and fk_address by a new user db2phpsite

*/

/*

create a user ( and schema ) db2phpsite before you execute these statements!

sqlplus64 /nolog

CONNECT system/oracle@192.168.1.65/XE

create user db2phpsite identified by "db2phpsite";

grant dba,resource, connect to db2phpsite;

connect db2phpsite/db2phpsite@192.168.1.65;

*/


/* create table fk_city - the statement to execute may not have a trailing semicolon! */

DECLARE create_statement varchar( 1024 ) := '
create table fk_city (
  ID_CITY number(8) NOT NULL,
  city varchar(255),
  country_id number(8) NOT NULL,
  is_europe number(1) NOT NULL,
  last_visit DATE,
    REVNAME                         CHAR(20)     NOT NULL ,
    REVDATE                         DATE        NOT NULL ,
    REVFIRST                        DATE        NOT NULL ,
    REVCREATOR                      CHAR(20)        NOT NULL,
  PRIMARY KEY ( ID_CITY )
)';
BEGIN
EXECUTE IMMEDIATE create_statement;
EXCEPTION
   WHEN OTHERS THEN
      IF SQLCODE != -955 THEN
         RAISE;
      END IF;
END;

/

INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVCREATOR, REVDATE, REVFIRST ) VALUES ( 0, 'Berlin', 83, 1, 'create-script' , 'create-script', SYSDATE, SYSDATE );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVCREATOR, REVDATE, REVFIRST ) VALUES ( 1, 'Altenburg', 83, 1, 'create-script' , 'create-script', SYSDATE, SYSDATE );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVCREATOR, REVDATE, REVFIRST ) VALUES ( 2, 'Leipzig', 83, 1, 'create-script' , 'create-script', SYSDATE, SYSDATE );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVCREATOR, REVDATE, REVFIRST ) VALUES ( 3, 'Erfurt', 83, 1, 'create-script' , 'create-script', SYSDATE, SYSDATE );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVCREATOR, REVDATE, REVFIRST ) VALUES ( 4, 'Dresden', 83, 1, 'create-script' , 'create-script', SYSDATE, SYSDATE );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVCREATOR, REVDATE, REVFIRST ) VALUES ( 5, 'Schmölln', 83, 1, 'create-script' , 'create-script', SYSDATE, SYSDATE );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVCREATOR, REVDATE, REVFIRST ) VALUES ( 6, 'Gera', 83, 1, 'create-script' , 'create-script', SYSDATE, SYSDATE );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVCREATOR, REVDATE, REVFIRST ) VALUES ( 7, 'Wilhelmshaven', 83, 1, 'create-script' , 'create-script', SYSDATE, SYSDATE );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVCREATOR, REVDATE, REVFIRST ) VALUES ( 8, 'Bremen', 83, 1, 'create-script' , 'create-script', SYSDATE, SYSDATE );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVCREATOR, REVDATE, REVFIRST ) VALUES ( 9, 'Bubesheim', 83, 1, 'create-script' , 'create-script', SYSDATE, SYSDATE );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVCREATOR, REVDATE, REVFIRST ) VALUES (10, 'Mainz', 83, 1, 'create-script' , 'create-script', SYSDATE, SYSDATE );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVCREATOR, REVDATE, REVFIRST ) VALUES (11, 'Bodenheim', 83, 1, 'create-script' , 'create-script', SYSDATE, SYSDATE );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVCREATOR, REVDATE, REVFIRST ) VALUES (12, 'Budenheim', 83, 1, 'create-script' , 'create-script', SYSDATE, SYSDATE );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVCREATOR, REVDATE, REVFIRST ) VALUES (13, 'Waltershausen', 83, 1, 'create-script' , 'create-script', SYSDATE, SYSDATE );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVCREATOR, REVDATE, REVFIRST ) VALUES (14, 'München', 83, 1, 'create-script' , 'create-script', SYSDATE, SYSDATE );

INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVCREATOR, REVDATE, REVFIRST ) VALUES (15, 'Günzburg', 83, 1, 'create-script' , 'create-script', SYSDATE, SYSDATE );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVCREATOR, REVDATE, REVFIRST ) VALUES (16, 'Augsburg', 83, 1, 'create-script' , 'create-script', SYSDATE, SYSDATE );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVCREATOR, REVDATE, REVFIRST ) VALUES (17, 'Hainsfeld', 83, 1, 'create-script' , 'create-script', SYSDATE, SYSDATE );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVCREATOR, REVDATE, REVFIRST ) VALUES (18, 'New York', 236, 1, 'create-script' , 'create-script', SYSDATE, SYSDATE );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVCREATOR, REVDATE, REVFIRST ) VALUES (19, 'London', 235, 1, 'create-script' , 'create-script', SYSDATE, SYSDATE );


DECLARE create_statement varchar( 1024 ) := '
CREATE TABLE fk_address (

  ID_MANDANT number(8) NOT NULL,
  ID_BUCHUNGSKREIS number(8) NOT NULL,
  ID_ADDRESS number(8) NOT NULL,

  ID_CITY number(8) NOT NULL,
  ID_COUNTRY number(8),

  Name VARCHAR(255) ,
  Vorname VARCHAR(255) ,

  PRIMARY KEY (ID_MANDANT, ID_BUCHUNGSKREIS, ID_ADDRESS ),
  FOREIGN KEY (ID_CITY) REFERENCES fk_city(ID_CITY)

)';
BEGIN
EXECUTE IMMEDIATE create_statement;
EXCEPTION
   WHEN OTHERS THEN
      IF SQLCODE != -955 THEN
         RAISE;
      END IF;
END;

/

DECLARE create_statement varchar( 1024 ) := '
CREATE TABLE countries (

  country_id number(8) NOT NULL,
  long_name varchar(80) NOT NULL,

  PRIMARY KEY ( country_id )

)';
BEGIN
EXECUTE IMMEDIATE create_statement;
EXCEPTION
   WHEN OTHERS THEN
      IF SQLCODE != -955 THEN
         RAISE;
      END IF;
END;

/


insert into countries( country_id, long_name ) values (  83, 'Germany' );
insert into countries( country_id, long_name ) values (  84, 'Ghana' );
insert into countries( country_id, long_name ) values (  85, 'Gibraltar' );
insert into countries( country_id, long_name ) values ( 235, 'Great Britain' );
insert into countries( country_id, long_name ) values ( 236, 'United States' );


DECLARE create_statement varchar( 1024 ) := '
CREATE TABLE MANDANT (

  ID_MANDANT number(8) NOT NULL,
  Name varchar(70) NOT NULL,

  PRIMARY KEY ( ID_MANDANT )

)';
BEGIN
EXECUTE IMMEDIATE create_statement;
EXCEPTION
   WHEN OTHERS THEN
      IF SQLCODE != -955 THEN
         RAISE;
      END IF;
END;

/

insert into MANDANT( ID_MANDANT, Name ) values ( 1, 'Mandant 1' );
insert into MANDANT( ID_MANDANT, Name ) values ( 2, 'Mandant 2' );




DECLARE create_statement varchar( 1024 ) := '
CREATE TABLE BUCHUNGSKREIS (

  ID_MANDANT number(8) NOT NULL,
  ID_BUCHUNGSKREIS number(8) NOT NULL,
  Name varchar(70) NOT NULL,

  PRIMARY KEY ( ID_MANDANT, ID_BUCHUNGSKREIS )

)';
BEGIN
EXECUTE IMMEDIATE create_statement;
EXCEPTION
   WHEN OTHERS THEN
      IF SQLCODE != -955 THEN
         RAISE;
      END IF;
END;

/


insert into BUCHUNGSKREIS( ID_MANDANT, ID_BUCHUNGSKREIS, Name ) values ( 1, 1, 'Buchungskreis 1' );
insert into BUCHUNGSKREIS( ID_MANDANT, ID_BUCHUNGSKREIS, Name ) values ( 1, 2, 'Buchungskreis 2' );
insert into BUCHUNGSKREIS( ID_MANDANT, ID_BUCHUNGSKREIS, Name ) values ( 1, 3, 'Buchungskreis 3' );
insert into BUCHUNGSKREIS( ID_MANDANT, ID_BUCHUNGSKREIS, Name ) values ( 2, 1, 'Buchungskreis 1' );


