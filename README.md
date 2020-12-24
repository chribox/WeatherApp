# WeatherApp

WeatherApp est une application de visualisation d'informations météorologiques d'une localisation donnée.
Développé sous Symfony 5 en PHP 7.

## Prérequis
- Docker sur sa machine ([Mac](https://docs.docker.com/docker-for-mac/install/), [Ubuntu](https://docs.docker.com/engine/install/ubuntu/), [Windows](https://docs.docker.com/docker-for-windows/install/))
- Docker-compose https://docs.docker.com/compose/install/

## Installation

Pour installer l'application veuillez suivre les instructions suivantes : 

### Instructions

- Dans le dossier infra du projet lancez la commande `docker-compose up -d --build`
- Puis lancez la commande `docker-compose run encore yarn install`
   
- Veuillez renseigner le fichier _.env_ avec les informations suivantes : 
**OPEN_WEATHER_API_KEY** and **GOOGLEMAP_API_KEY**

### Lancement

- Dans le dossier infra du projet lancez la commande `docker-compose up` et rendez vous dans votre navigateur sur l'adresse 
`http:/localhost/fr`

### Tests
- Dans le dossier infra du projet lancez la commande `docker-compose run php bin/phpunit`

## Utilisation

- Saisissez une localisation (autocomplétion) ou des coordonnées GPS afin d'en obbtenir les informations météorologiques.
- Une carte google map permet de vérifier la bonne localisation.

### langues
- Vous pouvez à tout moment changer la langue de l'application (actuellement Anglais, Français) en cliquant sur les boutons respectifs situés à droite dans le menu de l'application.

