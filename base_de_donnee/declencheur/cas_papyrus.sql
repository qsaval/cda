CREATE TRIGGER alerte_produit AFTER UPDATE ON produit
    FOR EACH ROW
    BEGIN
        DECLARE diff INT;
        SET diff = NEW.stkale - NEW.stkphy;
        IF diff > 0 THEN
            UPDATE article_a_commande SET qte = diff-qte WHERE codart = NEW.codart;
        END IF;
    END;

SHOW TRIGGERs;