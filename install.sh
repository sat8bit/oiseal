#!/bin/bash

# configs
COMPOSER=$HOME/bin/composer.phar
INSTALL_DIR=/var/www/oiseal
FILES="composer.json composer.lock"
DIRS="src public_html conf"

# copy to config files
cp etc/apache2/oiseal.conf /etc/apache2/sites-enabled/
cp etc/mysql/oiseal.cnf /etc/mysql/conf.d/
cp etc/php/oiseal.ini /etc/php5/apache2/conf.d/

# run
rm -rf $INSTALL_DIR
mkdir $INSTALL_DIR

for FILE in $FILES
do
    cp $FILE $INSTALL_DIR
done

for DIR in $DIRS
do
    cp -r $DIR $INSTALL_DIR
done

cd $INSTALL_DIR

$COMPOSER install --no-dev

