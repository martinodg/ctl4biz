# CTL4.biz is a fork of the Codeka simple web ERP. Under GPL3 Free Software Terms. Please reffer to the Licence file on this repo.
#Installation
+ Run Docker 
+ Access Docker
+ Change image's directory permission ` chmod 777 /var/www/img/`
+ Visit the website and register [http://localhost/login/register.html](http://localhost/login/register.html)
#Run Docker
+ Unzip Docker.zip in Docker
+ Move repository into src directory 
  *This should be the directory structure on development environment starting on your chose directory. We will use `~/ctl4biz`
  * `~/ctl4biz/src`: Contains the repository
  * `~/ctl4biz/Docker`: Contains the Docker folder
  * `cd ~/ctl4biz/Docker` : Go into Docker
  * `docker-compose up -d` : Run docker-compose, it will set up and get up the containers
#Database
+ Truncate tables on T_8d6846c85e8076b85318fd1054480811 database
+ Import `~/ctl4biz/src/database1.sql` into T_8d6846c85e8076b85318fd1054480811
#Access Docker  and access the main root
+ Run Docker 
+ `docker exec -it docker_nginx_1  ash` : Run Ash into the container
#Configuration Files
Set the database host, user and password config.php 
#Resource :
* Website [http://localhost/](http://localhost/)
* PHPMyAdmin [http://localhost:8080](http://localhost:8080/)

