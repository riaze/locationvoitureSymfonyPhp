<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190211223146 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE membres_brands (membres_id INT NOT NULL, brands_id INT NOT NULL, INDEX IDX_9B6FD61371128C5C (membres_id), INDEX IDX_9B6FD613E9EEC0C7 (brands_id), PRIMARY KEY(membres_id, brands_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE membres_vechicles (membres_id INT NOT NULL, vechicles_id INT NOT NULL, INDEX IDX_15181D8571128C5C (membres_id), INDEX IDX_15181D85F7DE8D6A (vechicles_id), PRIMARY KEY(membres_id, vechicles_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE membres_brands ADD CONSTRAINT FK_9B6FD61371128C5C FOREIGN KEY (membres_id) REFERENCES membres (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE membres_brands ADD CONSTRAINT FK_9B6FD613E9EEC0C7 FOREIGN KEY (brands_id) REFERENCES brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE membres_vechicles ADD CONSTRAINT FK_15181D8571128C5C FOREIGN KEY (membres_id) REFERENCES membres (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE membres_vechicles ADD CONSTRAINT FK_15181D85F7DE8D6A FOREIGN KEY (vechicles_id) REFERENCES vechicles (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE brands_membres');
        $this->addSql('ALTER TABLE booking ADD vechicles_id INT DEFAULT NULL, ADD brands_id INT NOT NULL');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDEF7DE8D6A FOREIGN KEY (vechicles_id) REFERENCES vechicles (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDEE9EEC0C7 FOREIGN KEY (brands_id) REFERENCES brands (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E00CEDDEF7DE8D6A ON booking (vechicles_id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDEE9EEC0C7 ON booking (brands_id)');
        $this->addSql('ALTER TABLE vechicles DROP FOREIGN KEY FK_8EB81B903301C60');
        $this->addSql('ALTER TABLE brands DROP FOREIGN KEY FK_8EB81B90E9EEC0C7 FOREIGN KEY (brands_id) REFERENCES brands (id) ON DELETE CASCADE');
        $this->addSql('DROP INDEX IDX_8EB81B903301C60 ON vechicles');
        
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE brands_membres (brands_id INT NOT NULL, membres_id INT NOT NULL, INDEX IDX_8EF7E047E9EEC0C7 (brands_id), INDEX IDX_8EF7E04771128C5C (membres_id), PRIMARY KEY(brands_id, membres_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE brands_membres ADD CONSTRAINT FK_8EF7E04771128C5C FOREIGN KEY (membres_id) REFERENCES membres (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE brands_membres ADD CONSTRAINT FK_8EF7E047E9EEC0C7 FOREIGN KEY (brands_id) REFERENCES brands (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE membres_brands');
        $this->addSql('DROP TABLE membres_vechicles');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDEF7DE8D6A');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDEE9EEC0C7');
        $this->addSql('DROP INDEX UNIQ_E00CEDDEF7DE8D6A ON booking');
        $this->addSql('DROP INDEX IDX_E00CEDDEE9EEC0C7 ON booking');
        $this->addSql('ALTER TABLE booking DROP vechicles_id, DROP brands_id');
        $this->addSql('ALTER TABLE vechicles ADD booking_id INT DEFAULT NULL, CHANGE brands_id brands_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vechicles ADD CONSTRAINT FK_8EB81B903301C60 FOREIGN KEY (booking_id) REFERENCES booking (id)');
        $this->addSql('CREATE INDEX IDX_8EB81B903301C60 ON vechicles (booking_id)');
    }
}
