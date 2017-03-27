## Explanation

The FETCH command lets you define relations to contents of the target database. 

Let there be, for example, a table with the name ADDRESS with address data. In ADDRESS there is a field id_country which is a foreign key to the table COUNTRIES. COUNTRIES owns a field id_country with the unique identifier of the record. In order to tell mk-sql-code that there is a relationship between COUNTRIES.id_country and ADDRESS.id_country you use the FETCH command.

You have to define [[DBPARAMS]] before you can use this feature. mk-sql-data will then try to fetch the possible relating data from the table in the database with the SELECTSTATEMENT you have provided.

You can declare more than one column name in the FIELDLIST.

## Syntax:
```
   fetch <FIELDLIST> using <SELECTSTATEMENT>;
```

## Example:

```
   fetch 'ID_COUNTRY' using 'select country_id from COUNTRIES';
   fetch 'ID_MANDANT,ID_BUCHUNGSKREIS' using "select ID_MANDANT,ID_BUCHUNGSKREIS from BUCHUNGSKREIS where xx = 1";
```

