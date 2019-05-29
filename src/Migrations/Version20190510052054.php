<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190510052054 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, membres_id INT DEFAULT NULL, vechicles_id INT DEFAULT NULL, brands_id INT NOT NULL, user_name VARCHAR(50) NOT NULL, user_email VARCHAR(50) NOT NULL, vechicle INT NOT NULL, from_date DATE NOT NULL, to_date DATE NOT NULL, message VARCHAR(100) DEFAULT NULL, status TINYINT(1) NOT NULL, INDEX IDX_E00CEDDE71128C5C (membres_id), UNIQUE INDEX UNIQ_E00CEDDEF7DE8D6A (vechicles_id), INDEX IDX_E00CEDDEE9EEC0C7 (brands_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE brands (id INT AUTO_INCREMENT NOT NULL, brand_name VARCHAR(255) NOT NULL, created_date DATE NOT NULL, updated_date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE membres (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(50) NOT NULL, password VARCHAR(255) NOT NULL, adresse VARCHAR(100) NOT NULL, ville VARCHAR(50) NOT NULL, code_postal INT NOT NULL, pays VARCHAR(50) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vechicles (id INT AUTO_INCREMENT NOT NULL, brands_id INT NOT NULL, vechicle_title VARCHAR(255) NOT NULL, vechilcle_overview VARCHAR(255) NOT NULL, prrice_per_day INT NOT NULL, fuel_type VARCHAR(50) NOT NULL, model_year DATE NOT NULL, seating_capacity INT NOT NULL, vimage1 VARCHAR(50) DEFAULT NULL, vimage2 VARCHAR(50) DEFAULT NULL, vimage VARCHAR(50) DEFAULT NULL, air_conditioner TINYINT(1) DEFAULT NULL, power_door_locks TINYINT(1) DEFAULT NULL, anti_lock_braking TINYINT(1) DEFAULT NULL, break_assist TINYINT(1) DEFAULT NULL, power_steering TINYINT(1) DEFAULT NULL, driver_air_bag TINYINT(1) DEFAULT NULL, reg_date DATE DEFAULT NULL, updation_date DATE DEFAULT NULL, INDEX IDX_8EB81B90E9EEC0C7 (brands_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE71128C5C FOREIGN KEY (membres_id) REFERENCES membres (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDEF7DE8D6A FOREIGN KEY (vechicles_id) REFERENCES vechicles (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDEE9EEC0C7 FOREIGN KEY (brands_id) REFERENCES brands (id)');
        $this->addSql('ALTER TABLE vechicles ADD CONSTRAINT FK_8EB81B90E9EEC0C7 FOREIGN KEY (brands_id) REFERENCES brands (id)');
        $this->addSql('ALTER TABLE membres_brands ADD CONSTRAINT FK_9B6FD61371128C5C FOREIGN KEY (membres_id) REFERENCES membres (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE membres_brands ADD CONSTRAINT FK_9B6FD613E9EEC0C7 FOREIGN KEY (brands_id) REFERENCES brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE membres_vechicles ADD CONSTRAINT FK_15181D8571128C5C FOREIGN KEY (membres_id) REFERENCES membres (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE membres_vechicles ADD CONSTRAINT FK_15181D85F7DE8D6A FOREIGN KEY (vechicles_id) REFERENCES vechicles (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDEE9EEC0C7');
        $this->addSql('ALTER TABLE membres_brands DROP FOREIGN KEY FK_9B6FD613E9EEC0C7');
        $this->addSql('ALTER TABLE vechicles DROP FOREIGN KEY FK_8EB81B90E9EEC0C7');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE71128C5C');
        $this->addSql('ALTER TABLE membres_brands DROP FOREIGN KEY FK_9B6FD61371128C5C');
        $this->addSql('ALTER TABLE membres_vechicles DROP FOREIGN KEY FK_15181D8571128C5C');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDEF7DE8D6A');
        $this->addSql('ALTER TABLE membres_vechicles DROP FOREIGN KEY FK_15181D85F7DE8D6A');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE brands');
        $this->addSql('DROP TABLE membres');
        $this->addSql('DROP TABLE vechicles');
    }
}
