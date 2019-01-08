<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190108104053 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE langues_traduct');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE langues_traduct (langues_id INT NOT NULL, traduct_id INT NOT NULL, INDEX IDX_91DFBC8828EAE92 (langues_id), INDEX IDX_91DFBC8859E5D412 (traduct_id), PRIMARY KEY(langues_id, traduct_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE langues_traduct ADD CONSTRAINT FK_91DFBC8828EAE92 FOREIGN KEY (langues_id) REFERENCES langues (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE langues_traduct ADD CONSTRAINT FK_91DFBC8859E5D412 FOREIGN KEY (traduct_id) REFERENCES traduct (id) ON DELETE CASCADE');
    }
}
