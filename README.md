# Getting Started with ITAT Mobile

  
### Prerequisites
* Sebelumnya siapkan server installasi webserver apache ,mysql ,sslEngine,php7.1 dan Git <br />
  Install Webserver :
  
  sudo apt install apache2<br />
  sudo apt install php7.1<br />
  sudo apt install mysql<br />
  sudo yum install mod_ssl<br />
  sudo apt-get install git-all<br /> 

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
  