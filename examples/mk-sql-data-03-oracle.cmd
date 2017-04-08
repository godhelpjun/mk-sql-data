#
#	script file for mk-sql-data.php
#
# - comments start with '#'
# - any command ends with ';'
#
# the command list is case insensitive - file names and field names are case sensitive:
#
#	filename is "<FILENAME>";
#
#	include text = "<TEXT>";
#
#	delete for <TABLENAME> is "";
#	delete for <TABLENAME> is "where x1 = 15;"
#	delete for <TABLENAME> is "where ID_MANDANT in (select * from MANDANT where Name = 'Mandant 1');";
#
#	do delete from <TABLENAME;
#
#	work on table <TABLENAME>;
#
#	read {PRENAMES|SURNAMES|STREETS|ZIPCODES|TEXT} from <TEXTFILENAME>;
#		the files have 1 column zip except the file with the zipcodes, which has 2 columns
#		you can load more than one file per pattern. the new records will be added to the current ones
#
#	start with <RECORDNUMBER>;
#
#	export <RECORDCOUNT> records;
#
#	use <FIELDNAME> AS {PRENAME|SURNAME|STREET|ZIPCODE|UNIQUE};
#	set <FIELDNAME> TO <VALUE>;
#       set <FIELDNAME> TO  RANDOMIZED {DATE|DATETIME|TIME} [IN {PAST|FUTURE}]
#       set <FIELDNAME> TO  RANDOMIZED {PHONE|BLZ|IBAN|BIC}
#       set <FIELDNAME> TO  RANDOMIZED {FLOAT|INT|BOOL} [BETWEEN <VALUE>  AND <VALUE>];
#	set <FIELDNAME> TO  SQL "<SQLVALUE>";
#	fetch <FIELDNAME> using <SELECTSTATEMENT>;
#		you can define variables in <SELECTSTATEMENT> with the prefix ':'
#		<FIELDLIST> := {FIELDNAME} ','
#		<SELECTSTATEMENT> := <delimiter><SELECT_STATEMENT><delimiter>
#		<delimiter> := ' | " | `
#		<FIELDNAME> := <delimiter> <FIELD_NAME> <delimiter>
#		<TABLENAME> := <delimiter> <TABLE_NAME> <delimiter>
#
#	increment <FIELDNAME> depending on <FIELDLIST>;
#
#	dbparams = <delimiter> <localhost>,<schema_name>,<user_name>,<user_password>
#		will not be resetted after declaration!
#		necessary for fetch-commands
#
#	run the export;
#
#	# reset the arrays with the imported data
#	reset data - the names, prenames, zips, cities etc
#
#	# reset the earlier defined per row actions ( use, set ) up to the last RUN THE EXPORT
#	reset actions
#
#	# reset code we included - the sql code written before
#	reset code
#

database  provider is "ORACLE";

include text = "

DECLARE create_statement varchar( 4096 ) := '
      CREATE TABLE ADRESSE (

	  ID_MANDANT          NUMBER(6) NOT NULL,
	  ID_BUCHUNGSKREIS    NUMBER(6) NOT NULL,
	  ID_ADRESSE    NUMBER(6) NOT NULL,
	  ID_COUNTRY    NUMBER(6) NOT NULL,
	  Name          VARCHAR( 200 ) NOT NULL,
	  Vorname       VARCHAR( 200 ) NOT NULL,
	  Strasse       VARCHAR( 200 ) NOT NULL,
	  Ort           VARCHAR( 200 ) NOT NULL,
	  PLZ           VARCHAR( 15 ) NOT NULL,
	  Telefon       VARCHAR( 35 ),

	  Datetime_1	DATE,
	  Datetime_2	DATE,
	  Datetime_3	DATE,
	  Datetime_4	DATE,
	  Datetime_5	DATE,
	  Datetime_6	DATE,

	  Date_1 	DATE,
	  Date_2	DATE,
	  Date_3	DATE,
	  Date_4	DATE,
	  Date_5	DATE,
	  Date_6	DATE,

	  Time_1	DATE,
	  Time_2	DATE,
	  Time_3	DATE,
	  Time_4	DATE,
	  Time_5	DATE,
	  Time_6	DATE,

	  Float_1	 FLOAT,
	  Float_2	 FLOAT,


	  Int_1		 NUMBER(6),

	  Bool_1	NUMBER(1),

	  Char_1	VARCHAR( 50 ),
	  Char_2	VARCHAR( 150 ),

	  IBAN_1	CHAR(23),
	  BIC_1	CHAR(12),
	  TINY_BLOB	BLOB,
	  MEDIUM_TEXT_1 CLOB,
	  MEDIUM_TEXT_2 CLOB,
	  YEAR_1	NUMBER(4),
	  YEAR_2	NUMBER(4),	/* same as year */
	  SET_  	VARCHAR2(255),
	  ENUM_SIZE    VARCHAR2(255),
	  REVFIRST	DATE,
	  REVDATE 	DATE,
	  REVNAME	VARCHAR(50),
	  REVCREATOR	VARCHAR(50),

	  -- key( ID_MANDANT ),
	  -- key( ID_BUCHUNGSKREIS ),
	  -- key( Name, Vorname ),
	  -- key( Ort ),
	  primary key( ID_MANDANT, ID_BUCHUNGSKREIS, ID_ADRESSE ),
	  unique( ID_ADRESSE )

      ) ;

      create index adresse_id_mandant on ADRESSE( ID_MANDANT );
      create index adresse_id_buchungskreis on ADRESSE( ID_BUCHUNGSKREIS );
      create index adresse_name_vorname on ADRESSE( Name, Vorname );
      create index adresse_ort on ADRESSE( Ort );
