## Explanation


The START command tells mk-sql-data to start the output of the SQL code with the zero based record number <RECORDNUMBER> and not with 0. The generated code normally ranges from 0 to the number of records defined by the [[EXPORT .. RECORDS]] command.

## Syntax:

```
  START WITH RECORD <RECORDNUMBER>;  
```

## Example:

```
   start with record 50;
```

