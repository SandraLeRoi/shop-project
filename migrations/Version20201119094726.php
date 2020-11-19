<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201119094726 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE line_order ADD product_id INT NOT NULL');
        $this->addSql('ALTER TABLE line_order ADD CONSTRAINT FK_AADB41B4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_AADB41B4584665A ON line_order (product_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE line_order DROP FOREIGN KEY FK_AADB41B4584665A');
        $this->addSql('DROP INDEX IDX_AADB41B4584665A ON line_order');
        $this->addSql('ALTER TABLE line_order DROP product_id');
    }
}
