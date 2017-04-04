Installing the library dbo_oci with the ORACLE DBO interface is easy on a debian linux machine:

## install ORACLE INSTANTCLIENT

we have to install the base and the development package
[[Install ORACLE INSTANTCLIENT]]

do not forget to set ORACLE_HOME

## install php interpreter

your version of the php interpreter ( and therefore the path ) may differ - 
```
mkdir /tmp/pdo_oci
cd /tmp/pdo_oci
apt-get source php-cli
cd php5-5.6.30+dfsg
cd ext/pdo_oci
```

## edit config.m4 
as ORACLE INSTANTCLIENT version 12.2 is not supported out of the box, we have to add this version to the config file config.m4

```
vi config.m4
```
change line 150:

9.0|10.1|10.2|11.1|11.2|12.1|12.2)

## prepare the environment and compile 

use the fitting version number of your INSTANTCLIENT. The pattern is _-with-pdo-oci=instantclient,prefix,version_

```
phpize

./configure --with-pdo-oci=instantclient,/usr,12.2
make
```
## find out, where the PHP extensions are located and copy the library pdo_oci.so in this directory

```
su

## where are the extensions?
php -i |grep "extension_dir"

cp modules/pdo_oci.so /usr/lib/php5/20131226
```

## tell php cli to use pdo_oci
```
echo "extension=pdo_oci.so" > /etc/php5/cli/conf.d/pdo_oci.ini
```

## verify the installation
php -m |grep PDO_OCI

