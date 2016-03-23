# Installation

## Prérequis
- Composer
- PHP
- Node
- MariaDB 5.5.48

## Base de données
1. Créer la base de données "moca"
2. Créer un utilisateur "moca"
3. Mettre les informations de votre base de données dans le fichier ".env", n'oublier pas le mot de passe

## Projet
1. Dans le dossier htdocs du projet, générer votre clé
~~~shell
php artisan key:generate
~~~
2. Changer le "APP_URL" du fichier ".env" par "moca.com.local"
3. Création de la base de donnée
~~~shell
php artisan migrate
~~~
4. Ajout des dépendances composer
~~~shell
composer install
~~~

## Serveur
1. Modifier le fichier "httpd.conf", changez la ligne 
~~~shell
#Include conf/extra/httpd-vhosts.conf
~~~
par
~~~shell
Include conf/extra/httpd-vhosts.conf
~~~
2. Modifier le fichier "extra/httpd-vhosts.conf" pour y ajouter
~~~shell
<VirtualHost *:80>
	ServerName moca.com.local
	DocumentRoot c:/wamp64/www/moca_v2/moca/public
	<Directory  "c:/wamp64/www/moca_v2/moca/public">
		Options Indexes FollowSymLinks MultiViews
		AllowOverride All
		Require local
	</Directory>
</VirtualHost>
~~~
3. Modifier votre fichier "host" pour y ajouter
~~~shell
127.0.0.1 mocal.com.loca
~~~