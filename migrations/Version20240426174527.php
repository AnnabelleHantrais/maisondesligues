<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240426174527 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE IF NOT EXISTS inscription_nuite (inscription_id INT NOT NULL, nuite_id INT NOT NULL, INDEX IDX_DF05E3585DAC5993 (inscription_id), INDEX IDX_DF05E358A84291E2 (nuite_id), PRIMARY KEY(inscription_id, nuite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE IF NOT EXISTS qualite (id INT AUTO_INCREMENT NOT NULL, libellequalite VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE IF NOT EXISTS role (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
       // $this->addSql('ALTER TABLE inscription_nuite ADD CONSTRAINT FK_DF05E3585DAC5993 FOREIGN KEY (inscription_id) REFERENCES inscription (id) ON DELETE CASCADE');
        //$this->addSql('ALTER TABLE inscription_nuite ADD CONSTRAINT FK_DF05E358A84291E2 FOREIGN KEY (nuite_id) REFERENCES nuite (id) ON DELETE CASCADE');
       // $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6A76ED395');
        //$this->addSql('DROP INDEX UNIQ_5E90F6D6A76ED395 ON inscription');
        //$this->addSql('ALTER TABLE inscription DROP user_id');
        //$this->addSql('ALTER TABLE user CHANGE numlicence numlicence INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription_nuite DROP FOREIGN KEY FK_DF05E3585DAC5993');
        $this->addSql('ALTER TABLE inscription_nuite DROP FOREIGN KEY FK_DF05E358A84291E2');
        $this->addSql('DROP TABLE inscription_nuite');
        $this->addSql('DROP TABLE qualite');
        $this->addSql('DROP TABLE role');
        $this->addSql('ALTER TABLE inscription ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5E90F6D6A76ED395 ON inscription (user_id)');
        $this->addSql('ALTER TABLE user CHANGE numlicence numlicence VARCHAR(180) NOT NULL');
    }
}
