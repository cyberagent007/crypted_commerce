<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211214023202 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE secret ADD city_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE secret ADD detailed_photo TEXT NOT NULL');
        $this->addSql('ALTER TABLE secret ADD description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE secret ADD CONSTRAINT FK_5CA2E8E53CCE3900 FOREIGN KEY (city_id_id) REFERENCES city (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_5CA2E8E53CCE3900 ON secret (city_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE secret DROP CONSTRAINT FK_5CA2E8E53CCE3900');
        $this->addSql('DROP INDEX IDX_5CA2E8E53CCE3900');
        $this->addSql('ALTER TABLE secret DROP city_id_id');
        $this->addSql('ALTER TABLE secret DROP detailed_photo');
        $this->addSql('ALTER TABLE secret DROP description');
    }
}
