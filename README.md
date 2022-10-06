# Php-fpm-alpine x Nginx
### Symfony | Docker

Avec MariaDB & MailDev

Pour lancer le projet :
````shell
docker-compose up -d
docker exec symfony_docker composer create-project symfony/skeleton html
sudo chown -R $USER ./
````

Pensez ensuite à aller exécuter toutes vos commandes depuis l'intérieur du container.

Par exemple :
````shell
cd symfony_project
composer require orm
````
(Demandez à Composer de NE PAS créer une config Docker pour la database)

Enfin, modifiez la config DB dans le fichier .env de Symfony :
````shell
DATABASE_URL=mysql://root:ChangeMeLater@db:3306/symfony_db?serverVersion=mariadb-10.7.1
````
