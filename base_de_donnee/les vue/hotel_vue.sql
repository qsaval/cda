--Afficher la liste des hôtels avec leur station
CREATE VIEW list_hot_sta
as
SELECT sta_nom, hot_nom, hot_categorie,hot_ville 
FROM hotel 
JOIN station ON sta_id = hot_sta_id;

--Afficher la liste des chambres et leur hôtel
CREATE VIEW List_cha_hot
as
SELECT hot_nom, hot_categorie, hot_ville, cha_numero 
FROM hotel 
JOIN chambre ON cha_hot_id = hot_id; 

--Afficher la liste des réservations avec le nom des clients
CREATE VIEW list_res_cli
as
SELECT cli_nom, hot_nom, res_date 
FROM client 
JOIN reservation ON res_cli_id = cli_id 
JOIN chambre ON cha_id = res_cha_id 
JOIN hotel ON hot_id = cha_hot_id;

--Afficher la liste des chambres avec le nom de l’hôtel et le nom de la station
CREATE VIEW list_cha_hot_sta
as
SELECT cli_nom, hot_nom, res_date 
FROM client 
JOIN reservation ON res_cli_id = cli_id 
JOIN chambre ON cha_id = res_cha_id 
JOIN hotel ON hot_id = cha_hot_id;

--Afficher les réservations avec le nom du client et le nom de l’hôtel
CREATE VIEW list_res_cli_hot
as
SELECT cli_nom, hot_nom, res_date_debut, res_date_fin 
FROM client 
JOIN reservation ON res_cli_id = cli_id 
JOIN chambre ON cha_id = res_cha_id 
JOIN hotel ON cha_hot_id = hot_id;