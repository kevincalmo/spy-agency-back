<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211229004300 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE agents_specialitys (agents_id INT NOT NULL, specialitys_id INT NOT NULL, INDEX IDX_10C879B7709770DC (agents_id), INDEX IDX_10C879B7FFFDA05A (specialitys_id), PRIMARY KEY(agents_id, specialitys_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE agents_specialitys ADD CONSTRAINT FK_10C879B7709770DC FOREIGN KEY (agents_id) REFERENCES agents (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE agents_specialitys ADD CONSTRAINT FK_10C879B7FFFDA05A FOREIGN KEY (specialitys_id) REFERENCES specialitys (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE agents_specialitys');
    }
}
