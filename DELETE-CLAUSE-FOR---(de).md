## Beschreibung

Das Kommando DELETE CLAUSE FOR bereitet ein [[DO DELETE FROM - (de)]] vor und gibt dem Entwickler die Möglichkeit, eine WHERE-Bedingung für das zugehörige [[DO DELETE FROM - (de)]] festzulegen, womit die beabsichtigte Löschoperation eingegrenzt werden kann.

## Syntax:

```
  delete clause for <TABLENAME> is <WHERECLAUSE>
```
## Siehe auch
   [[DO DELETE FROM - (de)]]

## Example:

```
   delete for "mytable" is "";
   do delete from "mytable";

   delete for "tbl" is "where x1 = 15;"
   do delete  from "tbl";

   delete for "clerks" is "where ID_MANDANT in (select * from MANDANT where Name = 'Mandant 1');";
   do delete from "BUCHUNGSKREIS";
```

