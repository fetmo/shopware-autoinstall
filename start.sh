#!/bin/bash

read -p 'Database host?     '  host
read -p 'Database port?     '  port
read -p 'Database name?     '  dbname
read -p 'Database user?     '  user
read -p 'Database password? '  password

read -p 'Shop name?         '  shopname
read -p 'Shop url?          '  url

echo "" > sql/3_create_shop.sql
echo "INSERT INTO s_core_shops (id, main_id, name, title, position, host, base_path, base_url, hosts, secure, secure_host, secure_base_path, template_id, document_template_id, category_id, locale_id, currency_id, customer_group_id, fallback_id, customer_scope, \`default\`, active, always_secure) VALUES (1, NULL, '$shopname', '$shopname', 0, '$url', NULL, NULL, '$url', 0, NULL, NULL, 22, 22, 3, 1, 1, 1, NULL, 0, 1, 1, 0);" >> sql/3_create_shop.sql


for file in sql/*.sql; do
	mysql -u$user -p$password -h$host -P$port $dbname < $file
done

cd shop

if [ -e config.php ]
then
	echo "" > config.php
else
	touch config.php
fi

echo "<?php" >> config.php
echo "return array(" >> config.php
echo "  'db' => array(" >> config.php
echo "    'username' => '$user'," >> config.php
echo "    'password' => '$password'," >> config.php
echo "    'dbname' => '$dbname'," >> config.php
echo "    'host' => '$host'," >> config.php
echo "    'port' => '$port'" >> config.php
echo "  )" >> config.php
echo ");" >> config.php

if [ -d vendor ]
then
	rm -rf vendor
fi

wget http://getcomposer.org/composer.phar
chmod +x composer.phar

php composer.phar install

chmod +x bin/console
php bin/console sw:cache:clear






