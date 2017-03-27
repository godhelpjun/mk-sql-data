## Explanation


The RESET command tells mk-sql-data to free memory used by certain data structures. Typically the command is used after the [[RUN THE EXPORT]] command. 

- Resetting data means to reset the data read out of text files after a [[READ .. FROM]] command. (names, prenames, zips, cities etc)
- Resetting actions means to reset the earlier defined per row actions ( use, set ) up to the last [[RUN THE EXPORT]] command. Clears internal data structures of mk-sql-data. Is necessary after an export.
- resetting code means to clear the sql code written before and is necessary after each export


## Syntax:

```
  reset {CODE|ACTIONS|DATA};  
```

## Example:

```
   reset code;
   reset actions;  
```

