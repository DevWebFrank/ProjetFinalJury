<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220512083947 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE content_list_product DROP FOREIGN KEY FK_B8DD51F9FA91286');
        $this->addSql('DROP TABLE list_product');
        $this->addSql('DROP INDEX IDX_B8DD51F9FA91286 ON content_list_product');
        $this->addSql('ALTER TABLE content_list_product DROP list_product_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE list_product (id INT AUTO_INCREMENT NOT NULL, purchase_id INT NOT NULL, UNIQUE INDEX UNIQ_F05D9A0558FBEB9 (purchase_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE list_product ADD CONSTRAINT FK_F05D9A0558FBEB9 FOREIGN KEY (purchase_id) REFERENCES purchase (id)');
        $this->addSql('ALTER TABLE category CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image_path image_path VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE content_invoice CHANGE product_name product_name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image_product image_product VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE content_list_product ADD list_product_id INT NOT NULL');
        $this->addSql('ALTER TABLE content_list_product ADD CONSTRAINT FK_B8DD51F9FA91286 FOREIGN KEY (list_product_id) REFERENCES list_product (id)');
        $this->addSql('CREATE INDEX IDX_B8DD51F9FA91286 ON content_list_product (list_product_id)');
        $this->addSql('ALTER TABLE `legalNotices` CHANGE title title VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE content content LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE produit CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image_path image_path VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE purchase CHANGE country country VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE city city VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE street street VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE postal_code postal_code VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE telephone telephone VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE reset_password_request CHANGE selector selector VARCHAR(20) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE hashed_token hashed_token VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image_path image_path VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE telephone telephone VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE first_name first_name VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adresse adresse VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
