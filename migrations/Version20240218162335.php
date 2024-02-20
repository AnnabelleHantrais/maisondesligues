<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240218162335 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE licencie');
        $this->addSql('DROP TABLE qualite');
        $this->addSql('DROP INDEX PK_CLUB ON club');
        $this->addSql('ALTER TABLE club CHANGE ID id INT AUTO_INCREMENT NOT NULL, CHANGE NOM nom VARCHAR(55) NOT NULL, CHANGE ADRESSE1 adresse1 VARCHAR(60) NOT NULL, CHANGE ADRESSE2 adresse2 VARCHAR(60) NOT NULL, CHANGE CP cp INT NOT NULL, CHANGE VILLE ville VARCHAR(60) NOT NULL, CHANGE TEL tel INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE licencie (ID DOUBLE PRECISION DEFAULT NULL, NUMLICENCE BIGINT DEFAULT NULL, NOM VARCHAR(70) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, PRENOM VARCHAR(70) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, ADRESSE1 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, ADRESSE2 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, CP CHAR(6) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, VILLE VARCHAR(70) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, TEL CHAR(14) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, MAIL VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, DATEADHESION DATETIME DEFAULT NULL, IDCLUB NUMERIC(38, 0) DEFAULT NULL, IDQUALITE NUMERIC(38, 0) DEFAULT NULL, UNIQUE INDEX PK_LICENCIE (ID), UNIQUE INDEX UQ_CLUB (NUMLICENCE)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE qualite (ID TINYINT(1) DEFAULT NULL, LIBELLEQUALITE VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, UNIQUE INDEX PK_QUALITE (ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('ALTER TABLE club CHANGE id ID NUMERIC(38, 0) NOT NULL, CHANGE nom NOM VARCHAR(50) DEFAULT NULL, CHANGE adresse1 ADRESSE1 VARCHAR(60) DEFAULT NULL, CHANGE adresse2 ADRESSE2 VARCHAR(60) DEFAULT NULL, CHANGE cp CP CHAR(5) DEFAULT NULL, CHANGE ville VILLE VARCHAR(60) DEFAULT NULL, CHANGE tel TEL CHAR(14) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX PK_CLUB ON club (ID)');
    }
}
