this is the file README.md for mk-sql-data - it is
written in English and in German / deutsch

#####################################################
#                      English part                 #
#####################################################

mk-sql-data is a CLI (command line interface) app
written in PHP. It is a test data generator. It's aim
is to give programmers the possibility, to generate
even large amounts of testing data for MySQL- databases
on the fly.

The generation of test data is a boring and time-
consuming matter. Automatic solutions often fill the
columns with ugly data, which are far behind the daily
needs.

The processing of mk-sql-data is controlled by a
configuration file, which can be easily generated and
modified. Various column data types can be filled with
a fitting randomized input. See the example script files
mk-sql-data-00.cmd and mk-sql-data-01.cmd for more
details.

The app creates one or more SQL files, which then can be
imported into the target database. Normally it does not
need a connection to the database server in order to
create the test data.
Only if you are using the FETCH-command or the INCREMENT
command, a database connection is necessary. The FETCH-
command selects relational data out of the database. See
mk-sql-data-01.cmd as sample configuration.

At the moment the app supports three target types of test
data; it was designed for English, Spanish and German users.
You are welcome to support me by providing sample data of
your country in order to enlarge the community which can
use mk-sql-data. Send me please

- a text file with common prenames
- a text file with common surnames
- a text file with zips and cities
- a text file with street names
- a text file with a longer text

The longer text must not be copyrighted, it could be, for
example, the text of an old famous novel in the target
language.

I will then add your test data to the app and publish
them with the next release of mk-sql-data.

mk-sql-data runs out of the box. You can use the sample
script mk-sql-data-00.cmd as starting point in order to
run a test with the command

    mk-sql-data.php --cfg mk-sql-data-00.cmd

mk-sql-data runs for me on a Linux-machine with PHP 5,
but it should run on other platforms, too. Please do
inform me, when you made it to run the app with another
operating system.

The app generates SQL code for MySQL databases. The code
should be usable for other databases, too. Give it a try
and inform me, when you succeeded in using the generated
code with another SQL dialect, please.

Import the generated SQL file into the database with

    mysql -u user -ppassword database < data.sql

The app mk-sql-data is licensed under the terms of the MIT
license.

Get more information by reading the project wiki

  https://github.com/rstoetter/mk-sql-data/wiki

Thank you for reading and using this part of software!

Greets,

Rainer Stötter, Altenburg, Germany

#########################################################
#               Deutsche Zusammenfassung                #
#########################################################

mk-sql-data ist eine CLI-Applikation ( command line
interface ), welche in PHP programmiert worden ist.
Es handelt sich um einen Testdatengenerator. Das
Programm soll Entwicklern die Möglichkeit geben, auf
die Schnelle sogar große Mengen an Testdaten für eine
MySQL-Datenbank zu erzeugen.

Testdaten zu erzeugen ist eine langweilige Sache und in
der Regel sehr zeitaufwendig. Automatisierte Lösungen
wiederum befüllen die Datenbankfelder oft mit hässlichen
Testdaten, die obendrein weit davon entfernt sind, echt
auszusehen.

Eine Konfigurationsdatei steuert die Erzeugung der
Testdaten. Diese Datei ist einfach zu erstellen und zu
modifizieren. Viele verschiedene Datentypen können mit
passenden randomisierten Daten befüllt werden. Siehe
dazu bitte die Beispielskripte mk-sql-data-00.cmd und
mk-sql-data-01.cmd.

Das Programm erzeugt eine oder mehrere SQL-Dateien, die
dann in die Zieldatenbank importiert werden.
Normalerweise ist für die Erzeugung der Testdaten keine
Datenbankanbindung nötig.
Verwenden Sie jedoch das FETCH-Kommando oder das
INCREMENT-Kommando, dann muss das Programm mit der
Datenbank in Kontakt treten, weil relationale Daten
abgefragt werden müssen. Siehe hierzu das Beispielskript
mk-sql-data-01.cmd

Derzeit unterstützt die Applikation drei Typen von
Testdaten - solche für den englischsprachigen Raum,
spanische Daten, und solche für den deutschsprachigen Raum.
Wenn Sie gerne eine weitere Zielgruppe versorgt sehen möchten,
dann sind Sie gerne dazu eingeladen, mich zu unterstützen, indem
Sie mir Beispieldaten des Ziellandes zur Verfügung
stellen. Um nun noch mehr Menschen die Generierung von
Testdaten zu ermöglichen, senden Sie mir bitte

- eine Textdatei mit üblichen Vornamen
- eine Textdatei mit üblichen Familiennamen
- eine Textdatei mit Postleitzahlen und Städten
- eine Textdatei mit Straßennamen
- eine Textdatei mit einem längeren Text

Auf den längeren Text darf kein Copyright bestehen. Verwenden
Sie doch einfach einen älteren berühmten Roman als Vorlage.

Ich werde dann Ihre Testdaten zum Programm hinzufügen und
diese mit der nächsten Version von mk-sql-data allem
Interessierten zur Verfügung stellen.

mk-sql-data läuft ohne weiteren Einstellungen gleich
nach dem Auspacken. Sie können also das Programm sofort
testen mit dem Befehl

    mk-sql-data.php --cfg mk-sql-data-00.cmd

mk-sql-data läuft bei mir in einer Linux-Umgebung mit
installiertem PHP 5, sollte jedoch auch auf anderen
Plattformen lauffähig sein. Sollten Sie das Programm
erfolgreich unter einem anderen Betriebssystem zum Laufen
gebracht haben, dann informieren Sie mich bitte darüber.

Das Programm erzeugt SQL-Code für MySQL-Datenbanken. Das
generierte SQL sollte auch in Verbindung mit anderen
Datenbankservern nutzbar sein. Versuchen Sie es bitte,
wenn Sie die Möglichkeit dazu haben. Und informieren
Sie mich doch bitte über Ihre Ergebnisse.

Um die generierte SQL-Datei in eine Datenbank zu importieren,
geben Sie ein:

    mysql -u Benutzer -pPasswort Datenbank < data.sql

Das Programm mk-sql-data hat eine MIT-Lizenz.

Weiterführende Informationen finden sich im Projekt-Wiki

  https://github.com/rstoetter/mk-sql-data/wiki

Vielen Dank, dass Sie sich die Zeit fürs Lesen genommen
haben und dafür, dass Sie diese Software nutzen möchten!

Herzliche Grüße

Rainer Stötter, Altenburg, Deutschland
