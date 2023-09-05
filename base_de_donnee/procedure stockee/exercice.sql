--exercice 1
DELIMITER |

CREATE PROCEDURE Lst_fournis()
BEGIN
    SELECT COUNT(numcom), numfou FROM entcom GROUP BY numfou;
END | 

DELIMITER;

--exercice 2
DELIMITER |

CREATE PROCEDURE Lst_Commandes(IN observation varchar(255))
BEGIN
    SELECT nomfou, numcom, datcom 
    FROM fournis 
    JOIN entcom ON entcom.numfou = fournis.numfou
    WHERE obscom = observation;
END |

DELIMITER ;

--exercice 3
DELIMITER |

CREATE PROCEDURE CA_Fournisseur(
    IN id_fournis int,
    IN annee int
)
BEGIN
    SELECT numfou, qtecde * priuni * 0.20 
    FROM ligcom 
    JOIN entcom ON entcom.numcom = ligcom.numcom
    WHERE  YEAR(datcom) = annee AND numfou = id_fournis;
END |

DELIMITER ;