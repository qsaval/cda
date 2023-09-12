--1)
CREATE TRIGGER modif_reservation AFTER UPDATE ON reservation
    FOR EACH ROW
    BEGIN
        SIGNAL SQLSTATE '40000' SET MESSAGE_TEXT = 'vous pouver pas modifier la table reservation';
    END; 

UPDATE reservation
set res_arrhes = 1000
WHERE res_id = 1;

--2)
CREATE TRIGGER insert_reservation AFTER INSERT ON reservation
    FOR EACH ROW
    BEGIN
        DECLARE nbr_res INT;
        SET nbr_res = (SELECT COUNT(*) FROM reservation JOIN chambre ON cha_id = res_cha_id JOIN hotel ON hot_id = cha_hot_id GROUP BY hot_id);
        IF nbr_res >= 10 THEN
            SIGNAL SQLSTATE '40000' set MESSAGE_TEXT = 'on peut plus entre de reservation';
        END IF;
    END

SELECT COUNT(*) FROM reservation JOIN chambre ON cha_id = res_cha_id JOIN hotel ON hot_id = cha_hot_id GROUP BY hot_id;

--3)
CREATE TRIGGER insert_reservation2 AFTER INSERT ON reservation
    FOR EACH ROW
    BEGIN
        DECLARE nbr_res INT;
        SET nbr_res = (SELECT COUNT(*) FROM reservation WHERE res_cli_id = NEW.res_cli_id GROUP BY res_cli_id);
        IF nbr_res >= 3 THEN
            SIGNAL SQLSTATE '40000' set MESSAGE_TEXT = 'il peut plus reserver';
        END IF;
    END;

--4)
CREATE TRIGGER insert_chambre AFTER INSERT ON chambre
    FOR EACH ROW
    BEGIN
        DECLARE cap_chambres INT;
        SET cap_chambres = (SELECT SUM(cha_capacite) FROM chambre WHERE cha_hot_id = NEW.cha_hot_id GROUP BY cha_hot_id);
        IF cap_chambres > 50 THEN
            SIGNAL SQLSTATE '40000' SET MESSAGE_TEXT = 'on peut plus inserer de chambre';
        END IF;
    END;


--exemple
CREATE TRIGGER insert_station AFTER INSERT ON station
    FOR EACH ROW
    BEGIN
        DECLARE altitude INT;
        SET altitude = NEW.sta_altitude;
        IF altitude<1000 THEN
            SIGNAL SQLSTATE '40000' SET MESSAGE_TEXT = 'Un problème est survenu. Règle de gestion altitude !';
        END IF;
END;

insert into station (sta_nom, sta_altitude) values ('station du bas', 666);