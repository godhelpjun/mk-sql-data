
The configuration file consists of commands which are interpreted by mk-sql-data. The commands are in English and should by self-explaining.

There are commands, which are executed immediately and commands, which are executed, when the generation of test data is triggered by the command RUN THE EXPORT:

## common rules

[[comments]]

[[commands]]

[[delimiters]]

## immediate execution:

[[DBPARAMS]]		

[[DELETE CLAUSE FOR]]

[[EXPORT .. RECORDS]]

[[FILENAME IS]]

[[INCLUDE TEXT]]

[[READ .. FROM]]

[[RESET]]

[[RUN THE EXPORT]]

[[START WITH RECORD]]

[[WORK ON TABLE]]

## executed during the export 

[[FETCH .. USING]]

[[INCREMENT .. DEPENDING ON .. IN TABLE]]

[[SET .. TO]]

[[USE .. AS]]

## Examples

[[mk-sql-data-00.cmd]]

[[mk-sql-data-01.cmd]] needs connection to an existing database server