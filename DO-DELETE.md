## Explanation

The DO DELETE command tells mk-sql-data to write a DELETE statement into the SQL script the program is generating. There can be a filter set by the [[DELETE CLAUSE FOR]] command, which gives the user the possibility to specify a where clause to filter the records he wants to delete.

## Syntax:

```
  do delete from <TABLENAME> 
```
## See also
   [[DELETE CLAUSE FOR]]

## Example:

```
   do delete clause for "mytable" is "";
   do delete from "mytable";

   do delete clause for "tbl" is "where x1 = 15;"
   do delete  from "tbl";

   do delete clause for "clerks" is "where ID_MANDANT in (select * from MANDANT where Name = 'Mandant 1');";
   do delete from §BUCHUNGSKREIS";
```

