/*
#
#	SQL script file for mk-sql-data.php - mysql intefrface
#
# creates the tables fk_city and fk_address by a new user db2phpsite
#
*/
/*

create a user db2phpsite before you execute these statements!

mysql -u root -ppassword

create database db2phpsite;

use db2phpsite;

CREATE USER 'db2phpsite'@'localhost' IDENTIFIED BY 'db2phpsite';

GRANT ALL ON db2phpsite.* TO 'db2phpsite'@'localhost';

*/


create table IF NOT EXISTS fk_city (

  ID_CITY INT UNSIGNED NOT NULL,

  city varchar(255),
  country_id INT(5) NOT NULL,
  is_europe BOOLEAN NOT NULL,
  last_visit DATE,

    REVNAME                         CHAR(20)     NOT NULL ,
    REVDATE                         DATETIME        NOT NULL ,
    REVFIRST                        DATETIME        NOT NULL ,
    REVCREATOR                      CHAR(20)        NOT NULL,

  PRIMARY KEY ( ID_CITY )

) ENGINE=InnoDb CHARACTER SET utf8;

INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( 0, 'Berlin', 83, true, 'create-script', NOW(), NOW(), FROM_UNIXTIME(UNIX_TIMESTAMP( NOW() ) - FLOOR(0 + (RAND() * 63072000)) ), 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( 1, 'Altenburg', 83, true, 'create-script', NOW(), NOW(), FROM_UNIXTIME(UNIX_TIMESTAMP( NOW() ) - FLOOR(0 + (RAND() * 63072000)) ), 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( 2, 'Leipzig', 83, true, 'create-script', NOW(), NOW(), FROM_UNIXTIME(UNIX_TIMESTAMP( NOW() ) - FLOOR(0 + (RAND() * 63072000)) ), 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( 3, 'Erfurt', 83, true, 'create-script', NOW(), NOW(), FROM_UNIXTIME(UNIX_TIMESTAMP( NOW() ) - FLOOR(0 + (RAND() * 63072000)) ), 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( 4, 'Dresden', 83, true, 'create-script', NOW(), NOW(), FROM_UNIXTIME(UNIX_TIMESTAMP( NOW() ) - FLOOR(0 + (RAND() * 63072000)) ), 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( 5, 'Schmölln', 83, true, 'create-script', NOW(), NOW(), NULL, 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( 6, 'Gera', 83, true, 'create-script', NOW(), NOW(), FROM_UNIXTIME(UNIX_TIMESTAMP( NOW() ) - FLOOR(0 + (RAND() * 63072000)) ), 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( 7, 'Wilhelmshaven', 83, true, 'create-script', NOW(), NOW(), FROM_UNIXTIME(UNIX_TIMESTAMP( NOW() ) - FLOOR(0 + (RAND() * 63072000)) ), 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( 8, 'Bremen', 83, true, 'create-script', NOW(), NOW(), FROM_UNIXTIME(UNIX_TIMESTAMP( NOW() ) - FLOOR(0 + (RAND() * 63072000)) ), 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( 9, 'Bubesheim', 83, true, 'create-script', NOW(), NOW(), FROM_UNIXTIME(UNIX_TIMESTAMP( NOW() ) - FLOOR(0 + (RAND() * 63072000)) ), 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES (10, 'Mainz', 83, true, 'create-script', NOW(), NOW(), FROM_UNIXTIME(UNIX_TIMESTAMP( NOW() ) - FLOOR(0 + (RAND() * 63072000)) ), 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES (11, 'Bodenheim', 83, true, 'create-script', NOW(), NOW(), FROM_UNIXTIME(UNIX_TIMESTAMP( NOW() ) - FLOOR(0 + (RAND() * 63072000)) ), 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES (12, 'Budenheim', 83, true, 'create-script', NOW(), NOW(), NULL, 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES (13, 'Waltershausen', 83, true, 'create-script', NOW(), NOW(), FROM_UNIXTIME(UNIX_TIMESTAMP( NOW() ) - FLOOR(0 + (RAND() * 63072000)) ), 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES (14, 'München', 83, true, 'create-script', NOW(), NOW(), FROM_UNIXTIME(UNIX_TIMESTAMP( NOW() ) - FLOOR(0 + (RAND() * 63072000)) ), 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES (15, 'Günzburg', 83, true, 'create-script', NOW(), NOW(), FROM_UNIXTIME(UNIX_TIMESTAMP( NOW() ) - FLOOR(0 + (RAND() * 63072000)) ), 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES (16, 'Augsburg', 83, true, 'create-script', NOW(), NOW(), FROM_UNIXTIME(UNIX_TIMESTAMP( NOW() ) - FLOOR(0 + (RAND() * 63072000)) ), 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES (17, 'Hainsfeld', 83, true, 'create-script', NOW(), NOW(), FROM_UNIXTIME(UNIX_TIMESTAMP( NOW() ) - FLOOR(0 + (RAND() * 63072000)) ), 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES (18, 'New York', 236, false, 'create-script', NOW(), NOW(), FROM_UNIXTIME(UNIX_TIMESTAMP( NOW() ) - FLOOR(0 + (RAND() * 63072000)) ), 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES (19, 'London', 235, false, 'create-script', NOW(), NOW(), FROM_UNIXTIME(UNIX_TIMESTAMP( NOW() ) - FLOOR(0 + (RAND() * 63072000)) ), 'create-script' );



CREATE TABLE IF NOT EXISTS fk_address (

  ID_MANDANT INT UNSIGNED NOT NULL,
  ID_BUCHUNGSKREIS INT UNSIGNED NOT NULL,
  ID_ADDRESS INT UNSIGNED NOT NULL,

  ID_CITY INT UNSIGNED NOT NULL,
  ID_COUNTRY INT(6),

  Name VARCHAR(255),
  Vorname VARCHAR(255),

  PRIMARY KEY (ID_MANDANT, ID_BUCHUNGSKREIS, ID_ADDRESS ),
  FOREIGN KEY (ID_CITY) REFERENCES fk_city(ID_CITY)

) Engine = InnoDb CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS countries (

  country_id INT UNSIGNED NOT NULL,

  long_name VARCHAR(80),

  PRIMARY KEY ( country_id )

) Engine = InnoDb CHARACTER SET utf8;

insert into countries( country_id, long_name ) values (  83, 'Germany' );
insert into countries( country_id, long_name ) values (  84, 'Ghana' );
insert into countries( country_id, long_name ) values (  85, 'Gibraltar' );
insert into countries( country_id, long_name ) values ( 235, 'Great Britain' );
insert into countries( country_id, long_name ) values ( 236, 'United States' );


CREATE TABLE IF NOT EXISTS MANDANT (

  ID_MANDANT INT UNSIGNED NOT NULL,
  Name varchar(70) NOT NULL,

  PRIMARY KEY ( ID_MANDANT )

);

insert into MANDANT( ID_MANDANT, Name ) values ( 1, 'Mandant 1' );
insert into MANDANT( ID_MANDANT, Name ) values ( 2, 'Mandant 2' );

CREATE TABLE IF NOT EXISTS BUCHUNGSKREIS (

  ID_MANDANT INT UNSIGNED NOT NULL,
  ID_BUCHUNGSKREIS INT UNSIGNED NOT NULL,
  Name varchar(70) NOT NULL,

  PRIMARY KEY ( ID_MANDANT, ID_BUCHUNGSKREIS )

);


insert into BUCHUNGSKREIS( ID_MANDANT, ID_BUCHUNGSKREIS, Name ) values ( 1, 1, 'Buchungskreis 1' );
insert into BUCHUNGSKREIS( ID_MANDANT, ID_BUCHUNGSKREIS, Name ) values ( 1, 2, 'Buchungskreis 2' );
insert into BUCHUNGSKREIS( ID_MANDANT, ID_BUCHUNGSKREIS, Name ) values ( 1, 3, 'Buchungskreis 3' );
insert into BUCHUNGSKREIS( ID_MANDANT, ID_BUCHUNGSKREIS, Name ) values ( 2, 1, 'Buchungskreis 1' );






