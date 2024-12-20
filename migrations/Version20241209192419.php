<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241209192419 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_answer ADD quizz_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_answer ADD CONSTRAINT FK_BF8F5118BA934BCD FOREIGN KEY (quizz_id) REFERENCES quizz (id)');
        $this->addSql('CREATE INDEX IDX_BF8F5118BA934BCD ON user_answer (quizz_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_answer DROP FOREIGN KEY FK_BF8F5118BA934BCD');
        $this->addSql('DROP INDEX IDX_BF8F5118BA934BCD ON user_answer');
        $this->addSql('ALTER TABLE user_answer DROP quizz_id');
    }
}
