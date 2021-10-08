FROM nginx:1.14-alpine

RUN addgroup -g 1000 developer \
    && adduser -u 1000 -D -h /home/developer -G developer -s /bin/sh developer

WORKDIR /var/www/app/web