
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

# The script file mk-sql-data-02-pdo-oracle.cmd

This script file runs against an Oracle database with the PDO interface and creates relational test data. 

Use the program "sqlplus" in order to execute the SQL commands.

## Run the example script and create the test data
```
./mk-sql-data.php --cfg examples/mk-sql-data-02-pdo-oracle.cmd

```

## Import the test data into our database 

```
sqlplus64 db2phpsite/db2phpsite@192.168.1.65/XE < output/random-fk-oracle-pdo.sql
```

