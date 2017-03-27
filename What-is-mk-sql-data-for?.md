mk-sql-data is a CLI (command line interface) app written in PHP. It's aim is to give programmers the possibility, to generate even large amounts of testing data for MySQL- databases on the fly.

The generation of test data is a boring and time-consuming matter. Automatic solutions often fill the columns with ugly data, which are far behind the daily needs.Often these solutions are very unflexible.

The processing of mk-sql-data is controlled by a configuration file, which can be easily generated and
modified. Various column data types can be filled with a flexible definable and therefore fitting randomized input. See the self-explaining example script files [[mk-sql-data-00.cmd]] and [[mk-sql-data-01.cmd]] for more details.

According to the rules in the configuration script the program creates one or more SQL files, which then can be imported into the target database. Normally it does not need a connection to the database server in order to create the test data.
Only if you are using the commands [[FETCH .. USING]] or [[INCREMENT .. DEPENDING ON .. IN TABLE]], a database connection is necessary. The FETCH command selects relational data out of the database. See [[mk-sql-data-01.cmd]] as sample configuration.

mk-sql-data runs out of the box. You can use the sample script [[mk-sql-data-00.cmd]] as starting point in order to run a test with the command

    mk-sql-data.php --cfg mk-sql-data-00.cmd

Import the generated SQL file into the database with 

    mysql -u user -ppassword database < output/random-data.sql

The program mk-sql-data is published under the terms of the MIT license.