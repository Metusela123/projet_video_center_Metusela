<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230823171950 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'ajout de is_verified dans user';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users ADD is_verified TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE videos ADD CONSTRAINT FK_29AA6432A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE videos RENAME INDEX user_id TO IDX_29AA6432A76ED395');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users DROP is_verified');
        $this->addSql('ALTER TABLE videos DROP FOREIGN KEY FK_29AA6432A76ED395');
        $this->addSql('ALTER TABLE videos RENAME INDEX idx_29aa6432a76ed395 TO user_id');
    }
}
