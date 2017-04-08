/*

    initialize a db2 database for the use with MK-SQL-DATA

*/

echo Connecting to the database;

CONNECT TO phpsite USER db2phpsite USING db2phpsite;

-- disable auto commit
-- UPDATE COMMAND OPTIONS USING c OFF;

SET SERVEROUTPUT ON;

SET SQLCOMPAT PLSQL;

-- check if table exists - if not, then create table and fill it with values
/
BEGIN
--
    DECLARE v_tbl_cnt INT;
    DECLARE statement VARCHAR( 4096 );
    --
    DECLARE ID_CITY BIGINT;
    DECLARE city VARCHAR( 255 );
    DECLARE country_id BIGINT;
    DECLARE REVNAME CHAR( 20 ) ;
    DECLARE REVCREATOR CHAR( 20 ) ;

    BEGIN

	select count(1) into v_tbl_cnt
	from sysibm.systables
	where
	creator = 'DB2PHPSITE' and
	type = 'T' and
	name = 'FK_CITY';

	IF (v_tbl_cnt = 0) THEN

	    SET statement = 'CREATE TABLE fk_city ( ID_CITY BIGINT NOT NULL, city varchar(255), country_id BIGINT NOT NULL, is_europe BOOLEAN NOT NULL, last_visit DATE, REVNAME CHAR(20) NOT NULL , REVDATE TIMESTAMP NOT NULL , REVFIRST TIMESTAMP NOT NULL , REVCREATOR CHAR(20) NOT NULL, PRIMARY KEY( ID_CITY ) )  CCSID UNICODE';

	    EXECUTE IMMEDIATE statement ;

	    SET ID_CITY = 0; SET city = chr(39) || 'Berlin' || chr(39); SET country_id = 83; SET REVNAME = chr(39) || 'create-script' || chr(39); SET REVCREATOR = chr(39) || 'create-script' || chr(39);
	    SET statement = 'INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( ' || ID_CITY || ', ' || city ||', ' || country_id || ', true, ' || REVNAME || ', CURRENT DATE, CURRENT DATE, CURRENT DATE, ' || REVCREATOR || ' )';
	    EXECUTE IMMEDIATE statement;

	    SET ID_CITY = 1; SET city = chr(39) || 'Altenburg' || chr(39); SET country_id = 83; SET REVNAME = chr(39) || 'create-script' || chr(39); SET REVCREATOR = chr(39) || 'create-script' || chr(39);
	    SET statement = 'INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( ' || ID_CITY || ', ' || city ||', ' || country_id || ', true, ' || REVNAME || ', CURRENT DATE, CURRENT DATE, CURRENT DATE, ' || REVCREATOR || ' )';
	    EXECUTE IMMEDIATE statement;

	    SET ID_CITY = 2; SET city = chr(39) || 'Leipzig' || chr(39); SET country_id = 83; SET REVNAME = chr(39) || 'create-script' || chr(39); SET REVCREATOR = chr(39) || 'create-script' || chr(39);
	    SET statement = 'INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( ' || ID_CITY || ', ' || city ||', ' || country_id || ', true, ' || REVNAME || ', CURRENT DATE, CURRENT DATE, CURRENT DATE, ' || REVCREATOR || ' )';
	    EXECUTE IMMEDIATE statement;

	    SET ID_CITY = 3; SET city = chr(39) || 'Erfurt' || chr(39); SET country_id = 83; SET REVNAME = chr(39) || 'create-script' || chr(39); SET REVCREATOR = chr(39) || 'create-script' || chr(39);
	    SET statement = 'INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( ' || ID_CITY || ', ' || city ||', ' || country_id || ', true, ' || REVNAME || ', CURRENT DATE, CURRENT DATE, CURRENT DATE, ' || REVCREATOR || ' )';
	    EXECUTE IMMEDIATE statement;

	    SET ID_CITY = 4; SET city = chr(39) || 'Dresden' || chr(39); SET country_id = 83; SET REVNAME = chr(39) || 'create-script' || chr(39); SET REVCREATOR = chr(39) || 'create-script' || chr(39);
	    SET statement = 'INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( ' || ID_CITY || ', ' || city ||', ' || country_id || ', true, ' || REVNAME || ', CURRENT DATE, CURRENT DATE, CURRENT DATE, ' || REVCREATOR || ' )';
	    EXECUTE IMMEDIATE statement;

	    SET ID_CITY = 5; SET city = chr(39) || 'Schmölln' || chr(39); SET country_id = 83; SET REVNAME = chr(39) || 'create-script' || chr(39); SET REVCREATOR = chr(39) || 'create-script' || chr(39);
	    SET statement = 'INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( ' || ID_CITY || ', ' || city ||', ' || country_id || ', true, ' || REVNAME || ', CURRENT DATE, CURRENT DATE, CURRENT DATE, ' || REVCREATOR || ' )';
	    EXECUTE IMMEDIATE statement;

	    SET ID_CITY = 6; SET city = chr(39) || 'Gera' || chr(39); SET country_id = 83; SET REVNAME = chr(39) || 'create-script' || chr(39); SET REVCREATOR = chr(39) || 'create-script' || chr(39);
	    SET statement = 'INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( ' || ID_CITY || ', ' || city ||', ' || country_id || ', true, ' || REVNAME || ', CURRENT DATE, CURRENT DATE, CURRENT DATE, ' || REVCREATOR || ' )';
	    EXECUTE IMMEDIATE statement;

	    SET ID_CITY = 7; SET city = chr(39) || 'Wilhelmshaven' || chr(39); SET country_id = 83; SET REVNAME = chr(39) || 'create-script' || chr(39); SET REVCREATOR = chr(39) || 'create-script' || chr(39);
	    SET statement = 'INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( ' || ID_CITY || ', ' || city ||', ' || country_id || ', true, ' || REVNAME || ', CURRENT DATE, CURRENT DATE, CURRENT DATE, ' || REVCREATOR || ' )';
	    EXECUTE IMMEDIATE statement;

	    SET ID_CITY = 8; SET city = chr(39) || 'Bremen' || chr(39); SET country_id = 83; SET REVNAME = chr(39) || 'create-script' || chr(39); SET REVCREATOR = chr(39) || 'create-script' || chr(39);
	    SET statement = 'INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( ' || ID_CITY || ', ' || city ||', ' || country_id || ', true, ' || REVNAME || ', CURRENT DATE, CURRENT DATE, CURRENT DATE, ' || REVCREATOR || ' )';
	    EXECUTE IMMEDIATE statement;

	    SET ID_CITY = 9; SET city = chr(39) || 'Bubesheim' || chr(39); SET country_id = 83; SET REVNAME = chr(39) || 'create-script' || chr(39); SET REVCREATOR = chr(39) || 'create-script' || chr(39);
	    SET statement = 'INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( ' || ID_CITY || ', ' || city ||', ' || country_id || ', true, ' || REVNAME || ', CURRENT DATE, CURRENT DATE, CURRENT DATE, ' || REVCREATOR || ' )';
	    EXECUTE IMMEDIATE statement;

	    SET ID_CITY =10; SET city = chr(39) || 'Mainz' || chr(39); SET country_id = 83; SET REVNAME = chr(39) || 'create-script' || chr(39); SET REVCREATOR = chr(39) || 'create-script' || chr(39);
	    SET statement = 'INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( ' || ID_CITY || ', ' || city ||', ' || country_id || ', true, ' || REVNAME || ', CURRENT DATE, CURRENT DATE, CURRENT DATE, ' || REVCREATOR || ' )';
	    EXECUTE IMMEDIATE statement;

	    SET ID_CITY =11; SET city = chr(39) || 'Bodenheim' || chr(39); SET country_id = 83; SET REVNAME = chr(39) || 'create-script' || chr(39); SET REVCREATOR = chr(39) || 'create-script' || chr(39);
	    SET statement = 'INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( ' || ID_CITY || ', ' || city ||', ' || country_id || ', true, ' || REVNAME || ', CURRENT DATE, CURRENT DATE, CURRENT DATE, ' || REVCREATOR || ' )';
	    EXECUTE IMMEDIATE statement;

	    SET ID_CITY =12; SET city = chr(39) || 'Budenheim' || chr(39); SET country_id = 83; SET REVNAME = chr(39) || 'create-script' || chr(39); SET REVCREATOR = chr(39) || 'create-script' || chr(39);
	    SET statement = 'INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( ' || ID_CITY || ', ' || city ||', ' || country_id || ', true, ' || REVNAME || ', CURRENT DATE, CURRENT DATE, CURRENT DATE, ' || REVCREATOR || ' )';
	    EXECUTE IMMEDIATE statement;

	    SET ID_CITY =13; SET city = chr(39) || 'Waltershausen' || chr(39); SET country_id = 83; SET REVNAME = chr(39) || 'create-script' || chr(39); SET REVCREATOR = chr(39) || 'create-script' || chr(39);
	    SET statement = 'INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( ' || ID_CITY || ', ' || city ||', ' || country_id || ', true, ' || REVNAME || ', CURRENT DATE, CURRENT DATE, CURRENT DATE, ' || REVCREATOR || ' )';
	    EXECUTE IMMEDIATE statement;

	    SET ID_CITY =14; SET city = chr(39) || 'München' || chr(39); SET country_id = 83; SET REVNAME = chr(39) || 'create-script' || chr(39); SET REVCREATOR = chr(39) || 'create-script' || chr(39);
	    SET statement = 'INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( ' || ID_CITY || ', ' || city ||', ' || country_id || ', true, ' || REVNAME || ', CURRENT DATE, CURRENT DATE, CURRENT DATE, ' || REVCREATOR || ' )';
	    EXECUTE IMMEDIATE statement;

	    SET ID_CITY =15; SET city = chr(39) || 'Günzburg' || chr(39); SET country_id = 83; SET REVNAME = chr(39) || 'create-script' || chr(39); SET REVCREATOR = chr(39) || 'create-script' || chr(39);
	    SET statement = 'INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( ' || ID_CITY || ', ' || city ||', ' || country_id || ', true, ' || REVNAME || ', CURRENT DATE, CURRENT DATE, CURRENT DATE, ' || REVCREATOR || ' )';
	    EXECUTE IMMEDIATE statement;

	    SET ID_CITY =16; SET city = chr(39) || 'Augsburg' || chr(39); SET country_id = 83; SET REVNAME = chr(39) || 'create-script' || chr(39); SET REVCREATOR = chr(39) || 'create-script' || chr(39);
	    SET statement = 'INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( ' || ID_CITY || ', ' || city ||', ' || country_id || ', true, ' || REVNAME || ', CURRENT DATE, CURRENT DATE, CURRENT DATE, ' || REVCREATOR || ' )';
	    EXECUTE IMMEDIATE statement;

	    SET ID_CITY =17;  SET city = chr(39) || 'Hainsfeld' || chr(39); SET country_id = 83; SET REVNAME = chr(39) || 'create-script' || chr(39); SET REVCREATOR = chr(39) || 'create-script' || chr(39);
	    SET statement = 'INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( ' || ID_CITY || ', ' || city ||', ' || country_id || ', true, ' || REVNAME || ', CURRENT DATE, CURRENT DATE, CURRENT DATE, ' || REVCREATOR || ' )';
	    EXECUTE IMMEDIATE statement;

	    SET ID_CITY =18; SET city = chr(39) || 'New York' || chr(39); SET country_id = 236; SET REVNAME = chr(39) || 'create-script' || chr(39); SET REVCREATOR = chr(39) || 'create-script' || chr(39);
	    SET statement = 'INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( ' || ID_CITY || ', ' || city ||', ' || country_id || ', true, ' || REVNAME || ', CURRENT DATE, CURRENT DATE, CURRENT DATE, ' || REVCREATOR || ' )';
	    EXECUTE IMMEDIATE statement;

	    SET ID_CITY =19; SET city = chr(39) || 'London' || chr(39); SET country_id = 235; SET REVNAME = chr(39) || 'create-script' || chr(39); SET REVCREATOR = chr(39) || 'create-script' || chr(39);
	    SET statement = 'INSERT INTO fk_city (ID_CITY, city, country_id, is_europe, REVNAME, REVDATE, REVFIRST, last_visit, REVCREATOR ) VALUES ( ' || ID_CITY || ', ' || city ||', ' || country_id || ', true, ' || REVNAME || ', CURRENT DATE, CURRENT DATE, CURRENT DATE, ' || REVCREATOR || ' )';
	    EXECUTE IMMEDIATE statement;



	END IF;


    END;

