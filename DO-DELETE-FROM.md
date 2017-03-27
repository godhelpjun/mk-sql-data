## Explanation

DO DELETE FROM writes a SQL DELETE to the SQL File and an optional WHERE part, defined with [[DELETE FOR]] .

## Syntax:

```
  do delete from <TABLENAME> 
```
## See also
   [[DO DELETE FROM]]

## Example:

```
   delete for "mytable" is "";
   do delete from "mytable";

   delete for "tbl" is "where x1 = 15;"
   do delete  from "tbl";

   delete for "clerks" is "where ID_MANDANT in (select * from MANDANT where Name = 'Mandant 1');";
   do delete from "BUCHUNGSKREIS";
```

