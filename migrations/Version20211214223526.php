<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211214223526 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE customer_orders_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE customer_orders (id INT NOT NULL, client_id INT NOT NULL, product_id INT NOT NULL, payment_type VARCHAR(255) NOT NULL, wallet_address VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_54EA21BF19EB6921 ON customer_orders (client_id)');
        $this->addSql('CREATE INDEX IDX_54EA21BF4584665A ON customer_orders (product_id)');
        $this->addSql('COMMENT ON COLUMN customer_orders.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE customer_orders ADD CONSTRAINT FK_54EA21BF19EB6921 FOREIGN KEY (client_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE customer_orders ADD CONSTRAINT FK_54EA21BF4584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE customer_orders_id_seq CASCADE');
        $this->addSql('DROP TABLE customer_orders');
    }
}