END
/


/
BEGIN
--
    DECLARE v_tbl_cnt INT;
    DECLARE statement VARCHAR( 4096 );

    BEGIN

	select count(1) into v_tbl_cnt
	from sysibm.systables
	where
	creator = 'DB2PHPSITE' and
	type = 'T' and
	name = 'FK_ADDRESS';

	IF (v_tbl_cnt = 0) THEN

	    SET statement = 'CREATE TABLE fk_address (ID_MANDANT BIGINT NOT NULL, ID_BUCHUNGSKREIS BIGINT NOT NULL,  ID_ADDRESS BIGINT NOT NULL,  ID_CITY BIGINT NOT NULL,  ID_COUNTRY BIGINT,  Name VARCHAR(255),  Vorname VARCHAR(255),  PRIMARY KEY (ID_MANDANT, ID_BUCHUNGSKREIS, ID_ADDRESS ),  FOREIGN KEY (ID_CITY) REFERENCES fk_city(ID_CITY)) ';

	    EXECUTE IMMEDIATE statement ;

	END IF;


    END;

END
/


/
BEGIN
--
    DECLARE v_tbl_cnt INT;
    DECLARE statement VARCHAR( 4096 );
    --
    DECLARE country_id BIGINT;
    DECLARE long_name VARCHAR( 80 ) ;

    BEGIN

	select count(1) into v_tbl_cnt
	from sysibm.systables
	where
	creator = 'DB2PHPSITE' and
	type = 'T' and
	name = 'COUNTRIES';

	IF (v_tbl_cnt = 0) THEN

	    SET statement = 'CREATE TABLE countries ( country_id BIGINT NOT NULL,  long_name VARCHAR(80),  PRIMARY KEY ( country_id ) ) ';

	    EXECUTE IMMEDIATE statement ;


	  SET country_id = 83; SET long_name = chr(39) ||  'Germany' || chr(39);
	  SET statement = 'insert into countries( country_id, long_name ) values ( ' || country_id || ', ' || long_name || ' )';
	  EXECUTE IMMEDIATE statement;

	  SET country_id = 84; SET long_name = chr(39) ||  'Ghana' || chr(39);
	  SET statement = 'insert into countries( country_id, long_name ) values ( ' || country_id || ', ' || long_name || ' )';
	  EXECUTE IMMEDIATE statement;


	  SET country_id = 85; SET long_name = chr(39) ||  'Gibraltar' || chr(39);
	  SET statement = 'insert into countries( country_id, long_name ) values ( ' || country_id || ', ' || long_name || ' )';
	  EXECUTE IMMEDIATE statement;

	  SET country_id = 235; SET long_name = chr(39) ||  'Great Britain' || chr(39);
	  SET statement = 'insert into countries( country_id, long_name ) values ( ' || country_id || ', ' || long_name || ' )';
	  EXECUTE IMMEDIATE statement;

	  SET country_id = 236; SET long_name = chr(39) ||  'United States' || chr(39);
	  SET statement = 'insert into countries( country_id, long_name ) values ( ' || country_id || ', ' || long_name || ' )';
	  EXECUTE IMMEDIATE statement;



	END IF;


    END;

