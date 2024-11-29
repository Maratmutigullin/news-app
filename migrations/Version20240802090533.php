<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240802090533 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE news (id SERIAL NOT NULL, date_create DATE NOT NULL, title VARCHAR(255) NOT NULL, author VARCHAR(255) DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, url_to_image VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON TABLE news IS \'Новости\'');
        $this->addSql('COMMENT ON COLUMN news.date_create IS \'Дата создания новости\'');
        $this->addSql('COMMENT ON COLUMN news.title IS \'Заголовок новости\'');
        $this->addSql('COMMENT ON COLUMN news.author IS \'Автор новости\'');
        $this->addSql('COMMENT ON COLUMN news.url IS \'Сылка на новость\'');
        $this->addSql('COMMENT ON COLUMN news.url_to_image IS \'Сылка на изоюражение\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA topology');
        $this->addSql('CREATE SCHEMA tiger_data');
        $this->addSql('CREATE SCHEMA tiger');
        $this->addSql('DROP TABLE news');
    }
}
