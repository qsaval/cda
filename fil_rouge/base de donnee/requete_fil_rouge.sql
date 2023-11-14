SELECT MONTH(date_commande), SUM(nb_commander * prix_commande)
FROM acheter
JOIN commande ON commande.id_commande = acheter.id_commande
GROUP BY MONTH(date_commande);

SELECT nom_fournisseur, SUM(nb_commander * prix_commande)
FROM acheter
JOIN bd ON bd.Id_bd = acheter.Id_bd
JOIN fournisseur ON fournisseur.id_fournisseur = bd.id_fournisseur
GROUP BY nom_fournisseur;