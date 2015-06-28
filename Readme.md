# Filigrane

Ce module permet d'ajouter une image en filigrane de vos images produit dont la hauteur est > 200 px (pas de filigrane dans les miniatures).

Il suffit pour cela de placer une image nommée watermark.png dans le dossier config du module, et le tour est joué.

Le module retaille le filigranne pour que sa hauteur soit de 10% de la hauteur de l'image, et il positionne le filigranne
en bas à droite des images, avec une marge haute et basse de 2% de la taille de l'image.

Popur modifier ces valeurs, rendez-vous dans EventListeners\ImageListener.php
