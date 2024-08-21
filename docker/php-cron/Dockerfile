ARG PHP_VERSION
FROM sanechek/php:${PHP_VERSION}

RUN apt-get update && apt-get install -y cron
ADD schedule /etc/cron.d/schedule
RUN crontab /etc/cron.d/schedule
