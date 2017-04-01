Before you can use the following examples you have to prepare things described here: [[Prerequisites]]

# The script file mk-sql-data-01.cmd

This script file runs against a MySQL database and creates relational test data. 

Use the program "mysql" in order to execute the SQL commands.

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

```
sqlplus64 /nolog

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


