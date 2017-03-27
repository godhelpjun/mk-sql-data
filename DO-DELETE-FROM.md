## Explanation

DO DELETE FROM writes a SQL DELETE to the SQL File and an optional WHERE clause, which was defined with [[DELETE CLAUSE FOR]] .

## Syntax:

```
  do delete from <TABLENAME> 
```
## See also
   [[DELETE CLAUSE FOR]]

## Example:

```
   delete clause for "mytable" is "";
   do delete from "mytable";

   delete clause for "tbl" is "where x1 = 15;"
   do delete  from "tbl";

   delete clause for "clerks" is "where ID_MANDANT in (select * from MANDANT where Name = 'Mandant 1');";
   do delete from "BUCHUNGSKREIS";
```

