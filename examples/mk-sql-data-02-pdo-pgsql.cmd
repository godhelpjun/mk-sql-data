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


########################################################################

PDO interface is active;
dbparams = "pgsql:host=192.168.1.66 dbname=db2phpsite,db2phpsite,db2phpsite,db2phpsite";

include text = "

CREATE TABLE IF NOT EXISTS fk_city  (

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

";

# first we add records to fk_city

reset data;
reset code;
reset actions;

filename is "output/random-fk-pdo-pgsql.sql";

read surnames from "data/de-surnames.txt";
read prenames from "data/de-prenames.txt";
read streets from "data/de-streets.txt";
# zip codes have two columns!
read zipcodes from "data/de-zips.txt";
read text from "data/de-text.txt";

# delete all records from the table fk_address
delete clause for fk_address is "";
do delete from fk_address;

# delete all records from the table fk_city
delete clause for fk_city is "";
do delete from fk_city;

work on table fk_city;

start with record 0;

export 150 records;

use ID_CITY as unique;
use city as city;
use REVNAME as surname ;
use REVCREATOR as surname ;

set is_europe to "1";
set last_visit to randomized DATE IN PAST;
set REVDATE to randomized DATETIME IN PAST;
set REVFIRST to randomized DATETIME IN PAST;

fetch 'country_id' using `select country_id from countries`;

run the export;

# then we add records to fk_address

# reset data; - we need the data
reset code;
reset actions;

work on table fk_address;

start with record 0;

export 50 records;

use Name as surname;
use Vorname as prename;

fetch 'ID_MANDANT,ID_BUCHUNGSKREIS' using "select ID_MANDANT,ID_BUCHUNGSKREIS from BUCHUNGSKREIS";
fetch 'ID_COUNTRY' using 'select country_id from countries';
fetch 'ID_CITY' using `select ID_CITY from fk_city`;

increment 'ID_ADDRESS' depending on 'ID_MANDANT, ID_BUCHUNGSKREIS';


run the export;

# now we are done :-)
