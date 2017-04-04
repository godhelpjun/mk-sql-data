# Install oci8 for PHP 

## ORACLE INSTANTCLIENT must be installed

[[Install ORACLE INSTANTCLIENT]]

## the debian way:
```
pecl install oci8-2.0.10
```

## Tell PHP to load the oci library
```
vi /etc/php5/cli/php.ini
```

add the line:
```
  extension=oci8.so
```
