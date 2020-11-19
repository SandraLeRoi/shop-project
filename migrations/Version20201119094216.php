<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201119094216 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE line_order ADD num_order_id INT NOT NULL');
        $this->addSql('ALTER TABLE line_order ADD CONSTRAINT FK_AADB41B548C34FE FOREIGN KEY (num_order_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_AADB41B548C34FE ON line_order (num_order_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE line_order DROP FOREIGN KEY FK_AADB41B548C34FE');
        $this->addSql('DROP INDEX IDX_AADB41B548C34FE ON line_order');
        $this->addSql('ALTER TABLE line_order DROP num_order_id');
    }
}
