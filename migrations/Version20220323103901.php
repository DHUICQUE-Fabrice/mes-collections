<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220323103901 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE horse_schleich DROP FOREIGN KEY FK_148B7C596DB2EB0');
        $this->addSql('DROP INDEX UNIQ_148B7C596DB2EB0 ON horse_schleich');
        $this->addSql('ALTER TABLE horse_schleich ADD image_name VARCHAR(255) NOT NULL, ADD updated_at DATETIME NOT NULL, DROP image_file_id');
        $this->addSql('ALTER TABLE petshop DROP FOREIGN KEY FK_A841440D6DB2EB0');
        $this->addSql('DROP INDEX UNIQ_A841440D6DB2EB0 ON petshop');
        $this->addSql('ALTER TABLE petshop ADD image_name VARCHAR(255) NOT NULL, ADD updated_at DATETIME NOT NULL, DROP image_file_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6496DB2EB0');
        $this->addSql('DROP INDEX UNIQ_8D93D6496DB2EB0 ON user');
        $this->addSql('ALTER TABLE user ADD image_name VARCHAR(255) NOT NULL, ADD updated_at DATETIME NOT NULL, DROP image_file_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE horse_schleich ADD image_file_id INT DEFAULT NULL, DROP image_name, DROP updated_at');
        $this->addSql('ALTER TABLE horse_schleich ADD CONSTRAINT FK_148B7C596DB2EB0 FOREIGN KEY (image_file_id) REFERENCES image_file (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_148B7C596DB2EB0 ON horse_schleich (image_file_id)');
        $this->addSql('ALTER TABLE petshop ADD image_file_id INT DEFAULT NULL, DROP image_name, DROP updated_at');
        $this->addSql('ALTER TABLE petshop ADD CONSTRAINT FK_A841440D6DB2EB0 FOREIGN KEY (image_file_id) REFERENCES image_file (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A841440D6DB2EB0 ON petshop (image_file_id)');
        $this->addSql('ALTER TABLE user ADD image_file_id INT DEFAULT NULL, DROP image_name, DROP updated_at');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6496DB2EB0 FOREIGN KEY (image_file_id) REFERENCES image_file (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6496DB2EB0 ON user (image_file_id)');
    }
}
