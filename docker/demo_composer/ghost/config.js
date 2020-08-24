var path=require('path'),
    config;
config={
    production:{
        "url": "http://localhost:2368",
        "server": {
            "port": 2368,
            "host": "0.0.0.0"
        },
        "database": {
            "client": "mysql",
            "connection": {
                "host": "db",
                "user": "ghost",
                "password": "ghost",
                "database": "ghost",
                "port": "3306",
                "charset": "utf8",
            },
            // "debug":false

        },
        "mail": {
            // "transport": "Direct"
        },
        "logging": {
            "transports": [
                "file",
                "stdout"
            ]
        },
        "process": "systemd",
        "paths": {
            "contentPath": path.join(process.env.GHOST_CONTENT,'/')
        }
    }
}
module.exports = config;