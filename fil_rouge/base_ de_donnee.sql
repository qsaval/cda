CREATE TABLE categorie(
   Id_categorie INT AUTO_INCREMENT,
   nom_categorie VARCHAR(255) ,
   image_categorie VARCHAR(255) ,
   Id_categorie_1 INT,
   PRIMARY KEY(Id_categorie),
   FOREIGN KEY(Id_categorie_1) REFERENCES categorie(Id_categorie)
);

INSERT INTO `categorie` (`Id_categorie`, `nom_categorie`, `image_categorie`, `Id_categorie_1`) VALUES
(1, 'BD', NULL, NULL),
(2, 'Comic', NULL, NULL),
(3, 'Manga', NULL, NULL),
(4, 'Marvel', NULL, 2),
(5, 'DC', NULL, 2),
(6, 'Shonen', NULL, 3),
(7, 'Seinen', NULL, 3);

CREATE TABLE utilisateur(
   Id_utilisateur INT AUTO_INCREMENT,
   nom_utilisateur VARCHAR(255) ,
   prenom_utilisateur VARCHAR(255) ,
   mdp_utilisateur VARCHAR(255) ,
   adresse_facturation VARCHAR(255) ,
   ville_facturation VARCHAR(255) ,
   cp_facturation VARCHAR(5) ,
   adresse_livraison VARCHAR(255) ,
   cp_livraison VARCHAR(5) ,
   ville_livraison VARCHAR(255) ,
   type VARCHAR(255) ,
   PRIMARY KEY(Id_utilisateur)
);

CREATE TABLE fournisseur(
   Id_fournisseur INT AUTO_INCREMENT,
   nom_fournisseur VARCHAR(255) ,
   nom_contact VARCHAR(255) ,
   telephone_contact VARCHAR(8) ,
   adresse_fournisseur VARCHAR(255) ,
   ville_fournisseur VARCHAR(255) ,
   cp_fournisseur VARCHAR(5) ,
   PRIMARY KEY(Id_fournisseur)
);

INSERT INTO `fournisseur` (`Id_fournisseur`, `nom_fournisseur`, `nom_contact`, `telephone_contact`, `adresse_fournisseur`, `ville_fournisseur`, `cp_fournisseur`) VALUES
(1, NULL, 'Lucien Dupont', '06351425', '15 rue du marechal feran', 'paris', '95000');

CREATE TABLE livraison(
   Id_livraison INT AUTO_INCREMENT,
   nom_entreprise VARCHAR(255) ,
   adresse_entreprise VARCHAR(255) ,
   cp_livreur VARCHAR(5) ,
   ville_livreur VARCHAR(255) ,
   telephone_livreur VARCHAR(50) ,
   PRIMARY KEY(Id_livraison)
);

CREATE TABLE colis(
   Id_colis INT AUTO_INCREMENT,
   PRIMARY KEY(Id_colis)
);

CREATE TABLE bd(
   Id_bd INT AUTO_INCREMENT,
   titre VARCHAR(255) ,
   image_bd VARCHAR(255) ,
   auteur VARCHAR(255) ,
   dessinateur VARCHAR(255) ,
   editeur VARCHAR(255) ,
   date_edition DATE,
   resume TEXT,
   prix DECIMAL(6,2)  ,
   Id_fournisseur INT NOT NULL,
   Id_categorie INT NOT NULL,
   PRIMARY KEY(Id_bd),
   FOREIGN KEY(Id_fournisseur) REFERENCES fournisseur(Id_fournisseur),
   FOREIGN KEY(Id_categorie) REFERENCES categorie(Id_categorie)
);

