<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220204090234 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE batman (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE content_invoice (id INT AUTO_INCREMENT NOT NULL, invoice_id INT NOT NULL, product_name VARCHAR(255) NOT NULL, price_product INT NOT NULL, image_product VARCHAR(255) NOT NULL, quantity INT NOT NULL, INDEX IDX_4F6DCEF72989F1FD (invoice_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE content_list_product (id INT AUTO_INCREMENT NOT NULL, list_product_id INT NOT NULL, product_id INT NOT NULL, quantity INT NOT NULL, INDEX IDX_B8DD51F9FA91286 (list_product_id), INDEX IDX_B8DD51F4584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoice (id INT AUTO_INCREMENT NOT NULL, purchase_id INT NOT NULL, total INT NOT NULL, is_payed TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_90651744558FBEB9 (purchase_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE list_product (id INT AUTO_INCREMENT NOT NULL, purchase_id INT NOT NULL, UNIQUE INDEX UNIQ_F05D9A0558FBEB9 (purchase_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE purchase (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, created_at DATETIME NOT NULL, country VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, street VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, INDEX IDX_6117D13BA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE content_invoice ADD CONSTRAINT FK_4F6DCEF72989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id)');
        $this->addSql('ALTER TABLE content_list_product ADD CONSTRAINT FK_B8DD51F9FA91286 FOREIGN KEY (list_product_id) REFERENCES list_product (id)');
        $this->addSql('ALTER TABLE content_list_product ADD CONSTRAINT FK_B8DD51F4584665A FOREIGN KEY (product_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_90651744558FBEB9 FOREIGN KEY (purchase_id) REFERENCES purchase (id)');
        $this->addSql('ALTER TABLE list_product ADD CONSTRAINT FK_F05D9A0558FBEB9 FOREIGN KEY (purchase_id) REFERENCES purchase (id)');
        $this->addSql('ALTER TABLE purchase ADD CONSTRAINT FK_6117D13BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE content_invoice DROP FOREIGN KEY FK_4F6DCEF72989F1FD');
        $this->addSql('ALTER TABLE content_list_product DROP FOREIGN KEY FK_B8DD51F9FA91286');
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_90651744558FBEB9');
        $this->addSql('ALTER TABLE list_product DROP FOREIGN KEY FK_F05D9A0558FBEB9');
        $this->addSql('DROP TABLE batman');
        $this->addSql('DROP TABLE content_invoice');
        $this->addSql('DROP TABLE content_list_product');
        $this->addSql('DROP TABLE invoice');
        $this->addSql('DROP TABLE list_product');
        $this->addSql('DROP TABLE purchase');
        $this->addSql('ALTER TABLE category CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image_path image_path VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE produit CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image_path image_path VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
