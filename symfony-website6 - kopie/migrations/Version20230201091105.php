<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230201091105 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lessen (id INT AUTO_INCREMENT NOT NULL, training_id INT NOT NULL, instructor_id INT NOT NULL, date DATE NOT NULL, time TIME NOT NULL, location VARCHAR(255) NOT NULL, max_persons INT NOT NULL, INDEX IDX_29B9C79BEFD98D1 (training_id), INDEX IDX_29B9C798C4FC193 (instructor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lessen ADD CONSTRAINT FK_29B9C79BEFD98D1 FOREIGN KEY (training_id) REFERENCES training (id)');
        $this->addSql('ALTER TABLE lessen ADD CONSTRAINT FK_29B9C798C4FC193 FOREIGN KEY (instructor_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE registration DROP FOREIGN KEY FK_62A8A7A7CDF80196');
        $this->addSql('DROP INDEX IDX_62A8A7A7CDF80196 ON registration');
        $this->addSql('ALTER TABLE registration DROP lesson_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lessen DROP FOREIGN KEY FK_29B9C79BEFD98D1');
        $this->addSql('ALTER TABLE lessen DROP FOREIGN KEY FK_29B9C798C4FC193');
        $this->addSql('DROP TABLE lessen');
        $this->addSql('ALTER TABLE registration ADD lesson_id INT NOT NULL');
        $this->addSql('ALTER TABLE registration ADD CONSTRAINT FK_62A8A7A7CDF80196 FOREIGN KEY (lesson_id) REFERENCES lessen (id)');
        $this->addSql('CREATE INDEX IDX_62A8A7A7CDF80196 ON registration (lesson_id)');
    }
}
