<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190107103930 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE traduct (id INT AUTO_INCREMENT NOT NULL, source_id INT DEFAULT NULL, traductfield LONGTEXT DEFAULT NULL, INDEX IDX_98359EDF953C1C61 (source_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE langues_traduct (langues_id INT NOT NULL, traduct_id INT NOT NULL, INDEX IDX_91DFBC8828EAE92 (langues_id), INDEX IDX_91DFBC8859E5D412 (traduct_id), PRIMARY KEY(langues_id, traduct_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE traduct ADD CONSTRAINT FK_98359EDF953C1C61 FOREIGN KEY (source_id) REFERENCES source (id)');
        $this->addSql('ALTER TABLE langues_traduct ADD CONSTRAINT FK_91DFBC8828EAE92 FOREIGN KEY (langues_id) REFERENCES langues (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE langues_traduct ADD CONSTRAINT FK_91DFBC8859E5D412 FOREIGN KEY (traduct_id) REFERENCES traduct (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE langues_projet DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE langues_projet ADD PRIMARY KEY (projet_id, langues_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE langues_traduct DROP FOREIGN KEY FK_91DFBC8859E5D412');
        $this->addSql('DROP TABLE traduct');
        $this->addSql('DROP TABLE langues_traduct');
        $this->addSql('ALTER TABLE langues_projet DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE langues_projet ADD PRIMARY KEY (langues_id, projet_id)');
    }
}
