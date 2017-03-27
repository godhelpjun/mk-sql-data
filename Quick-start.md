mk-sql-data runs out of the box. You can use the sample script [[mk-sql-data-00.cmd]] as starting point. Copy  the example scripting file and adapt it to your needs.

Run the command

    mk-sql-data.php --cfg mk-sql-data-00.cmd

Import the generated SQL file into the database with

    mysql -u user -ppassword database < output/random-data.sql