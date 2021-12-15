<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211214223656 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE order_id_seq CASCADE');
        $this->addSql('DROP TABLE "order"');
        $this->addSql('ALTER TABLE customer_orders ADD product_secret_id INT NOT NULL');
        $this->addSql('ALTER TABLE customer_orders ADD CONSTRAINT FK_54EA21BF9B7DA8A FOREIGN KEY (product_secret_id) REFERENCES secret (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_54EA21BF9B7DA8A ON customer_orders (product_secret_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE order_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "order" (id INT NOT NULL, client_id INT NOT NULL, product_id INT NOT NULL, secret_id INT NOT NULL, payment_type VARCHAR(255) NOT NULL, wallet_address VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_f529939867176c07 ON "order" (secret_id)');
        $this->addSql('CREATE INDEX idx_f52993984584665a ON "order" (product_id)');
        $this->addSql('CREATE INDEX idx_f529939819eb6921 ON "order" (client_id)');
        $this->addSql('COMMENT ON COLUMN "order".created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT fk_f529939819eb6921 FOREIGN KEY (client_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT fk_f52993984584665a FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT fk_f529939867176c07 FOREIGN KEY (secret_id) REFERENCES secret (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE customer_orders DROP CONSTRAINT FK_54EA21BF9B7DA8A');
        $this->addSql('DROP INDEX UNIQ_54EA21BF9B7DA8A');
        $this->addSql('ALTER TABLE customer_orders DROP product_secret_id');
    }
}
