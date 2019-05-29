<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190511061956 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE booking ADD membres_id INT NOT NULL, ADD vechicles_id INT NOT NULL, ADD brand_id INT NOT NULL');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE71128C5C FOREIGN KEY (membres_id) REFERENCES membres (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDEF7DE8D6A FOREIGN KEY (vechicles_id) REFERENCES vechicles (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE44F5D008 FOREIGN KEY (brand_id) REFERENCES brands (id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDE71128C5C ON booking (membres_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E00CEDDEF7DE8D6A ON booking (vechicles_id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDE44F5D008 ON booking (brand_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE71128C5C');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDEF7DE8D6A');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE44F5D008');
        $this->addSql('DROP INDEX IDX_E00CEDDE71128C5C ON booking');
        $this->addSql('DROP INDEX UNIQ_E00CEDDEF7DE8D6A ON booking');
        $this->addSql('DROP INDEX IDX_E00CEDDE44F5D008 ON booking');
        $this->addSql('ALTER TABLE booking DROP membres_id, DROP vechicles_id, DROP brand_id');
    }
}
