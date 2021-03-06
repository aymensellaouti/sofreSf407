<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190717133957 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE etudiant (id INT AUTO_INCREMENT NOT NULL, status VARCHAR(255) NOT NULL, establishment VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formateur (id INT AUTO_INCREMENT NOT NULL, speciality VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, formateur_id INT DEFAULT NULL, designation VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, etat INT NOT NULL, INDEX IDX_404021BF155D8F51 (formateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation_topic (formation_id INT NOT NULL, topic_id INT NOT NULL, INDEX IDX_EBCB406E5200282E (formation_id), INDEX IDX_EBCB406E1F55203D (topic_id), PRIMARY KEY(formation_id, topic_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation_etudiant (formation_id INT NOT NULL, etudiant_id INT NOT NULL, INDEX IDX_B6EC75125200282E (formation_id), INDEX IDX_B6EC7512DDEAB1A3 (etudiant_id), PRIMARY KEY(formation_id, etudiant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE topic (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BF155D8F51 FOREIGN KEY (formateur_id) REFERENCES formateur (id)');
        $this->addSql('ALTER TABLE formation_topic ADD CONSTRAINT FK_EBCB406E5200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation_topic ADD CONSTRAINT FK_EBCB406E1F55203D FOREIGN KEY (topic_id) REFERENCES topic (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation_etudiant ADD CONSTRAINT FK_B6EC75125200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation_etudiant ADD CONSTRAINT FK_B6EC7512DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE formation_etudiant DROP FOREIGN KEY FK_B6EC7512DDEAB1A3');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BF155D8F51');
        $this->addSql('ALTER TABLE formation_topic DROP FOREIGN KEY FK_EBCB406E5200282E');
        $this->addSql('ALTER TABLE formation_etudiant DROP FOREIGN KEY FK_B6EC75125200282E');
        $this->addSql('ALTER TABLE formation_topic DROP FOREIGN KEY FK_EBCB406E1F55203D');
        $this->addSql('DROP TABLE etudiant');
        $this->addSql('DROP TABLE formateur');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE formation_topic');
        $this->addSql('DROP TABLE formation_etudiant');
        $this->addSql('DROP TABLE topic');
    }
}
