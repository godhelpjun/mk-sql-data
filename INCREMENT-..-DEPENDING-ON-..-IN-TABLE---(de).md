## Beschreibung

Der Befehl INCREMENT weist mk-sql-data an, wie das Programm den Startwert einer eindeutigen (UNIQUE) Tabellenspalte bestimmen kann. Wenn etwa in der Zieltabelle schon Daten vorhanden sind und Sie diesen Bestand vor der Befüllung mit neuen Daten nicht löschen möchten mit [[DO DELETE FROM - (de)]], dann ist INCREMENT wohl das Kommando Ihrer Wahl, um diesem Szenario gerecht zu werden. Denn nun benötigen Sie einen Startwert für die Spalte, der noch nicht vergeben worden ist, um die UNIQUE-Regelung einhalten zu können. INCREMENT bestimmt nun den höchsten vergebenen Wert der Spalte in der Tabelle und beginnt den Zähler für die Spalte beim nächsthöheren Wert.
Nehmen wir etwa an, wir haben eine Applikation erstellt, welche Mandanten und Buchungskreise unterstützt. Jeder Buchungskreis hat seinen eigenen Adressdatenbestand, den er nicht teilt mit den Beständen der anderen Buchungskreise. Der eindeutige Zugriff auf eine einzelne Adresse würde demnach über drei Felder erfolgen: Das Feld ID_MANDANT, welches den Mandanten eindeutig bestimmt, das Feld ID_BUCHUNGSKREIS, welches den Buchungskreis eindeutig bestimmt und das Zählerfeld ID_ADRESSE vom Adressbestand. Diese drei Felder werden höchstwahrscheinlich als Primärschlüssel, als PRIMARY KEY, deklariert. Um nun mk-sql-data zu erklären, dass da eine Beziehung besteht zwischen ID_ADRESSE und dem Tupel ID_MANDANT und ID_BUCHUNGSKREIS, verwenden wir den INCREMENT-Befehl:

```
   increment 'ID_ADRESSE' depending on 'ID_MANDANT, ID_BUCHUNGSKREIS';
```

Um INCREMENT benutzen zu können, ist zunächst [[DBPARAMS - (de)]] zu definieren.

In der Feldliste FIELDLIST kann mehr als ein Spaltenname stehen.

Der Befehl kann auch ohne "DEPENDNG ON" geschrieben werden; dann wird einfach der Wert des benannten Feldes auf den nächsthöheren Wert aus der Datenbank gesetzt.

```
   increment 'ID_BUCHUNG';
```

Bisher werden als Feldtypen nur INTEGER-Werte unterstützt.

## Syntax:

```
   increment <FIELDNAME>;
   increment <FIELDNAME> depending on <FIELDLIST>;
```

## Beispiel:

```
   increment 'ID_ADRESSE' depending on 'ID_MANDANT, ID_BUCHUNGSKREIS';

   increment 'ID_BUCHUNG';
```

