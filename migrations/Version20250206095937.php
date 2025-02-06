<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250206095937 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tournament ADD name VARCHAR(255) NOT NULL, ADD registration_start_date DATETIME NOT NULL, ADD registration_end_date DATETIME NOT NULL, ADD start_date DATETIME NOT NULL, ADD max_teams INT NOT NULL, ADD players_per_team INT NOT NULL, ADD status VARCHAR(20) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE team');
        $this->addSql('ALTER TABLE tournament DROP name, DROP registration_start_date, DROP registration_end_date, DROP start_date, DROP max_teams, DROP players_per_team, DROP status');
    }
}
