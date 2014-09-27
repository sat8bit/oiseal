# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
  config.vm.box = "precise64"
  config.vm.box_url = "http://files.vagrantup.com/precise64.box"

  config.vm.network :forwarded_port, guest: 80, host: 8080

  config.vm.synced_folder "./", "/home/vagrant/oiseal"

  config.vm.provision "shell", inline: <<-EOT
        # Apache
        apt-get -y update
        apt-get -y install python-software-properties
        add-apt-repository ppa:ondrej/php5
        apt-get -y update
        apt-get -y install php5 php5-mysqlnd curl git
        a2enmod rewrite
        apt-get install curl
        mkdir bin
        curl -sS https://getcomposer.org/installer | php -- --install-dir=bin
        service apache2 start
  EOT

end
