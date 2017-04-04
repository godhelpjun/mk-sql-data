
## download the packages

- go to the ORACLE website and search for INSTANTCLIENT [INSTANT CLIENT](https://www.google.de/url?sa=t&rct=j&q=&esrc=s&source=web&cd=1&cad=rja&uact=8&ved=0ahUKEwjVvJPVx4PTAhULkSwKHd4QD5QQFgglMAA&url=http%3A%2F%2Fwww.oracle.com%2Ftechnetwork%2Fdatabase%2Ffeatures%2Finstant-client%2Findex-097480.html&usg=AFQjCNG0psq_TG0eboqXY6CNm22mqyg6HQ&sig2=u6AvAYNZLSpVY0uvJR_QfQ)

- download the base package from ORACLE website
- download the devel package from ORACLE website
- download the sql plus package from ORACLE website

## convert and install the packages
```
alien --scripts -d oracle-instantclient12.2-basic-12.2.0.1.0-1.x86_64.rpm
alien --scripts -d oracle-instantclient12.2-devel-12.2.0.1.0-1.x86_64.rpm
alien --scripts -d oracle-instantclient12.2-sqlplus-12.2.0.1.0-1.x86_64.rpm
dpkg --install *.deb
```
## Set ORACLE HOME and the ORACLE LIBRARY path

change ~/.bashrc

```
ORACLE_HOME=/usr/lib/oracle/12.2/client64/
export DYLD_LIBRARY_PATH=$ORACLE_HOME/lib
export LD_LIBRARY_PATH=$LD_LIBRARY_PATH:$DYLD_LIBRARY_PATH
```


