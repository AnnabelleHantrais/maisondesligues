<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 * Remplissage de la table theme
 */
final class Version202403031410 extends AbstractMigration
{
    public function getDescription(): string 
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        
        $this->addSql("INSERT INTO theme (libelle) VALUES ('Diagnostic et identification des critères du club')");
          $this->addSql("INSERT INTO theme (libelle) VALUES ('Analyse systémique de l’environnement et méthodologie de mise en œuvre du projet')");
          $this->addSql("INSERT INTO theme (libelle) VALUES ('Actions solidaires et innovantes')");
          $this->addSql("INSERT INTO theme (libelle) VALUES ('Financements')");
          $this->addSql("INSERT INTO theme (libelle) VALUES ('Outils et documentation')");
          $this->addSql("INSERT INTO theme (libelle) VALUES ('Valoriser et communiquer sur le projet')");
          
          $this->addSql("INSERT INTO theme (libelle) VALUES ('Création – Obligations légales')");
          $this->addSql("INSERT INTO theme (libelle) VALUES ('Gestion du personnel, de la structure et des conflits')");
          $this->addSql("INSERT INTO theme (libelle) VALUES ('Relations internes, externes et avec le Comité départemental, la Ligue et la Fédération')");
          $this->addSql("INSERT INTO theme (libelle) VALUES ('Conventions')");
          $this->addSql("INSERT INTO theme (libelle) VALUES ('Partenariats')");
          
          $this->addSql("INSERT INTO theme (libelle) VALUES ('Logiciel FFE de gestion des compétitions (présentation et formation)')");
          $this->addSql("INSERT INTO theme (libelle) VALUES ('Présentation du document « L’arbitrage en images »')");
          $this->addSql("INSERT INTO theme (libelle) VALUES ('Plaquette & guide projet du club')");
          $this->addSql("INSERT INTO theme (libelle) VALUES ('Labelisation du club')");
          $this->addSql("INSERT INTO theme (libelle) VALUES ('Aménagement des équipements')");
          $this->addSql("INSERT INTO theme (libelle) VALUES ('Assurances')");
          
          $this->addSql("INSERT INTO theme (libelle) VALUES ('Observations et analyses sur l’encadrement actuel')");
          $this->addSql("INSERT INTO theme (libelle) VALUES ('Propositions de nouveaux schémas d’organisation')");
          $this->addSql("INSERT INTO theme (libelle) VALUES ('Profils types et pratiques innovantes')");
          $this->addSql("INSERT INTO theme (libelle) VALUES ('Critères et seuils nécessaires à la pérennité de l’emploi')");
          $this->addSql("INSERT INTO theme (libelle) VALUES ('Exercice du métier d’enseignant (avantages et inconvénients)')");
          
          $this->addSql("INSERT INTO theme (libelle) VALUES ('Présentation')");
          $this->addSql("INSERT INTO theme (libelle) VALUES ('Fonctionnement')");
          $this->addSql("INSERT INTO theme (libelle) VALUES ('Objectifs')");
          $this->addSql("INSERT INTO theme (libelle) VALUES ('Nouveaux diplômes')");
          
          $this->addSql("INSERT INTO theme (libelle) VALUES ('Les enjeux climatiques, énergétiques et économiques')");
          $this->addSql("INSERT INTO theme (libelle) VALUES ('Sport et développement durable')");
          $this->addSql("INSERT INTO theme (libelle) VALUES ('Démarche fédérale')");
          $this->addSql("INSERT INTO theme (libelle) VALUES ('Échange')");
        
        
          
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql("DELETE FROM theme where id <>0");
    }
}
