Before you can use the examples you have to prepare the following [[Prerequisites]]

# The script file mk-sql-data-02-pdo-informix.cmd

This script file runs against an Informix database with the PDO interface and creates relational test data. 

Use the program "dbaccess" in order to execute the SQL commands.

## Run the example script and create the test data
```
./mk-sql-data.php --cfg examples/mk-sql-data-02-pdo-informix.cmd
```

## Import the test data into our database 

Login via ifx-access.sql and then execute the SQL commands in random-fk-informix-pdo.sql

```
dbaccess - examples/ifx_access.sql output/random-fk-informix-pdo.sql
```

