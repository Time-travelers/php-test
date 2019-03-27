#!/bin/bash
###
###wdCP install scripts
###
ver="v3.3.6"
bit=`getconf LONG_BIT`
filename=wdcp_${ver}_${bit}.tar.gz
ind="/www/wdlinux/wdcp"
if [ -f $ind/data/db.inc.php ];then
if [ -d /www/wdlinux/wdcp/phpmyadmin ];then
cp -pR /www/wdlinux/wdcp/phpmyadmin /www/web/default/
fi
service wdapache stop
mv $ind /www/wdlinux/wdcp2
if [ -f /www/wdlinux/wdcp/data/db.inc.php ];then
sed -i 's#/wdcp#/wdcp2#' /www/wdlinux/wdapache/conf/httpd.conf
fi
grep "8080" /www/wdlinux/wdapache/conf/httpd.conf
if [ $? == 0 ];then
sed -i 's/8080/8090/' /www/wdlinux/wdapache/conf/httpd.conf
iptables -I INPUT -p tcp --dport 8090 -j ACCEPT
else
iptables -I INPUT -p tcp --dport 8080 -j ACCEPT
fi
iptables-save > /etc/sysconfig/iptables
#service wdapache start
fi
if [ ! -d $ind ];then
mkdir -p $ind
fi
cd $ind
wget -c http://dl.wdlinux.cn/files/wdcp/$filename
if [ $? == 0 ];then
tar zxvf $filename
mkdir {logs,data,tmp,rewrite,conf}
ln -sf bin/wdcp_${ver}_${bit} wdcp
if [ ! -f /bin/mysql ];then
ln -s /www/wdlinux/mysql/bin/mysql /bin/mysql
fi
chown root.root bin favicon.ico html static shell conf -R
chmod 700 data conf shell bin html
ln -sf /www/wdlinux/wdcp/wdcp.sh /etc/rc.d/init.d/wdcp
chkconfig --add wdcp
chkconfig --level 35 wdcp on
service wdcp start
rm -f $filename
fi
cd -
rm -f install_v3.sh

