<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231117120117 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Adds indexes on the columns used for the search, is active already has an index';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE INDEX is_member ON test_users (is_member)');
        $this->addSql('CREATE INDEX user_type ON test_users (user_type)');
        $this->addSql('CREATE INDEX last_login_at ON test_users (last_login_at)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP INDEX is_member ON test_users');
        $this->addSql('DROP INDEX user_type ON test_users');
        $this->addSql('DROP INDEX last_login_at ON test_users');
    }
}
