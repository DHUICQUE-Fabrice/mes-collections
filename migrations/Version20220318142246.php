<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220318142246 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE horse_schleich CHANGE image_file_id image_file_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE petshop CHANGE image_file_id image_file_id INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE horse_schleich CHANGE image_file_id image_file_id INT NOT NULL');
        $this->addSql('ALTER TABLE petshop CHANGE image_file_id image_file_id INT NOT NULL');
    }
}
