<?php

declare(strict_types=1);

namespace <namespace>;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use RuntimeException;

final class <className> extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('select true');
    }

    public function down(Schema $schema): void
    {
        throw new RuntimeException('Nothing to see here…');
    }
}
