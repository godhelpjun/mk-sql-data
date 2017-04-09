## Explanation

THE USE command tells mk-sql-data, how to use a column and how to randomize special columns.

```
   use <FIELDNAME> AS {PRENAME|SURNAME|STREET|ZIPCODE};
```

This declaration tells mk-sql-data to apply the prenames, surnames, streets, zips we provided via [[READ .. FROM]] to the column.

```
   use <FIELDNAME> AS {UNIQUE};
```

Treat the column as unique number

## Syntax:

```
   use <FIELDNAME> AS {PRENAME|SURNAME|STREET|ZIPCODE|UNIQUE};
```

== See also

[[SET .. TO]]

## Example:

```
   use "ZIP" as zipcode;
   use "NAME" as surname;
   use "PRENAME" as prename;
   use "STREET" as street;
   use "CITY" as city;
   use "ID_ADDRESS" as unique;
```
