<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211208044743 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE city (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE district (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, city_id_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_31C154873CCE3900 ON district (city_id_id)');
        $this->addSql('CREATE TABLE package (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, size INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE product (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description CLOB NOT NULL, photo CLOB NOT NULL, price INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE secret (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, package_id_id INTEGER NOT NULL, product_id_id INTEGER NOT NULL, created_by_id INTEGER NOT NULL, district_id_id INTEGER NOT NULL, lan DOUBLE PRECISION NOT NULL, lat DOUBLE PRECISION NOT NULL, photo CLOB NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('CREATE INDEX IDX_5CA2E8E5EA4099B0 ON secret (package_id_id)');
        $this->addSql('CREATE INDEX IDX_5CA2E8E5DE18E50B ON secret (product_id_id)');
        $this->addSql('CREATE INDEX IDX_5CA2E8E5B03A8386 ON secret (created_by_id)');
        $this->addSql('CREATE INDEX IDX_5CA2E8E5D0023964 ON secret (district_id_id)');
        $this->addSql('CREATE TABLE "user" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, balance INTEGER NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON "user" (username)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE district');
        $this->addSql('DROP TABLE package');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE secret');
        $this->addSql('DROP TABLE "user"');
    }
}
