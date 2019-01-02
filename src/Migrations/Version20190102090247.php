<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190102090247 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE langues (id INT AUTO_INCREMENT NOT NULL, langue VARCHAR(64) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE langues_projet (langues_id INT NOT NULL, projet_id INT NOT NULL, INDEX IDX_C7BE0A528EAE92 (langues_id), INDEX IDX_C7BE0A5C18272 (projet_id), PRIMARY KEY(langues_id, projet_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE langues_projet ADD CONSTRAINT FK_C7BE0A528EAE92 FOREIGN KEY (langues_id) REFERENCES langues (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE langues_projet ADD CONSTRAINT FK_C7BE0A5C18272 FOREIGN KEY (projet_id) REFERENCES projet (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE langues_projet DROP FOREIGN KEY FK_C7BE0A528EAE92');
        $this->addSql('DROP TABLE langues');
        $this->addSql('DROP TABLE langues_projet');
    }
}
