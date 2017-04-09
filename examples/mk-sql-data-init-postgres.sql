/*
#
#	SQL script file for mk-sql-data.php - postgresql intefrface
#
# creates the tables fk_city and fk_address 	
#
*/


create table IF NOT EXISTS fk_city (

  ID_CITY INT NOT NULL,

  city varchar(255),
  country_id INT NOT NULL,
  is_europe BOOLEAN NOT NULL,
  last_visit DATE,

    REVNAME                         CHAR(20)     NOT NULL ,
    REVDATE                         TIMESTAMP        NOT NULL ,
    REVFIRST                        TIMESTAMP        NOT NULL ,
    REVCREATOR                      CHAR(20)        NOT NULL,

  PRIMARY KEY ( ID_CITY )

) ;

INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( 0, 'Berlin', 83, true, 'create-script', NOW(), NOW(), NOW(), 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( 1, 'Altenburg', 83, true, 'create-script', NOW(), NOW(), NOW(), 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( 2, 'Leipzig', 83, true, 'create-script', NOW(), NOW(), NOW(), 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( 3, 'Erfurt', 83, true, 'create-script', NOW(), NOW(), NOW(), 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( 4, 'Dresden', 83, true, 'create-script', NOW(), NOW(), NOW(), 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( 5, 'Schmölln', 83, true, 'create-script', NOW(), NOW(), NULL, 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( 6, 'Gera', 83, true, 'create-script', NOW(), NOW(), NOW(), 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( 7, 'Wilhelmshaven', 83, true, 'create-script', NOW(), NOW(), NOW(), 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( 8, 'Bremen', 83, true, 'create-script', NOW(), NOW(), NOW(), 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( 9, 'Bubesheim', 83, true, 'create-script', NOW(), NOW(), NOW(), 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES (10, 'Mainz', 83, true, 'create-script', NOW(), NOW(), NOW(), 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES (11, 'Bodenheim', 83, true, 'create-script', NOW(), NOW(), NOW(), 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES (12, 'Budenheim', 83, true, 'create-script', NOW(), NOW(), NULL, 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES (13, 'Waltershausen', 83, true, 'create-script', NOW(), NOW(), NOW(), 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES (14, 'München', 83, true, 'create-script', NOW(), NOW(), NOW(), 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES (15, 'Günzburg', 83, true, 'create-script', NOW(), NOW(), NOW(), 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES (16, 'Augsburg', 83, true, 'create-script', NOW(), NOW(), NOW(), 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES (17, 'Hainsfeld', 83, true, 'create-script', NOW(), NOW(), NOW(), 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES (18, 'New York', 236, false, 'create-script', NOW(), NOW(), NOW(), 'create-script' );
INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES (19, 'London', 235, false, 'create-script', NOW(), NOW(), NOW(), 'create-script' );



CREATE TABLE IF NOT EXISTS fk_address (

  ID_MANDANT INT NOT NULL,
  ID_BUCHUNGSKREIS INT NOT NULL,
  ID_ADDRESS INT NOT NULL,

  ID_CITY INT NOT NULL,
  ID_COUNTRY INT,

  Name VARCHAR(255),
  Vorname VARCHAR(255),

  PRIMARY KEY (ID_MANDANT, ID_BUCHUNGSKREIS, ID_ADDRESS ),
  FOREIGN KEY (ID_CITY) REFERENCES fk_city(ID_CITY)

) ;

CREATE TABLE IF NOT EXISTS countries (

  country_id INT NOT NULL,

  long_name VARCHAR(80),

  PRIMARY KEY ( country_id )

) ;

insert into countries( country_id, long_name ) values (  83, 'Germany' );
insert into countries( country_id, long_name ) values (  84, 'Ghana' );
insert into countries( country_id, long_name ) values (  85, 'Gibraltar' );
insert into countries( country_id, long_name ) values ( 235, 'Great Britain' );
insert into countries( country_id, long_name ) values ( 236, 'United States' );


CREATE TABLE IF NOT EXISTS MANDANT (

  ID_MANDANT INT NOT NULL,
  Name varchar(70) NOT NULL,

  PRIMARY KEY ( ID_MANDANT )

);

insert into MANDANT( ID_MANDANT, Name ) values ( 1, 'Mandant 1' );
insert into MANDANT( ID_MANDANT, Name ) values ( 2, 'Mandant 2' );

CREATE TABLE IF NOT EXISTS BUCHUNGSKREIS (

  ID_MANDANT INT NOT NULL,
  ID_BUCHUNGSKREIS INT NOT NULL,
  Name varchar(70) NOT NULL,

  PRIMARY KEY ( ID_MANDANT, ID_BUCHUNGSKREIS )

);


insert into BUCHUNGSKREIS( ID_MANDANT, ID_BUCHUNGSKREIS, Name ) values ( 1, 1, 'Buchungskreis 1' );
insert into BUCHUNGSKREIS( ID_MANDANT, ID_BUCHUNGSKREIS, Name ) values ( 1, 2, 'Buchungskreis 2' );
insert into BUCHUNGSKREIS( ID_MANDANT, ID_BUCHUNGSKREIS, Name ) values ( 1, 3, 'Buchungskreis 3' );
insert into BUCHUNGSKREIS( ID_MANDANT, ID_BUCHUNGSKREIS, Name ) values ( 2, 1, 'Buchungskreis 1' );






