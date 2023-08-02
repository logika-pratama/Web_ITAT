# Getting Started with ITAT Mobile

  
### Prerequisites
* Sebelumnya siapkan server installasi webserver apache ,mysql-server ,sslEngine,php7.1 dan Git <br />
  Install Webserver :
  
  * Apache2
  ```sh
  $ sudo apt install apache2
  ```
* php 7.1
   ```sh
  $ sudo apt install php7.1
   ```  
* MySql Server
  ```sh 
  $ sudo apt install mysql-server
  ```

* SslEngine  
  ```sh
  $ sudo yum install mod_ssl
  ```

* mysql 
  ```sh
  $ sudo apt-get install git-all
  ```
 

### Konfigurasi
* Github <br />
  Clone Repository
  ```sh
  $ git clone  https://github.com/logika-pratama/itat.git
  ```
 
* Konfigurasi database pada source code berdasarkan settingan mysql<br />
  /application/config/database.php
  <br />
  contoh :<br />
  'hostname' = 'localhost',<br />
	'username' = 'root',<br />
	'password' = 'P@ssw0rd',<br />
	'database' = 'rfid_db',<br />
	'dbdriver' = 'mysqli',<br />
  
  Lakukan check ip address pada server
  ```sh
  $ ipconfig
  ```
  
  Jalankan aplikasi pada prangkat lain yang terhubung dengan membuka browser berdasarkan IP Adress pada server
  ```sh
  https://IP-ADDRESS-SEVER/itat
  ```
  