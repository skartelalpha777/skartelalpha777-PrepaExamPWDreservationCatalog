<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260623124103 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artis_type (id INT AUTO_INCREMENT NOT NULL, artist_id INT DEFAULT NULL, type_id INT DEFAULT NULL, INDEX IDX_AFA1D577B7970CF8 (artist_id), INDEX IDX_AFA1D577C54C8C93 (type_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE artis_type_show (id INT AUTO_INCREMENT NOT NULL, artist_type_id INT DEFAULT NULL, the_show_id INT DEFAULT NULL, INDEX IDX_C4764B1F7203D2A4 (artist_type_id), INDEX IDX_C4764B1F3013D282 (the_show_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE artist (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE locality (id INT AUTO_INCREMENT NOT NULL, postalcode VARCHAR(60) NOT NULL, locality VARCHAR(60) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, slug VARCHAR(60) DEFAULT NULL, designation VARCHAR(60) NOT NULL, address VARCHAR(255) NOT NULL, website VARCHAR(255) DEFAULT NULL, phone VARCHAR(30) DEFAULT NULL, locality_id INT DEFAULT NULL, INDEX IDX_5E9E89CB88823A92 (locality_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE price (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, price NUMERIC(10, 2) NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE price_show (price_id INT NOT NULL, show_id INT NOT NULL, INDEX IDX_4F5C2BBBD614C7E7 (price_id), INDEX IDX_4F5C2BBBD0C1FC64 (show_id), PRIMARY KEY (price_id, show_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE representation (id INT AUTO_INCREMENT NOT NULL, schedule DATETIME NOT NULL, representation_show_id INT DEFAULT NULL, location_id INT DEFAULT NULL, INDEX IDX_29D5499EC1324B99 (representation_show_id), INDEX IDX_29D5499E64D218E (location_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE representation_reservation (id INT AUTO_INCREMENT NOT NULL, quantity INT NOT NULL, representation_id INT DEFAULT NULL, price_id INT DEFAULT NULL, reservation_id INT DEFAULT NULL, INDEX IDX_A3F4FD3646CE82F4 (representation_id), INDEX IDX_A3F4FD36D614C7E7 (price_id), INDEX IDX_A3F4FD36B83297E7 (reservation_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, booking_date DATETIME NOT NULL, status VARCHAR(255) NOT NULL, user_id INT DEFAULT NULL, INDEX IDX_42C84955A76ED395 (user_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, review LONGTEXT DEFAULT NULL, stars INT NOT NULL, validated INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, show_review_id INT DEFAULT NULL, user_id INT NOT NULL, INDEX IDX_794381C6EA20D93 (show_review_id), INDEX IDX_794381C6A76ED395 (user_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE `show` (id INT AUTO_INCREMENT NOT NULL, slug VARCHAR(255) DEFAULT NULL, title VARCHAR(255) NOT NULL, poster_url VARCHAR(255) DEFAULT NULL, duration INT NOT NULL, created_in DATETIME NOT NULL, bookable TINYINT NOT NULL, description VARCHAR(255) DEFAULT NULL, location_id INT DEFAULT NULL, INDEX IDX_320ED90164D218E (location_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(60) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, role VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE artis_type ADD CONSTRAINT FK_AFA1D577B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id)');
        $this->addSql('ALTER TABLE artis_type ADD CONSTRAINT FK_AFA1D577C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE artis_type_show ADD CONSTRAINT FK_C4764B1F7203D2A4 FOREIGN KEY (artist_type_id) REFERENCES artis_type (id)');
        $this->addSql('ALTER TABLE artis_type_show ADD CONSTRAINT FK_C4764B1F3013D282 FOREIGN KEY (the_show_id) REFERENCES `show` (id)');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB88823A92 FOREIGN KEY (locality_id) REFERENCES locality (id)');
        $this->addSql('ALTER TABLE price_show ADD CONSTRAINT FK_4F5C2BBBD614C7E7 FOREIGN KEY (price_id) REFERENCES price (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE price_show ADD CONSTRAINT FK_4F5C2BBBD0C1FC64 FOREIGN KEY (show_id) REFERENCES `show` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE representation ADD CONSTRAINT FK_29D5499EC1324B99 FOREIGN KEY (representation_show_id) REFERENCES `show` (id)');
        $this->addSql('ALTER TABLE representation ADD CONSTRAINT FK_29D5499E64D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE representation_reservation ADD CONSTRAINT FK_A3F4FD3646CE82F4 FOREIGN KEY (representation_id) REFERENCES representation (id)');
        $this->addSql('ALTER TABLE representation_reservation ADD CONSTRAINT FK_A3F4FD36D614C7E7 FOREIGN KEY (price_id) REFERENCES price (id)');
        $this->addSql('ALTER TABLE representation_reservation ADD CONSTRAINT FK_A3F4FD36B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6EA20D93 FOREIGN KEY (show_review_id) REFERENCES `show` (id)');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `show` ADD CONSTRAINT FK_320ED90164D218E FOREIGN KEY (location_id) REFERENCES location (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artis_type DROP FOREIGN KEY FK_AFA1D577B7970CF8');
        $this->addSql('ALTER TABLE artis_type DROP FOREIGN KEY FK_AFA1D577C54C8C93');
        $this->addSql('ALTER TABLE artis_type_show DROP FOREIGN KEY FK_C4764B1F7203D2A4');
        $this->addSql('ALTER TABLE artis_type_show DROP FOREIGN KEY FK_C4764B1F3013D282');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CB88823A92');
        $this->addSql('ALTER TABLE price_show DROP FOREIGN KEY FK_4F5C2BBBD614C7E7');
        $this->addSql('ALTER TABLE price_show DROP FOREIGN KEY FK_4F5C2BBBD0C1FC64');
        $this->addSql('ALTER TABLE representation DROP FOREIGN KEY FK_29D5499EC1324B99');
        $this->addSql('ALTER TABLE representation DROP FOREIGN KEY FK_29D5499E64D218E');
        $this->addSql('ALTER TABLE representation_reservation DROP FOREIGN KEY FK_A3F4FD3646CE82F4');
        $this->addSql('ALTER TABLE representation_reservation DROP FOREIGN KEY FK_A3F4FD36D614C7E7');
        $this->addSql('ALTER TABLE representation_reservation DROP FOREIGN KEY FK_A3F4FD36B83297E7');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955A76ED395');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C6EA20D93');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C6A76ED395');
        $this->addSql('ALTER TABLE `show` DROP FOREIGN KEY FK_320ED90164D218E');
        $this->addSql('DROP TABLE artis_type');
        $this->addSql('DROP TABLE artis_type_show');
        $this->addSql('DROP TABLE artist');
        $this->addSql('DROP TABLE locality');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE price');
        $this->addSql('DROP TABLE price_show');
        $this->addSql('DROP TABLE representation');
        $this->addSql('DROP TABLE representation_reservation');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE `show`');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE user');
    }
}