INSERT INTO `bd` (`Id_bd`, `titre`, `image_bd`, `auteur`, `editeur`, `date_edition`, `resume`, `prix`, `Id_fournisseur`, `Id_categorie`) VALUES
(1, 'Eigyr', 'eigyr.jpeg', 'Hamon Jerome', 'LOMBARD', NULL, 'Au fin fond d\'une Angleterre qui ne porte pas encore ce nom, Chrétiens et Bretons s\'affrontent sur un nouveau champ de bataille : la possession d\'Eigyr ! Est-ce là un artefact ou une place forte ? Que nenni ! Eigyr est une jeune femme dont le ventre rond abriterait la réincarnation de Merlin. Son corps est devenu un enjeu politique dont les hommes entendent disposer. Mais une mère est prête à tout pour protéger la future chair de sa chair...', '24.50', 1, 1),
(2, 'Pendragon - L\'épee perdue - Tome 1', 'pendragon:lepee_perdue_t1.jpeg', NULL, 'GLENAT', '2023-06-09', 'Arthur, le retour de la légende. Depuis le départ des légions romaines, les dieux semblent avoir abandonné les hommes et les terres d\'Alba. Et cet antique royaume est désormais la proie de guerres féroces et incessantes. Pourtant, le sorcier Merlin cherche sans relâche à rétablir l\'harmonie. Il devra, pour ce faire, trouver enfin un roi capable de mettre un terme aux querelles intestines entre les Sept Royaumes.\nUn roi capable aussi de rétablir les anciennes croyances face à l\'émergence d\'une nouvelle religion. Alors que les combats font rage sur les terres du roi Leodan, la prêtresse Nimue sent que l\'heure est proche. Bientôt, un homme fera entrer l\'Angleterre dans un âge nouveau : Arthur. Chef de guerre local sans rêve de grandeurs, Arthur n\'a pas l\'ambition de devenir le Haut-Roi des Basses-Terres. Pourtant ses exploits ont déjà plusieurs fois montré ses qualités de leader et de fin stratège.\nPour certains, le futur époux d\'Elwen, fille du défunt roi Leodan, incarne le seul espoir face aux troubles grandissants qui menacent l\'unité d\'Alba. Arthur acceptera-t-il la lourde charge proposée par Merlin ? Saura-t-il se montrer digne de l\'espoir qui a été placé en lui ? Et si le roi Arthur avait régné au Ve siècle après J. -C. ? Avec un premier cycle prévu en quatre tomes, Jérôme Le Gris revisite librement le mythe chrétien du Graal en l\'inscrivant dans le contexte historique qui aurait vu émerger cette figure légendaire.\nLe dessin généreux et flamboyant de Paolo Martinello nous propose un univers sauvage, empreint de mythologie celte, tout en s\'appuyant sur le story-board hollywoodien de Benoît Dellac. ', '14.50', 1, 1),
(3, 'Webster & Jones', 'webster&jones.jpeg', 'Laine', 'DARGAUD', '2023-01-09', '1956, quelque part au-dessus de la forêt amazonienne. Un petit avion de reconnaissance survole l\'épaisse végétation et semble avoir trouvé ce qu\'il était venu chercher quand, soudainement, le voilà abattu... A son bord, deux inspecteurs américains prenaient des clichés d\'une importance capitale. Trois mois plus tard, après des recherches infructueuses, les Etats-Unis dépêchent sur place un commando plutôt étonnant pour enquêter sur cette étrange disparition.\nLe capitaine Wallace Webster, qui préfère \"casser du bolchévique\" à l\'art subtil de la stratégie militaire, et Betty Jones, agente de liaison du département de la défense, se voient obligés de collaborer. Tandis qu\'il crapahute au coeur de cette jungle hostile, le duo découvre la carcasse de l\'avion et les cadavres des agents de reconnaissance. Et à deux pas de là... une base secrète abandonnée qui a visiblement servi au lancement d\'engins spatiaux avant d\'être la cible d\'une attaque ennemie.\nSoudain, un robot géant et absolument futuriste, frappé d\'une immense croix gammée, prend Webster et Jones en chasse. Il ne fait aucun doute : les nazis n\'ont pas encore dit leur dernier mot et sont partis... à la conquête de l\'espace ! ', '21.50', 1, 1),
(4, 'Marvel Comic n°19', 'marvel_comic_n19.jpeg', NULL, 'PANINI', '2023-05-07', ' Kang revient dans les pages de MARVEL COMICS pour nous donner un aperçu du futur. Que présage l\'avenir pour les héros Marvel ? Vous allez le découvrir ! Spider-Man voit un de ses pires ennemis s\'allier à un adversaire des X-Men. Ca sent le crossover ! Et puisqu\'on en parle, l\'affrontement entre toutes les équipes d\'Avengers du multivers et les Maîtres du Mal de Méphisto se poursuit. Quant à Thor, il part sur la piste de Corvus Glaive pour comprendre ses visions concernant Thanos.\nEncore du changement ce mois-ci ! Jed Mackay, le futur scénariste des Avengers (ce sera en novembre) se penche sur l\'avenir de l\'univers Marvel. Jason Aaron poursuit sa dernière saga des Avengers. En plus, Amazing Spider-Man vous présente le prologue d\'une saga Spidey / X-Men, Dark Web, qui nous tiendra en haleine à partir du mois prochain dans un mensuel à part, et Thor commence une nouvelle saga !', '16.00', 1, 4),
(5, 'X-Men - Proteus', 'x-men:proteus.jpeg', 'Claremont', 'PANINI', '2023-06-09', 'Magnéto veut régler ses comptes avec les X-Men, et l\'affrontement va en faire passer certains pour morts, piégés en Terre Sauvage avec Sauron ! Mais sur l\'île de Muir, l\'équipe va surtout devoir affronter la menace du terrifiant Protéus, fils de Moira MacTaggert ! Avec aussi la première apparition d\'Alpha Flight ! Cet album recueille une partie importante des épisodes de la série Uncanny X-Men signés par Chris Claremont et John Byrne, à l\'origine de certaines des plus grandes sagas de l\'équipe.\nLa collection MARVEL EPIC offre à nos lecteurs l\'occasion de découvrir cette époque essentielle dans un épais volume de 400 pages, comme à l\'habitude disponible en version souple ou collector cartonnée ! ', '28.00', 1, 4),
(6, 'Punisher - La fin du punisher - Tome 3', 'punisher:la_fin_du_punisher_t3.jpeg', 'Aaron Saiz Azaceta', 'PANINI', '2023-06-09', 'Le Punisher contre Arès : le combat final. Mais même si Frank Castle survit à l\'assaut du Dieu de la Guerre, il va devoir affronter d\'autres forces qui souhaitent le faire tomber une fois pour toutes... au risque de perdre son âme ? Est-ce Maria Castle qui tient la clé de la rédemption du terrible anti-héros ? Jason Aaron (Avengers) boucle la terrifiante saga qui a ressuscité Maria, la femme du Punisher, et dans laquelle Frank Castle a pris la tête des assassins de la Main.\nUne épopée sublimée par les dessins de Jesus Saiz (Captain America) pour les scènes du présent et Paul Azaceta (Daredevil) pour les flash-backs. ', '19.00', 1, 4),
(7, 'Flash infinite - Tome 3', 'flash_infinite_t3.jpeg', 'Jeremy Adams', 'URBAN COMICS', '2025-02-05', 'Etre l\'homme le plus rapide du monde exige de grandes responsabilités. Wally West, également connu sous le nom de Flash, décide d\'enseigner au nouveau Kid Flash son savoir-faire. Mais les agissements du Bolide Ecarlate ne sont pas du goût de Gregory Wolfe, le directeur de la prison d\'Iron Heights qui accède au poste de maire de Keystone City. Afin d\'assurer la sécurité en ville, celui-ci décide de confier le maintien de l\'ordre aux Lascars.\nEt comme si cela ne suffisait pas. Linda, l\'épouse de Wally, a une surprise pour lui... ', '19.00', 1, 5),
(8, 'Harley Quinn infinite - Tome 3', 'harley_quinn_infinite_t3.jpeg', 'Stephanie Philips', 'URBAN COMICS', '2024-04-10', 'Si, dans le passé, Harley Quinn a commis de nombreux crimes, c\'est bien une innocente que l\'on vient de jeter en prison cette fois-ci ! Et pour le prouver, il ne sera pas de meilleure acolyte que Batwoman. Ensemble, elles chercheront à laver le nom d\'Harley en enquêtant sur la nouvelle criminelle de Gotham, Verdict, qui semble en vouloir personnellement à l\'ex-copine du Joker. ', '17.00', 1, 5),
(9, 'Superman Aventures - Tome 6', 'superman_aventures_t6.jpeg', 'Millar Mark', 'URBAN COMICS', '2022-09-12', 'Un récit inoubliable sur l\'homme d\'acier ! Seul, sans ami et amnésique, Superman est obligé de chercher refuge dans une ville hostile et inconnue : Smallville. Et le super-héros n\'est pas au bout de ses peines... Une attaque de vaisseau extraterrestres, son rétrécissement contraint, la perte de ses pouvoirs, la justice à ses trousses ou encore la menace d\'un virus mortel dont est atteint Kara, et les actions suspectes de Lex Luthor, Superman doit redoubler d\'efforts pour gérer ces situations de crise, parviendra-t-il à ce que tout rentre dans l\'ordre ?', '10.00', 1, 5),
(10, 'Sakamoto Days - Tome 1', 'sakamoto_days_t1.jpeg', 'Yuto Suzuki', 'GLENAT', '2022-06-04', 'Taro Sakamoto est un assassin légendaire, le meilleur d\'entre tous, craint par tous les gangsters, adulé par ses pairs. Mais un beau jour? il tombe amoureux ! S\'ensuivent retraite, mariage, paternité? et prise de poids. Sakamoto est aujourd\'hui patron d\'une petite épicerie de quartier et coule des jours heureux avec sa famille. Mais lorsque son passé le rattrape sous les traits de Shin, un jeune assassin télépathe, Sakamoto reprend du service? et malgré son apparence, il est toujours aussi charismatique lorsqu\'il passe à l\'action !', '6.99', 1, 6),
(11, 'Dandadan - Tome 6', 'dandadan6jpeg', 'Yukinobu Talsu', 'CRUNCHYROLL', '2024-09-06', 'Momo Ayase et Ken Takakura sont tous deux lycéens. Tandis que la première croit aux fantômes, le second est fasciné par les extraterrestres. Évidemment, chacun se moque des croyances de l\'autre. Incapables de se convaincre, ils se lancent un défi pour savoir lequel des deux a raison', '7.29', 1, 6),
(12, 'jujutsu kaisen - Tome 1', 'jujutsu_kaisen1.jpeg', 'Gege Akutami', 'KI-OON', '2020-06-02', 'Yuta Okkotsu, un adolescent de 16 ans atteint d\'une puissante malédiction du fléau Rika Orimoto, a accepté d\'être exécuté. Cependant, Satoru Gojo lui propose un autre issue : entrer à l\'école d\'exorcisme de Tokyo pour en savoir plus sur les fléaux et se défaire de sa malédiction.', '6.95', 1, 6),
(13, 'Alpi - The Soul Sender - Tome 1', 'alpi_the_soul_sender_t1.jpeg', 'Rona', 'KI-OON', '2020-03-09', 'Une fable écologique au coeur d\'un monde fantastique ! Les esprits divins sont source de vie. Des communautés se forment sous leur protection, jouissant des bienfaits de leur énergie. Cependant, leur mort enclenche une malédiction qui détruit tout ce qui les entoure... C\'est là qu\'interviennent les soul senders ! Ces rares élus sont capables d\'absorber la pollution maléfique et de délivrer l\'âme des esprits qui, une fois apaisés, ne constituent plus une menace.\nMalgré son jeune âge, Alpi fait partie de ces mages d\'élite. Aidée de son fidèle serviteur Pelenai, elle fait de son mieux pour remplir sa tâche, en dépit des souffrances extrêmes provoquées par le contact avec les ténèbres divines. La fillette s\'est lancée dans une odyssée à travers le monde sur les traces de ses parents, eux-mêmes soul senders et disparus au cours d\'une mission... L\'harmonie avec la nature a un prix ! Au fil de son périple, la courageuse Alpi découvre diverses cultures et autant d\'approches différentes des liens entre humains et esprits.\nAvec sensibilité, sans manichéisme, Alpi the Soul Sender offre une invitation au voyage et, surtout, au partage avec les êtres qui nous entourent. ', '7.95', 1, 7),
(14, 'Villageois lvl 999 - Tome 1', 'villageois_lvl_999.jpeg', 'Hoshitsuki Koneko', 'MANA BOOKS', '2023-01-06', 'Les aventures épiques et pleines de rebondissements de Villageois LVL 999 ! Héros, sages, guerriers... Dans un monde où le rôle de chacun est attribué à la naissance, quiconque naît \" villageois \" - ; le plus faible de tous les rôles - ; est condamné à oeuvrer au développement des villes sous la protection d\'êtres supérieurs. Contre toute attente, l\'un d\'entre eux a atteint un niveau absolument inouï : 999 ! Sa rencontre avec une fillette de la race des démons va pousser le villageois Kagami à lutter pour un monde meilleur.', '7.95', 1, 7),
(15, 'Gantz :E - Tome 4', 'gantz4.jpeg', 'Hiroya Oku', 'DELCOURT', '2024-01-09', 'Hanbe\'e, un paysan, demande O-Haru en mariage, mais celle-ci lui répond qu\'elle en aime un autre, Masakichi. Hanbe\'e rencontre Masakichi et découvre qu\'il sait magner le sabre malgré sa condition de paysan. Alors qu\'ils s\'affrontent, une jeune fille se noie. Les deux hommes meurent en tentant de la sauver. Ils se retrouvent alors dans une salle Gantz. ', '8.50', 1, 7);


