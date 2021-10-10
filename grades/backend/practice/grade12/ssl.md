# Настройка самоподписанного ssl

## Сначала нужно сгенерировать ключи для вашего локального домена

```
//домен yii-practice.local

openssl req -x509 -out ~/documents/ssl.crt -keyout ~/documents/ssl.key \
-newkey rsa:2048 -nodes -sha256 \
-subj '/CN=yii-practice.local' -extensions EXT -config <( \
printf "[dn]\nCN=yii-practice.local\n[req]\ndistinguished_name = dn\n[EXT]\nsubjectAltName=DNS:yii-practice.local\nkeyUsage=digitalSignature\nextendedKeyUsage=serverAuth")

openssl dhparam -out ~/documents/dhparam.pem 2048
```

## Пример конфигурационного файла nginx
```
server {
        charset utf-8;
        client_max_body_size 128M;
        listen 80;
        listen [::]:80;

        server_name yii-practice.local;
        # редирект на HTTPS

        return 301 https://$server_name$request_uri;
        server_tokens off;
}

server {
        charset utf-8;
        client_max_body_size 128M;
        listen 443 ssl http2;
        listen [::]:443 ssl http2;

        server_name yii-practice.local;

        # Подстановка созданных ключей
        ssl_certificate /etc/nginx/ssl/ssl.crt;
        ssl_certificate_key /etc/nginx/ssl/ssl.key;
        ssl_dhparam /etc/nginx/ssl/dhparam.pem;

        ssl_session_timeout 1d;
        ssl_session_cache shared:SSL:50m;
        ssl_session_tickets off;
        # конфигурация Modern
        ssl_protocols TLSv1.2;
        ssl_ciphers 'ECDHE-ECDSA-AES256-GCM-SHA384:ECDHE-RSA-AES256-GCM-SHA384:ECDHE-ECDSA-CHACHA20-POLY1305:ECDHE-RSA-CHACHA20-POLY1305:ECDHE-ECDSA-AES128-GCM-SHA256:ECDHE-RSA-AES128-GCM-SHA256:ECDHE-ECDSA-AES256-SHA384:ECDHE-RSA-AES256-SHA384:ECDHE-ECDSA-AES128-SHA256:ECDHE-RSA-AES128-SHA256';
        ssl_prefer_server_ciphers on;
        # HSTS - форсированно устанавливать соединение по HTTPS
        add_header Strict-Transport-Security "max-age=15768000";
        # Разрешение прикрепления OCSP-ответов сервером
        ssl_stapling on;
        # Разрешение проверки сервером ответов OCSP
        ssl_stapling_verify on;

        server_name localhost;
        root        /var/www/app/web;
        index       index.php;

        location / {
            try_files $uri $uri/ /index.php$is_args$args;
        }

        location ~ ^/assets/.*\.php$ {
            deny all;
        }

        location ~ \.php$ {
            include fastcgi_params;
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
            fastcgi_pass php:9000;
            try_files $uri =404;
        }

        location ~* /\. {
            deny all;
        }

        location ~ /.well-known {
                allow all;
        }
}
```