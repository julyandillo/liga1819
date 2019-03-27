<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181014112832 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE partido ADD id_equipo_local INT DEFAULT NULL, ADD id_equipo_visitante INT DEFAULT NULL');
        $this->addSql('ALTER TABLE partido ADD CONSTRAINT FK_4E79750B566B345E FOREIGN KEY (id_equipo_local) REFERENCES equipo (id)');
        $this->addSql('ALTER TABLE partido ADD CONSTRAINT FK_4E79750BBE31F08D FOREIGN KEY (id_equipo_visitante) REFERENCES equipo (id)');
        $this->addSql('CREATE INDEX IDX_4E79750B566B345E ON partido (id_equipo_local)');
        $this->addSql('CREATE INDEX IDX_4E79750BBE31F08D ON partido (id_equipo_visitante)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE partido DROP FOREIGN KEY FK_4E79750B566B345E');
        $this->addSql('ALTER TABLE partido DROP FOREIGN KEY FK_4E79750BBE31F08D');
        $this->addSql('DROP INDEX IDX_4E79750B566B345E ON partido');
        $this->addSql('DROP INDEX IDX_4E79750BBE31F08D ON partido');
        $this->addSql('ALTER TABLE partido DROP id_equipo_local, DROP id_equipo_visitante');
    }
}
