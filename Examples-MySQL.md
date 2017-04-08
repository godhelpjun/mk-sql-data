Before you can use the examples you have to prepare the following [[Prerequisites]]

# The script file mk-sql-data-01.cmd

This script file runs against a MYSQL database and creates relational test data. 

Use the program "mysql" in order to execute the SQL commands.

## Run the example script and create the test data
```
./mk-sql-data.php --cfg examples/mk-sql-data-01.cmd
```

## Import the test data into our database
```
mysql -u db2phpsite -pdb2phpsite < output/random-data-mysql.sql
```

# The script file mk-sql-data-02-mysql.cmd

This script file runs against a MYSQL database and creates relational test data. 

Use the program "mysql" in order to execute the SQL commands.

## Run the example script and create the test data
```
./mk-sql-data.php --cfg examples/mk-sql-data-02-mysql.cmd
```

## Import the test data into our database
```
mysql -u db2phpsite -pdb2phpsite db2phpsite< output/random-fk-mysql.sql
```

