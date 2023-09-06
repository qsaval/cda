--Afficher la liste des hôtels. 
SELECT hot_nom, hot_ville 
FROM hotel; 

--Afficher la ville de résidence de Mr White
SELECT cli_nom, cli_prenom, cli_adresse 
FROM client 
WHERE cli_nom = "White"; 

--Afficher la liste des stations dont l’altitude < 1000
SELECT sta_nom, sta_altitude 
FROM station 
WHERE sta_altitude < 1000;

--Afficher la liste des chambres ayant une capacité > 1
SELECT cha_numero, cha_capacite 
FROM chambre 
WHERE cha_capacite > 1;

--Afficher les clients n’habitant pas à Londre
SELECT cli_nom, cli_ville 
FROM client 
WHERE cli_ville != "Londre";

--Afficher la liste des hôtels située sur la ville de Bretou et possédant une catégorie>3 
SELECT hot_nom, hot_ville, hot_categorie 
FROM hotel 
WHERE hot_ville = "Bretou" AND hot_categorie > 3;

--Afficher la liste des hôtels avec leur station
SELECT sta_nom, hot_nom, hot_categorie,hot_ville 
FROM hotel 
JOIN station ON sta_id = hot_sta_id;

--Afficher la liste des chambres et leur hôte
SELECT hot_nom, hot_categorie, hot_ville, cha_numero 
FROM hotel 
JOIN chambre ON cha_hot_id = hot_id; 

--Afficher la liste des chambres de plus d'une place dans des hôtels situés sur la ville de Bretou 
SELECT hot_nom, hot_categorie, hot_ville, cha_numero, cha_capacite 
FROM hotel 
JOIN chambre ON cha_hot_id = cha_id 
WHERE hot_ville = "Bretou";

--Afficher la liste des réservations avec le nom des clients
SELECT cli_nom, hot_nom, res_date 
FROM client 
JOIN reservation ON res_cli_id = cli_id 
JOIN chambre ON cha_id = res_cha_id 
JOIN hotel ON hot_id = cha_hot_id;

--Afficher la liste des chambres avec le nom de l’hôtel et le nom de la station
SELECT cli_nom, hot_nom, res_date 
FROM client 
JOIN reservation ON res_cli_id = cli_id 
JOIN chambre ON cha_id = res_cha_id 
JOIN hotel ON hot_id = cha_hot_id;

--Afficher les réservations avec le nom du client et le nom de l’hôtel 
SELECT cli_nom, hot_nom, res_date_debut, res_date_fin 
FROM client 
JOIN reservation ON res_cli_id = cli_id 
JOIN chambre ON cha_id = res_cha_id 
JOIN hotel ON cha_hot_id = hot_id;

--Compter le nombre d’hôtel par station
SELECT COUNT(hot_nom), sta_nom
FROM hotel
JOIN station ON sta_id = hot_sta_id
GROUP BY sta_nom;

--Compter le nombre de chambre par station
SELECT sta_nom, COUNT(cha_numero) 
FROM chambre 
JOIN hotel on hot_id=cha_hot_id 
JOIN station on sta_id=hot_sta_id 
GROUP by sta_id;

--Compter le nombre de chambre par station ayant une capacité > 1
SELECT sta_nom, COUNT(cha_numero) 
FROM chambre 
JOIN hotel on hot_id = cha_hot_id 
JOIN station on sta_id = hot_sta_id 
WHERE cha_capacite >1 
GROUP by sta_id; 

--Afficher la liste des hôtels pour lesquels Mr Squire a effectué une réservation
SELECT hot_nom
FROM hotel
JOIN chambre ON cha_hot_id = hot_id
JOIN reservation ON res_cha_id = cha_id
JOIN client ON cli_id = res_cli_id
WHERE cli_nom = 'Squire'

--Afficher la durée moyenne des réservations par station
SELECT sta_nom, AVG(DATEDIFF(res_date_fin, res_date_debut)) 
FROM station 
JOIN hotel ON hot_sta_id = sta_id 
JOIN chambre ON cha_hot_id = hot_id 
JOIN reservation ON res_cha_id = cha_id 
GROUP BY sta_nom; 