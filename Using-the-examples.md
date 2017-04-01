In order to use the examples you have to create a database / schema and a user, which owns this database/schema. then you can use the example files

# the script file mk-sql-data-01.cmd

This script file runs against a MYSQL database and creates relational test data. 

Use the program "mysql" in order to execute the SQL commands.

## Create database
create database db2phpsite;
use db2phpsite;

## Create user

CREATE USER 'db2phpsite'@'localhost' IDENTIFIED BY 'db2phpsite'
GRANT ALL ON db2phpsite.* TO 'db2phpsite'@'localhost';
exit

## Fill the database
mysql -u db2phpsite -pdb2phpsite < mk-sql-data-init-mysql.sql

## run the example script and create the test data

./mk-sql-data --cfg mk-sql-data-01.cmd

## import the test data into our database

mysql -u db2phpsite -pdb2phpsite < output/random-data.sql






