# CTL4.biz is a fork of the Codeka simple web ERP. Under GPL3 Free Software Terms. Please reffer to the Licence file on this repo.
#Installation
+ Unzip Docker.zip in Docker 
+ Move repository into src directory
  This should be the directory structure on development environment starting on your chose directory. We will use `~/ctl4biz`
* `~/ctl4biz/src`: Contains the repository
* `~/ctl4biz/Docker`: Contains the Docker folder
#Run docker
```
cd ~/ctl4biz/DockerDocker; 
docker-compose build; 
docker-compose up -d;
```
#Access Docker  and access the main root
```
cd ~/ctl4biz/DockerDocker; 
docker exec -it docker_nginx_1  ash;
cd /var/www/html
```
#Configuration Files
Set the database host, user and password config.php 

