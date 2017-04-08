## Explanation

The READ command tells mk-sql-data to read data from textual files. These data can then be used with the [[USE .. AS]] command as base for the randomization.

Normally the text files have one column text data. The ZIPCODES has two columns and the TEXT file has zero column as it consits of normal text.

You can load more than one file per pattern. the new records will be added to the current ones. If no [[RESET]] was given, then the data will be merged with the existing ones.

### Available data sets

English data:
-   data/us-prenames.txt
-   data/us-surnames.txt
-   data/us-streets.txt
-   data/us-zips.txt
-   data/us-text.txt 

German data:
-   data/de-prenames.txt
-   data/de-surnames.txt
-   data/de-streets.txt
-   data/de-zips.txt
-   data/de-text.txt 

Spanish data:
-   data/es-prenames.txt
-   data/es-surnames.txt
-   data/es-streets.txt
-   data/es-zips.txt
-   data/es-text.txt 

## Syntax:

```
  read {PRENAMES|SURNAMES|STREETS|ZIPCODES|TEXT} from <TEXTFILENAME>;  
```

## Example:

```
   # read English data
   read prenames from "data/us-prenames.txt";
   read surnames from "data/us-surnames.txt";
   read streets from "data/us-streets.txt";   
   read zipcodes from "data/us-zips.txt";
   read text from "data/us-text.txt";   

   # read German data
   read prenames from "data/de-prenames.txt";
   read surnames from "data/de-surnames.txt";
   read streets from "data/de-streets.txt";   
   read zipcodes from "data/de-zips.txt";
   read text from "data/de-text.txt";  

   # read Spanish data
   read prenames from "data/es-prenames.txt";
   read surnames from "data/es-surnames.txt";
   read streets from "data/es-streets.txt";   
   read zipcodes from "data/es-zips.txt";
   read text from "data/es-text.txt"; 
```

