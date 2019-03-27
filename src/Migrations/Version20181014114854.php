<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181014114854 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE gol (id INT AUTO_INCREMENT NOT NULL, id_jugador INT DEFAULT NULL, id_partido INT DEFAULT NULL, minuto INT NOT NULL, penalti TINYINT(1) NOT NULL, propia_meta TINYINT(1) NOT NULL, INDEX IDX_14B85EAC8CE0C668 (id_jugador), INDEX IDX_14B85EAC90E4DC7B (id_partido), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE gol ADD CONSTRAINT FK_14B85EAC8CE0C668 FOREIGN KEY (id_jugador) REFERENCES jugador (id)');
        $this->addSql('ALTER TABLE gol ADD CONSTRAINT FK_14B85EAC90E4DC7B FOREIGN KEY (id_partido) REFERENCES partido (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE gol');
    }
}
