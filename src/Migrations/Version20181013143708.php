<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181013143708 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE equipo (id INT AUTO_INCREMENT NOT NULL, id_estadio INT DEFAULT NULL, nombre VARCHAR(100) NOT NULL, escudo VARCHAR(20) NOT NULL, entrenador VARCHAR(100) NOT NULL, fundacion INT NOT NULL, UNIQUE INDEX UNIQ_C49C530BBEED7391 (id_estadio), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE equipo ADD CONSTRAINT FK_C49C530BBEED7391 FOREIGN KEY (id_estadio) REFERENCES estadio (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE equipo');
    }
}
