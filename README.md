# Oiseal

## build

```
vagrant up
vagrant ssh
cd oiseal
sudo apt-get install mysql-server
mysql -u root -p -e "create database oiseal"
mysql -u root -p oiseal < db/init/tables/seal.sql
mysql -u root -p oiseal < db/init/users/webapi.sql
vim conf/oiseal.ini
vim public_html/assets/js/app.js
sudo ./install.sh
sudo service apache2 restart
```
