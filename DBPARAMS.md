## Explanation

DBPARMS configures the credentials and establishes a database connection to the server. Only the [[FETCH .. USING]] parameter and the [[INCREMENT .. DEPENDING FROM .. IN TABLE]] parameter need a connection to the target database.

## Syntax:

  dbparams <localhost>,<schema_name>,<user_name>,<user_password>

## Example:

  dbparams = "localhost,db2phpsite,db2phpsite,db2phpsite";
