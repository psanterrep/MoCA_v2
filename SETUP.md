# Installation

## Pr�requis
- Composer
- PHP
- Node
- MariaDB 5.5.48

## Base de donn�es
1. Cr�er la base de donn�es "moca"
2. Cr�er un utilisateur "moca"
3. Mettre les informations de votre base de donn�es dans le fichier ".env", n'oublier pas le mot de passe

## Projet
1. Dans le dossier htdocs du projet, g�n�rer votre cl�
~~~shell
php artisan key:generate
~~~
2. Changer le "APP_URL" du fichier ".env" par "moca.com.local"
3. Cr�ation de la base de donn�e
~~~shell
php artisan migrate
~~~
4. Ajout des d�pendances composer
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