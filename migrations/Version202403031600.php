<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 * Remplissage de la table atelier
 */
final class Version202403031600 extends AbstractMigration
{
    public function getDescription(): string 
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $atelier_ids=[1,2,3,4,5,6];
        foreach($atelier_ids as $id){
            $this->addSql("insert into vacation (atelier_id,dateheure_debut, dateheure_fin) values($id,'2024-09-08 11:00:00', '2024-09-08 12:30:00');");
            $this->addSql("insert into vacation (atelier_id,dateheure_debut, dateheure_fin) values($id,'2024-09-08 14:00:00', '2024-09-08 15:30:00')");
            $this->addSql("insert into vacation (atelier_id,dateheure_debut, dateheure_fin) values($id,'2024-09-08 16:00:00', '2024-09-08 17:30:00')");
            $this->addSql("insert into vacation (atelier_id,dateheure_debut, dateheure_fin) values($id,'2024-09-09 09:00:00', '2024-09-09 10:30:00')");
            $this->addSql("insert into vacation (atelier_id,dateheure_debut, dateheure_fin) values($id,'2024-09-09 11:00:00', '2024-09-09 12:30:00')");
        }
        
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DELETE FROM vacation where id <>0');
    }
}
