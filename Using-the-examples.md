Before you can use the following examples you have to prepare things described here: [[Prerequisites]]

[[example mysql]]

[[example oracle]]



# The script file mk-sql-data-02-oracle.cmd

This script file runs against an ORACLE database and creates relational test data. You have to change the CONNECT-string in order to fit to your environment

## Run the example script and create the test data
```
./mk-sql-data.php --cfg examples/mk-sql-data-02-oracle.cmd
```

## Import the test data into our database
```
sqlplus64 db2phpsite/db2phpsite@192.168.1.65/XE < output/random-fk-oracle.sql
```


