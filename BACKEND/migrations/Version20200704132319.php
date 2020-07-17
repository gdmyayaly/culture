<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200704132319 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE allsession (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, mois VARCHAR(255) NOT NULL, annee VARCHAR(255) NOT NULL, teams JSON DEFAULT NULL, concerner VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evalluation (id INT AUTO_INCREMENT NOT NULL, evaluer_id INT DEFAULT NULL, evaluateur_id INT DEFAULT NULL, session_id INT DEFAULT NULL, perseverance INT NOT NULL, confiance INT NOT NULL, collaboration INT NOT NULL, autonomie INT NOT NULL, problemsolving INT NOT NULL, transmission INT NOT NULL, performance INT NOT NULL, date DATETIME NOT NULL, INDEX IDX_2590461755A18BD3 (evaluer_id), INDEX IDX_25904617231F139 (evaluateur_id), INDEX IDX_25904617613FECDF (session_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE poste (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, statut VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, poste VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_team (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, team_id INT DEFAULT NULL, INDEX IDX_BE61EAD6A76ED395 (user_id), INDEX IDX_BE61EAD6296CD8AE (team_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE evalluation ADD CONSTRAINT FK_2590461755A18BD3 FOREIGN KEY (evaluer_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE evalluation ADD CONSTRAINT FK_25904617231F139 FOREIGN KEY (evaluateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE evalluation ADD CONSTRAINT FK_25904617613FECDF FOREIGN KEY (session_id) REFERENCES allsession (id)');
        $this->addSql('ALTER TABLE user_team ADD CONSTRAINT FK_BE61EAD6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_team ADD CONSTRAINT FK_BE61EAD6296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evalluation DROP FOREIGN KEY FK_25904617613FECDF');
        $this->addSql('ALTER TABLE user_team DROP FOREIGN KEY FK_BE61EAD6296CD8AE');
        $this->addSql('ALTER TABLE evalluation DROP FOREIGN KEY FK_2590461755A18BD3');
        $this->addSql('ALTER TABLE evalluation DROP FOREIGN KEY FK_25904617231F139');
        $this->addSql('ALTER TABLE user_team DROP FOREIGN KEY FK_BE61EAD6A76ED395');
        $this->addSql('DROP TABLE allsession');
        $this->addSql('DROP TABLE evalluation');
        $this->addSql('DROP TABLE poste');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_team');
    }
}
