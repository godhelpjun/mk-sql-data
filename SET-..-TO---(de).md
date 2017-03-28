## Beschreibung

Der SET-befehl weist mk-sql-data an, mit welchem Wert das Programm den Inhalt einer Spalte befüllen soll. mk-sql-data erlaubt hier viele Feineinstellungen:

```
   set <FIELDNAME> TO <VALUE>;
```
Setzt den Spaltenwert auf einen bestimmten Wert.

```
   set <FIELDNAME> TO  RANDOMIZED {DATE|DATETIME|TIME} [IN {PAST|FUTURE}];
```
Setzt den Wert einer Datums- oder Zeitspalte auf einen randomisierten Wert. Optional ist noch definierbar, ob der Wert in der Zukunft ( IN FUTURE ) oder in der Vergangenheit ( IN PAST ) liegen soll.
```
   set <FIELDNAME> TO  RANDOMIZED {PHONE|BLZ|IBAN|BIC};
```
Setzt den Wert einer Spalte auf einen randomisierten Wert. Dabei wird eine Telefonnummer ( PHONE ), eine IBAN-Kontonummer ( IBAN ), eine Bankleitzahl ( BIC ) oder eine althergebrachte Bankleitzahl (BLZ ) generiert.

```
   set <FIELDNAME> TO  RANDOMIZED {FLOAT|INT|BOOL} [BETWEEN <VALUE>  AND <VALUE>];
```
Setzt den Wert einer numerischen Spalte auf einen randomisierten Wert. Wir unterscheiden dabei zwischen einer Fließkommazahl ( FLOAT ), einer Ganzzahl ( INTEGER ) und einem Wahrheitswert. Optional kann noch der Bereich für die Zahl angegeben werden mit BETWEEN.. AND.

```
   set <FIELDNAME> TO  RANDOMIZED {CHAR} [BETWEEN <VALUE>  AND <VALUE>];
```
Setzt den Wert einer Textspalte auf einen randomisierten Wert. Optional kann noch die minimale und maximale Länge der randomisierten Zeichenkette angegeben werden. 

 64 KB = 65535 Bytes

 32 KB = 32768 Bytes

 16 KB = 16384 Bytes

  8 KB = 8192 Bytes

  4 KB = 4096 Bytes

```
   set <FIELDNAME> TO  SQL "<SQLVALUE>";   
```
Setzt den Spaltenwert auf einen SQL-Ausdruck. 

== Siehe auch

[[USE .. AS - (de)]] 

## Syntax:

```
   set <FIELDNAME> TO <VALUE>;
   set <FIELDNAME> TO  RANDOMIZED {DATE|DATETIME|TIME} [IN {PAST|FUTURE}];
   set <FIELDNAME> TO  RANDOMIZED {PHONE|BLZ|IBAN|BIC};
   set <FIELDNAME> TO  RANDOMIZED {FLOAT|INT|BOOL} [BETWEEN <VALUE>  AND <VALUE>];
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

