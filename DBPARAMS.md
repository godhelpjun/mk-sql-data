## Explanation

DBPARAMS configures the credentials and establishes a database connection to the database server. Only the [[FETCH .. USING]] parameter and the [[INCREMENT .. DEPENDING ON .. IN TABLE]] parameter need a connection to the target database.

If not all credentials are mentioned ( do not forget the commas ), then mk-sql-data will prompt the user for the missing data.

## Syntax:
```
  dbparams <localhost>,<schema_name>,<user_name>,<user_password>
```

## Example:
```
  dbparams = "localhost,db2phpsite,db2phpsite,db2phpsite";
  dbparams = "localhost,db2phpsite,,";
```