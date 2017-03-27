## Explanation

The DELETE CLAUSE FOR command tells mk-sql-data prepares a DO DELETE command and gives the user the possibility to  specify a where clause to filter the records we want to delete.

## Syntax:

```
  delete clause for <TABLENAME> is <WHERECLAUSE>
```
## See also
   [[DO DELETE]]

## Example:

```
   delete for "mytable" is "";
   delete from "mytable";

   delete for "tbl" is "where x1 = 15;"
   delete  from "tbl";

   delete for "clerks" is "where ID_MANDANT in (select * from MANDANT where Name = 'Mandant 1');";
   delete from §BUCHUNGSKREIS";
```

