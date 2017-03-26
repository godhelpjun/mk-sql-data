## Explanation

The FILENAME command tells mk-sql-data in which file it should export the generated SQL code. If the path does not exist, then mk-sql-data will try to create the necessary directory structure.

## Syntax:

```
filename is <FILENAME>;
```

## Example:

```
   filename is "output/random-fk.sql";
```

