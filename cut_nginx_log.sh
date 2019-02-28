#!/bin/bash -
# version: 1.5
# modify IP to Domain name 20180608

. /etc/init.d/functions
strtime=`date +%Y%m%d%H`
log_path="/export/home/logs"
ngx_pid=`ps axu |grep -v grep |grep 'nginx: master process' |awk '{print $2}'`


Usage(){
    green="\033[36m"
    ed="\033[0m"
    echo -e "${green}$0${ed} [ create | rotatelogs | compress ]"
}

if [ $# -ne 1 ];then
    Usage && exit 1
fi

log2file(){
    UpTime=`date "+%Y-%m-%d %H:%M:%S"`;
    LogFile="/tmp/ngx_cut_log.txt";
    Info=$1;
    echo "${UpTime} $HOSTNAME ${Info}" >> ${LogFile}
}

ngx_home=`ps axu |grep -v grep |grep 'nginx: master process' |awk '{print $14}' |sed 's#/sbin/nginx$##'`
cd ${ngx_home}/conf/
acclog=`grep access_log nginx.conf vhost/* |egrep -v "off|#access_log" |awk '{print $3}' |awk -F'/' '{print $(NF-1)}'`
for i in ${acclog}
do
    if [ ! -d ${log_path}/${i} ];then
        mkdir -p ${log_path}/${i}
    fi
done

rotatelogs(){
    cd ${log_path}
    log_name=`ls -l |grep "^d" |awk '{print $NF}'`
    for y in ${log_name}
    do
        cd ${log_path}/${y}
        mv access.log access_${strtime}.log
        if [ $? -eq 0 ]
        then
            log2file "rename ${y}_access.log success."
        else
            log2file "rename ${y}_access.log failed."
        fi
    done

    kill -USR1 ${ngx_pid}
    if [ $? -eq 0 ]
    then
        log2file "Nginx reload log file is OK."
    else
        log2file "Nginx reload log file is ERROR."
    fi

}
compress(){
    cd ${log_path}
    log_name=`ls -l | grep "^d" | awk '{print $NF}'`
    b1day=`date +%Y%m%d --date "-1 days"`
    for y in ${log_name}
    do
        then 
            log2file "${b1day} ${y}_log already backup"
            rm -f access_${b1day}*.log
            if [ $? -eq 0 ]
            then 
                log2file "yesterday log ${y}_access_${b1day}*.log delete success."
            else
                log2file "yesterday log ${y}_access_${b1day}*.log delete failed."
            fi  
        else
            tar jcf bak_access_${b1day}.bz2 access_${b1day}*.log
            if [ $? -eq 0 ]
            then 
                log2file "${b1day} ${y}_log compress success."
                rm -f access_${b1day}*.log
                if [ $? -eq 0 ]
                then 
                    log2file "yesterday log ${y}_access_${b1day}*.log delete success."
                else
                    log2file "yesterday log ${y}_access_${b1day}*.log delete failed."
                fi  
            else
                log2file "${b1day} ${y}_log compress failed."
            fi  
        fi  
    done
    
}

rsync(){
    ipaddr=`/sbin/ifconfig eth0|grep 'inet addr' | awk -F : '{print$2}' | awk '{print $1}'`
    domain=`find /export/home/logs/ -maxdepth 1 -type d |grep -w -v "/export/home/logs/" |awk -F/ '{print $NF}'`
    for i in ${domain}
    do
        cd /tmp/ && mkdir ${i} && /usr/bin/rsync -vzrtopg --progress ${i} m873b.rsync.filebackup.op.xcar.com.cn::xcar_nginx_log_backup/
        rmdir /tmp/${i}
    done

}

clean(){
    date1=`date +%Y%m%d --date "-14 days"`
    t1=`date -d "$date1" +%s`
    for i in ${acclog}
    do
        cd ${log_path}/${i}
        date2=`find . -maxdepth 1 -name "*.bz2" |awk -F/ '{print $NF}' |awk -F[_\.] '{print $3}' |sort`
        for y in ${date2}
        do
            t2=`date -d "$y" +%s`
            if [ $t1 -gt $t2 ]; then
                rm -f bak_access_${y}.bz2
            fi
        done
    done

}



case $1 in
    create_dir ) create
    ;;
    rotatelogs ) rotatelogs
    ;;
    compress ) compress ; rsync ; clean
    ;;
    rsync ) rsync
    ;;
    clean ) clean
    ;;
    * ) Usage
    ;;
esac
