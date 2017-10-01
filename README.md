sf-comtocode
============

Projet Symfony 3.3.9 qui consiste à se loguer depuis un formulaire afin de pouvoir accéder à un formulaire de contact renvoyant à un email.

##Installer le projet
Cloner le repository Git sur Github :
https://github.com/Axelle-slv/sf-comtocode

Positionnez-vous à la racine du projet puis tapez la commande ```composer install```.

Ensuite, générez la base de données avec la commande ```doctrine:database:create``` puis créez les tables avec la commande ```doctrine:schema:update```.

Importez le dump de la base existante qui se trouve dans le dossier db_dump.

