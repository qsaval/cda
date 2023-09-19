<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230918071357 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bd (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, fournisseur_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, image_bd VARCHAR(255) NOT NULL, auteur VARCHAR(255) NOT NULL, editeur VARCHAR(255) NOT NULL, date_edition DATE NOT NULL, resume LONGTEXT NOT NULL, prix NUMERIC(6, 2) NOT NULL, INDEX IDX_5CCDBE9BBCF5E72D (categorie_id), INDEX IDX_5CCDBE9B670C757F (fournisseur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, nom_categorie VARCHAR(255) NOT NULL, image_categorie VARCHAR(255) NOT NULL, INDEX IDX_497DD634BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, livraison_id INT DEFAULT NULL, montant_commande NUMERIC(7, 2) NOT NULL, date_commande DATE NOT NULL, etat_commande INT NOT NULL, facture VARCHAR(255) NOT NULL, adresse_facture VARCHAR(255) NOT NULL, cp_facture VARCHAR(5) NOT NULL, ville_facture VARCHAR(255) NOT NULL, nb_colis INT NOT NULL, INDEX IDX_6EEAA67D8E54FB25 (livraison_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detail_commande (id INT AUTO_INCREMENT NOT NULL, id_bd_id INT DEFAULT NULL, id_commande_id INT DEFAULT NULL, nb_commander INT NOT NULL, prix_commander NUMERIC(6, 2) NOT NULL, INDEX IDX_98344FA6E611EE76 (id_bd_id), INDEX IDX_98344FA69AF8E3A3 (id_commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detail_livraison (id INT AUTO_INCREMENT NOT NULL, id_bd_id INT DEFAULT NULL, id_livraison_id INT DEFAULT NULL, nb_livrer INT NOT NULL, INDEX IDX_B7FB4AAAE611EE76 (id_bd_id), INDEX IDX_B7FB4AAAAD958E57 (id_livraison_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournisseur (id INT AUTO_INCREMENT NOT NULL, nom_fourniseur VARCHAR(255) NOT NULL, nom_contact VARCHAR(255) NOT NULL, telephone_contact VARCHAR(255) NOT NULL, adresse_fournisseur VARCHAR(255) NOT NULL, ville_fournisseur VARCHAR(255) NOT NULL, cp_fournisseur VARCHAR(5) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livraison (id INT AUTO_INCREMENT NOT NULL, date_livraison DATE NOT NULL, nom_transporteur VARCHAR(255) NOT NULL, retard_eventuel TINYINT(1) NOT NULL, telephone_transporteur VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bd ADD CONSTRAINT FK_5CCDBE9BBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE bd ADD CONSTRAINT FK_5CCDBE9B670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD634BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D8E54FB25 FOREIGN KEY (livraison_id) REFERENCES livraison (id)');
        $this->addSql('ALTER TABLE detail_commande ADD CONSTRAINT FK_98344FA6E611EE76 FOREIGN KEY (id_bd_id) REFERENCES bd (id)');
        $this->addSql('ALTER TABLE detail_commande ADD CONSTRAINT FK_98344FA69AF8E3A3 FOREIGN KEY (id_commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE detail_livraison ADD CONSTRAINT FK_B7FB4AAAE611EE76 FOREIGN KEY (id_bd_id) REFERENCES bd (id)');
        $this->addSql('ALTER TABLE detail_livraison ADD CONSTRAINT FK_B7FB4AAAAD958E57 FOREIGN KEY (id_livraison_id) REFERENCES livraison (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bd DROP FOREIGN KEY FK_5CCDBE9BBCF5E72D');
        $this->addSql('ALTER TABLE bd DROP FOREIGN KEY FK_5CCDBE9B670C757F');
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD634BCF5E72D');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D8E54FB25');
        $this->addSql('ALTER TABLE detail_commande DROP FOREIGN KEY FK_98344FA6E611EE76');
        $this->addSql('ALTER TABLE detail_commande DROP FOREIGN KEY FK_98344FA69AF8E3A3');
        $this->addSql('ALTER TABLE detail_livraison DROP FOREIGN KEY FK_B7FB4AAAE611EE76');
        $this->addSql('ALTER TABLE detail_livraison DROP FOREIGN KEY FK_B7FB4AAAAD958E57');
        $this->addSql('DROP TABLE bd');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE detail_commande');
        $this->addSql('DROP TABLE detail_livraison');
        $this->addSql('DROP TABLE fournisseur');
        $this->addSql('DROP TABLE livraison');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
