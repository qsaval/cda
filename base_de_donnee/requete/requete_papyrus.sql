--requete
--Quelles sont les commandes du fournisseur 09120 ?
SELECT numcom 
FROM entcom 
WHERE numfou = 9120;

--Afficher le code des fournisseurs pour lesquels des commandes ont été passées
SELECT COUNT(numcom), numfou 
FROM entcom 
GROUP BY numfou; 

--Afficher le nombre de commandes fournisseurs passées, et le nombre de fournisseur concernés.
SELECT numcom, numfou 
FROM entcom;

--Editer les produits ayant un stock inférieur ou égal au stock d'alerte et dont la quantité annuelle est inférieur est inférieure à 1000 (informations à fournir : n° produit, libellé produit, stock, stock actuel d'alerte, quantité annuelle)
SELECT codart, libart, stkphy, stkale, qteann 
FROM produit 
WHERE stkphy <= stkale AND qteann < 1000;

--Quels sont les fournisseurs situés dans les départements 75 78 92 77 ? L’affichage (département, nom fournisseur) sera effectué par département décroissant, puis par ordre alphabétique
SELECT nomfou, posfou 
FROM fournis 
WHERE posfou > 70000 AND !(posfou > 80000 AND posfou < 90000);

--Quelles sont les commandes passées au mois de mars et avril?
SELECT numcom, datcom 
FROM entcom 
WHERE month(datcom) >= 3 AND month(datcom) <= 4;

--Quelles sont les commandes du jour qui ont des observations particulières ? (Affichage numéro de commande, date de commande)
SELECT numcom, datcom, obscom 
FROM entcom 
WHERE obscom <> '';

--Lister le total de chaque commande par total décroissant (Affichage numéro de commande et total)
SELECT numcom, qtecde*priuni 
FROM ligcom 
ORDER BY qtecde*priuni DESC; 

--Lister les commandes dont le total est supérieur à 10 000€ ; on exclura dans le calcul du total les articles commandés en quantité supérieure ou égale à 1000. (Affichage numéro de commande et total)
SELECT numcom, qtecde*priuni, qtecde 
FROM ligcom 
WHERE qtecde*priuni > 10000 AND qtecde < 1000;

--Lister les commandes par nom fournisseur (Afficher le nom du fournisseur, le numéro de commande et la date)
SELECT nomfou, numcom, datcom 
FROM fournis 
JOIN entcom ON entcom.numfou = fournis.numfou; 

--Sortir les produits des commandes ayant le mot "urgent' en observation?(Afficher le numéro de commande, le nom du fournisseur, le libellé du produit et le sous total = quantité commandée * Prix unitaire)
SELECT entcom.numcom, nomfou, libart, qtecde*priuni as total 
FROM fournis 
JOIN entcom ON entcom.numfou = fournis.numfou 
JOIN ligcom ON ligcom.numcom = entcom.numcom 
JOIN produit ON produit.codart = ligcom.codart 
WHERE obscom = "Commande urgente"; 

--Coder de 2 manières différentes la requête suivante : Lister le nom des fournisseurs susceptibles de livrer au moins un article
SELECT nomfou 
FROM fournis 
JOIN entcom ON entcom.numfou = fournis.numfou 
JOIN ligcom ON ligcom.numcom = entcom.numcom 
WHERE qteliv >=1 
GROUP BY nomfou; 

--Coder de 2 manières différentes la requête suivante : Lister les commandes (Numéro et date) dont le fournisseur est celui de la commande 70210 :
SELECT numcom, datcom 
FROM entcom 
WHERE numfou = (SELECT numfou FROM entcom WHERE numcom = 70210); 

--Dans les articles susceptibles d’être vendus, lister les articles moins chers (basés sur Prix1) que le moins cher des rubans (article dont le premier caractère commence par R). On affichera le libellé de l’article et prix1
SELECT libart, prix1 
FROM produit 
JOIN vente ON vente.codart = produit.codart 
WHERE stkphy > 0 AND prix1 < (SELECT min(prix1) FROM vente JOIN produit ON vente.codart = produit.codart WHERE libart LIKE 'R%'); 

--Editer la liste des fournisseurs susceptibles de livrer les produits dont le stock est inférieur ou égal à 150 % du stock d'alerte. La liste est triée par produit puis fournisseur
SELECT nomfou, libart 
FROM fournis 
JOIN vente ON vente.numfou = fournis.numfou 
JOIN produit ON produit.codart = vente.codart 
WHERE stkphy <= (stkale * 150);

--Éditer la liste des fournisseurs susceptibles de livrer les produit dont le stock est inférieur ou égal à 150 % du stock d'alerte et un délai de livraison d'au plus 30 jours. La liste est triée par fournisseur puis produit
SELECT libart, nomfou 
FROM produit 
JOIN vente ON produit.codart = vente.codart
JOIN fournis ON vente.numfou = fournis.numfou 
WHERE stkphy <= (stkale * 1.5) AND delliv < 30;

--Avec le même type de sélection que ci-dessus, sortir un total des stocks par fournisseur trié par total décroissant
SELECT numfou, stkphy 
FROM vente
JOIN produit ON produit.codart = vente.codart
GROUP BY numfou 
ORDER BY stkphy DESC;

--En fin d'année, sortir la liste des produits dont la quantité réellement commandée dépasse 90% de la quantité annuelle prévue.
SELECT libart, qtecde 
FROM produit
JOIN ligcom ON produit.codart = ligcom.codart 
GROUP BY libart, qteann 
HAVING qteann * 0.90 < qtecde;

--Calculer le chiffre d'affaire par fournisseur pour l'année 93 sachant que les prix indiqués sont hors taxes et que le taux de TVA est 20%.
SELECT numfou, qtecde * priuni * 0.20 
FROM ligcom 
JOIN entcom ON entcom.numcom = ligcom.numcom
WHERE  YEAR(datcom) = 1993
GROUP BY numfou;


--mise a jour
--Application d'une augmentation de tarif de 4% pour le prix 1 et de 2% pour le prix2 pour le fournisseur 9180
UPDATE produit
SET prix1 = prix1 * 1.04,
    prix2 = prix2 *1.02
WHERE numfou = 9180;

--Dans la table vente, mettre à jour le prix2 des articles dont le prix2 est null, en affectant a prix2 la valeur de prix1.
UPDATE vente 
set prix2 = 0, prix2 = prix1 

--Mettre à jour le champ obscom en positionnant '*****' pour toutes les commandes dont le fournisseur a un indice de satisfaction <5
UPDATE entcom
join fournis on fournis.numfou = entcom.numfou
set obscom = '*****'
where fournis.satisf < 5;

--Suppression du produit I110
DELETE FROM produit WHERE codart = 'I110';
DELETE FROM vente WHERE codart = 'I110';
DELETE FROM ligcom WHERE codart = 'I110';

--Suppression des entête de commande qui n'ont aucune ligne