<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260623134851 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE catalog_show (catalog_id INT NOT NULL, show_id INT NOT NULL, INDEX IDX_47BB6977CC3C66FC (catalog_id), INDEX IDX_47BB6977D0C1FC64 (show_id), PRIMARY KEY (catalog_id, show_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE catalog_show ADD CONSTRAINT FK_47BB6977CC3C66FC FOREIGN KEY (catalog_id) REFERENCES catalogs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE catalog_show ADD CONSTRAINT FK_47BB6977D0C1FC64 FOREIGN KEY (show_id) REFERENCES `show` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE catalog_show DROP FOREIGN KEY FK_47BB6977CC3C66FC');
        $this->addSql('ALTER TABLE catalog_show DROP FOREIGN KEY FK_47BB6977D0C1FC64');
        $this->addSql('DROP TABLE catalog_show');
    }
}
