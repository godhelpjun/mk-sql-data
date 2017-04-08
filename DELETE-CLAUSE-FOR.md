## Explanation

The DELETE CLAUSE FOR command prepares a [[DO DELETE FROM]] command and gives the user the possibility to  specify a where clause to filter the records we want to delete.

## Syntax:

```
  delete clause for <TABLENAME> is <WHERECLAUSE>
```
## See also
   [[DO DELETE FROM]]

## Example:

```
   delete clause for "mytable" is "";
   do delete from "mytable";

   delete clause for "tbl" is "where x1 = 15;"
   do delete  from "tbl";

   delete clause for "clerks" is "where ID_MANDANT in (select * from MANDANT where Name = 'Mandant 1');";
   do delete from "BUCHUNGSKREIS";
```

