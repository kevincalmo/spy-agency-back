<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211229024302 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE missions_contacts (missions_id INT NOT NULL, contacts_id INT NOT NULL, INDEX IDX_FA54446417C042CF (missions_id), INDEX IDX_FA544464719FB48E (contacts_id), PRIMARY KEY(missions_id, contacts_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE missions_targets (missions_id INT NOT NULL, targets_id INT NOT NULL, INDEX IDX_B7328F6017C042CF (missions_id), INDEX IDX_B7328F6043B5F743 (targets_id), PRIMARY KEY(missions_id, targets_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE missions_stashs (missions_id INT NOT NULL, stashs_id INT NOT NULL, INDEX IDX_47F51B5217C042CF (missions_id), INDEX IDX_47F51B52EE826336 (stashs_id), PRIMARY KEY(missions_id, stashs_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE missions_contacts ADD CONSTRAINT FK_FA54446417C042CF FOREIGN KEY (missions_id) REFERENCES missions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE missions_contacts ADD CONSTRAINT FK_FA544464719FB48E FOREIGN KEY (contacts_id) REFERENCES contacts (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE missions_targets ADD CONSTRAINT FK_B7328F6017C042CF FOREIGN KEY (missions_id) REFERENCES missions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE missions_targets ADD CONSTRAINT FK_B7328F6043B5F743 FOREIGN KEY (targets_id) REFERENCES targets (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE missions_stashs ADD CONSTRAINT FK_47F51B5217C042CF FOREIGN KEY (missions_id) REFERENCES missions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE missions_stashs ADD CONSTRAINT FK_47F51B52EE826336 FOREIGN KEY (stashs_id) REFERENCES stashs (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE missions_contacts');
        $this->addSql('DROP TABLE missions_targets');
        $this->addSql('DROP TABLE missions_stashs');
    }
}
