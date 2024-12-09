<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241208015838 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answer RENAME INDEX idx_52b675ae1e27f6bf TO IDX_DADD4A251E27F6BF');
        $this->addSql('ALTER TABLE quizz ADD title VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answer RENAME INDEX idx_dadd4a251e27f6bf TO IDX_52B675AE1E27F6BF');
        $this->addSql('ALTER TABLE quizz DROP title');
    }
}
