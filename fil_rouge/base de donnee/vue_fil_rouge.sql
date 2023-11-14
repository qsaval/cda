
CREATE VIEW bd_fournisseur
AS
SELECT nom_fournisseur, bd.*
FROM fournisseur
JOIN bd ON bd.Id_fourniseur = fournisseur.Id__fournisseur;


CREATE VIEW bd_categorie
AS
SELECT mere.nom_categorie, fille.nom_categorie, bd.*
FROM categorie as mere
JOIN categorie as fille ON mere.Id_categorie = fille.Id_categorie_1
JOIN bd ON bd.Id_categorie = fille.Id__categorie;