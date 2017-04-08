## Explanation

The INCLUDE command tells mk-sql-data to write the text, which consists of SQL commands, to be included in the SQL file.

## Syntax:

```
  include text = <TEXT>;
```

## Example:

```
include text = "

create table fk_city IF NOT EXISTS (

  ID_CITY INT UNSIGNED NOT NULL,

  city varchar(255),
  country_id INT(5) NOT NULL,
  is_europe BOOLEAN NOT NULL,
  last_visit DATE

    REVNAME                         CHAR(20)     NOT NULL ,
    REVDATE                         DATETIME        NOT NULL ,
    REVFIRST                        DATETIME        NOT NULL ,
    REVCREATOR                      CHAR(20)        NOT NULL,

  PRIMARY KEY ( ID_CITY ),

) ENGINE=InnoDb CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS fk_address (

  ID_MANDANT INT UNSIGNED NOT NULL,
  ID_BUCHUNGSKREIS INT UNSIGNED NOT NULL,
  ID_ADDRESS INT UNSIGNED NOT NULL,

  ID_CITY INT UNSIGNED NOT NULL,
  ID_COUNTRY INT(6),

  Name VARCHAR(255),
  Vorname VARCHAR(255),

  PRIMARY KEY (ID_MANDANT, ID_BUCHUNGSKREIS, ID_ADDRESS ),
  FOREIGN KEY (ID_CITY) REFERENCES fk_city(ID_CITY)

) Engine = InnoDb CHARACTER SET utf8;
";
```

