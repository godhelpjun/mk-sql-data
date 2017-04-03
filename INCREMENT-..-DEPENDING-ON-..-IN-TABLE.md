## Explanation

The INCREMENT command tells mk-sql-data how to fetch the start value of an unique table column. If there are data in the target table and you want to add more records without deleting the tables' content first, then it is possibly necessary to get the maximum value of the field, when it is declared as unique. INCREMENT helps you to do this job.

Another scenario would be an application which supports mandatories and accounting areas. Each accounting area has addresses, which it does not share with the other accounting areas. The unique identifier of each address record would then consist of three parts - the identifier of the mandatory (ID_MANDATORY), the identifier of the accounting area (ID_ACCOUNTING_AREA) and the counter identifier of the address record (ID_ADDRESS). This is often the primary key. Now we have to explain mk-test-data that there is a relationship between the address id and the tupel mandatory id and accounting area id. INCREMENT allows you to define this relation:

```
   increment 'ID_ADDRESS' depending on 'ID_MANDATORY, ID_ACCOUNTING_AREA';
```

In order to use this feature you have to define [[DBPARAMS]] first.

You can define more than one column name in FIELDLIST.

You can use the command without the "DEPENDNG ON" clause, too.  In this case merely the mentioned field will be incremented. It gets the value, which comes next behind the highest value in the table.
```
   increment 'ID_BOOKING';
```

Only scalar field types ( integers ) are supported as field types for the FIELDNAME and the FIELDLIST.


## Syntax:

```
   increment <FIELDNAME>;
   increment <FIELDNAME> depending on <FIELDLIST>;
```

## Example:

```
   increment 'ID_ADDRESS' depending on 'ID_MANDANT, ID_BUCHUNGSKREIS';

   increment 'ID_BOOKING';
```