END
/

/
BEGIN
--
    DECLARE v_tbl_cnt INT;
    DECLARE statement VARCHAR( 4096 );
    --
    DECLARE ID_MANDANT BIGINT;
    DECLARE Name VARCHAR( 70 ) ;

    BEGIN

	select count(1) into v_tbl_cnt
	from sysibm.systables
	where
	creator = 'DB2PHPSITE' and
	type = 'T' and
	name = 'MANDANT';

	IF (v_tbl_cnt = 0) THEN

	    SET statement = 'CREATE TABLE MANDANT ( ID_MANDANT BIGINT NOT NULL, Name varchar(70) NOT NULL,  PRIMARY KEY ( ID_MANDANT ))';

	    EXECUTE IMMEDIATE statement ;


	  SET ID_MANDANT = 1; SET Name = chr(39) ||  'Mandant 1' || chr(39);
	  SET statement = 'insert into MANDANT( ID_MANDANT, Name ) values ( ' || ID_MANDANT || ', ' || Name || ' )';
	  EXECUTE IMMEDIATE statement;

	  SET ID_MANDANT = 2; SET Name = chr(39) ||  'Mandant 2' || chr(39);
	  SET statement = 'insert into MANDANT( ID_MANDANT, Name ) values ( ' || ID_MANDANT || ', ' || Name || ' )';
	  EXECUTE IMMEDIATE statement;



	END IF;


    END;

