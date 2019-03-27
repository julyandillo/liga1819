<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190106131224 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE estadistica ADD CONSTRAINT FK_DF3A8544E2ABE6E6 FOREIGN KEY (id_equipo) REFERENCES equipo (id)');
        $this->addSql('ALTER TABLE estadistica ADD CONSTRAINT FK_DF3A8544BF4FB5CF FOREIGN KEY (id_jornada) REFERENCES jornada (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DF3A8544E2ABE6E6 ON estadistica (id_equipo)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DF3A8544BF4FB5CF ON estadistica (id_jornada)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE estadistica DROP FOREIGN KEY FK_DF3A8544E2ABE6E6');
        $this->addSql('ALTER TABLE estadistica DROP FOREIGN KEY FK_DF3A8544BF4FB5CF');
        $this->addSql('DROP INDEX UNIQ_DF3A8544E2ABE6E6 ON estadistica');
        $this->addSql('DROP INDEX UNIQ_DF3A8544BF4FB5CF ON estadistica');
    }
}
