--1)
CREATE TRIGGER total_com AFTER INSERT ON commande
    FOR EACH ROW
    BEGIN
        DECLARE v_total DOUBLE;
        SET v_total = NEW.total;
        IF v_total = null THEN
            SIGNAL SQLSTATE '40000' SET MESSAGE_TEXT = 'le total ne doit pas etre nul';
        END IF;
    END;

--2)3)
CREATE TRIGGER maj_total_insert AFTER INSERT ON lignedecommande
    FOR EACH ROW
    BEGIN
        DECLARE id_c INT;
        DECLARE tot DOUBLE;
        SET id_c = NEW.id_commande;
        SET tot = (SELECT sum(prix*quantite) FROM lignedecommande WHERE id_commande=id_c); 
        UPDATE commande SET total=(tot - (tot-remise/100))  WHERE id=id_c;
END;

CREATE TRIGGER maj_total_update AFTER UPDATE ON lignedecommande
    FOR EACH ROW
    BEGIN
        DECLARE id_c INT;
        DECLARE tot DOUBLE;
        SET id_c = NEW.id_commande;
        SET tot = (SELECT sum(prix*quantite) FROM lignedecommande WHERE id_commande=id_c); 
        UPDATE commande SET total=(tot - (tot-remise/100))  WHERE id=id_c;
END;

CREATE TRIGGER maj_total_delete AFTER DELETE ON lignedecommande
    FOR EACH ROW
    BEGIN
        DECLARE id_c INT;
        DECLARE tot DOUBLE;
        SET id_c = OLD.id_commande;
        SET tot = (SELECT sum(prix*quantite) FROM lignedecommande WHERE id_commande=id_c) - (OLD.prix*OLD.quantite);
        UPDATE commande SET total= (tot - (tot-remise/100))  WHERE id=id_c;
END;
