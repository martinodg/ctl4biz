# CTL4.biz is a fork of the Codeka simple web ERP. Under GPL3 Free Software Terms. Please reffer to the Licence file on this repo.
#Run docker
```
cd Docker; 
docker-compose build; 
docker-compose up -d;
```
#Access Docker  and access the main root
```
cd Docker; 
docker exec -it docker_nginx_1  ash;
cd /var/www/html
```
#Configuration Files
Set the database host, user and password config.php 

