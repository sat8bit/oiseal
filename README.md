# Oiseal

## build

```
vagrant up
vagrant ssh
cd oiseal
sudo apt-get install mysql-server
sudo ./config.sh
sudo ./install.sh
mysql -u root -p -e "create database oiseal"
mysql -u root -p oiseal < db/init/tables/seal.sql
mysql -u root -p oiseal < db/init/users/webapi.sql
sudo service apache2 restart
```
