<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230131143633 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lessen ADD training_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE lessen ADD CONSTRAINT FK_29B9C79909E143A FOREIGN KEY (training_id_id) REFERENCES training (id)');
        $this->addSql('CREATE INDEX IDX_29B9C79909E143A ON lessen (training_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lessen DROP FOREIGN KEY FK_29B9C79909E143A');
        $this->addSql('DROP INDEX IDX_29B9C79909E143A ON lessen');
        $this->addSql('ALTER TABLE lessen DROP training_id_id');
    }
}
