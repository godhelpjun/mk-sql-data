#!/bin/bash

DATUMSBLOCK=$(date "+%Y-%m-%d-%H-%M")
STARTTIME=$(date +%s)

echo "Erstelle zufällige Testdaten mit mk-sql-data.php"

./mk-sql-data.php --cfg mk_sql_data-00.cmd
./mk-sql-data.php --cfg mk_sql_data-01.cmd

ENDTIME=$(date +%s)
secs=$(($ENDTIME - $STARTTIME))
printf 'Elapsed Time %dh:%dm:%ds\n' $(($secs/3600)) $(($secs%3600/60)) $(($secs%60))
