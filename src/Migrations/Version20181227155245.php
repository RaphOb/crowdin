<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181227155245 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE langue (id INT AUTO_INCREMENT NOT NULL, langue VARCHAR(38) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE langue_source (langue_id INT NOT NULL, source_id INT NOT NULL, INDEX IDX_B9C8BC2AADBACD (langue_id), INDEX IDX_B9C8BC953C1C61 (source_id), PRIMARY KEY(langue_id, source_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE langue_user (langue_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_B11E19E32AADBACD (langue_id), INDEX IDX_B11E19E3A76ED395 (user_id), PRIMARY KEY(langue_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE langue_source ADD CONSTRAINT FK_B9C8BC2AADBACD FOREIGN KEY (langue_id) REFERENCES langue (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE langue_source ADD CONSTRAINT FK_B9C8BC953C1C61 FOREIGN KEY (source_id) REFERENCES source (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE langue_user ADD CONSTRAINT FK_B11E19E32AADBACD FOREIGN KEY (langue_id) REFERENCES langue (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE langue_user ADD CONSTRAINT FK_B11E19E3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE langue_source DROP FOREIGN KEY FK_B9C8BC2AADBACD');
        $this->addSql('ALTER TABLE langue_user DROP FOREIGN KEY FK_B11E19E32AADBACD');
        $this->addSql('DROP TABLE langue');
        $this->addSql('DROP TABLE langue_source');
        $this->addSql('DROP TABLE langue_user');
    }
}
