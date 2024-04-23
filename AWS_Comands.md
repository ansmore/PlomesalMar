-sudo apt update
-sudo apt install apache2
-sudo systemctl enable apache2

-sudo apt update
-sudo apt upgrade
-sudo ufw status -------------si es inactive
-sudo ufw app list
-sudo ufw allow in "Apache Full"
-sudo ufw allow in "OpenSSH"
-sudo ufw enable

INSTALAR MYSQL
-sudo systemctl restart apache2
-sudo apt install mysql-server
-sudo mysql_secure_installation

INSTALAR PHP
-sudo apt install php libapache2-mod-php php-mysql

PROYECTO
-sudo apt update
-sudo add-apt-repository ppa:ondrej/php
-sudo apt update
-sudo apt install php8.2 php8.2-cli php8.2-xml php8.2-mbstring php8.2-curl
-sudo apt install php8.2-xml php8.2-dom php8.2-curl
-cd ~
-curl -sS https://getcomposer.org/installer | php
-sudo mv composer.phar /usr/local/bin/composer
-sudo git clone https://git.copernic.cat/valls.berengueras.albert/2024_plomes_al_mar.git

fer aixo dins de site (y la api cuan sigui necesari):
-cd /var/www/html/2024_plomes_al_mar/site
-sudo composer update
-sudo cp .env.example .env
-sudo php artisan key:generate
-sudo php artisan storage:link

INSTALAR DOCKER
-sudo apt-get update
-sudo apt-get install apt-transport-https ca-certificates curl software-properties-common
-cd ~
-curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /usr/share/keyrings/docker-archive-keyring.gpg
-echo "deb [arch=$(dpkg --print-architecture) signed-by=/usr/share/keyrings/docker-archive-keyring.gpg] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
-sudo apt-get update
-sudo apt-get install docker-ce docker-ce-cli containerd.io
-sudo curl -L "https://github.com/docker/compose/releases/download/VERSION/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
-sudo chmod +x /usr/local/bin/docker-compose
-cd /var/www/html/2024_plomes_al_mar/site

-cd ~
-sudo systemctl stop mysql
-pgrep mysql(si sigue devolviendo algun numero de proceso)
-sudo kill -9 $(pgrep mysql)
-sudo mysqld_safe --skip-grant-tables &
-mysql -u root
-(DENTRO DE MYSQL)
-FLUSH PRIVILEGES;
ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'NuevaContraseña123!';
EXIT;

-sudo kill $(pgrep mysqld_safe)
-sudo systemctl start mysql (si da error)
-sudo kill -9 $(pgrep mysql)
-pgrep mysql(solo tiene que devolver uno)

- sudo systemctl start mysql

-cd /var/www/html/2024_plomes_al_mar/site/
-sudo nano docker-compose.yml{
version: '3'

services:
mi_mysql:
image: mysql:latest
container_name: mi_mysql
environment:
MYSQL_ROOT_PASSWORD: NuevaContraseña123!
MYSQL_DATABASE: plomesdemar
MYSQL_USER: root
MYSQL_PASSWORD: NuevaContraseña123!
ports: - "3306:3306"
command: --default-authentication-plugin=mysql_native_password

mysql_api:
image: mysql:latest
container_name: mysql_api
environment:
MYSQL_ROOT_PASSWORD: NuevaContraseña123!
MYSQL_DATABASE: apibd
MYSQL_USER: root
MYSQL_PASSWORD: NuevaContraseña123!
ports: - "3307:3306"
command: --default-authentication-plugin=mysql_native_password
}

- editar ficher sudo nano .env{
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=plomesdemar
  DB_USERNAME=root
  DB_PASSWORD=NuevaContraseña123!
  }

-sudo nano /etc/systemd/system/plomesdemar.service {
[Unit]
Description=Levantar Docker Compose

[Service]
WorkingDirectory=/var/www/html/2024_plomes_al_mar/site
ExecStart=/usr/local/bin/docker-compose -f /var/www/html/2024_plomes_al_mar/site/docker-compose.yml up -d

[Install]
WantedBy=multi-user.target
}
-sudo systemctl daemon-reload
-sudo systemctl enable plomesdemar.service
-sudo systemctl start plomesdemar.service
-sudo systemctl restart apache2
-sudo nano /etc/apache2/sites-available/plomesalmar.conf{
<VirtualHost \*:80>
ServerName (ip `publica)
DocumentRoot /var/www/html/2024_plomes_al_mar/site/public

    <Directory /var/www/html/2024_plomes_al_mar/site/public>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

</VirtualHost>
}
-sudo a2dismod php8.1
-sudo a2enmod php8.2
-sudo systemctl restart apache2
-sudo a2ensite plomesalmar.conf
-sudo systemctl restart apache2

-sudo mkdir -p /var/www/html/2024_plomes_al_mar/site/storage/logs
-sudo chown -R www-data:www-data /var/www/html/2024_plomes_al_mar/site/storage
-sudo chown -R www-data:www-data /var/www/html/2024_plomes_al_mar/site/bootstrap/cache
-sudo chmod -R 775 /var/www/html/2024_plomes_al_mar/site/storage
-sudo chmod -R 775 /var/www/html/2024_plomes_al_mar/site/bootstrap/cache
-sudo systemctl restart apache2
-sudo a2enmod rewrite
-sudo systemctl restart apache2
