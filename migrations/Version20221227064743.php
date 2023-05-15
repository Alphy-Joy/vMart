<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221227064743 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE price (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, product_id INT DEFAULT NULL, quantity_id INT DEFAULT NULL, status TINYINT(1) NOT NULL, insert_date DATETIME NOT NULL, update_date DATETIME NOT NULL, INDEX IDX_CAC822D912469DE2 (category_id), INDEX IDX_CAC822D94584665A (product_id), INDEX IDX_CAC822D97E8B4AFC (quantity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quantity (id INT AUTO_INCREMENT NOT NULL, quantity VARCHAR(100) DEFAULT NULL, status TINYINT(1) DEFAULT NULL, insert_time DATETIME DEFAULT NULL, update_time DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE price ADD CONSTRAINT FK_CAC822D912469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE price ADD CONSTRAINT FK_CAC822D94584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE price ADD CONSTRAINT FK_CAC822D97E8B4AFC FOREIGN KEY (quantity_id) REFERENCES quantity (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE price DROP FOREIGN KEY FK_CAC822D912469DE2');
        $this->addSql('ALTER TABLE price DROP FOREIGN KEY FK_CAC822D94584665A');
        $this->addSql('ALTER TABLE price DROP FOREIGN KEY FK_CAC822D97E8B4AFC');
        $this->addSql('DROP TABLE price');
        $this->addSql('DROP TABLE quantity');
    }
}
