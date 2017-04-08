The IBM Informix Dynamic Server driver for PDO needs To build and run PDO_INFORMIX the Informix Client Software Development Kit (CSDK) from http://ibm.com/informix/downloads.html.
```
mkdir /tmp/ifx
cd /tmp/ifx
```
## Download the package
- Download the clientsdk.4.10.FC8DE.LINUX.tar

## Extract the package

```
tar xvf clientsdk.4.10.FC8DE.LINUX.tar
```

## Run the installer
```
./installclientsdk
```

## Set your environment variables
```
export PATH=$PATH:/opt/IBM/informix/bin/
export INFORMIXDIR=/opt/IBM/informix
export INFORMIXSQLHOSTS=/opt/IBM/informix/etc/sqlhosts
export INFORMIXSERVER=ol_informix1210
export CLIENT_LOCALE=DE_DE.8859-1 
# alias dbaccess="rlwrap dbaccess"
```

