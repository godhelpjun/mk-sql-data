## Explanation

The DELETE command tells mk-sql-data to write a DELETE statement into the SQL script the program is generating. We can specify a where clause to filter the records we want to delete.

## Syntax:

```
  delete for <TABLENAME> is <WHERECLAUSE>
```

## Example:

```
   delete for "mytable" is "";
   delete for "tbl" is "where x1 = 15;"
   delete for "clerks" is "where ID_MANDANT in (select * from MANDANT where Name = 'Mandant 1');";
```

