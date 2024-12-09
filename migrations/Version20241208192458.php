<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241208192458 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quizz RENAME INDEX idx_7c77973d12469de2 TO IDX_7C77973DF7BFE87C');
        $this->addSql('ALTER TABLE sub_category ADD image VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sub_category DROP image');
        $this->addSql('ALTER TABLE quizz RENAME INDEX idx_7c77973df7bfe87c TO IDX_7C77973D12469DE2');
    }
}