'
BEGIN
EXECUTE IMMEDIATE create_statement;
EXCEPTION
   WHEN OTHERS THEN
      IF SQLCODE != -955 THEN
         RAISE;
      END IF;
END;

/

";

read prenames from "data/de-prenames.txt";
read surnames from "data/de-surnames.txt";
read streets from "data/de-streets.txt";
# zip codes have two columns!
read zipcodes from "data/de-zips.txt";
read text from "data/de-text.txt";

filename is "output/random-data-oracle.sql";

# delete all records from the table ADRESSE
delete clause for "ADRESSE" is "";
do delete from "ADRESSE";

work on table "ADRESSE";

PRIMARY KEY IS " ID_MANDANT, ID_BUCHUNGSKREIS, ID_ADRESSE ";

start with record 0;

export 50 records;

set "REVDATE"  to sql "SYSDATE";
set "REVFIRST" to randomized DATETIME IN PAST;
use "REVCREATOR" as surname;
use "REVNAME" as surname;

use "PLZ" as zipcode;
use "Name" as surname;
use "Vorname" as prename;
use "Strasse" as street;
use Ort as city;
use ID_ADRESSE as unique;

set "ID_MANDANT" to "1";
set "ID_BUCHUNGSKREIS" to "1";
# Germany is 83
set "ID_COUNTRY" to "83";

set "Telefon" to randomized phone;
set "Datetime_1" to randomized DATETIME ;
set "Datetime_2" to randomized DATETIME IN PAST;
set "Datetime_3" to randomized DATETIME IN PAST;
set "Datetime_4" to randomized DATETIME IN PAST;
set "Datetime_5" to randomized DATETIME IN PAST;
set "Datetime_6" to randomized DATETIME IN FUTURE;
set "Date_1" to randomized DATE IN PAST;
set "Date_2" to randomized DATE IN PAST;
set "Date_3" to randomized DATE IN PAST;
set "Date_4" to randomized DATE IN PAST;
set "Date_5" to randomized DATE IN PAST;
set "Date_6" to randomized DATE IN FUTURE;
set "Time_1" to randomized TIME IN FUTURE;
set "Time_2" to randomized TIME IN PAST;
set "Time_3" to randomized TIME IN PAST;
set "Time_4" to randomized TIME IN PAST;
set "Time_5" to randomized TIME IN PAST;
set "Time_6" to randomized TIME IN PAST;
set "Float_1" to randomized FLOAT ;
set "Float_2" to randomized FLOAT between 0.58 and 15.75;
set "Int_1" to randomized INT between 1 and 31000;
set "Bool_1" to randomized BOOLEAN ;
set "Char_1" to randomized Char between 0 and 50;
set "Char_2" to randomized Char between 0 and 150;
set "IBAN_1" to randomized IBAN;
set "BIC_1" to randomized BIC;
set "YEAR_1" to randomized INT between 1901 and 2155;
set "YEAR_2" to randomized INT between 1901 and 2155;

# MEDIUMTEXT stores up to 16777215 Bytes ( 16 MB )
# 64 KB = 65535 Bytes
# 32 KB = 32768 Bytes
# 16 KB = 16384 Bytes
#  8 KB = 8192 Bytes
#  4 KB = 4096 Bytes

set "MEDIUM_TEXT_1" to randomized Char between 0 and 8192;
set "MEDIUM_TEXT_2" to randomized Char between 0 and 4096;

run the export;

# now let us append american adress records

reset data;
reset code;
reset actions;

read prenames from "data/us-prenames.txt";
read surnames from "data/us-surnames.txt";
read streets from "data/us-streets.txt";
# zip codes have two columns!
read zipcodes from "data/us-zips.txt";
read text from "data/us-text.txt";

use PLZ as zipcode;
use Name as surname;
use Vorname as prename;
use Strasse as street;
use Ort as city;
use ID_ADRESSE as unique;

set "ID_MANDANT" to "1";
set "ID_BUCHUNGSKREIS" to "1";
# United States of America is 236
set "ID_COUNTRY" to "236";
set "Telefon" to randomized phone;

# append American records to the export file

run the export;

