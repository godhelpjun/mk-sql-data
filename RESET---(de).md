## Beschreibung

Der Befehl RESET weist mk-sql-data an, Speicher freizugeben, der von bestimmten Datenstrukturen benutzt wurde. Typischerweise erfolgen REST Kommandos nach deinem [[RUN THE EXPORT - (de)]]. 

- Resetting Zurücksetzen (Reset) von Daten (DATA) bedeutet, dass die Daten, welche mit  [[READ .. FROM]] eingelesen worden sind, gelöscht werden. (names, prenames, zips, cities etc)
- Der Reset von Aktionen (ACTIONS) löscht die vorher ausgeführten Aktionen aus dem Speicher, die die jeweiligen Zeilen verändert haben. ( use, set ). Interne Datenstrukturen von mk-sql-data werden also gelöscht. Wird benötigt nach jedem Export.
- Der RESET von CODE löscht den noch nicht verarbeiteten SQL-Code wieder aus dem Speicher. Wird benötigt nach jedem Export.

## Syntax:

```
  reset {CODE|ACTIONS|DATA};  
```

## Beispiel:

```
   reset code;
   reset actions;  
```

