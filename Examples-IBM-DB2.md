Before you can use the examples you have to prepare the following [[Prerequisites]]

# The script file mk-sql-data-02-pdo-db2.cmd

This script file runs against an IBM db2 database with the PDO interface and creates relational test data. 

Use the program "db2" in order to execute the SQL commands.

## Run the example script and create the test data
```
./mk-sql-data.php --cfg examples/mk-sql-data-02-pdo-db2.cmd
```

## Import the test data into our database
```
db2 -tf output/random-fk-ibm-pdo.sql
```

# The script file mk-sql-data-02-db2.cmd

This script file runs against an IBM db2 database with the native interface and creates relational test data. 

Use the program "db2" in order to execute the SQL commands.

## Run the example script and create the test data
```
./mk-sql-data.php --cfg examples/mk-sql-data-02-db2.cmd
```

## Import the test data into our database
```
db2 -tvf output/random-fk-ibm-db2.sql
```
