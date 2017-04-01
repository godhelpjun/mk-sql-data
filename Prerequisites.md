In order to use examples which are connecting to the database have to create a database / schema and a user, which owns this database/schema. Then you will be able to use the example files

# Using MySQL

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

# Using Oracle

The CONNECT-string may vary depending on the Version and the location of the databse.

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
```
export DYLD_LIBRARY_PATH=/usr/lib/oracle/12.2/client64/lib
export LD_LIBRARY_PATH=$LD_LIBRARY_PATH:$DYLD_LIBRARY_PATH
```

## Install oci8 for php 

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

