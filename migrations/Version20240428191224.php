<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240428191224 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nuite ADD categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE nuite ADD CONSTRAINT FK_8D4CB715BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie_chambre (id)');
        $this->addSql('CREATE INDEX IDX_8D4CB715BCF5E72D ON nuite (categorie_id)');
        $this->addSql('ALTER TABLE user CHANGE numlicence numlicence INT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6495DB85673 ON user (numlicence)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_8D93D6495DB85673 ON user');
        $this->addSql('ALTER TABLE user CHANGE numlicence numlicence BIGINT NOT NULL');
        $this->addSql('ALTER TABLE nuite DROP FOREIGN KEY FK_8D4CB715BCF5E72D');
        $this->addSql('DROP INDEX IDX_8D4CB715BCF5E72D ON nuite');
        $this->addSql('ALTER TABLE nuite DROP categorie_id');
    }
}
