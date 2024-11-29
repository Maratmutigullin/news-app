<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240821142634 extends AbstractMigration
{
    const initData = [
        "business" => "Бизнесс",
        "entertainment" => "Развлечения",
        "general" => "Общие",
        "health" => "Здоровье",
        "science" => "Наука",
        "sports" => "Спорт",
        "technology" => "Технологии",
    ];

    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE news_category (id SERIAL NOT NULL, title VARCHAR(255) DEFAULT NULL, code VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON TABLE news_category IS \'Категории новостей\'');
        $this->addSql('COMMENT ON COLUMN news_category.title IS \'Название категории\'');
        $this->addSql('COMMENT ON COLUMN news_category.code IS \'Код категории\'');
        $this->addSql('ALTER TABLE news ADD news_category_id INT DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN news.url_to_image IS \'Ссылка на изображение\'');
        $this->addSql('ALTER TABLE news ADD CONSTRAINT FK_1DD399503B732BAD FOREIGN KEY (news_category_id) REFERENCES news_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_1DD399503B732BAD ON news (news_category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE news DROP CONSTRAINT FK_1DD399503B732BAD');
        $this->addSql('DROP TABLE news_category');
        $this->addSql('DROP INDEX IDX_1DD399503B732BAD');
        $this->addSql('ALTER TABLE news DROP news_category_id');
        $this->addSql('COMMENT ON COLUMN news.url_to_image IS \'Сылка на изоюражение\'');
    }

    public function postUp(Schema $schema): void
    {
        foreach (self::initData as $code => $title) {
            $this->connection->insert('news_category', ['title' => $title, 'code' => $code]);
        }
    }
}
