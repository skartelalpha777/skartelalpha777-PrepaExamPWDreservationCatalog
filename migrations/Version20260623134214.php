<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260623134214 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
      
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE catalogs (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(120) NOT NULL, year INT NOT NULL, validity_date DATETIME NOT NULL, UNIQUE INDEX UNIQ_F3AD370A2B36786B (title), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE catalogs');
    }
}
