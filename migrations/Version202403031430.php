<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 * Remplissage de la table atelier
 */
final class Version202403031430 extends AbstractMigration
{
    public function getDescription(): string 
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("INSERT INTO atelier (libelle) VALUES ( 'Le club et son projet')");
        $this->addSql("INSERT INTO atelier (libelle) VALUES ( 'Le fonctionnement du club')");
        $this->addSql("INSERT INTO atelier (libelle) VALUES ( 'Les outils à disposition et remis aux clubs')");
        $this->addSql("INSERT INTO atelier (libelle) VALUES ( 'Observatoire des métiers de l’escrime')");
        $this->addSql("INSERT INTO atelier (libelle) VALUES ( 'I.F.F.E')");
        $this->addSql("INSERT INTO atelier (libelle) VALUES ( 'Développement durable')");
          
        
        
          
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DELETE FROM atelier where id <>0');
    }
}
