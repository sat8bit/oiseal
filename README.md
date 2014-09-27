# Oiseal

## build

```
vagrant up
vagrant ssh
cd oiseal
./config.sh
sudo apt-get install mysql-server
sudo ./install.sh
sudo service mysql restart
mysql -u root -p -e "create database oiseal"
mysql -u root -p oiseal < db/init/tables/seal.sql
mysql -u root -p oiseal < db/init/users/webapi.sql
sudo service apache2 restart
```
