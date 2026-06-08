# Account system - PHP
![TypeScript](https://img.shields.io/badge/TypeScript-6-3178C6?style=for-the-badge&logo=typescript&logoColor=white)
![PHPUnit](https://img.shields.io/badge/PHPUnit-11.5-366488?style=for-the-badge&logo=php&logoColor=white)

Petit projet sur le system de sign up et login en PHP. <br>
tuto suivie : https://youtu.be/Ojk70Ag8Ofs?si=pGWRmAV59L3C64Z4

<img src="/img/screenshot.png" height="500" alt="screenshot du projet">

### INSTALLATION

1. ```npm install```
2. ```composer install```
3. Renommer `.env.example` en `.env` et indiquer vos variables d'environnement.
4. Exécuter les requettes SQL du fichier `db.sql` pour créer la BDD.


### DÉVELOPPEMENT
Commande pour générer le css en continu :
```npx @tailwindcss/cli -i ./css/style.css -o ./css/output.css --watch```

Commande pour générer le js en continu : 
```npx tsc --watch```
