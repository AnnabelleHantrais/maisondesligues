<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240416095055 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
       // $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE IF NOT EXISTS user (id INT AUTO_INCREMENT NOT NULL, inscription_id INT DEFAULT NULL, numlicence VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, is_verified TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D6495DB85673 (numlicence), UNIQUE INDEX UNIQ_8D93D6495DAC5993 (inscription_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        //$this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6495DAC5993 FOREIGN KEY (inscription_id) REFERENCES inscription (id)');
        //$this->addSql('ALTER TABLE inscription ADD user_id INT DEFAULT NULL');
        //$this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        //$this->addSql('CREATE UNIQUE INDEX UNIQ_5E90F6D6A76ED395 ON inscription (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6A76ED395');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6495DAC5993');
        //$this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE user IF EXISTS');
        $this->addSql('DROP INDEX UNIQ_5E90F6D6A76ED395 ON inscription');
        $this->addSql('ALTER TABLE inscription DROP user_id');
    }
}
