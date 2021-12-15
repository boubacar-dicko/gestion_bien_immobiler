<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211214234218 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contrat DROP FOREIGN KEY FK_60349993A22917C9');
        $this->addSql('DROP INDEX UNIQ_60349993A22917C9 ON contrat');
        $this->addSql('ALTER TABLE contrat ADD transaction VARCHAR(20) NOT NULL, DROP tansaction_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contrat ADD tansaction_id INT DEFAULT NULL, DROP transaction');
        $this->addSql('ALTER TABLE contrat ADD CONSTRAINT FK_60349993A22917C9 FOREIGN KEY (tansaction_id) REFERENCES transaction (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_60349993A22917C9 ON contrat (tansaction_id)');
    }
}
