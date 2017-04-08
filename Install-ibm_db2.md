
## get the IBM DATA SERVER DRIVER FOR CLI from the IBM webpage
[[Install IBM DATA SERVER CLIENT Software]]

## Install the pdo_ibm library for IBM DB2
```
cd /tmp
su
mkdir php
cd php
pecl install ibm_db2
```
  mit DB2 Installation Directory = /opt/ibm/db2/V11.1
  -> Installing '/usr/lib/php5/20131226/ibm_db2.so'
```
echo "extension=ibm_db2.so" > /etc/php5/cli/conf.d/ibm_db2.ini
```
