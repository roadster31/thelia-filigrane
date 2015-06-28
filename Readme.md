# Module Filigrane pour Thelia 2

Ce module permet d'ajouter une image en filigrane de vos images produit dont la hauteur est > 200 px (pas de filigrane dans les miniatures).

Il suffit pour cela de placer une image nommée `watermark.png` dans le dossier `Config` du module, et le tour est joué.

Le module retaille le filigrane pour que sa hauteur soit de 10% de la hauteur de l'image, et il positionne le filigrane en bas à droite des images, avec une marge haute et basse de 2% de la taille de l'image.

Pour modifier ces valeurs, rendez-vous dans `EventListeners\ImageListener.php`
