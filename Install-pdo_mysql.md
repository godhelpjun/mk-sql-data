Installing the library pdo_mysql with the MySQL DBO interface is easy on a debian linux machine:

## install MYSQL client libraries
```
apt-get install libmysqlclient-dev
```
## install php interpreter

your version of the php interpreter ( and therefore the path ) may differ - 
```
mkdir /tmp/pdo_mysql
cd /tmp/pdo_mysql
apt-get source php-cli
cd php5-5.6.30+dfsg
cd ext/pdo_mysql
phpize
./configure 
make
```
## find out, where the PHP extensions are located and copy the library pdo_oci.so in this directory
```
su

## where are the extensions?
php -i |grep "extension_dir"

cp modules/pdo_mysql.so /usr/lib/php5/20131226
```

## tell php cli to use pdo_oci
```
echo "extension=pdo_mysql.so" > /etc/php5/cli/conf.d/pdo_mysql.ini
```

## verify the installation
php -m |grep pdo_mysql


