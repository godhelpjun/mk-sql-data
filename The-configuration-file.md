
The configuration file consists of commands which are interpreted by mk-sql-data. The commands are in English and should by self-explaining.

There are commands, which are executed immediately and commands, which are executed, when the generation of test data is triggered by the command RUN THE EXPORT:

## immediate execution:

[[DBPARAMS]]		
nur von FETCH benötigt

[[DELETE CLAUSE FOR]]

[[EXPORT ... RECORDS]]

[[FILENAME IS]]

[[INCLUDE TEXT]]

[[READ .. FROM]]

[[RESET]]

[[RUN THE EXPORT]]

[[START WITH RECORD]]

[[WORK ON TABLE]]

## executed during the export 

[[FETCH .. USING]]

[[INCREMENT .. DEPENDING FROM .. IN TABLE ..]]

[[SET .. TO]]

[[USE .. AS]]
