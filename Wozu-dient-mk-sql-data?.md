mk-sql-data ist ein CLI-Programm (command line interface), welches in PHP programmiert worden ist. Die Applikation soll Entwicklern die Möglichkeit geben, selbst große Mengen an Testdaten für MySQL-Datenbanken auf die Schnelle zu erzeugen.

Das Generieren von Testadten ist üblicherweise eine recht langweilige und obendrein zeitraubende Angelegenheit. Automatisierte Lösungen befüllen die Datenbankfelder in der  Regel mit aussagslosen und unschönen Inhalten, die nichts mit der Anwendung selbst zu tun haben. Zudem geben sie oft ein starres Schema vor.

Der Programmablauf von mk-sql-data wird über eine Konfigurationsdatei gesteuert. Dieses Skript kann leicht erzeugt und erweitert werden. Viele Datentypen können mit einem flexibel definierbaren und damit passenden randomisierten Inhalt befüllt werden. Sehen Sie sich dazu die Beispielkonfigurationen [[mk-sql-data-00.cmd]] und [[mk-sql-data-01.cmd]] an, welche im Grunde genommen selbsterklärend sind.

Das Programm erzeugt gemäß den Vorschriften im Steuerskript eine oder mehrere SQL-Dateien, welche dann in die Zieldatenbank importiert werden können. Normalerweise ist bei der Codegenerierung keine Datenbankverbindung nötig. Ausnahmen von der Regel sind die Kommandos [[FETCH .. USING]] und [[INCREMENT .. DEPENDING ON .. IN TABLE]], welche mit dem Datenbankserver in Verbindung treten müssen. Das FETCH-Kommando liest nämlich relationale Daten aus der Datenbank aus. Werfen Sie dazu bitte einen Blick auf das Beispielskript [[mk-sql-data-01.cmd]].

Das Programm mk-sql-data wurde unter den Bestimmungen der MIT-Lizenz veröffentlicht.