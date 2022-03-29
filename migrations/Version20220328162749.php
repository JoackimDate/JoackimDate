<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220328162749 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT NOT NULL, cni VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enregistrement (id INT AUTO_INCREMENT NOT NULL, cree_par VARCHAR(255) NOT NULL, cree_le DATE NOT NULL, modifie_par VARCHAR(255) NOT NULL, modifie_le DATE NOT NULL, enable TINYINT(1) NOT NULL, dtype VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gerant (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne (id INT NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, telephone INT NOT NULL, nom_utilisateur VARCHAR(100) NOT NULL, mot_de_passe VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vente (id INT NOT NULL, voiture_id INT NOT NULL, client_id INT NOT NULL, date_vente DATE NOT NULL, montant INT NOT NULL, UNIQUE INDEX UNIQ_888A2A4C181A8BA (voiture_id), INDEX IDX_888A2A4C19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voiture (id INT NOT NULL, marque VARCHAR(100) NOT NULL, modele VARCHAR(100) NOT NULL, numero_identifiant INT NOT NULL, numero_serie INT NOT NULL, date_achat DATE NOT NULL, couleur VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D76BF396750 FOREIGN KEY (id) REFERENCES enregistrement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455BF396750 FOREIGN KEY (id) REFERENCES enregistrement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gerant ADD CONSTRAINT FK_D1D45C70BF396750 FOREIGN KEY (id) REFERENCES enregistrement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EFBF396750 FOREIGN KEY (id) REFERENCES enregistrement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vente ADD CONSTRAINT FK_888A2A4C181A8BA FOREIGN KEY (voiture_id) REFERENCES voiture (id)');
        $this->addSql('ALTER TABLE vente ADD CONSTRAINT FK_888A2A4C19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE vente ADD CONSTRAINT FK_888A2A4CBF396750 FOREIGN KEY (id) REFERENCES enregistrement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810FBF396750 FOREIGN KEY (id) REFERENCES enregistrement (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vente DROP FOREIGN KEY FK_888A2A4C19EB6921');
        $this->addSql('ALTER TABLE admin DROP FOREIGN KEY FK_880E0D76BF396750');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455BF396750');
        $this->addSql('ALTER TABLE gerant DROP FOREIGN KEY FK_D1D45C70BF396750');
        $this->addSql('ALTER TABLE personne DROP FOREIGN KEY FK_FCEC9EFBF396750');
        $this->addSql('ALTER TABLE vente DROP FOREIGN KEY FK_888A2A4CBF396750');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810FBF396750');
        $this->addSql('ALTER TABLE vente DROP FOREIGN KEY FK_888A2A4C181A8BA');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE enregistrement');
        $this->addSql('DROP TABLE gerant');
        $this->addSql('DROP TABLE personne');
        $this->addSql('DROP TABLE vente');
        $this->addSql('DROP TABLE voiture');
    }
}
