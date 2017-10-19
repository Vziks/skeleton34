<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171019102355 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE adw_geoip_ipgeobase_location (id INT AUTO_INCREMENT NOT NULL, country VARCHAR(255) DEFAULT NULL, country_fullname VARCHAR(255) DEFAULT NULL, code VARCHAR(255) NOT NULL, region VARCHAR(255) DEFAULT NULL, district VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, longitude DOUBLE PRECISION DEFAULT NULL, latitude DOUBLE PRECISION DEFAULT NULL, ip_min BIGINT NOT NULL, ip_max BIGINT NOT NULL, INDEX search_geoip_range (ip_min, ip_max), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seo_redirect_rules (id VARCHAR(255) NOT NULL, source_template VARCHAR(255) NOT NULL, destination VARCHAR(255) NOT NULL, code INT NOT NULL, priority INT NOT NULL, stopped TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seo_rules (id VARCHAR(255) NOT NULL, pattern VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, meta_tags LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', extra LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', priority INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE adw_geoip_ipgeobase_location');
        $this->addSql('DROP TABLE seo_redirect_rules');
        $this->addSql('DROP TABLE seo_rules');
    }
}
