## Explanation

The READ command tells mk-sql-data to read data from textual files. These data can then be used with the [[USE .. AS]] command.

Normally the text files have one column text data. The ZIPCODES has two columns and the TEXT file has zero column as it consits of normal text.

You can load more than one file per pattern. the new records will be added to the current ones. If no [[RESET]] was given, then the data will be merged with the existing ones.

## Syntax:

```
  read {PRENAMES|SURNAMES|STREETS|ZIPCODES|TEXT} from <TEXTFILENAME>;  
```

## Example:

```
   read prenames from "data/de-prenames.txt";
   read surnames from "data/de-surnames.txt";
   read streets from "data/de-streets.txt";   
   read zipcodes from "data/de-zips.txt";
   read text from "data/de-text.txt";   
```

