--Northwind
--1)requete
--Liste des contacts français
SELECT CompanyName as Société, ContactName as contact, ContactTitle as Fonction, Phone as téléphone
FROM customers
WHERE Country = 'france';

--Produits vendus par le fournisseur « Exotic Liquids »
SELECT ProductName as Produit, UnitPrice as prix 
FROM products
JOIN suppliers ON suppliers.SupplierID = products.SupplierID
WHERE CompanyName = 'Exotic Liquids';

--Nombre de produits vendus par les fournisseurs Français dans l’ordre décroissant
SELECT CompanyName as Fournisseur, COUNT(ProductName) as `Nbre produits`
FROM products
JOIN suppliers ON suppliers.SupplierID = products.SupplierID
WHERE Country = 'France'
GROUP BY CompanyName
ORDER BY COUNT(ProductName) DESC;

-- Liste des clients Français ayant plus de 10 commandes
SELECT CompanyName as `Client`, COUNT(*) as `Nbre commande`
FROM customers
JOIN orders ON orders.CustomerID = customers.CustomerID
WHERE Country = 'france'
GROUP BY CompanyName
HAVING  COUNT(*) > 10;

--Liste des clients ayant un chiffre d’affaires > 30.000
SELECT `CompanyName` as `Client`, SUM(`UnitPrice` * `Quantity`) as CA, `Country` as Pays
FROM customers
JOIN orders ON orders.`CustomerID` = customers.`CustomerID`
JOIN `order details` ON orders.`OrderID` = `order details`.`OrderID`
GROUP BY `CompanyName`
HAVING SUM(`UnitPrice` * `Quantity`) > 30000
ORDER BY SUM(`UnitPrice` * `Quantity`) DESC;

-- Liste des pays dont les clients ont passé commande de produits fournis par « Exotic Liquids »
SELECT customers.`Country` as Pays
FROM customers
JOIN orders ON orders.`CustomerID` = customers.`CustomerID`
JOIN `order details` ON orders.`OrderID` = `order details`.`OrderID`
JOIN products ON products.`ProductID` = `order details`.`ProductID`
JOIN suppliers ON suppliers.`SupplierID` = products.`SupplierID`
WHERE suppliers.`CompanyName` = 'Exotic Liquids'
GROUP BY customers.`Country`;

--Montant des ventes de 1997
SELECT SUM(`UnitPrice` * `Quantity`) as `Montant Ventes 97`
FROM `order details`
JOIN orders ON orders.`OrderID` = `order details`.`OrderID`
WHERE YEAR(`OrderDate`) = 1997; 

--Montant des ventes de 1997 mois par mois

SELECT MONTH(`OrderDate`) as `Mois 97`, SUM(`UnitPrice` * `Quantity`) as `Montant Ventes 97`
FROM `order details`
JOIN orders ON orders.`OrderID` = `order details`.`OrderID`
WHERE YEAR(`OrderDate`) = 1997
GROUP BY MONTH(`OrderDate`);

--Depuis quelle date le client « Du monde entier » n’a plus commandé
SELECT `OrderDate` as `Date de dernière commande`
FROM orders
JOIN customers ON customers.`CustomerID` = orders.`CustomerID`
WHERE `CompanyName` = 'Du monde entier'
ORDER BY `OrderDate` DESC
LIMIT 1;

--Quel est le délai moyen de livraison en jours ?
SELECT ROUND(AVG(DATEDIFF( `ShippedDate`, `OrderDate`))) as `Délai moyen de livraison en jours`
FROM orders


--2)procedure stokee
--pour la requete 9
DELIMITER |

CREATE PROCEDURE derniere_commande(IN societe VARCHAR(255))
BEGIN
    SELECT `OrderDate` as `Date de dernière commande`
    FROM orders
    JOIN customers ON customers.`CustomerID` = orders.`CustomerID`
    WHERE `CompanyName` = societe
    ORDER BY `OrderDate` DESC
    LIMIT 1;
END |

DELIMITER ;

CALL derniere_commande('Franchi S.p.A.');

--pour la requete 10
DELIMITER |

CREATE PROCEDURE delais_liv()
BEGIN
    SELECT ROUND(AVG(DATEDIFF( `ShippedDate`, `OrderDate`))) as `Délai moyen de livraison en jours`
    FROM orders;
END |

DELIMITER ;

CALL delais_liv();

--3)trigger
CREATE TRIGGER v_pays AFTER INSERT ON `order details`
FOR EACH ROW
BEGIN
    DECLARE costumer_country VARCHAR(255);
    DECLARE supplier_country VARCHAR(255);
    SET costumer_country = (SELECT country FROM customers JOIN orders ON orders.`CustomerID` = costomers.`CustomerID`  WHERE `OrderID` = NEW.`OrderID`);
    SET supplier_country = (SELECT country FROM suppliers JOIN products ON suppliers.`SupplierID` = products.`SupplierID` JOIN `order details` ON products.`ProductID` = `order details`.`ProductID` WHERE `ProductID` = NEW.`ProductID`);
    IF costumer_country != supplier_country THEN
        SIGNAL SQLSTATE '40000' SET MESSAGE_TEXT = 'le client et le fournisseur sont pas dans le meme pays';
    END IF;
END;
