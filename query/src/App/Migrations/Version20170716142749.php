<?php

namespace App\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170716142749 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql(
            'CREATE VIEW account_current_balance AS
                SELECT a.id, a.name, SUM(a.initial_balance) + SUM(m.value) AS current_balance
                    FROM account a
                    INNER JOIN movement m
                        ON m.account_id = a.id
                    GROUP BY a.id, a.name'
        );
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('DROP VIEW account_current_balance');
    }
}
