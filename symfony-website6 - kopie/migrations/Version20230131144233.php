<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230131144233 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lessen ADD instructor_id INT NOT NULL');
        $this->addSql('ALTER TABLE lessen ADD CONSTRAINT FK_29B9C798C4FC193 FOREIGN KEY (instructor_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_29B9C798C4FC193 ON lessen (instructor_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lessen DROP FOREIGN KEY FK_29B9C798C4FC193');
        $this->addSql('DROP INDEX IDX_29B9C798C4FC193 ON lessen');
        $this->addSql('ALTER TABLE lessen DROP instructor_id');
    }
}
