#!/usr/bin/env bash

apt-get update
apt-get -y --no-install-recommends install cron  php-memcached php7.3-mysql php7.3-pgsql php-redis php7.3-sqlite3 php-xdebug php7.3-bcmath php7.3-bz2 php7.3-dba php7.3-enchant php7.3-gd php-gearman php7.3-gmp php-igbinary php-imagick php7.3-imap php7.3-interbase php7.3-intl php7.3-ldap php-mongodb php-msgpack php7.3-odbc php7.3-phpdbg php7.3-pspell php-raphf php7.3-recode php7.3-snmp php7.3-soap php-ssh2 php7.3-sybase php-tideways php7.3-tidy php7.3-xmlrpc php7.3-xsl php-yaml php-zmq git vim
apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

composer install
php artisan migrate
php artisan db:seed
php artisan passport:install
php artisan telescope:install
php artisan cache:clear
php artisan apidoc:rebuild
chmod -R 777 storage
