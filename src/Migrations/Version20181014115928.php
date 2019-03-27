<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181014115928 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tarjeta (id INT AUTO_INCREMENT NOT NULL, id_jugador INT DEFAULT NULL, id_partido INT DEFAULT NULL, minuto INT NOT NULL, tipo SMALLINT NOT NULL, INDEX IDX_AE90B7868CE0C668 (id_jugador), INDEX IDX_AE90B78690E4DC7B (id_partido), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tarjeta ADD CONSTRAINT FK_AE90B7868CE0C668 FOREIGN KEY (id_jugador) REFERENCES jugador (id)');
        $this->addSql('ALTER TABLE tarjeta ADD CONSTRAINT FK_AE90B78690E4DC7B FOREIGN KEY (id_partido) REFERENCES partido (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE tarjeta');
    }
}
