<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211229013802 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contacts ADD missions_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contacts ADD CONSTRAINT FK_3340157317C042CF FOREIGN KEY (missions_id) REFERENCES missions (id)');
        $this->addSql('CREATE INDEX IDX_3340157317C042CF ON contacts (missions_id)');
        $this->addSql('ALTER TABLE stashs ADD missions_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE stashs ADD CONSTRAINT FK_81231F8517C042CF FOREIGN KEY (missions_id) REFERENCES missions (id)');
        $this->addSql('CREATE INDEX IDX_81231F8517C042CF ON stashs (missions_id)');
        $this->addSql('ALTER TABLE targets ADD missions_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE targets ADD CONSTRAINT FK_AF431E1317C042CF FOREIGN KEY (missions_id) REFERENCES missions (id)');
        $this->addSql('CREATE INDEX IDX_AF431E1317C042CF ON targets (missions_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contacts DROP FOREIGN KEY FK_3340157317C042CF');
        $this->addSql('DROP INDEX IDX_3340157317C042CF ON contacts');
        $this->addSql('ALTER TABLE contacts DROP missions_id');
        $this->addSql('ALTER TABLE stashs DROP FOREIGN KEY FK_81231F8517C042CF');
        $this->addSql('DROP INDEX IDX_81231F8517C042CF ON stashs');
        $this->addSql('ALTER TABLE stashs DROP missions_id');
        $this->addSql('ALTER TABLE targets DROP FOREIGN KEY FK_AF431E1317C042CF');
        $this->addSql('DROP INDEX IDX_AF431E1317C042CF ON targets');
        $this->addSql('ALTER TABLE targets DROP missions_id');
    }
}
