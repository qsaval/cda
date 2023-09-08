DELIMITER |

CREATE PROCEDURE  commande_nonsolde()
BEGIN
   SELECT commande.Id_commande
   from commande
   JOIN acheter ON acheter.`Id_commande` = commande.`Id_commande`
   WHERE etat_commande = 2 AND solde = 0;
end|

DELIMITER ;

DELIMITER |

CREATE PROCEDURE  delai_facture()
BEGIN
   SELECT AVG(DATEDIFF(date_facture,date_commande))
   FROM commande;
end|

DELIMITER ;