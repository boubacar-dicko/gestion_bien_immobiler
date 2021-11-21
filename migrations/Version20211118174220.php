<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211118174220 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE acheteur (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE agence_immobilier (id INT AUTO_INCREMENT NOT NULL, nom_agence VARCHAR(50) NOT NULL, adresse_agence VARCHAR(20) NOT NULL, telephone VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE agent_immo (id INT AUTO_INCREMENT NOT NULL, agence_immobilier_id INT DEFAULT NULL, versement_id INT DEFAULT NULL, user_id INT DEFAULT NULL, poste VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_87A0EC26165425D3 (agence_immobilier_id), INDEX IDX_87A0EC26DBBF8D62 (versement_id), UNIQUE INDEX UNIQ_87A0EC26A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE appartement (id INT AUTO_INCREMENT NOT NULL, numero_etage VARCHAR(20) NOT NULL, numero_appartement VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bien_immobilier (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, numero_bi VARCHAR(100) NOT NULL, status VARCHAR(20) NOT NULL, description VARCHAR(255) NOT NULL, localisation_bi VARCHAR(255) NOT NULL, etat VARCHAR(255) NOT NULL, INDEX IDX_D1BE34E119EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, versement_id INT DEFAULT NULL, cni VARCHAR(100) NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(100) NOT NULL, telephone VARCHAR(50) NOT NULL, email VARCHAR(20) NOT NULL, adresse VARCHAR(20) NOT NULL, INDEX IDX_C7440455DBBF8D62 (versement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contrat (id INT AUTO_INCREMENT NOT NULL, bien_immobilier_id INT DEFAULT NULL, tansaction_id INT DEFAULT NULL, agent_immo_id INT DEFAULT NULL, client_id INT DEFAULT NULL, numero_contrat VARCHAR(20) NOT NULL, date_contrat DATE NOT NULL, INDEX IDX_603499935992120A (bien_immobilier_id), UNIQUE INDEX UNIQ_60349993A22917C9 (tansaction_id), INDEX IDX_603499937E9CE0ED (agent_immo_id), INDEX IDX_6034999319EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE immeuble (id INT AUTO_INCREMENT NOT NULL, niveau VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE locataire (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, locataire_id INT DEFAULT NULL, prix_location INT NOT NULL, UNIQUE INDEX UNIQ_5E9E89CBD8A38199 (locataire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE magasin (id INT AUTO_INCREMENT NOT NULL, superfie INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE maison (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mode_paiement (id INT AUTO_INCREMENT NOT NULL, numero_paiement INT NOT NULL, nom_paiement VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transaction (id INT AUTO_INCREMENT NOT NULL, mode_paiement_id INT DEFAULT NULL, numero_transaction INT NOT NULL, date_transaction DATE NOT NULL, INDEX IDX_723705D1438F5B63 (mode_paiement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_transaction (id INT AUTO_INCREMENT NOT NULL, nom_transaction VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vente (id INT AUTO_INCREMENT NOT NULL, acheteur_id INT DEFAULT NULL, prix_de_vente INT NOT NULL, INDEX IDX_888A2A4C96A7BB5F (acheteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE versement (id INT AUTO_INCREMENT NOT NULL, numero_versement INT NOT NULL, date_versement DATE NOT NULL, somme_verse INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE agent_immo ADD CONSTRAINT FK_87A0EC26165425D3 FOREIGN KEY (agence_immobilier_id) REFERENCES agence_immobilier (id)');
        $this->addSql('ALTER TABLE agent_immo ADD CONSTRAINT FK_87A0EC26DBBF8D62 FOREIGN KEY (versement_id) REFERENCES versement (id)');
        $this->addSql('ALTER TABLE agent_immo ADD CONSTRAINT FK_87A0EC26A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE bien_immobilier ADD CONSTRAINT FK_D1BE34E119EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455DBBF8D62 FOREIGN KEY (versement_id) REFERENCES versement (id)');
        $this->addSql('ALTER TABLE contrat ADD CONSTRAINT FK_603499935992120A FOREIGN KEY (bien_immobilier_id) REFERENCES bien_immobilier (id)');
        $this->addSql('ALTER TABLE contrat ADD CONSTRAINT FK_60349993A22917C9 FOREIGN KEY (tansaction_id) REFERENCES transaction (id)');
        $this->addSql('ALTER TABLE contrat ADD CONSTRAINT FK_603499937E9CE0ED FOREIGN KEY (agent_immo_id) REFERENCES agent_immo (id)');
        $this->addSql('ALTER TABLE contrat ADD CONSTRAINT FK_6034999319EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CBD8A38199 FOREIGN KEY (locataire_id) REFERENCES locataire (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1438F5B63 FOREIGN KEY (mode_paiement_id) REFERENCES mode_paiement (id)');
        $this->addSql('ALTER TABLE vente ADD CONSTRAINT FK_888A2A4C96A7BB5F FOREIGN KEY (acheteur_id) REFERENCES acheteur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vente DROP FOREIGN KEY FK_888A2A4C96A7BB5F');
        $this->addSql('ALTER TABLE agent_immo DROP FOREIGN KEY FK_87A0EC26165425D3');
        $this->addSql('ALTER TABLE contrat DROP FOREIGN KEY FK_603499937E9CE0ED');
        $this->addSql('ALTER TABLE contrat DROP FOREIGN KEY FK_603499935992120A');
        $this->addSql('ALTER TABLE bien_immobilier DROP FOREIGN KEY FK_D1BE34E119EB6921');
        $this->addSql('ALTER TABLE contrat DROP FOREIGN KEY FK_6034999319EB6921');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CBD8A38199');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1438F5B63');
        $this->addSql('ALTER TABLE contrat DROP FOREIGN KEY FK_60349993A22917C9');
        $this->addSql('ALTER TABLE agent_immo DROP FOREIGN KEY FK_87A0EC26DBBF8D62');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455DBBF8D62');
        $this->addSql('DROP TABLE acheteur');
        $this->addSql('DROP TABLE agence_immobilier');
        $this->addSql('DROP TABLE agent_immo');
        $this->addSql('DROP TABLE appartement');
        $this->addSql('DROP TABLE bien_immobilier');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE contrat');
        $this->addSql('DROP TABLE immeuble');
        $this->addSql('DROP TABLE locataire');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE magasin');
        $this->addSql('DROP TABLE maison');
        $this->addSql('DROP TABLE mode_paiement');
        $this->addSql('DROP TABLE transaction');
        $this->addSql('DROP TABLE type_transaction');
        $this->addSql('DROP TABLE vente');
        $this->addSql('DROP TABLE versement');
    }
}
