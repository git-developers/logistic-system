<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180502170748 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE requerimiento (id_increment INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, user_id INT DEFAULT NULL, code VARCHAR(45) DEFAULT NULL, compania VARCHAR(45) DEFAULT NULL, numero VARCHAR(45) DEFAULT NULL, prioridad VARCHAR(45) DEFAULT NULL, almacen VARCHAR(45) DEFAULT NULL, fecha_requerida DATE DEFAULT NULL, estado VARCHAR(45) DEFAULT NULL, name VARCHAR(150) DEFAULT NULL, comment VARCHAR(150) DEFAULT NULL, slug VARCHAR(150) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, INDEX IDX_54E9241212469DE2 (category_id), UNIQUE INDEX UNIQ_54E92412A76ED395 (user_id), UNIQUE INDEX code_UNIQUE (code), PRIMARY KEY(id_increment)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session (id_increment INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, token VARCHAR(45) DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME DEFAULT NULL, active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_D044D5D4A76ED395 (user_id), PRIMARY KEY(id_increment)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proveedor (id_increment INT AUTO_INCREMENT NOT NULL, code VARCHAR(45) DEFAULT NULL, razon_social VARCHAR(45) DEFAULT NULL, ruc VARCHAR(45) DEFAULT NULL, image TEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, PRIMARY KEY(id_increment)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, profile_id INT DEFAULT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', client_id INT DEFAULT NULL, code VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, device_code VARCHAR(100) DEFAULT NULL, dni VARCHAR(8) DEFAULT NULL, name VARCHAR(100) NOT NULL, last_name VARCHAR(100) DEFAULT NULL, dob DATE DEFAULT NULL, address VARCHAR(100) DEFAULT NULL, phone VARCHAR(45) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, is_active TINYINT(1) NOT NULL, last_access DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D64992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_8D93D649A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_8D93D649C05FB297 (confirmation_token), INDEX FK_8D93D649CCFA12B8 (profile_id), UNIQUE INDEX email_UNIQUE (email), UNIQUE INDEX username_UNIQUE (username), UNIQUE INDEX dni_UNIQUE (dni), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quotation_main (id INT AUTO_INCREMENT NOT NULL, proveedor_id INT DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, requerimiento_id INT DEFAULT NULL, estado VARCHAR(45) DEFAULT NULL, INDEX IDX_22DC6828CB305D73 (proveedor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quotation_main_has_quotation (quotation_main_id INT NOT NULL, quotation_id INT NOT NULL, INDEX IDX_E4347E7E725EAD1A (quotation_main_id), INDEX IDX_E4347E7EB4EA4E60 (quotation_id), PRIMARY KEY(quotation_main_id, quotation_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id_increment INT AUTO_INCREMENT NOT NULL, code VARCHAR(45) DEFAULT NULL, unidad_medida VARCHAR(45) DEFAULT NULL, description VARCHAR(45) DEFAULT NULL, stock INT DEFAULT NULL, name VARCHAR(150) NOT NULL, slug VARCHAR(150) DEFAULT NULL, image TEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, PRIMARY KEY(id_increment)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id_increment INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) DEFAULT NULL, slug VARCHAR(100) NOT NULL, group_rol VARCHAR(100) DEFAULT NULL, group_rol_tag VARCHAR(100) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, is_active TINYINT(1) NOT NULL, PRIMARY KEY(id_increment)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile (id_increment INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, slug VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, PRIMARY KEY(id_increment)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile_has_role (profile_id INT NOT NULL, role_id INT NOT NULL, INDEX IDX_F35F3084CCFA12B8 (profile_id), INDEX IDX_F35F3084D60322AC (role_id), PRIMARY KEY(profile_id, role_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quote (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, requerimiento_id INT DEFAULT NULL, description VARCHAR(45) DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, INDEX IDX_6B71CBF44584665A (product_id), INDEX fk_quote_requerimiento1_idx (requerimiento_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE requerimiento_has_product (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, requerimiento_id INT DEFAULT NULL, stock VARCHAR(45) DEFAULT NULL, INDEX fk_requerimiento_has_product_product1_idx (product_id), INDEX fk_requerimiento_has_product_requerimiento1_idx (requerimiento_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quotation (id INT AUTO_INCREMENT NOT NULL, proveedor_id INT DEFAULT NULL, requerimiento_id INT NOT NULL, product_id INT NOT NULL, forma_pago VARCHAR(45) DEFAULT NULL, monto_total VARCHAR(255) DEFAULT NULL, precio_unitario VARCHAR(255) DEFAULT NULL, cantidad_pedida INT DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, estado VARCHAR(45) DEFAULT NULL, INDEX fk_quotation_proveedor1_idx (proveedor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE requerimiento ADD CONSTRAINT FK_54E9241212469DE2 FOREIGN KEY (category_id) REFERENCES requerimiento (id_increment)');
        $this->addSql('ALTER TABLE requerimiento ADD CONSTRAINT FK_54E92412A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id_increment)');
        $this->addSql('ALTER TABLE quotation_main ADD CONSTRAINT FK_22DC6828CB305D73 FOREIGN KEY (proveedor_id) REFERENCES proveedor (id_increment)');
        $this->addSql('ALTER TABLE quotation_main_has_quotation ADD CONSTRAINT FK_E4347E7E725EAD1A FOREIGN KEY (quotation_main_id) REFERENCES quotation_main (id)');
        $this->addSql('ALTER TABLE quotation_main_has_quotation ADD CONSTRAINT FK_E4347E7EB4EA4E60 FOREIGN KEY (quotation_id) REFERENCES quotation (id)');
        $this->addSql('ALTER TABLE profile_has_role ADD CONSTRAINT FK_F35F3084CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id_increment)');
        $this->addSql('ALTER TABLE profile_has_role ADD CONSTRAINT FK_F35F3084D60322AC FOREIGN KEY (role_id) REFERENCES role (id_increment)');
        $this->addSql('ALTER TABLE quote ADD CONSTRAINT FK_6B71CBF44584665A FOREIGN KEY (product_id) REFERENCES product (id_increment)');
        $this->addSql('ALTER TABLE quote ADD CONSTRAINT FK_6B71CBF451DD0900 FOREIGN KEY (requerimiento_id) REFERENCES requerimiento (id_increment)');
        $this->addSql('ALTER TABLE requerimiento_has_product ADD CONSTRAINT FK_D829677F4584665A FOREIGN KEY (product_id) REFERENCES product (id_increment)');
        $this->addSql('ALTER TABLE requerimiento_has_product ADD CONSTRAINT FK_D829677F51DD0900 FOREIGN KEY (requerimiento_id) REFERENCES requerimiento (id_increment)');
        $this->addSql('ALTER TABLE quotation ADD CONSTRAINT FK_474A8DB9CB305D73 FOREIGN KEY (proveedor_id) REFERENCES proveedor (id_increment)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE requerimiento DROP FOREIGN KEY FK_54E9241212469DE2');
        $this->addSql('ALTER TABLE quote DROP FOREIGN KEY FK_6B71CBF451DD0900');
        $this->addSql('ALTER TABLE requerimiento_has_product DROP FOREIGN KEY FK_D829677F51DD0900');
        $this->addSql('ALTER TABLE quotation_main DROP FOREIGN KEY FK_22DC6828CB305D73');
        $this->addSql('ALTER TABLE quotation DROP FOREIGN KEY FK_474A8DB9CB305D73');
        $this->addSql('ALTER TABLE requerimiento DROP FOREIGN KEY FK_54E92412A76ED395');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D4A76ED395');
        $this->addSql('ALTER TABLE quotation_main_has_quotation DROP FOREIGN KEY FK_E4347E7E725EAD1A');
        $this->addSql('ALTER TABLE quote DROP FOREIGN KEY FK_6B71CBF44584665A');
        $this->addSql('ALTER TABLE requerimiento_has_product DROP FOREIGN KEY FK_D829677F4584665A');
        $this->addSql('ALTER TABLE profile_has_role DROP FOREIGN KEY FK_F35F3084D60322AC');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649CCFA12B8');
        $this->addSql('ALTER TABLE profile_has_role DROP FOREIGN KEY FK_F35F3084CCFA12B8');
        $this->addSql('ALTER TABLE quotation_main_has_quotation DROP FOREIGN KEY FK_E4347E7EB4EA4E60');
        $this->addSql('DROP TABLE requerimiento');
        $this->addSql('DROP TABLE session');
        $this->addSql('DROP TABLE proveedor');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE quotation_main');
        $this->addSql('DROP TABLE quotation_main_has_quotation');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE profile');
        $this->addSql('DROP TABLE profile_has_role');
        $this->addSql('DROP TABLE quote');
        $this->addSql('DROP TABLE requerimiento_has_product');
        $this->addSql('DROP TABLE quotation');
    }
}
