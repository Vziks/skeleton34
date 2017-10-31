<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171031135713 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE classification__category_audit (id INT NOT NULL, rev INT NOT NULL, parent_id INT DEFAULT NULL, context VARCHAR(255) DEFAULT NULL, media_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, enabled TINYINT(1) DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, position INT DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, revtype VARCHAR(4) NOT NULL, INDEX rev_4725bc84db5356e6585cf5f842a76074_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classification__collection_audit (id INT NOT NULL, rev INT NOT NULL, context VARCHAR(255) DEFAULT NULL, media_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, enabled TINYINT(1) DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, revtype VARCHAR(4) NOT NULL, INDEX rev_30c2a45a4e0bc156e9330793e9c979bb_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classification__context_audit (id VARCHAR(255) NOT NULL, rev INT NOT NULL, name VARCHAR(255) DEFAULT NULL, enabled TINYINT(1) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, revtype VARCHAR(4) NOT NULL, INDEX rev_a13a4c1bb983bb0c771d1c3f946f20e8_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classification__tag_audit (id INT NOT NULL, rev INT NOT NULL, context VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, enabled TINYINT(1) DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, revtype VARCHAR(4) NOT NULL, INDEX rev_8b50432c424afcd2a3e0c8bc06435ab9_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media__gallery_audit (id INT NOT NULL, rev INT NOT NULL, name VARCHAR(255) DEFAULT NULL, context VARCHAR(64) DEFAULT NULL, default_format VARCHAR(255) DEFAULT NULL, enabled TINYINT(1) DEFAULT NULL, updated_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, revtype VARCHAR(4) NOT NULL, INDEX rev_1ab07bc767a1d240bce23cc5a6c72fe2_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media__gallery_media_audit (id INT NOT NULL, rev INT NOT NULL, gallery_id INT DEFAULT NULL, media_id INT DEFAULT NULL, position INT DEFAULT NULL, enabled TINYINT(1) DEFAULT NULL, updated_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, revtype VARCHAR(4) NOT NULL, INDEX rev_e37fe6790d24ff70dcc7da52631a2b6d_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media__media_audit (id INT NOT NULL, rev INT NOT NULL, category_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, description TEXT DEFAULT NULL, enabled TINYINT(1) DEFAULT NULL, provider_name VARCHAR(255) DEFAULT NULL, provider_status INT DEFAULT NULL, provider_reference VARCHAR(255) DEFAULT NULL, provider_metadata LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', width INT DEFAULT NULL, height INT DEFAULT NULL, length NUMERIC(10, 0) DEFAULT NULL, content_type VARCHAR(255) DEFAULT NULL, content_size INT DEFAULT NULL, copyright VARCHAR(255) DEFAULT NULL, author_name VARCHAR(255) DEFAULT NULL, context VARCHAR(64) DEFAULT NULL, cdn_is_flushable TINYINT(1) DEFAULT NULL, cdn_flush_identifier VARCHAR(64) DEFAULT NULL, cdn_flush_at DATETIME DEFAULT NULL, cdn_status INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, revtype VARCHAR(4) NOT NULL, INDEX rev_7e85041618e08087eb9a0547f7c4b521_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE adw_config_site_audit (id INT NOT NULL, rev INT NOT NULL, name VARCHAR(255) DEFAULT NULL, turn_off TINYINT(1) DEFAULT NULL, allowips LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', start_at DATETIME DEFAULT NULL, stop_at DATETIME DEFAULT NULL, revtype VARCHAR(4) NOT NULL, INDEX rev_6b70b1106cffc9190be41e9074331764_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seo_rules_audit (id VARCHAR(255) NOT NULL, rev INT NOT NULL, pattern VARCHAR(255) DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, meta_tags LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', extra LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', priority INT DEFAULT NULL, revtype VARCHAR(4) NOT NULL, INDEX rev_617bf3eeb61de74552dbd6656f92bd2f_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE admin__user_audit (id INT NOT NULL, rev INT NOT NULL, email VARCHAR(255) DEFAULT NULL, password VARCHAR(255) DEFAULT NULL, password_updated_at DATETIME DEFAULT NULL, roles LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, revtype VARCHAR(4) NOT NULL, INDEX rev_aacc521db203f1af5149ef310e40bd99_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE revisions (id INT AUTO_INCREMENT NOT NULL, timestamp DATETIME NOT NULL, username VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE classification__category_audit');
        $this->addSql('DROP TABLE classification__collection_audit');
        $this->addSql('DROP TABLE classification__context_audit');
        $this->addSql('DROP TABLE classification__tag_audit');
        $this->addSql('DROP TABLE media__gallery_audit');
        $this->addSql('DROP TABLE media__gallery_media_audit');
        $this->addSql('DROP TABLE media__media_audit');
        $this->addSql('DROP TABLE adw_config_site_audit');
        $this->addSql('DROP TABLE seo_rules_audit');
        $this->addSql('DROP TABLE admin__user_audit');
        $this->addSql('DROP TABLE revisions');
    }
}
