mk-sql-data läuft bei mir auf einer Linux-Maschine mit PHP 5; doch sollte das Programm auch auf anderen Plattformen lauffähig sein. Geben Sie mir doch bite Bescheid, wenn Sie das Programm unter einem anderen Betriebssystem zum Laufen gebracht haben.

Die Applikation generiert SQL-Code für MySQL-Datenbanken. Doch sollte das erzeugte SQL auch auf anderen SQL-Datenbanken anwendbar sein, weil keine speziellen MySQL-eigenen SQL-Befehele zur Anwendung kommen. Probieren Sie es doch einfach mit dem anderen SQL-Dialekt aus und informieren Sie mich doch bitte über Ihr Resultat.

Was Sie nicht verwenden könen, das sind die Befehle [[INCREMENT .. DEPENDING ON .. IN TABLE]] und [[FETCH .. USING]], weil mk-sql-data ein anderes Interface benötigen würde als das mysqli von PHP für MySQL. Vielleicht möchten Sie ja gerne das Interface für ihre Datenbank ausprogrammieren? und den Code anderen Benutzern zur Verfügung stellen? Es wäre sicher kein großer Aufwand. 
