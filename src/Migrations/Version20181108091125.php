<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181108091125 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, id_figure_id INT NOT NULL, comment LONGTEXT NOT NULL, creation_date DATETIME NOT NULL, id_user INT NOT NULL, INDEX IDX_9474526C85F5AD92 (id_figure_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE figure (id INT AUTO_INCREMENT NOT NULL, group_id INT NOT NULL, name VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, create_date DATETIME NOT NULL, INDEX IDX_2F57B37AFE54D947 (group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `group` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, comment LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, type INT NOT NULL, id_figure INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, pseudo VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, picture_path VARCHAR(255) NOT NULL, login VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, role INT NOT NULL, last_connection DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C85F5AD92 FOREIGN KEY (id_figure_id) REFERENCES figure (id)');
        $this->addSql('ALTER TABLE figure ADD CONSTRAINT FK_2F57B37AFE54D947 FOREIGN KEY (group_id) REFERENCES `group` (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C85F5AD92');
        $this->addSql('ALTER TABLE figure DROP FOREIGN KEY FK_2F57B37AFE54D947');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE figure');
        $this->addSql('DROP TABLE `group`');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE user');
    }
}
