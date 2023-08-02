# Getting Started with ITAT Mobile

  
### Prerequisites
* Sebelumnya siapkan server installasi webserver apache ,mysql-server ,sslEngine,php7.1 dan Git <br />
  Install Webserver :
  
* Apache2
  ```sh
  sudo apt install apache2
  ```
* php 7.1
  ```sh
  sudo apt-get install software-properties-common
  ```
  ```sh
  sudo add-apt-repository ppa:ondrej/php
  ```
  ```sh
  sudo apt-get update
  ```
  ```sh
  sudo apt-get install php7.1 php7.1-cli php7.1-common php7.1-json php7.1-opcache php7.1-mysql php7.1-mbstring php7.1-mcrypt php7.1-zip php7.1-fpm

   ```  
* MySql Server
  ```sh 
  sudo apt install mysql-server
  ```

* SslEngine  
  ```sh
  sudo yum install mod_ssl
  ```

* mysql 
  ```sh
  sudo apt-get install git-all
  ```
 

### Konfigurasi
* Github <br />
  Clone Repository
  ```sh
  $ git clone  https://github.com/logika-pratama/itat.git
  ```

* Letakan Folder clone pada webserver
  Clone Repository
  ```sh
  /var/www/html/
  ```
 
* Konfigurasi database pada source code berdasarkan setting mysql<br />
  
  /application/config/database.php
  
  <br />
  contoh :<br />
  'hostname' = 'localhost',<br />
	'username' = '[db_user]',<br />
	'password' = '[db_password]',<br />
	'database' = '[db_database]',<br />
	'dbdriver' = 'mysqli',<br />
  
  Lakukan check ip address pada server
  ```sh
  $ ipconfig
  ```
  
  Jalankan aplikasi pada prangkat lain yang terhubung dengan membuka browser berdasarkan IP Adress pada server
  ```sh
  https://IP-ADDRESS-SEVER/itat
  ```
