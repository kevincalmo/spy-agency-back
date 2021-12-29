<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211229205330 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE missions_specialitys');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE missions_specialitys (missions_id INT NOT NULL, specialitys_id INT NOT NULL, INDEX IDX_B1EEBBD817C042CF (missions_id), INDEX IDX_B1EEBBD8FFFDA05A (specialitys_id), PRIMARY KEY(missions_id, specialitys_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE missions_specialitys ADD CONSTRAINT FK_B1EEBBD817C042CF FOREIGN KEY (missions_id) REFERENCES missions (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE missions_specialitys ADD CONSTRAINT FK_B1EEBBD8FFFDA05A FOREIGN KEY (specialitys_id) REFERENCES specialitys (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