CREATE TABLE commande(
   Id_commande INT AUTO_INCREMENT,
   montant_commande DECIMAL(7,2)  ,
   date_commande DATE,
   etat_commande INT,
   facture VARCHAR(255) ,
   adresse_facture VARCHAR(255) ,
   cp_facture VARCHAR(5) ,
   ville_facture VARCHAR(255) ,
   nbr_colis INT,
   Id_colis INT NOT NULL,
   Id_utilisateur INT NOT NULL,
   PRIMARY KEY(Id_commande),
   FOREIGN KEY(Id_colis) REFERENCES colis(Id_colis),
   FOREIGN KEY(Id_utilisateur) REFERENCES utilisateur(Id_utilisateur)
);

CREATE TABLE acheter(
   Id_bd INT,
   Id_commande INT,
   nb_commander VARCHAR(50) ,
   prix_commande DECIMAL(6,2)  ,
   PRIMARY KEY(Id_bd, Id_commande),
   FOREIGN KEY(Id_bd) REFERENCES bd(Id_bd),
   FOREIGN KEY(Id_commande) REFERENCES commande(Id_commande)
);

CREATE TABLE est_livraie_par(
   Id_livraison INT,
   Id_colis INT,
   date_livraison VARCHAR(50) ,
   retard_eventuel BOOLEAN,
   PRIMARY KEY(Id_livraison, Id_colis),
   FOREIGN KEY(Id_livraison) REFERENCES livraison(Id_livraison),
   FOREIGN KEY(Id_colis) REFERENCES colis(Id_colis)
);

CREATE TABLE contient(
   Id_bd INT,
   Id_colis INT,
   PRIMARY KEY(Id_bd, Id_colis),
   FOREIGN KEY(Id_bd) REFERENCES bd(Id_bd),
   FOREIGN KEY(Id_colis) REFERENCES colis(Id_colis)
);