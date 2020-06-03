<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200527113335 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE candidature (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, relance TINYINT(1) NOT NULL, poste VARCHAR(255) NOT NULL, contact_name VARCHAR(255) DEFAULT NULL, entreprise VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE candidature_contact (candidature_id INT NOT NULL, contact_id INT NOT NULL, INDEX IDX_A6DB99EEB6121583 (candidature_id), INDEX IDX_A6DB99EEE7A1254A (contact_id), PRIMARY KEY(candidature_id, contact_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE candidature_contact ADD CONSTRAINT FK_A6DB99EEB6121583 FOREIGN KEY (candidature_id) REFERENCES candidature (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE candidature_contact ADD CONSTRAINT FK_A6DB99EEE7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE candidature_contact DROP FOREIGN KEY FK_A6DB99EEE7A1254A');
        $this->addSql('ALTER TABLE candidature_contact DROP FOREIGN KEY FK_A6DB99EEB6121583');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE candidature');
        $this->addSql('DROP TABLE candidature_contact');
    }
}
