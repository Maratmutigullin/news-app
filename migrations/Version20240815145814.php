<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240815145814 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE news ALTER title TYPE VARCHAR(1000)');
        $this->addSql('ALTER TABLE news ALTER author TYPE VARCHAR(1000)');
        $this->addSql('ALTER TABLE news ALTER url TYPE VARCHAR(1000)');
        $this->addSql('ALTER TABLE news ALTER url_to_image TYPE VARCHAR(1000)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA topology');
        $this->addSql('CREATE SCHEMA tiger_data');
        $this->addSql('CREATE SCHEMA tiger');
        $this->addSql('ALTER TABLE news ALTER title TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE news ALTER author TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE news ALTER url TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE news ALTER url_to_image TYPE VARCHAR(255)');
    }
}
