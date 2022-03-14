<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220314122845 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avatar (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, petshop_id INT DEFAULT NULL, horse_schleich_id INT DEFAULT NULL, avatar_name VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_1677722FA76ED395 (user_id), UNIQUE INDEX UNIQ_1677722FFB57ADCC (petshop_id), UNIQUE INDEX UNIQ_1677722FFCCCBC49 (horse_schleich_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, nickname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, created_at DATETIME NOT NULL, is_sent TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE horse_coat (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE horse_schleich (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, coat_id INT NOT NULL, species_id INT NOT NULL, user_id INT NOT NULL, object_family_id INT NOT NULL, created_at DATETIME NOT NULL, picture VARCHAR(255) DEFAULT NULL, name VARCHAR(255) NOT NULL, biography LONGTEXT DEFAULT NULL, INDEX IDX_148B7C59C54C8C93 (type_id), INDEX IDX_148B7C5979F419D (coat_id), INDEX IDX_148B7C59B2A1D860 (species_id), INDEX IDX_148B7C59A76ED395 (user_id), INDEX IDX_148B7C5980E169ED (object_family_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE horse_species (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE horse_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE object_family (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE petshop (id INT AUTO_INCREMENT NOT NULL, size_id INT NOT NULL, species_id INT NOT NULL, user_id INT NOT NULL, object_family_id INT NOT NULL, created_at DATETIME NOT NULL, picture VARCHAR(255) DEFAULT NULL, name VARCHAR(255) NOT NULL, biography LONGTEXT DEFAULT NULL, INDEX IDX_A841440D498DA827 (size_id), INDEX IDX_A841440DB2A1D860 (species_id), INDEX IDX_A841440DA76ED395 (user_id), INDEX IDX_A841440D80E169ED (object_family_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE petshop_size (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE petshop_species (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, nickname VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, about LONGTEXT DEFAULT NULL, registered_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649A188FE64 (nickname), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE avatar ADD CONSTRAINT FK_1677722FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE avatar ADD CONSTRAINT FK_1677722FFB57ADCC FOREIGN KEY (petshop_id) REFERENCES petshop (id)');
        $this->addSql('ALTER TABLE avatar ADD CONSTRAINT FK_1677722FFCCCBC49 FOREIGN KEY (horse_schleich_id) REFERENCES horse_schleich (id)');
        $this->addSql('ALTER TABLE horse_schleich ADD CONSTRAINT FK_148B7C59C54C8C93 FOREIGN KEY (type_id) REFERENCES horse_type (id)');
        $this->addSql('ALTER TABLE horse_schleich ADD CONSTRAINT FK_148B7C5979F419D FOREIGN KEY (coat_id) REFERENCES horse_coat (id)');
        $this->addSql('ALTER TABLE horse_schleich ADD CONSTRAINT FK_148B7C59B2A1D860 FOREIGN KEY (species_id) REFERENCES horse_species (id)');
        $this->addSql('ALTER TABLE horse_schleich ADD CONSTRAINT FK_148B7C59A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE horse_schleich ADD CONSTRAINT FK_148B7C5980E169ED FOREIGN KEY (object_family_id) REFERENCES object_family (id)');
        $this->addSql('ALTER TABLE petshop ADD CONSTRAINT FK_A841440D498DA827 FOREIGN KEY (size_id) REFERENCES petshop_size (id)');
        $this->addSql('ALTER TABLE petshop ADD CONSTRAINT FK_A841440DB2A1D860 FOREIGN KEY (species_id) REFERENCES petshop_species (id)');
        $this->addSql('ALTER TABLE petshop ADD CONSTRAINT FK_A841440DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE petshop ADD CONSTRAINT FK_A841440D80E169ED FOREIGN KEY (object_family_id) REFERENCES object_family (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE horse_schleich DROP FOREIGN KEY FK_148B7C5979F419D');
        $this->addSql('ALTER TABLE avatar DROP FOREIGN KEY FK_1677722FFCCCBC49');
        $this->addSql('ALTER TABLE horse_schleich DROP FOREIGN KEY FK_148B7C59B2A1D860');
        $this->addSql('ALTER TABLE horse_schleich DROP FOREIGN KEY FK_148B7C59C54C8C93');
        $this->addSql('ALTER TABLE horse_schleich DROP FOREIGN KEY FK_148B7C5980E169ED');
        $this->addSql('ALTER TABLE petshop DROP FOREIGN KEY FK_A841440D80E169ED');
        $this->addSql('ALTER TABLE avatar DROP FOREIGN KEY FK_1677722FFB57ADCC');
        $this->addSql('ALTER TABLE petshop DROP FOREIGN KEY FK_A841440D498DA827');
        $this->addSql('ALTER TABLE petshop DROP FOREIGN KEY FK_A841440DB2A1D860');
        $this->addSql('ALTER TABLE avatar DROP FOREIGN KEY FK_1677722FA76ED395');
        $this->addSql('ALTER TABLE horse_schleich DROP FOREIGN KEY FK_148B7C59A76ED395');
        $this->addSql('ALTER TABLE petshop DROP FOREIGN KEY FK_A841440DA76ED395');
        $this->addSql('DROP TABLE avatar');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE horse_coat');
        $this->addSql('DROP TABLE horse_schleich');
        $this->addSql('DROP TABLE horse_species');
        $this->addSql('DROP TABLE horse_type');
        $this->addSql('DROP TABLE object_family');
        $this->addSql('DROP TABLE petshop');
        $this->addSql('DROP TABLE petshop_size');
        $this->addSql('DROP TABLE petshop_species');
        $this->addSql('DROP TABLE user');
    }
}
