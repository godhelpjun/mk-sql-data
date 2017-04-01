In order to use the examples you have to create a database / schema and a user, which owns this database/schema. then you can use the example files

# The script file mk-sql-data-01.cmd

This script file runs against a MYSQL database and creates relational test data. 

Use the program "mysql" in order to execute the SQL commands.

## Create database
```
create database db2phpsite;
use db2phpsite;
```

## Create user
```
CREATE USER 'db2phpsite'@'localhost' IDENTIFIED BY 'db2phpsite'
GRANT ALL ON db2phpsite.* TO 'db2phpsite'@'localhost';
exit
```

## Fill the database
```
mysql -u db2phpsite -pdb2phpsite < mk-sql-data-init-mysql.sql
```

## Run the example script and create the test data
```
./mk-sql-data.php --cfg mk-sql-data-01.cmd
```

## Import the test data into our database
```
mysql -u db2phpsite -pdb2phpsite < output/random-data.sql
```

# The script file mk-sql-data-02-ora.cmd

This script file runs against an ORACLE database and creates relational test data. 

## Install instantclient from ORACLE and sqlplus

- go to the ORACLE website and search for INSTANTCLIENT
- download the base package from ORACLE website
- download the sql plus package from ORACLE website
- install the packages
```
alien --scripts -d oracle-instantclient12.2-basic-12.2.0.1.0-1.x86_64.rpm
alien --scripts -d oracle-instantclient12.2-sqlplus-12.2.0.1.0-1.x86_64.rpm
dpkg --install *.deb
```

## Set the ORACLE LIBRARY path
export DYLD_LIBRARY_PATH=/usr/lib/oracle/12.2/client64/lib
export LD_LIBRARY_PATH=$LD_LIBRARY_PATH:$DYLD_LIBRARY_PATH

## Install oci8 for php after installing the instant client download from oracle

the debian way:
```
pecl install oci8-2.0.10
```

## Tell php to load the oci library
```
vi /etc/php5/cli/php.ini
```

add the line:

  extension=oci8.so

## Create a new user ( = schema )

Use the program "sqlplus" in order to execute the SQL commands. sqlplus64 /nolog starts without connecting to a schema.
```
sqlplus64 /nolog

CONNECT system/oracle@192.168.1.65/XE

create user db2phpsite identified by "db2phpsite";

grant dba,resource, connect to db2phpsite;

connect db2phpsite/db2phpsite@192.168.1.65;
```

## Fill the database
```
@ './mk-sql-data-init-oracle.sql';
exit;
```

## Run the example script and create the test data
```
./mk-sql-data.php --cfg mk-sql-data-02-ora.cmd
```

## Import the test data into our database
```
sqlplus64 /nolog

connect db2phpsite/db2phpsite@192.168.1.65;
@ 'output/random-fk.sql';
```


