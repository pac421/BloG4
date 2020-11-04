<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200929141253 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, created_on_id INT NOT NULL, updated_on_id INT DEFAULT NULL, deleted_on_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, picture VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, lst_categories JSON NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_23A0E6685642811 (created_on_id), INDEX IDX_23A0E66BC331049 (updated_on_id), INDEX IDX_23A0E66F231B4C5 (deleted_on_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, created_on_id INT NOT NULL, updated_on_id INT DEFAULT NULL, deleted_on_id INT DEFAULT NULL, label VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_64C19C185642811 (created_on_id), INDEX IDX_64C19C1BC331049 (updated_on_id), INDEX IDX_64C19C1F231B4C5 (deleted_on_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, fiche_id INT NOT NULL, created_on_id INT NOT NULL, updated_on_id INT DEFAULT NULL, deleted_on_id INT DEFAULT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_9474526CDF522508 (fiche_id), INDEX IDX_9474526C85642811 (created_on_id), INDEX IDX_9474526CBC331049 (updated_on_id), INDEX IDX_9474526CF231B4C5 (deleted_on_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, born_date DATE NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E6685642811 FOREIGN KEY (created_on_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66BC331049 FOREIGN KEY (updated_on_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66F231B4C5 FOREIGN KEY (deleted_on_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C185642811 FOREIGN KEY (created_on_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1BC331049 FOREIGN KEY (updated_on_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1F231B4C5 FOREIGN KEY (deleted_on_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CDF522508 FOREIGN KEY (fiche_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C85642811 FOREIGN KEY (created_on_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CBC331049 FOREIGN KEY (updated_on_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF231B4C5 FOREIGN KEY (deleted_on_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CDF522508');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E6685642811');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66BC331049');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66F231B4C5');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C185642811');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1BC331049');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1F231B4C5');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C85642811');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CBC331049');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CF231B4C5');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE user');
    }
}