END
/


/
BEGIN
--
    DECLARE v_tbl_cnt INT;
    DECLARE statement VARCHAR( 4096 );
    --
    DECLARE ID_MANDANT BIGINT;
    DECLARE ID_BUCHUNGSKREIS BIGINT;
    DECLARE Name VARCHAR( 70 ) ;

    BEGIN

	select count(1) into v_tbl_cnt
	from sysibm.systables
	where
	creator = 'DB2PHPSITE' and
	type = 'T' and
	name = 'BUCHUNGSKREIS';

	IF (v_tbl_cnt = 0) THEN

	    SET statement = 'CREATE TABLE BUCHUNGSKREIS ( ID_BUCHUNGSKREIS BIGINT NOT NULL, ID_MANDANT BIGINT NOT NULL, Name varchar(70) NOT NULL,  PRIMARY KEY ( ID_MANDANT, ID_BUCHUNGSKREIS ))';

	    EXECUTE IMMEDIATE statement ;


	  SET ID_MANDANT = 1; SET ID_BUCHUNGSKREIS = 1; SET Name = chr(39) ||  'Buchungskreis 1' || chr(39);
	  SET statement = 'insert into BUCHUNGSKREIS( ID_MANDANT, ID_BUCHUNGSKREIS, Name ) values ( ' || ID_MANDANT || ', ' || ID_BUCHUNGSKREIS || ', ' || Name || ' )';
	  EXECUTE IMMEDIATE statement;

	  SET ID_MANDANT = 1; SET ID_BUCHUNGSKREIS = 2; SET Name = chr(39) ||  'Buchungskreis 2' || chr(39);
	  SET statement = 'insert into BUCHUNGSKREIS( ID_MANDANT, ID_BUCHUNGSKREIS, Name ) values ( ' || ID_MANDANT || ', ' || ID_BUCHUNGSKREIS || ', ' || Name || ' )';
	  EXECUTE IMMEDIATE statement;

	  SET ID_MANDANT = 1; SET ID_BUCHUNGSKREIS = 3; SET Name = chr(39) ||  'Buchungskreis 3' || chr(39);
	  SET statement = 'insert into BUCHUNGSKREIS( ID_MANDANT, ID_BUCHUNGSKREIS, Name ) values ( ' || ID_MANDANT || ', ' || ID_BUCHUNGSKREIS || ', ' || Name || ' )';
	  EXECUTE IMMEDIATE statement;

	  SET ID_MANDANT = 2; SET ID_BUCHUNGSKREIS = 1; SET Name = chr(39) ||  'Buchungskreis 1' || chr(39);
	  SET statement = 'insert into BUCHUNGSKREIS( ID_MANDANT, ID_BUCHUNGSKREIS, Name ) values ( ' || ID_MANDANT || ', ' || ID_BUCHUNGSKREIS || ', ' || Name || ' )';
	  EXECUTE IMMEDIATE statement;


	END IF;


    END;

END
/


