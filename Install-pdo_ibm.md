## install the client software and set the environment

## get the IBM DATA SERVER DRIVER FOR CLI from the IBM webpage
[[Install IBM DATA SERVER CLIENT Software]]

## make the pdo_ibm library
```
cd /tmp
mkdir pdo_ibm
cd pdo_ibm
tar xvf /tmp/ibm_data_server_driver_for_odbc_cli_linuxx64_v11.1.tar.gz

export C_INCLUDE_PATH=/tmp/pdo_ibm/clidriver/include/
export PDO_IBM_SHARED_LIBADD=/tmp/pdo_ibm/clidriver/lib

pecl download pdo_ibm
tar xvf PDO_IBM-1.3.4.tgz
cd PDO_IBM-1.3.4

phpize
./configure --with-pdo-ibm=/tmp/pdo_ibm/clidriver
make
```

## find out, where the PHP extensions are located and copy the library pdo_oci.so in this directory

```
su

## where are the extensions?
php -i |grep "extension_dir"

cp modules/pdo_ibm.so /usr/lib/php5/20131226
```

## tell php cli to use pdo_ibm
```
echo "extension=pdo_ibm.so" > /etc/php5/cli/conf.d/pdo_ibm.ini
```

## verify the installation
php -m |grep pdo_ibm

