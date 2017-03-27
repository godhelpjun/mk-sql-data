## Beschreibung

DO DELETE FROM schreibt ein SQL DELETE in die SQL-Datei samt einer optionalen WHERE-Bedingung, die mit [[DELETE CLAUSE FOR - (de)]] definiert worden ist.

## Syntax:

```
  do delete from <TABLENAME> 
```
## See also
   [[DELETE CLAUSE FOR - (de)]]

## Example:

```
   delete clause for "mytable" is "";
   do delete from "mytable";

   delete clause for "tbl" is "where x1 = 15;"
   do delete  from "tbl";

   delete clause for "clerks" is "where ID_MANDANT in (select * from MANDANT where Name = 'Mandant 1');";
   do delete from "BUCHUNGSKREIS";
```

