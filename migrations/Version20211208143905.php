<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211208143905 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE city_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE district_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE package_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE product_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE secret_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE city (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE district (id INT NOT NULL, city_id_id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_31C154873CCE3900 ON district (city_id_id)');
        $this->addSql('CREATE TABLE package (id INT NOT NULL, size INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE product (id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, photo TEXT NOT NULL, price INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE secret (id INT NOT NULL, package_id_id INT NOT NULL, product_id_id INT NOT NULL, created_by_id INT NOT NULL, district_id_id INT NOT NULL, lan DOUBLE PRECISION NOT NULL, lat DOUBLE PRECISION NOT NULL, photo TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5CA2E8E5EA4099B0 ON secret (package_id_id)');
        $this->addSql('CREATE INDEX IDX_5CA2E8E5DE18E50B ON secret (product_id_id)');
        $this->addSql('CREATE INDEX IDX_5CA2E8E5B03A8386 ON secret (created_by_id)');
        $this->addSql('CREATE INDEX IDX_5CA2E8E5D0023964 ON secret (district_id_id)');
        $this->addSql('COMMENT ON COLUMN secret.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, balance INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON "user" (username)');
        $this->addSql('ALTER TABLE district ADD CONSTRAINT FK_31C154873CCE3900 FOREIGN KEY (city_id_id) REFERENCES city (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE secret ADD CONSTRAINT FK_5CA2E8E5EA4099B0 FOREIGN KEY (package_id_id) REFERENCES package (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE secret ADD CONSTRAINT FK_5CA2E8E5DE18E50B FOREIGN KEY (product_id_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE secret ADD CONSTRAINT FK_5CA2E8E5B03A8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE secret ADD CONSTRAINT FK_5CA2E8E5D0023964 FOREIGN KEY (district_id_id) REFERENCES district (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE district DROP CONSTRAINT FK_31C154873CCE3900');
        $this->addSql('ALTER TABLE secret DROP CONSTRAINT FK_5CA2E8E5D0023964');
        $this->addSql('ALTER TABLE secret DROP CONSTRAINT FK_5CA2E8E5EA4099B0');
        $this->addSql('ALTER TABLE secret DROP CONSTRAINT FK_5CA2E8E5DE18E50B');
        $this->addSql('ALTER TABLE secret DROP CONSTRAINT FK_5CA2E8E5B03A8386');
        $this->addSql('DROP SEQUENCE city_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE district_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE package_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE product_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE secret_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE district');
        $this->addSql('DROP TABLE package');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE secret');
        $this->addSql('DROP TABLE "user"');
    }
}
