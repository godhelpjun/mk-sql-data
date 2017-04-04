# Install oci8 for PHP 

## ORACLE INSTANTCLIENT must be installed

[[Install ORACLE INSTANTCLIENT]]

## the debian way:
```
pecl install oci8-2.0.10
```

## Tell PHP to load the oci library

```
echo "extension=oci8.so" > /etc/php5/cli/conf.d/oci8.ini
```
