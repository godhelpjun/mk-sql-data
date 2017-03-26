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
#	read {PRENAMES|SURNAMES|STREETS|ZIPCODES} from <TEXTFILENAME>;
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
#	increment <FIELDNAME> depending from <FIELDLIST>;
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

include text = "

      CREATE TABLE IF NOT EXISTS ADRESSE (

	  ID_MANDANT          INT UNSIGNED NOT NULL,
	  ID_BUCHUNGSKREIS    INT UNSIGNED NOT NULL,
	  ID_ADRESSE    INT UNSIGNED NOT NULL,
	  ID_COUNTRY    INT UNSIGNED NOT NULL,
	  Name          VARCHAR( 200 ) NOT NULL,
	  Vorname       VARCHAR( 200 ) NOT NULL,
	  Strasse       VARCHAR( 200 ) NOT NULL,
	  Ort           VARCHAR( 200 ) NOT NULL,
	  PLZ           VARCHAR( 15 ) NOT NULL,
	  Telefon       VARCHAR( 35 ),

	  _Datetime_1	DATETIME,
	  _Datetime_2	DATETIME,
	  _Datetime_3	DATETIME,
	  _Datetime_4	DATETIME,
	  _Datetime_5	DATETIME,
	  _Datetime_6	DATETIME,
	  _Date_1 	DATE,
	  _Date_2	DATE,
	  _Date_3	DATE,
	  _Date_4	DATE,
	  _Date_5	DATE,
	  _Date_6	DATE,
	  _Time_1	TIME,
	  _Time_2	TIME,
	  _Time_3	TIME,
	  _Time_4	TIME,
	  _Time_5	TIME,
	  _Time_6	TIME,
	  _Float_1	FLOAT,
	  _Float_2	FLOAT,
	  _Int_1	INT,
	  _Bool_1	BOOL,
	  _Char_1	VARCHAR( 50 ),
	  _Char_2	VARCHAR( 150 ),
	  _IBAN_1	CHAR(22),
	  _BIC_1	CHAR(12),
	  _TINY_BLOB	TINYBLOB,
	  _MEDIUM_TEXT_1 MEDIUMTEXT,
	  _MEDIUM_TEXT_2 MEDIUMTEXT,
	  _YEAR_1	YEAR,
	  _YEAR_2	YEAR(4),	/* same as year */
	  _SET  	SET('a', 'b', 'c', 'd') ,
	  _ENUM_SIZE ENUM( 'x-small', 'small', 'medium', 'large', 'x-large'),
	  REVFIRST	DATETIME,
	  REVDATE 	DATETIME,
	  REVNAME	VARCHAR(50),
	  REVCREATOR	VARCHAR(50),

	  key( ID_MANDANT ),
	  key( ID_BUCHUNGSKREIS ),
	  key( Name, Vorname ),
	  key( Ort ),
	  primary key( ID_MANDANT, ID_BUCHUNGSKREIS, ID_ADRESSE ),
	  key( ID_ADRESSE )

      ) ENGINE = INNODB CHARACTER SET UTF8;


";

read prenames from "data/de-prenames.txt";
read surnames from "data/de-surnames.txt";
read streets from "data/de-streets.txt";
# zip codes have two columns!
read zipcodes from "data/de-zips.txt";
read text from "data/de-text.txt";

filename is "output/random-data.sql";

# delete all records from the table ADRESSE
delete clause for ADRESSE is "";
do delete from ADRESSE;

work on table ADRESSE;

start with record 0;

export 1000 records;

set REVDATE to sql "NOW( )";
set REVFIRST to randomized DATETIME IN PAST;
use REVCREATOR as surname;
use REVNAME as surname;

use PLZ as zipcode;
use Name as surname;
use Vorname as prename;
use Strasse as street;
use Ort as city;
use ID_ADRESSE as unique;
set ID_MANDANT to "1";
set ID_BUCHUNGSKREIS to "1";
# Germany is 83
set ID_COUNTRY to "83";

set Telefon to randomized phone;
set _Datetime_1 to randomized DATETIME ;
set _Datetime_2 to randomized DATETIME IN PAST;
set _Datetime_3 to randomized DATETIME IN PAST;
set _Datetime_4 to randomized DATETIME IN PAST;
set _Datetime_5 to randomized DATETIME IN PAST;
set _Datetime_6 to randomized DATETIME IN FUTURE;
set _Date_1 to randomized DATE IN PAST;
set _Date_2 to randomized DATE IN PAST;
set _Date_3 to randomized DATE IN PAST;
set _Date_4 to randomized DATE IN PAST;
set _Date_5 to randomized DATE IN PAST;
set _Date_6 to randomized DATE IN FUTURE;
set _Time_1 to randomized TIME IN FUTURE;
set _Time_2 to randomized TIME IN PAST;
set _Time_3 to randomized TIME IN PAST;
set _Time_4 to randomized TIME IN PAST;
set _Time_5 to randomized TIME IN PAST;
set _Time_6 to randomized TIME IN PAST;
set _Float_1 to randomized FLOAT ;
set _Float_2 to randomized FLOAT between 0.58 and 15.75;
set _Int_1 to randomized INT between 1 and 31000;
set _Bool_1 to randomized BOOLEAN ;
set _Char_1 to randomized Char between 0 and 50;
set _Char_2 to randomized Char between 0 and 150;
set _IBAN_1 to randomized IBAN;
set _BIC_1 to randomized BIC;
set _YEAR_1 to randomized INT between 1901 and 2155;
set _YEAR_2 to randomized INT between 1901 and 2155;

# MEDIUMTEXT stores up to 16777215 Bytes ( 16 MB )
# 64 KB = 65535 Bytes
# 32 KB = 32768 Bytes
# 16 KB = 16384 Bytes
#  8 KB = 8192 Bytes
#  4 KB = 4096 Bytes

set _MEDIUM_TEXT_1 to randomized Char between 0 and 8192;
set _MEDIUM_TEXT_2 to randomized Char between 0 and 4096;

run the export;

# now let us append american adress records

reset data;
reset code;
reset actions;

read prenames from "data/us-prenames.txt";
read surnames from "data/us-surnames.txt";
read streets from "data-us-streets.txt";
# zip codes have two columns!
read zipcodes from "data/us-zips.txt";
read text from "data/us-text.txt";

use PLZ as zipcode;
use Name as surname;
use Vorname as prename;
use Strasse as street;
use Ort as city;
use ID_ADRESSE as unique;
set ID_MANDANT to "1";
set ID_BUCHUNGSKREIS to "1";
# United States of America is 236
set ID_COUNTRY to "236";
set Telefon to randomized phone;

# append 1000 records to the export file

run the export;

