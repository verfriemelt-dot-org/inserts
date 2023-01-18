<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use RuntimeException;

final class Version20230118214459 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA if not exists docker');
    }

    public function down(Schema $schema): void
    {
        throw new RuntimeException('Nothing to see here…');
    }
}
