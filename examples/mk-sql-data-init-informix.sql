/*
#
#	SQL script file for mk-sql-data.php - mysql intefrface
#
# creates the tables fk_city and fk_address by a new user db2phpsite
#
*/
/*

/etc/services
ol_informix1210          9088/tcp
dr_informix1210          9089/tcp
lo_informix1210          9090/tcp
ol_informix1210_json    27017/tcp

set environment variables in .bashrc


create a file $INFORMIXDIR/etc/sqlhost

craete new system user or adduser informix rs
adduser --ingroup informix db2phpsite


create a user db2phpsite before you execute these statements!

dbaccess
Connection->ol_informix1210->informix/informix->sysuser@ol_informix1210
SQL->New
CREATE DATABASE IF NOT EXISTS db2phpsite WITH LOG;
<Escape>->RUN
New->
CREATE USER 'db2phpsite' WITH PASSWORD 'db2phpsite' ;
ALTER USER 'db2phpsite' MODIFY AUTHORIZATION (dbsa);
DATABASE db2phpsite;
GRANT dba TO db2phpsite;
CONNECT TO 'db2phpsite@ol_informix1210' USER 'db2phpsite';
EXIT


create a file ifx_access.sql with the following content:

CONNECT TO 'db2phpsite@ol_informix1210' USER 'db2phpsite';


check your environment settings:
export PATH=$PATH:/opt/IBM/informix/bin/
export INFORMIXDIR=/opt/IBM/informix
export INFORMIXSQLHOSTS=/opt/IBM/informix/etc/sqlhosts
export INFORMIXSERVER=ol_informix1210
export CLIENT_LOCALE=DE_DE.8859-1

dbaccess - misc/ifx_access.sql mk-sql-data-init-informix.sql

*/


BEGIN WORK;

create table IF NOT EXISTS fk_city  (

  ID_CITY BIGINT  NOT NULL,
  city varchar(255),
  country_id BIGINT    NOT NULL,
  is_europe BOOLEAN NOT NULL,
  last_visit DATE,

    REVNAME                         CHAR(20)     NOT NULL ,
    REVDATE                         DATETIME YEAR TO FRACTION  NOT NULL ,
    REVFIRST                        DATETIME YEAR TO FRACTION  NOT NULL ,
    REVCREATOR                      CHAR(20)        NOT NULL,

  PRIMARY KEY ( ID_CITY )
) ;

delete from fk_city;


INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST,last_visit, REVCREATOR ) VALUES ( 0, 'Berlin', 83, 't', 'create-script', current, current, current, 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME,REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( 1, 'Altenburg',83, 't', 'create-script', current, current, current, 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( 2, 'Leipzig', 83, 't', 'create-script', current, current, current, 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( 3, 'Erfurt', 83, 't', 'create-script', current, current, current, 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( 4, 'Dresden', 83, 't', 'create-script', current, current, current, 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( 5, 'Schmölln', 83, 't', 'create-script', current, current, NULL, 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( 6, 'Gera', 83, 't', 'create-script', current, current, current, 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( 7, 'Wilhelmshaven', 83, 't', 'create-script', current, current, current, 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( 8, 'Bremen', 83, 't', 'create-script', current, current, current, 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( 9, 'Bubesheim', 83, 't', 'create-script', current, current, current, 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES (10, 'Mainz', 83, 't', 'create-script', current, current, current, 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES (11, 'Bodenheim', 83, 't', 'create-script', current, current, current, 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES (12, 'Budenheim', 83, 't', 'create-script', current, current, NULL, 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES (13, 'Waltershausen', 83, 't', 'create-script', current, current, current, 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES (14, 'München', 83, 't', 'create-script', current, current, current, 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES (15, 'Günzburg', 83, 't', 'create-script', current, current, current, 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES (16, 'Augsburg', 83, 't', 'create-script', current, current, current, 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES (17, 'Hainsfeld', 83, 't', 'create-script', current, current, current, 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES (18, 'New York', 236, 'f', 'create-script', current, current, current, 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES (19, 'London', 235, 'f', 'create-script', current, current, current, 'create-script' );



CREATE TABLE IF NOT EXISTS fk_address (

  ID_MANDANT BIGINT NOT NULL,
  ID_BUCHUNGSKREIS BIGINT NOT NULL,
  ID_ADDRESS BIGINT NOT NULL,

  ID_CITY BIGINT NOT NULL,
  ID_COUNTRY BIGINT,

  Name VARCHAR(255),
  Vorname VARCHAR(255),

  PRIMARY KEY (ID_MANDANT, ID_BUCHUNGSKREIS, ID_ADDRESS ),
  FOREIGN KEY (ID_CITY) REFERENCES fk_city(ID_CITY)

) ;

CREATE TABLE IF NOT EXISTS countries (

  country_id BIGINT NOT NULL,

  long_name VARCHAR(80),

  PRIMARY KEY ( country_id )

) ;

delete from countries;

insert into countries( country_id, long_name ) values (  83, 'Germany' );
insert into countries( country_id, long_name ) values (  84, 'Ghana' );
insert into countries( country_id, long_name ) values (  85, 'Gibraltar' );
insert into countries( country_id, long_name ) values ( 235, 'Great Britain' );
insert into countries( country_id, long_name ) values ( 236, 'United States' );



CREATE TABLE IF NOT EXISTS MANDANT (

  ID_MANDANT BIGINT NOT NULL,
  Name varchar(70) NOT NULL,

  PRIMARY KEY ( ID_MANDANT )

);

delete from MANDANT;

insert into MANDANT( ID_MANDANT, Name ) values ( 1, 'Mandant 1' );
insert into MANDANT( ID_MANDANT, Name ) values ( 2, 'Mandant 2' );

CREATE TABLE IF NOT EXISTS BUCHUNGSKREIS (

  ID_MANDANT BIGINT NOT NULL,
  ID_BUCHUNGSKREIS BIGINT NOT NULL,
  Name varchar(70) NOT NULL,

  PRIMARY KEY ( ID_MANDANT, ID_BUCHUNGSKREIS )

);

delete from BUCHUNGSKREIS;

insert into BUCHUNGSKREIS( ID_MANDANT, ID_BUCHUNGSKREIS, Name ) values ( 1, 1, 'Buchungskreis 1' );
insert into BUCHUNGSKREIS( ID_MANDANT, ID_BUCHUNGSKREIS, Name ) values ( 1, 2, 'Buchungskreis 2' );
insert into BUCHUNGSKREIS( ID_MANDANT, ID_BUCHUNGSKREIS, Name ) values ( 1, 3, 'Buchungskreis 3' );
insert into BUCHUNGSKREIS( ID_MANDANT, ID_BUCHUNGSKREIS, Name ) values ( 2, 1, 'Buchungskreis 1' );

COMMIT WORK;




