Installation
===

1. chmod -R 777 sur tout le projet pour éviter les problèmes de permissions (ou uniquement sur le sous-dossier 'data')
2. Lancer le serveur web
  - Méthode 1. Utiliser Apache2 et créer un lien symbolique de ce dossier vers le dossier 'source' d'Apache2.
    - ex : sudo ln -s ~/quiz-back /var/www/html
  - Méthode 2. lancer le serveur web de développement intégré à PHP
    - ex : (sudo) php -S localhost:80