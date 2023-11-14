-- MariaDB dump 10.19  Distrib 10.6.12-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: vente_bd2
-- ------------------------------------------------------
-- Server version	10.6.12-MariaDB-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bd`
--

DROP TABLE IF EXISTS `bd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categorie_id` int(11) DEFAULT NULL,
  `fournisseur_id` int(11) DEFAULT NULL,
  `titre` varchar(255) NOT NULL,
  `image_bd` varchar(255) NOT NULL,
  `auteur` varchar(255) NOT NULL,
  `editeur` varchar(255) NOT NULL,
  `date_edition` date NOT NULL,
  `resume` longtext NOT NULL,
  `prix` decimal(6,2) NOT NULL,
  `stock` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5CCDBE9BBCF5E72D` (`categorie_id`),
  KEY `IDX_5CCDBE9B670C757F` (`fournisseur_id`),
  CONSTRAINT `FK_5CCDBE9B670C757F` FOREIGN KEY (`fournisseur_id`) REFERENCES `fournisseur` (`id`),
  CONSTRAINT `FK_5CCDBE9BBCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bd`
--

LOCK TABLES `bd` WRITE;
/*!40000 ALTER TABLE `bd` DISABLE KEYS */;
INSERT INTO `bd` VALUES (1,1,1,'Eigyr','eigyr.jpeg','Hamon Jerome','LOMBARD','2023-10-25','Au fin fond d\'une Angleterre qui ne porte pas encore ce nom, Chrétiens et Bretons s\'affrontent sur un nouveau champ de bataille : la possession d\'Eigyr ! Est-ce là un artefact ou une place forte ? Que nenni ! Eigyr est une jeune femme dont le ventre rond abriterait la réincarnation de Merlin. Son corps est devenu un enjeu politique dont les hommes entendent disposer. Mais une mère est prête à tout pour protéger la future chair de sa chair...',24.50,253),(2,1,1,'Pendragon - L\'épee perdue - Tome 1','pendragon:lepee_perdue_t1.jpeg','Jerome Le Gris','GLENAT','2023-06-09','Arthur, le retour de la légende. Depuis le départ des légions romaines, les dieux semblent avoir abandonné les hommes et les terres d\'Alba. Et cet antique royaume est désormais la proie de guerres féroces et incessantes. Pourtant, le sorcier Merlin cherche sans relâche à rétablir l\'harmonie. Il devra, pour ce faire, trouver enfin un roi capable de mettre un terme aux querelles intestines entre les Sept Royaumes.\nUn roi capable aussi de rétablir les anciennes croyances face à l\'émergence d\'une nouvelle religion. Alors que les combats font rage sur les terres du roi Leodan, la prêtresse Nimue sent que l\'heure est proche. Bientôt, un homme fera entrer l\'Angleterre dans un âge nouveau : Arthur. Chef de guerre local sans rêve de grandeurs, Arthur n\'a pas l\'ambition de devenir le Haut-Roi des Basses-Terres. Pourtant ses exploits ont déjà plusieurs fois montré ses qualités de leader et de fin stratège.\nPour certains, le futur époux d\'Elwen, fille du défunt roi Leodan, incarne le seul espoir face aux troubles grandissants qui menacent l\'unité d\'Alba. Arthur acceptera-t-il la lourde charge proposée par Merlin ? Saura-t-il se montrer digne de l\'espoir qui a été placé en lui ? Et si le roi Arthur avait régné au Ve siècle après J. -C. ? Avec un premier cycle prévu en quatre tomes, Jérôme Le Gris revisite librement le mythe chrétien du Graal en l\'inscrivant dans le contexte historique qui aurait vu émerger cette figure légendaire.\nLe dessin généreux et flamboyant de Paolo Martinello nous propose un univers sauvage, empreint de mythologie celte, tout en s\'appuyant sur le story-board hollywoodien de Benoît Dellac. ',14.50,74),(3,1,1,'Webster & Jones','webster&jones.jpeg','Laine','DARGAUD','2023-01-09','1956, quelque part au-dessus de la forêt amazonienne. Un petit avion de reconnaissance survole l\'épaisse végétation et semble avoir trouvé ce qu\'il était venu chercher quand, soudainement, le voilà abattu... A son bord, deux inspecteurs américains prenaient des clichés d\'une importance capitale. Trois mois plus tard, après des recherches infructueuses, les Etats-Unis dépêchent sur place un commando plutôt étonnant pour enquêter sur cette étrange disparition.\nLe capitaine Wallace Webster, qui préfère \"casser du bolchévique\" à l\'art subtil de la stratégie militaire, et Betty Jones, agente de liaison du département de la défense, se voient obligés de collaborer. Tandis qu\'il crapahute au coeur de cette jungle hostile, le duo découvre la carcasse de l\'avion et les cadavres des agents de reconnaissance. Et à deux pas de là... une base secrète abandonnée qui a visiblement servi au lancement d\'engins spatiaux avant d\'être la cible d\'une attaque ennemie.\nSoudain, un robot géant et absolument futuriste, frappé d\'une immense croix gammée, prend Webster et Jones en chasse. Il ne fait aucun doute : les nazis n\'ont pas encore dit leur dernier mot et sont partis... à la conquête de l\'espace ! ',21.50,254),(4,4,1,'Marvel Comic n°19','marvel_comic_n19.jpeg','colective','PANINI','2023-05-07',' Kang revient dans les pages de MARVEL COMICS pour nous donner un aperçu du futur. Que présage l\'avenir pour les héros Marvel ? Vous allez le découvrir ! Spider-Man voit un de ses pires ennemis s\'allier à un adversaire des X-Men. Ca sent le crossover ! Et puisqu\'on en parle, l\'affrontement entre toutes les équipes d\'Avengers du multivers et les Maîtres du Mal de Méphisto se poursuit. Quant à Thor, il part sur la piste de Corvus Glaive pour comprendre ses visions concernant Thanos.\nEncore du changement ce mois-ci ! Jed Mackay, le futur scénariste des Avengers (ce sera en novembre) se penche sur l\'avenir de l\'univers Marvel. Jason Aaron poursuit sa dernière saga des Avengers. En plus, Amazing Spider-Man vous présente le prologue d\'une saga Spidey / X-Men, Dark Web, qui nous tiendra en haleine à partir du mois prochain dans un mensuel à part, et Thor commence une nouvelle saga !',16.00,15),(5,4,1,'X-Men - Proteus','x-men:proteus.jpeg','Claremont','PANINI','2023-06-09','Magnéto veut régler ses comptes avec les X-Men, et l\'affrontement va en faire passer certains pour morts, piégés en Terre Sauvage avec Sauron ! Mais sur l\'île de Muir, l\'équipe va surtout devoir affronter la menace du terrifiant Protéus, fils de Moira MacTaggert ! Avec aussi la première apparition d\'Alpha Flight ! Cet album recueille une partie importante des épisodes de la série Uncanny X-Men signés par Chris Claremont et John Byrne, à l\'origine de certaines des plus grandes sagas de l\'équipe.\nLa collection MARVEL EPIC offre à nos lecteurs l\'occasion de découvrir cette époque essentielle dans un épais volume de 400 pages, comme à l\'habitude disponible en version souple ou collector cartonnée ! ',28.00,54),(6,4,1,'Punisher - La fin du punisher - Tome 3','punisher:la_fin_du_punisher_t3.jpeg','Aaron Saiz Azaceta','PANINI','2023-06-09','Le Punisher contre Arès : le combat final. Mais même si Frank Castle survit à l\'assaut du Dieu de la Guerre, il va devoir affronter d\'autres forces qui souhaitent le faire tomber une fois pour toutes... au risque de perdre son âme ? Est-ce Maria Castle qui tient la clé de la rédemption du terrible anti-héros ? Jason Aaron (Avengers) boucle la terrifiante saga qui a ressuscité Maria, la femme du Punisher, et dans laquelle Frank Castle a pris la tête des assassins de la Main.\nUne épopée sublimée par les dessins de Jesus Saiz (Captain America) pour les scènes du présent et Paul Azaceta (Daredevil) pour les flash-backs. ',19.00,220),(7,5,1,'Flash infinite - Tome 3','flash_infinite_t3.jpeg','Jeremy Adams','URBAN COMICS','2025-02-05','Etre l\'homme le plus rapide du monde exige de grandes responsabilités. Wally West, également connu sous le nom de Flash, décide d\'enseigner au nouveau Kid Flash son savoir-faire. Mais les agissements du Bolide Ecarlate ne sont pas du goût de Gregory Wolfe, le directeur de la prison d\'Iron Heights qui accède au poste de maire de Keystone City. Afin d\'assurer la sécurité en ville, celui-ci décide de confier le maintien de l\'ordre aux Lascars.\nEt comme si cela ne suffisait pas. Linda, l\'épouse de Wally, a une surprise pour lui... ',19.00,76),(8,5,1,'Harley Quinn infinite - Tome 3','harley_quinn_infinite_t3.jpeg','Stephanie Philips','URBAN COMICS','2024-04-10','Si, dans le passé, Harley Quinn a commis de nombreux crimes, c\'est bien une innocente que l\'on vient de jeter en prison cette fois-ci ! Et pour le prouver, il ne sera pas de meilleure acolyte que Batwoman. Ensemble, elles chercheront à laver le nom d\'Harley en enquêtant sur la nouvelle criminelle de Gotham, Verdict, qui semble en vouloir personnellement à l\'ex-copine du Joker. ',17.00,70),(9,5,1,'Superman Aventures - Tome 6','superman_aventures_t6.jpeg','Millar Mark','URBAN COMICS','2022-09-12','Un récit inoubliable sur l\'homme d\'acier ! Seul, sans ami et amnésique, Superman est obligé de chercher refuge dans une ville hostile et inconnue : Smallville. Et le super-héros n\'est pas au bout de ses peines... Une attaque de vaisseau extraterrestres, son rétrécissement contraint, la perte de ses pouvoirs, la justice à ses trousses ou encore la menace d\'un virus mortel dont est atteint Kara, et les actions suspectes de Lex Luthor, Superman doit redoubler d\'efforts pour gérer ces situations de crise, parviendra-t-il à ce que tout rentre dans l\'ordre ?',10.00,75),(10,6,1,'Sakamoto Days - Tome 1','sakamoto_days_t1.jpeg','Yuto Suzuki','GLENAT','2022-06-04','Taro Sakamoto est un assassin légendaire, le meilleur d\'entre tous, craint par tous les gangsters, adulé par ses pairs. Mais un beau jour? il tombe amoureux ! S\'ensuivent retraite, mariage, paternité? et prise de poids. Sakamoto est aujourd\'hui patron d\'une petite épicerie de quartier et coule des jours heureux avec sa famille. Mais lorsque son passé le rattrape sous les traits de Shin, un jeune assassin télépathe, Sakamoto reprend du service? et malgré son apparence, il est toujours aussi charismatique lorsqu\'il passe à l\'action !',6.99,98),(11,6,1,'Dandadan - Tome 6','dandadan6.jpeg','Yukinobu Talsu','CRUNCHYROLL','2024-09-06','Momo Ayase et Ken Takakura sont tous deux lycéens. Tandis que la première croit aux fantômes, le second est fasciné par les extraterrestres. Évidemment, chacun se moque des croyances de l\'autre. Incapables de se convaincre, ils se lancent un défi pour savoir lequel des deux a raison',7.29,46),(12,6,1,'jujutsu kaisen - Tome 1','jujutsu_kaisen1.jpeg','Gege Akutami','KI-OON','2020-06-02','Yuta Okkotsu, un adolescent de 16 ans atteint d\'une puissante malédiction du fléau Rika Orimoto, a accepté d\'être exécuté. Cependant, Satoru Gojo lui propose un autre issue : entrer à l\'école d\'exorcisme de Tokyo pour en savoir plus sur les fléaux et se défaire de sa malédiction.',6.95,75),(13,7,1,'Alpi - The Soul Sender - Tome 1','alpi_the_soul_sender_t1.jpeg','Rona','KI-OON','2020-03-09','Une fable écologique au coeur d\'un monde fantastique ! Les esprits divins sont source de vie. Des communautés se forment sous leur protection, jouissant des bienfaits de leur énergie. Cependant, leur mort enclenche une malédiction qui détruit tout ce qui les entoure... C\'est là qu\'interviennent les soul senders ! Ces rares élus sont capables d\'absorber la pollution maléfique et de délivrer l\'âme des esprits qui, une fois apaisés, ne constituent plus une menace.\nMalgré son jeune âge, Alpi fait partie de ces mages d\'élite. Aidée de son fidèle serviteur Pelenai, elle fait de son mieux pour remplir sa tâche, en dépit des souffrances extrêmes provoquées par le contact avec les ténèbres divines. La fillette s\'est lancée dans une odyssée à travers le monde sur les traces de ses parents, eux-mêmes soul senders et disparus au cours d\'une mission... L\'harmonie avec la nature a un prix ! Au fil de son périple, la courageuse Alpi découvre diverses cultures et autant d\'approches différentes des liens entre humains et esprits.\nAvec sensibilité, sans manichéisme, Alpi the Soul Sender offre une invitation au voyage et, surtout, au partage avec les êtres qui nous entourent. ',7.95,246),(14,7,1,'Villageois lvl 999 - Tome 1','villageois_lvl_999.jpeg','Hoshitsuki Koneko','MANA BOOKS','2023-01-06','Les aventures épiques et pleines de rebondissements de Villageois LVL 999 ! Héros, sages, guerriers... Dans un monde où le rôle de chacun est attribué à la naissance, quiconque naît \" villageois \" - ; le plus faible de tous les rôles - ; est condamné à oeuvrer au développement des villes sous la protection d\'êtres supérieurs. Contre toute attente, l\'un d\'entre eux a atteint un niveau absolument inouï : 999 ! Sa rencontre avec une fillette de la race des démons va pousser le villageois Kagami à lutter pour un monde meilleur.',7.95,420),(15,7,1,'Gantz :E - Tome 4','gantz4.jpeg','Hiroya Oku','DELCOURT','2024-01-09','Hanbe\'e, un paysan, demande O-Haru en mariage, mais celle-ci lui répond qu\'elle en aime un autre, Masakichi. Hanbe\'e rencontre Masakichi et découvre qu\'il sait magner le sabre malgré sa condition de paysan. Alors qu\'ils s\'affrontent, une jeune fille se noie. Les deux hommes meurent en tentant de la sauver. Ils se retrouvent alors dans une salle Gantz. ',8.50,250);
/*!40000 ALTER TABLE `bd` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categorie_id` int(11) DEFAULT NULL,
  `nom_categorie` varchar(255) NOT NULL,
  `image_categorie` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_497DD634BCF5E72D` (`categorie_id`),
  CONSTRAINT `FK_497DD634BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorie`
--

LOCK TABLES `categorie` WRITE;
/*!40000 ALTER TABLE `categorie` DISABLE KEYS */;
INSERT INTO `categorie` VALUES (1,NULL,'BD','bd.png'),(2,NULL,'Comic','comic.png'),(3,NULL,'Manga','manga.png'),(4,2,'Marvel','marvel.png'),(5,2,'DC','dc.png'),(6,3,'Shonen','shonen.png'),(7,3,'Seinen','seinen.png');
/*!40000 ALTER TABLE `categorie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commande`
--

DROP TABLE IF EXISTS `commande`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `livraison_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `montant_commande` decimal(7,2) NOT NULL,
  `date_commande` date NOT NULL,
  `etat_commande` int(11) NOT NULL,
  `facture` varchar(255) NOT NULL,
  `adresse_facture` varchar(255) NOT NULL,
  `cp_facture` varchar(10) NOT NULL,
  `ville_facture` varchar(255) NOT NULL,
  `nb_colis` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6EEAA67D8E54FB25` (`livraison_id`),
  KEY `IDX_6EEAA67DA76ED395` (`user_id`),
  CONSTRAINT `FK_6EEAA67D8E54FB25` FOREIGN KEY (`livraison_id`) REFERENCES `livraison` (`id`),
  CONSTRAINT `FK_6EEAA67DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commande`
--

LOCK TABLES `commande` WRITE;
/*!40000 ALTER TABLE `commande` DISABLE KEYS */;
INSERT INTO `commande` VALUES (1,NULL,1,34.40,'2023-11-06',0,'Facture.pdf','32 rue valentin hauy','80000','Amiens',1);
/*!40000 ALTER TABLE `commande` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_commande`
--

DROP TABLE IF EXISTS `detail_commande`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detail_commande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bd_id` int(11) DEFAULT NULL,
  `commande_id` int(11) DEFAULT NULL,
  `nb_commander` int(11) NOT NULL,
  `prix_commander` decimal(6,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_98344FA6894AF46` (`bd_id`),
  KEY `IDX_98344FA682EA2E54` (`commande_id`),
  CONSTRAINT `FK_98344FA682EA2E54` FOREIGN KEY (`commande_id`) REFERENCES `commande` (`id`),
  CONSTRAINT `FK_98344FA6894AF46` FOREIGN KEY (`bd_id`) REFERENCES `bd` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_commande`
--

LOCK TABLES `detail_commande` WRITE;
/*!40000 ALTER TABLE `detail_commande` DISABLE KEYS */;
INSERT INTO `detail_commande` VALUES (1,1,1,1,24.50);
/*!40000 ALTER TABLE `detail_commande` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_livraison`
--

DROP TABLE IF EXISTS `detail_livraison`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detail_livraison` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bd_id` int(11) DEFAULT NULL,
  `livraison_id` int(11) DEFAULT NULL,
  `nb_livrer` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B7FB4AAA894AF46` (`bd_id`),
  KEY `IDX_B7FB4AAA8E54FB25` (`livraison_id`),
  CONSTRAINT `FK_B7FB4AAA894AF46` FOREIGN KEY (`bd_id`) REFERENCES `bd` (`id`),
  CONSTRAINT `FK_B7FB4AAA8E54FB25` FOREIGN KEY (`livraison_id`) REFERENCES `livraison` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_livraison`
--

LOCK TABLES `detail_livraison` WRITE;
/*!40000 ALTER TABLE `detail_livraison` DISABLE KEYS */;
/*!40000 ALTER TABLE `detail_livraison` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fournisseur`
--

DROP TABLE IF EXISTS `fournisseur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fournisseur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_fourniseur` varchar(255) NOT NULL,
  `nom_contact` varchar(255) NOT NULL,
  `telephone_contact` varchar(255) NOT NULL,
  `adresse_fournisseur` varchar(255) NOT NULL,
  `ville_fournisseur` varchar(255) NOT NULL,
  `cp_fournisseur` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fournisseur`
--

LOCK TABLES `fournisseur` WRITE;
/*!40000 ALTER TABLE `fournisseur` DISABLE KEYS */;
INSERT INTO `fournisseur` VALUES (1,'fnac','Lucien Dupon','06351425','15 rue du marechal feran','paris','95000');
/*!40000 ALTER TABLE `fournisseur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `livraison`
--

DROP TABLE IF EXISTS `livraison`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `livraison` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_livraison` date NOT NULL,
  `retard_eventuel` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `livraison`
--

LOCK TABLES `livraison` WRITE;
/*!40000 ALTER TABLE `livraison` DISABLE KEYS */;
/*!40000 ALTER TABLE `livraison` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messenger_messages`
--

LOCK TABLES `messenger_messages` WRITE;
/*!40000 ALTER TABLE `messenger_messages` DISABLE KEYS */;
INSERT INTO `messenger_messages` VALUES (1,'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:39:\\\"Symfony\\\\Bridge\\\\Twig\\\\Mime\\\\TemplatedEmail\\\":4:{i:0;s:41:\\\"registration/confirmation_email.html.twig\\\";i:1;N;i:2;a:3:{s:9:\\\"signedUrl\\\";s:167:\\\"http://127.0.0.1:8000/verify/email?expires=1698657447&signature=iCIdNvenOr4TRj4Kf1VqXwdScUiVwliBxSfhI9G%2FXcc%3D&token=9ntKIt34LQQsbkuR6hnZUXIYplYMTtQDHfEcu%2BBUT6Y%3D\\\";s:19:\\\"expiresAtMessageKey\\\";s:26:\\\"%count% hour|%count% hours\\\";s:20:\\\"expiresAtMessageData\\\";a:1:{s:7:\\\"%count%\\\";i:1;}}i:3;a:6:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;a:0:{}i:5;a:2:{i:0;O:37:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\\":2:{s:46:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\\";a:3:{s:4:\\\"from\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:4:\\\"From\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:16:\\\"admin@bd-cda.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:5:\\\"admin\\\";}}}}s:2:\\\"to\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:2:\\\"To\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:24:\\\"quentin.saval@hotmail.fr\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:7:\\\"subject\\\";a:1:{i:0;O:48:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:7:\\\"Subject\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:55:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\\";s:25:\\\"Please Confirm your Email\\\";}}}s:49:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\\";i:76;}i:1;N;}}}s:61:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\\";N;}}','[]','default','2023-10-30 09:17:27','2023-10-30 09:17:27',NULL);
/*!40000 ALTER TABLE `messenger_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `nom_user` varchar(255) NOT NULL,
  `prenom_user` varchar(255) NOT NULL,
  `adresse_facturation` varchar(255) NOT NULL,
  `ville_facturation` varchar(255) NOT NULL,
  `cp_facturation` varchar(10) NOT NULL,
  `adresse_livraison` varchar(255) NOT NULL,
  `cp_livraison` varchar(10) NOT NULL,
  `ville_livraison` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'quentin.saval@hotmail.fr','[]','$2y$13$g74Q6iZcD63Bs7n9L6iqt.Qbu1PiaaXR1.1HL39qAmmZKZ0yYRUui','saval','quentin','32 rue valentin hauy','Amiens','80000','32 rue valentin hauy','80000','Amiens','particulier',0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-13 16:45:45
