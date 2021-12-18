<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211218050721 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE user_stats_lines_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE bitcoin_wallet_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE easy_pay_wallet_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE bitcoin_wallet (id INT NOT NULL, customer_order_id INT DEFAULT NULL, address VARCHAR(255) NOT NULL, payment_status VARCHAR(255) NOT NULL, blocked_until TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D66ED82EA15A2E17 ON bitcoin_wallet (customer_order_id)');
        $this->addSql('COMMENT ON COLUMN bitcoin_wallet.blocked_until IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE easy_pay_wallet (id INT NOT NULL, customer_order_id INT DEFAULT NULL, address VARCHAR(255) NOT NULL, payment_status VARCHAR(255) NOT NULL, blocked_until TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F45A243BA15A2E17 ON easy_pay_wallet (customer_order_id)');
        $this->addSql('COMMENT ON COLUMN easy_pay_wallet.blocked_until IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE bitcoin_wallet ADD CONSTRAINT FK_D66ED82EA15A2E17 FOREIGN KEY (customer_order_id) REFERENCES customer_orders (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE easy_pay_wallet ADD CONSTRAINT FK_F45A243BA15A2E17 FOREIGN KEY (customer_order_id) REFERENCES customer_orders (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE user_stats_lines');
        $this->addSql('ALTER TABLE customer_orders ADD order_amount INT NOT NULL');
        $this->addSql('ALTER TABLE customer_orders ALTER client_id DROP NOT NULL');
        $this->addSql('ALTER TABLE customer_orders ALTER payment_type DROP NOT NULL');
        $this->addSql('ALTER TABLE customer_orders ALTER wallet_address DROP NOT NULL');
        $this->addSql('ALTER TABLE "user" DROP last_connexion');
        $this->addSql('ALTER TABLE "user" DROP last_visited');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE bitcoin_wallet_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE easy_pay_wallet_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE user_stats_lines_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE user_stats_lines (id INT NOT NULL, user_id INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, url TEXT NOT NULL, route TEXT NOT NULL, session_id VARCHAR(255) DEFAULT NULL, browser VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_908768fba76ed395 ON user_stats_lines (user_id)');
        $this->addSql('ALTER TABLE user_stats_lines ADD CONSTRAINT fk_908768fba76ed395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE bitcoin_wallet');
        $this->addSql('DROP TABLE easy_pay_wallet');
        $this->addSql('ALTER TABLE "user" ADD last_connexion TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD last_visited TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE customer_orders DROP order_amount');
        $this->addSql('ALTER TABLE customer_orders ALTER client_id SET NOT NULL');
        $this->addSql('ALTER TABLE customer_orders ALTER payment_type SET NOT NULL');
        $this->addSql('ALTER TABLE customer_orders ALTER wallet_address SET NOT NULL');
    }
}
