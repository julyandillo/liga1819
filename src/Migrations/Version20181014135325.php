<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181014135325 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE estadistica (id INT AUTO_INCREMENT NOT NULL, id_equipo INT DEFAULT NULL, id_jornada SMALLINT DEFAULT NULL, puntos INT NOT NULL, jugados INT NOT NULL, ganados INT NOT NULL, ganados_local INT NOT NULL, ganados_visitante INT NOT NULL, empatados INT NOT NULL, empatados_local INT NOT NULL, empatados_visitante INT NOT NULL, perdidos INT NOT NULL, perdidos_local INT NOT NULL, perdidos_visitante INT NOT NULL, goles_favor INT NOT NULL, goles_favor_local INT NOT NULL, goles_favor_visitante INT NOT NULL, goles_contra INT NOT NULL, goles_contra_local INT NOT NULL, goles_contra_visitante INT NOT NULL, UNIQUE INDEX UNIQ_DF3A8544E2ABE6E6 (id_equipo), UNIQUE INDEX UNIQ_DF3A8544BF4FB5CF (id_jornada), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE estadistica ADD CONSTRAINT FK_DF3A8544E2ABE6E6 FOREIGN KEY (id_equipo) REFERENCES equipo (id)');
        $this->addSql('ALTER TABLE estadistica ADD CONSTRAINT FK_DF3A8544BF4FB5CF FOREIGN KEY (id_jornada) REFERENCES jornada (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE estadistica');
    }
}
