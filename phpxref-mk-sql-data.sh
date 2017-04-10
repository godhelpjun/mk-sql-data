#!/bin/bash

DATUMSBLOCK=$(date "+%Y-%m-%d-%H-%M")
STARTTIME=$(date +%s)

echo "Erstelle XREF vom Projekt"

mkdir -p xref
rm xref/* -R


# cd ../misc/phpxref-0.7.1

time nice -n 15 ../misc/phpxref-0.7.1/phpxref.pl $* -c phpxref-mk-sql-data.cfg
# cd ../../mk-sql-data

ENDTIME=$(date +%s)
secs=$(($ENDTIME - $STARTTIME))
printf 'Elapsed Time %dh:%dm:%ds\n' $(($secs/3600)) $(($secs%3600/60)) $(($secs%60))
chromium xref/index.html &
sleep 5




