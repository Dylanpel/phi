# Co Creative Challenge - Pharmacie Humanitaire Internationale

## Installation du projet sous windows avec XAMP

### Activer les Virtual Hosts

Dans le fichier :
`C:\xampp\apache\conf\httpd.conf`

Vérifie que cette ligne est décommentée :
`Include conf/extra/httpd-vhosts.conf`

### Déclarer ton Virtual Host

Dans le fichier :
`C:\xampp\apache\conf\extra\httpd-vhosts.conf`

Ajouter à la fin (remplacer le chemin par le chemin sur votre poste, la première partie devant être mise une seule fois) :
```apache
<VirtualHost *:80>
    ServerName localhost
    DocumentRoot "C:/xampp/htdocs"

    <Directory "C:/xampp/htdocs">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>

<VirtualHost *:80>
    ServerName phi.local
    DocumentRoot "C:/xampp/htdocs/phi/public"

    <Directory "C:/xampp/htdocs/phi/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

### Modifier le fichier hosts Windows

Ouvre en tant qu'administrateur :
`C:\Windows\System32\drivers\etc\hosts`

Ajoute à la fin :
`127.0.0.1 phi.local`

### Dupliquer localement le fichier de configuration

Copier le fichier `.env` vers `.env.local` et modifier éventuellement les paramètres suivant :

```env
APP_ENV=dev

DB_HOST=localhost
DB_NAME=ccc_phi
DB_USER=root
DB_PASS=
```

### Créer et installer la base de donnée

Installer la dernière version de la base de donnée présente dans `database/schema.sql`.
Utiliser le nom de base `ccc_phi`.

## Lancement du projet

### Installation de Composer

Voir le site [getcomposer.org](https://getcomposer.org/download/) pour télécharger installer `Composer-Setup.exe`.
Laisser vide à l'étape Proxy. Cocher la case pour ajouter au PATH (indispensable).


### Installation des dépendendaces et compilation du projet

Lancer les commandes suivantes :
`composer install`

### Pour exécuter une version de dev en local :

Lancer le server Apache et Mysql dans Xamp et se rendre sur l'adresse :
[phi.local](http://phi.local)
