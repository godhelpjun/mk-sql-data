mk-sql-data läuft ohne weiteren Einstellungen gleich nach Installation des Programms in einem Verzeichnis. Sie können das Beispielskript [[mk-sql-data-00.cmd]] als Schnelleinstieg verwenden, um das Programm zu testen. Geben Sie dazu das folgende Kommando ein:
mk-sql-data läuft ohne weiteren Einstellungen gleich nach Installation des Programms in einem Verzeichnis. Sie können das Beispielskript [[mk-sql-data-00.cmd]] als Schnelleinstieg verwenden, um das Programm zu testen. Geben Sie dazu das folgende Kommando ein:
```
    mk-sql-data.php --cfg mk-sql-data-00.cmd
```
Um die von mk-sql-data erzeugte SQL-Datei in die Datenbank zu importieren geben Sie dann das folgende Kommando ein:
```
    mysql -u Benutzername -pPasswort Datenbank < output/random-data.sql
```