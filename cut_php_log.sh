#!/bin/bash -
# version: 1.22
. /etc/init.d/functions
strtime=`date +%Y%m%d --date "-1 days"`


# php5.2
php52_exist=`ps aux |grep php-cgi |grep root |grep -v grep |wc -l`
# php5.6
php56_exist=`ps aux |grep php-fpm |grep root |grep -v grep |wc -l`
# php7.0.16
php7_exist=`ps aux |grep php-fpm |grep root |grep -v grep |wc -l`

if [ ${php52_exist} -eq 1 ];then
        php_home=`ps aux |grep php-cgi |grep root |grep -v grep |awk '{print $NF}' |awk -F'/' '{print $(NF-2)}'`
elif [ ${php56_exist} -eq 1 ];then
        php_home=`ps aux |grep php-fpm |grep root |grep -v grep |awk '{print $NF}' |awk -F'/' '{print $(NF-2)}'`
elif [ ${php7_exist} -eq 1 ];then
        php_home=`ps aux |grep php-fpm |grep root |grep -v grep |awk '{print $NF}' |awk -F'/' '{print $(NF-2)}'`
else
        echo "PHP version of the error, or the existence of multiple PHP program."
#!/bin/bash -
# version: 1.22
. /etc/init.d/functions
strtime=`date +%Y%m%d --date "-1 days"`


# php5.2
php52_exist=`ps aux |grep php-cgi |grep root |grep -v grep |wc -l`
# php5.6
php56_exist=`ps aux |grep php-fpm |grep root |grep -v grep |wc -l`
# php7.0.16
php7_exist=`ps aux |grep php-fpm |grep root |grep -v grep |wc -l`

if [ ${php52_exist} -eq 1 ];then
        php_home=`ps aux |grep php-cgi |grep root |grep -v grep |awk '{print $NF}' |awk -F'/' '{print $(NF-2)}'`
elif [ ${php56_exist} -eq 1 ];then
        php_home=`ps aux |grep php-fpm |grep root |grep -v grep |awk '{print $NF}' |awk -F'/' '{print $(NF-2)}'`
elif [ ${php7_exist} -eq 1 ];then
        php_home=`ps aux |grep php-fpm |grep root |grep -v grep |awk '{print $NF}' |awk -F'/' '{print $(NF-2)}'`
else
        echo "PHP version of the error, or the existence of multiple PHP program."
        exit 1
fi


php_rotatelogs(){
        cd /opt/${php_home}/etc/
        if [[ ${php_home} == "php52" || ${php_home} == "php5" ]];then
                fpmlog=`grep error_log php-fpm.conf |awk -F\> '{print $2}' |awk -F\< '{print $1}'`
                mv ${fpmlog} ${fpmlog}_${strtime} && chmod 644 ${fpmlog}
                cd /opt/${php_home}/logs/
                mv slow.log slow.log_${strtime} && chmod 644 slow.log
                cd /opt/${php_home}/lib/
                errlog=`grep error_log php.ini |awk -F= '{print $NF}' |sed 's/ //g'`
                mv ${errlog} ${errlog}_${strtime}
                /opt/php5/sbin/php-fpm restart
        elif [[ ${php_home} == "php56" || ${php_home} == "php7" ]];then
                fpmlog=`grep error_log php-fpm.conf |awk -F= '{print $NF}' |sed 's/ //g'`
                mv ${fpmlog} ${fpmlog}_${strtime} && chmod 644 ${fpmlog}
                cd /opt/${php_home}/logs/
                mv slow.log slow.log_${strtime} && chmod 644 slow.log
                cd /opt/${php_home}/lib/
                errlog=`grep error_log php.ini |awk -F= '{print $NF}' |sed 's/ //g'`
                mv ${errlog} ${errlog}_${strtime}
                if [ ${php_home} == "php56" ];then
                        /opt/php56/sbin/php.service restart
                elif [ ${php_home} == "php7" ];then
                        /opt/php7/sbin/php.service restart
                fi
        else
                echo "bad configuration file."
                exit 1
        fi

}


php_rotatelogs
