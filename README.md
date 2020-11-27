# WeatherApp

WeatherApp est une application de visualisation d'informations météorologiques d'une localisation donnée.
Développé sous Symfony 5 en PHP 7.

## Installation

Pour installer l'application veuillez suivre les instructions suivantes : 

### Instructions

- Dans le dossier infra du projet lancez la commande `docker-compose up -d --build`
- Puis lancez la commande `docker-compose run encore yarn install`
   
- Veuillez renseigner le fichier _.env_ avec les informations suivantes : 
**OPEN_WEATHER_API_KEY** and **GOOGLEMAP_API_KEY**

### Lancement

- Dans le dossier infra du projet lancez la commande `docker-compose up` et rendez vous dans votre navigateur sur l'adresse 
http:/localhost
