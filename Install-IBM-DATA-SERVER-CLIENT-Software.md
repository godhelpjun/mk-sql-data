## First download the IBM Data Server Client from the IBM web page
## Install the client software
```
cd /tmp
mkdir db2-client
cd db2-client
tar xvf /tmp/ibm_data_server_client_linuxx64_v11.1.tar.gz

cd client
./db2_install -f sysreq -c /tmp/db2-client/nlpack
./installFixPack -f sysreq
  mit /opt/ibm/db2/V11.1
cd ..
```

## Edit /etc/hosts add entry 
- node name is limited to 8 characters and must not contain -
```
   192.168.1.67    debian-server-db2
   192.168.1.67    db2srv
```

## Initialize users, group, instance

```
groupadd -g 999 db2iadm1
groupadd -g 998 db2fadm1
groupadd -g 997 dasadm1
useradd -u 1004 -g db2iadm1 -m -d /home/db2inst1 db2inst1
useradd -u 1003 -g db2fadm1 -m -d /home/db2fenc1 db2fenc1
useradd -u 1002 -g dasadm1 -m -d /home/dasusr1 dasusr1
/opt/ibm/db2/V11.1/instance/db2icrt -a server -u db2fenc1 db2inst1
cp /home/db2inst1/sqllib/db2profile /etc/profile.d/db2profile.sh
```

## Create the instance alias
```
db2 "catalog tcpip node db2srv remote 192.168.1.67 server 50000"
db2 "terminate"
```
## Create the database alias
```
db2 "catalog database SAMPLE as SAMPLE at node db2srv authentication server"
db2 "catalog database phpsite as phpsite at node db2srv authentication server"
db2 "terminate"
```
## Test the connection
```
db2
CONNECT TO phpsite USER db2phpsite USING db2phpsite
```