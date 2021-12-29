<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211229205542 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE missions ADD specialitys_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE missions ADD CONSTRAINT FK_34F1D47EFFFDA05A FOREIGN KEY (specialitys_id) REFERENCES specialitys (id)');
        $this->addSql('CREATE INDEX IDX_34F1D47EFFFDA05A ON missions (specialitys_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE missions DROP FOREIGN KEY FK_34F1D47EFFFDA05A');
        $this->addSql('DROP INDEX IDX_34F1D47EFFFDA05A ON missions');
        $this->addSql('ALTER TABLE missions DROP specialitys_id');
    }
}
