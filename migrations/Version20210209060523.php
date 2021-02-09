<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210209060523 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD username VARCHAR(32) NOT NULL, ADD first_name VARCHAR(32) NOT NULL, ADD last_name VARCHAR(32) NOT NULL, ADD phone_number VARCHAR(255) DEFAULT NULL, ADD is_locked TINYINT(1) NOT NULL, ADD confirmation_token VARCHAR(255) NOT NULL, ADD requested_at DATETIME NOT NULL, ADD is_lawyer TINYINT(1) NOT NULL, ADD law_licence_no VARCHAR(255) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649A9D1C132 ON user (first_name)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_8D93D649A9D1C132 ON `user`');
        $this->addSql('ALTER TABLE `user` DROP username, DROP first_name, DROP last_name, DROP phone_number, DROP is_locked, DROP confirmation_token, DROP requested_at, DROP is_lawyer, DROP law_licence_no');
    }
}
