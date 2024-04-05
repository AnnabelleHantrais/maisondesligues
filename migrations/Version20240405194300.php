<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 * Remplissage de la table atelier
 */
final class Version20240405194300 extends AbstractMigration
{
    public function getDescription(): string 
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $ids=[1,2];
        $dates=['2024/09/08', '2024/09/09'];
        foreach($ids as $id){
            foreach($dates as $date){
                $this->addSql("insert into nuite(hotel_id,date_nuite) values($id, str_to_date('$date', '%Y/%m/%d'))");
            }
        }
        
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DELETE FROM nuite where id <> 0');
    }
}
