## Install the client software and set the environment
[[Install Informix Client Software]]

## make the pdo_informix library
```
mkdir /tmp/pdo_informix
cd /tmp/pdo_informix
pecl download PDO_INFORMIX
tar xvf PDO_INFORMIX-1.3.3.tgz
cd PDO_INFORMIX-1.3.3
phpize
./configure
make
```

## find out, where the PHP extensions are located and copy the library pdo_oci.so in this directory

```
su

## where are the extensions?
php -i |grep "extension_dir"

cp modules/pdo_informix.so /usr/lib/php5/20131226
```

## tell php cli to use pdo_informix
```
echo "extension=pdo_informix.so" > /etc/php5/cli/conf.d/pdo_informix.ini
```

## verify the installation
php -m |grep pdo_informix



