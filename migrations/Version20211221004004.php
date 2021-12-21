<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211221004004 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agence_immobilier ADD latitude DOUBLE PRECISION NOT NULL, ADD longitude DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE user ADD agence_immobilier_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649165425D3 FOREIGN KEY (agence_immobilier_id) REFERENCES agence_immobilier (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649165425D3 ON user (agence_immobilier_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agence_immobilier DROP latitude, DROP longitude');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649165425D3');
        $this->addSql('DROP INDEX UNIQ_8D93D649165425D3 ON user');
        $this->addSql('ALTER TABLE user DROP agence_immobilier_id');
    }
}
