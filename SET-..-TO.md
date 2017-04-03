## Explanation

THE SET command tells mk-sql-data, how it should randomize the contents of a column. There are lots of possibilities to apply the SET command:

```
   set <FIELDNAME> TO <VALUE>;
```
Sets the column value to the specified value.

```
   set <FIELDNAME> TO  RANDOMIZED {DATE|DATETIME|TIME} [IN {PAST|FUTURE}];
```
Sets the date or time column value to a randomized value. Optionally you can declare, whether the value should be in the future or in the past, too.

```
   set <FIELDNAME> TO  RANDOMIZED {PHONE|BLZ|IBAN|BIC};
```
Sets the column value to a randomized value. It can be a phone number, a BIC code, an IBAN code or a former German Bankleitzahl.

```
   set <FIELDNAME> TO  RANDOMIZED {FLOAT|INT|BOOLEAN} [BETWEEN <VALUE>  AND <VALUE>];
```
Sets the numeric column value to a randomized value. We differ between float, integer and bool values. It is optionally possible to define a range of values with BETWEEN.

```
   set <FIELDNAME> TO  RANDOMIZED {CHAR} [BETWEEN <VALUE>  AND <VALUE>];
```
Sets the string column value to a randomized value. It is optionally possible to define the length of the string with BETWEEN.

 64 KB = 65535 Bytes

 32 KB = 32768 Bytes

 16 KB = 16384 Bytes

  8 KB = 8192 Bytes

  4 KB = 4096 Bytes

```
   set <FIELDNAME> TO  SQL "<SQLVALUE>";   
```
Sets the column value to the result of a SQL expression. 

See the [[USE .. AS]] command, too.

## Syntax:

```
   set <FIELDNAME> TO <VALUE>;
   set <FIELDNAME> TO  RANDOMIZED {DATE|DATETIME|TIME} [IN {PAST|FUTURE}];
   set <FIELDNAME> TO  RANDOMIZED {PHONE|BLZ|IBAN|BIC};
   set <FIELDNAME> TO  RANDOMIZED {FLOAT|INT|BOOLEAN} [BETWEEN <VALUE>  AND <VALUE>];
   set <FIELDNAME> TO  RANDOMIZED {CHAR} [BETWEEN <VALUE>  AND <VALUE>];
   set <FIELDNAME> TO  SQL "<SQLVALUE>";
```

## Example:

```
   set "is_europe" to "1";
   set "last_visit" to randomized DATE IN PAST;
   set "REVDATE" to randomized DATETIME IN PAST;
   set "_Date_6" to randomized DATE IN FUTURE;
   set "_Float_1" to randomized FLOAT ;
   set _"Float_2" to randomized FLOAT between 0.58 and 15.75;
   set "_Int_1" to randomized INT between 1 and 31000;
   set "_Bool_1" to randomized BOOLEAN ;
   set "_Char_1" to randomized Char between 0 and 50;
   set "_IBAN_1" to randomized IBAN;
   set "_BIC_1" to randomized BIC;
   set "_YEAR_1" to randomized INT between 1901 and 2155;
   set "_MEDIUM_TEXT_1" to randomized Char between 0 and 8192;
   set "PHONE_NUMBER" to randomized phone;
   set "REVDATE" to sql "NOW( )";
```

