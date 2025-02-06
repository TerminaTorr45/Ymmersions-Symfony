<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250206100902 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game ADD team_a_id INT NOT NULL, ADD team_b_id INT NOT NULL, ADD tournament_id INT NOT NULL, ADD score_a INT DEFAULT NULL, ADD score_b INT DEFAULT NULL, ADD game_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CEA3FA723 FOREIGN KEY (team_a_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CF88A08CD FOREIGN KEY (team_b_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C33D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (id)');
        $this->addSql('CREATE INDEX IDX_232B318CEA3FA723 ON game (team_a_id)');
        $this->addSql('CREATE INDEX IDX_232B318CF88A08CD ON game (team_b_id)');
        $this->addSql('CREATE INDEX IDX_232B318C33D1A3E7 ON game (tournament_id)');
        $this->addSql('ALTER TABLE participation ADD team_id INT NOT NULL, ADD tournament_id INT NOT NULL, ADD participation_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24F296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24F33D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (id)');
        $this->addSql('CREATE INDEX IDX_AB55E24F296CD8AE ON participation (team_id)');
        $this->addSql('CREATE INDEX IDX_AB55E24F33D1A3E7 ON participation (tournament_id)');
        $this->addSql('ALTER TABLE team ADD tournament_id INT NOT NULL');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F33D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_C4E0A61F33D1A3E7 ON team (tournament_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318CEA3FA723');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318CF88A08CD');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C33D1A3E7');
        $this->addSql('DROP INDEX IDX_232B318CEA3FA723 ON game');
        $this->addSql('DROP INDEX IDX_232B318CF88A08CD ON game');
        $this->addSql('DROP INDEX IDX_232B318C33D1A3E7 ON game');
        $this->addSql('ALTER TABLE game DROP team_a_id, DROP team_b_id, DROP tournament_id, DROP score_a, DROP score_b, DROP game_date');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24F296CD8AE');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24F33D1A3E7');
        $this->addSql('DROP INDEX IDX_AB55E24F296CD8AE ON participation');
        $this->addSql('DROP INDEX IDX_AB55E24F33D1A3E7 ON participation');
        $this->addSql('ALTER TABLE participation DROP team_id, DROP tournament_id, DROP participation_date');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61F33D1A3E7');
        $this->addSql('DROP INDEX IDX_C4E0A61F33D1A3E7 ON team');
        $this->addSql('ALTER TABLE team DROP tournament_id');
    }
}
